<?php

namespace Validx\Exceptions;

use Exception;

/**
 * Exception thrown when a required validation method is missing.
 * Implements ExecptionInterface to provide standardized throwWith() method.
 */
class MissingValidateMethodException extends Exception implements ExecptionInterface
{
    /**
     * Throws a MissingValidateMethodException with the provided context message.
     *
     * @param string $context Description of the missing method
     * @return void
     * @throws MissingValidateMethodException
     */
    public static function throwWith(string $context): void
    {
        throw new self($context);
    }
}
