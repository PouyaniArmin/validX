<?php

namespace Validx\Rules;

use Error;
use Exception;
use PDO;
use Validx\Message\ErrorMessage;

class UniqueRule implements RuleInterface
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function validate(array $data, string $field, ...$params): bool
    {
        $table = $params[0];
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
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::UNIQUE->getMessage(), $field);
    }
}
