<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * InRule
 * 
 * Validates that a given field's value is one of the allowed values.
 */
class InRule implements RuleInterface
{
    /**
     * Validate if the field's value exists in the allowed list.
     *
     * @param array<string, mixed> $data
     * @param string $field Field name to validate
     * @param mixed ...$params Allowed values
     * 
     * @return bool True if value is allowed, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field])) {
            return false;
        }
        foreach ($params as $value) {
            if ($data[$field] == $value) {
                return true;
            }
        }
        return false;
    }
    /**
     * Get the error message for invalid values.
     *
     * @param string $field Field name
     * @param mixed ...$params Allowed values (not used in message)
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::IN->getMessage(), $field);
    }
}
