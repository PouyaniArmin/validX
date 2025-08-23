<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * MinRule
 * 
 * Validates that the length of a given field meets the specified minimum.
 */
class MinRule implements RuleInterface
{
    /**
     * Validate if the field's length is greater than or equal to the minimum required length.
     *
     * @param array $data   Input data array
     * @param string $field Field name to validate
     * @param mixed ...$params First parameter should be the minimum length
     * 
     * @return bool True if field length is valid, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {

        $value = isset($data[$field]) ? trim($data[$field]) : '';
        if ($value === '') {
            return false;
        }
        if (mb_strlen($value) < $params[0]) {
            return false;
        }
        return true;
    }

    /**
     * Get the error message when the field length is below the minimum required.
     *
     * @param string $field Field name
     * @param mixed ...$params Minimum length parameter
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {

        return sprintf(ErrorMessage::MIN->getMessage(), $field, $params[0]);
    }
}
