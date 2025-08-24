<?php

namespace Validx\Rules;

use Error;
use Validx\Message\ErrorMessage;

/**
 * IntegerRule
 * 
 * Validates that a given field's value is an integer.
 */
class IntegerRule implements RuleInterface
{
    /**
     * Validate if the field's value is an integer.
     *
     *@param array<string, mixed> $data
     * @param string $field Field name to validate
     * @param mixed ...$params Not used
     * 
     * @return bool True if value is an integer, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field])) {
            return false;
        }
        $pattern = '/^[-+]?\d+$/';
        if (preg_match($pattern, $data[$field])) {
            return true;
        }
        return false;
    }
    /**
     * Get the error message for non-integer values.
     *
     * @param string $field Field name
     * @param mixed ...$params Not used
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::INTEGER->getMessage(), $field);
    }
}
