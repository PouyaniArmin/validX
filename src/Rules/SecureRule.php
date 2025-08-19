<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * SecureRule
 * 
 * Validates that a given field meets a strong password/security pattern:
 * - At least 8 characters
 * - Contains at least one uppercase letter
 * - Contains at least one lowercase letter
 * - Contains at least one number
 * - Contains at least one special character (!@#$%&*)
 */
class SecureRule implements RuleInterface
{

    /**
     * Validate the field against the secure pattern.
     *
     * @param array $data Input data array
     * @param string $field Field name to validate
     * @param mixed ...$params Additional parameters (not used)
     * 
     * @return bool True if the field matches the secure pattern, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool
    {

        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%&*]).{8,}$/";
        if (preg_match($pattern, $data[$field], $matches)) {
            return true;
        }
        return false;
    }
    /**
     * Get the error message when the field does not meet the secure criteria.
     *
     * @param string $field Field name
     * @param mixed ...$params Not used
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::SECURE->getMessage(), $field, $params);
    }
}
