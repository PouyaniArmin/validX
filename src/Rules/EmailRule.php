<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * EmailRule
 * 
 * Validates whether a given field contains a valid email address.
 */
class EmailRule implements RuleInterface
{
    /**
     * Validate if the field value is a valid email address.
     *
     * @param array<string, mixed> $data
     * @param string $field Field name to validate
     * @param mixed ...$params Additional parameters (not used here)
     * 
     * @return bool True if valid email, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field])) {
            return false;
        }
        return filter_var($data[$field], FILTER_VALIDATE_EMAIL)!==false;
    }
    /**
     * Get the error message for invalid email values.
     *
     * @param string $field Field name
     * @param mixed ...$params Additional parameters (not used here)
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::EMAIL->getMessage(), ucfirst($field));
    }
}
