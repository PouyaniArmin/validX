<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class AlphanumericRule implements RuleInterface
{
    public function validate(array $data, string $field, ...$params): bool
    {
        $pattern = '/^[A-Za-z0-9]+$/';
        if (preg_match($pattern,$data[$field])) {
            return true;
        }
        return false;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::ALPHANUMERIC->getMessage(), $field);
    }
}
