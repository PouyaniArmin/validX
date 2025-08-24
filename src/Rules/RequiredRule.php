<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;


/**
 * RequiredRule
 * 
 * Validates that a given field is present and not empty.
 */
class RequiredRule implements RuleInterface
{
    /**
     * Validate if the field is set and not an empty string.
     *
     * @param array<string, mixed> $data
     * @param string $field Field name to validate
     * @param mixed ...$params Additional parameters (not used)
     * 
     * @return bool True if the field is present and not empty, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        return isset($data[$field]) && $data[$field] !== '';
    }
    /**
     * Get the error message when the field is missing or empty.
     *
     * @param string $field Field name
     * @param mixed ...$params Not used
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::REQUIRED->getMessage(), ucfirst($field));
    }
}
