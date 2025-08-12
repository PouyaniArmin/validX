<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class SecureRule implements RuleInterface
{
    public function validate(array $data, string $field, ...$params): bool
    {

        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%&*]).{8,}$/";
        if (preg_match($pattern, $data[$field], $matches)) {
            return true;
        }
        return false;
    }

    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::SECURE->getMessage(), $field, $params);
    }
}
