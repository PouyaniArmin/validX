<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * NumericRule
 * 
 * Validates that a given field contains only numeric characters (digits).
 */

class NumericRule implements RuleInterface
{
    /**
     * Validate if the field contains only numbers.
     *
     * @param array<string, mixed> $data
     * @param string $field Field name to validate
     * @param mixed ...$params Additional parameters (not used here)
     * 
     * @return bool True if the field contains only digits, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field]) || !is_string($data[$field])) {
            return false;
        }
        $pattern = '/\A[0-9]+\z/u';
        if (preg_match($pattern, $data[$field])) {
            return true;
        }
        return false;
    }
    /**
     * Get the error message when the field is not numeric.
     *
     * @param string $field Field name
     * @param mixed ...$params Not used
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::NUMERIC->getMessage(), $field);
    }
}
