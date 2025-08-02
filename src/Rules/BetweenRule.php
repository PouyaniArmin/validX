<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class BetweenRule implements RuleInterface
{

    public function validate(array $data, string $field, ...$params): bool
    {
        if (strlen($data[$field]) < $params[0] || strlen($data[$field]) > $params[1]) {
            return false;
        }
        return true;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::BETWEEN->getMessage(), $field, $params[0], $params[1]);
    }
}
