<?php
namespace Validx\Exceptions;

use Exception;


class InvalidRuleException extends Exception implements ExecptionInterface{

    public static function throwWith(string $context): void
    {
        throw new self($context);
    }
}