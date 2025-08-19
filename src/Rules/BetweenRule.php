<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * Validation rule to check if the length of a field
 * is between a given minimum and maximum value.
 */
class BetweenRule implements RuleInterface
{
    /**
     * Validates whether the field's length is within the given range.
     *
     * @param array $data   The dataset being validated
     * @param string $field The field name to validate
     * @param mixed ...$params Expected: [min, max]
     * @return bool True if the field's length is within the range, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {
        if (strlen($data[$field]) < $params[0] || strlen($data[$field]) > $params[1]) {
            return false;
        }
        return true;
    }
    /**
     * Returns the error message if validation fails.
     *
     * @param string $field The field name being validated
     * @param mixed ...$params Expected: [min, max]
     * @return string The error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::BETWEEN->getMessage(), $field, $params[0], $params[1]);
    }
}
