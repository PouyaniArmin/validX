<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * Validation rule to check if a field contains only
 * alphanumeric characters (letters and numbers).
 */
class AlphanumericRule implements RuleInterface
{
    /**
     * Validates whether the given field contains only letters and numbers.
     *
     * @param array<string, string|null> $data
     * @param string $field The field name to validate
     * @param mixed ...$params Not used in this rule
     * @return bool True if the value is alphanumeric, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        if (!is_string($data[$field])) {
            return false;
        }
        $pattern = '/^[A-Za-z0-9]+$/';
        if (preg_match($pattern, $data[$field])) {
            return true;
        }
        return false;
    }
    /**
     * Returns the error message if validation fails.
     *
     * @param string $field The field name being validated
     * @param mixed ...$params Not used in this rule
     * @return string The error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::ALPHANUMERIC->getMessage(), $field);
    }
}
