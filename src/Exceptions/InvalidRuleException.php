<?php

namespace Validx\Exceptions;

use Exception;

/**
 * Exception thrown when an invalid validation rule is used.
 * Implements ExecptionInterface to provide standardized throwWith() method.
 */
class InvalidRuleException extends Exception implements ExecptionInterface
{
    /**
     * Throws an InvalidRuleException with the provided context message.
     *
     * @param string $context Description of why the rule is invalid
     * @return void
     * @throws InvalidRuleException
     */
    public static function throwWith(string $context): void
    {
        throw new self($context);
    }
}
