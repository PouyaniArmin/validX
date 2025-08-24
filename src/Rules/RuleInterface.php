<?php


namespace Validx\Rules;

use ReflectionFunctionAbstract;

/**
 * Interface for all validation rules.
 * Each rule must implement a validation check
 * and return an error message when validation fails.
 */
interface RuleInterface
{
    /**
     * Validates the given field in the provided data.
     *
     * @param array<string, mixed> $data   The full dataset being validated
     * @param string $field         The field name to validate
     * @param mixed ...$params      Additional parameters for the rule
     * @return bool True if validation passes, false otherwise
     */
    public function validate(array $data, string $field, ...$params): bool;
    /**
     * Returns the error message if validation fails.
     *
     * @param string $field  The field name being validated
     * @param mixed ...$params Parameters to format the message
     * @return string The error message
     */
    public function message(string $field, ...$params): string;
}
