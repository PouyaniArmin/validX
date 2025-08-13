<?php

namespace Validx\Rules;

use Error;
use Validx\Message\ErrorMessage;

class IntegerRule implements RuleInterface
{
    public function validate(array $data, string $field, ...$params): bool
    {

        $pattern = '/^[-+]?\d+$/';
        if (preg_match($pattern, $data[$field])) {
            return true;
        }
        return false;
    }

    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::INTEGER->getMessage(), $field);
    }
}
