<?php


namespace Validx\Rules;

use DateTime;
use Validx\Message\ErrorMessage;

/**
 * DateRule
 * 
 * Validates whether a given field contains a valid date in the format 'Y-m-d'.
 */
class DateRule implements RuleInterface
{

    /**
     * Validate if the field value is a valid date.
     *
     * @param array $data   Input data array
     * @param string $field Field name to validate
     * @param mixed ...$params Additional parameters (not used here)
     * 
     * @return bool True if valid date, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        $value = $data[$field] ?? null;
        if (!is_string($value) || empty($value)) {
            return false;
        }
        if (is_array($data[$field])) {
            return false;
        }
        $date = DateTime::createFromFormat('Y-m-d', $value);
        if ($date && $date->format('Y-m-d') == $value) {
            return true;
        }
        return false;
    }

    /**
     * Get the error message for invalid date values.
     *
     * @param string $field Field name
     * @param mixed ...$params Additional parameters (not used here)
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::DATE->getMessage(), $field);
    }
}
