<?php

namespace Validx\Rules;

use Error;
use Exception;
use PDO;
use Validx\Message\ErrorMessage;

/**
 * UniqueRule
 * 
 * Validates that a given field's value is unique in a specified database table.
 * Requires a PDO database connection to check existing records.
 */
class UniqueRule implements RuleInterface
{
    /**
     * @var PDO $db The PDO database connection
     */
    protected $db;
    /**
     * Constructor
     *
     * @param PDO $db PDO database connection
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
    /**
     * Validate that the field value does not already exist in the table.
     *
     * @param array $data Input data array
     * @param string $field Field name to validate
     * @param mixed ...$params Parameters where the first one must be the table name
     * 
     * @return bool True if the value is unique, false otherwise
     * @throws Exception If table name is not provided
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        $table = $params[0] ?? null;
        if (!$table) {
            throw new Exception("Table name must be provided for UniqueRule.");
        }
        $value = $data[$field] ?? null;
        if ($value === null) {
            return false;
        }
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM {$table} WHERE {$field} = :$field");
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result[0]['count']) {
            return false;
        }
        return true;
    }
    /**
     * Get the error message when the field value is not unique.
     *
     * @param string $field Field name
     * @param mixed ...$params Not used
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::UNIQUE->getMessage(), $field);
    }
}
