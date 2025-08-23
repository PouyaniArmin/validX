<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * MaxRule
 * 
 * Validates that the length of a given field does not exceed the specified maximum.
 */
class MaxRule implements RuleInterface
{
    /**
     * Validate if the field's length is less than or equal to the maximum allowed length.
     *
     * @param array $data   Input data array
     * @param string $field Field name to validate
     * @param mixed ...$params First parameter should be the maximum length
     * 
     * @return bool True if field length is valid, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        $value = isset($data[$field]) ? trim($data[$field]) : '';
        if ($value === '') {
            return false;
        }
        if (!empty($value)) {
            if (mb_strlen($value) > $params[0]) {
                return false;
            }
        }
        return true;
    }
    /**
     * Get the error message when the field exceeds the maximum length.
     *
     * @param string $field Field name
     * @param mixed ...$params Maximum length parameter
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::MAX->getMessage(), $field, $params[0]);
    }
}
