<?php

namespace Validx\Exceptions;

/**
 * Interface for all custom exception classes in Validx.
 * Ensures a standardized static method to throw exceptions with context.
 */
interface ExceptionInterface{
      /**
     * Throws the exception with a given context message.
     *
     * @param string $context Description of the error or context
     * @return void
     */
    public static function throwWith(string $context):void;
}