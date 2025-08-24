<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * UrlRule
 * 
 * Validates that a given field contains a properly formatted URL.
 */
class UrlRule implements RuleInterface
{
    /**
     * @param array<string, string> $data Input data array
     * @param string $field Field name to validate
     * @param mixed ...$params Additional parameters (not used)
     *
     * @return bool True if the value is a valid URL, false otherwise
     */

    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field])) {
            return false;
        }
        return filter_var($data[$field], FILTER_VALIDATE_URL);
    }
    /**
     * Get the error message when the field value is not a valid URL.
     *
     * @param string $field Field name
     * @param mixed ...$params Additional parameters (not used)
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::URL->getMessage(), $field);
    }
}
