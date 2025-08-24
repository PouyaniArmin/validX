<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * PhoneRule
 * 
 * Validates that a given field contains a valid phone number.
 * Supports optional '+' prefix and allows 5 to 17 digits.
 */
class PhoneRule implements RuleInterface
{
    /**
     * Validate if the field is a valid phone number.
     *
     *@param array<string, mixed> $data
     * @param string $field Field name to validate
     * @param mixed ...$params Additional parameters (not used here)
     * 
     * @return bool True if valid phone number, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field]) || !is_string($data[$field])) {
            return false;
        }
        $pattern = '/^\+?\d{5,17}\z/';
        if (preg_match($pattern, $data[$field])) {
            return true;
        }
        return false;
    }
    /**
     * Get the error message when the field is not a valid phone number.
     *
     * @param string $field Field name
     * @param mixed ...$params Not used
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::PHONE->getMessage(), $field);
    }
}
