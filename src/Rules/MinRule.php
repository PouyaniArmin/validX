<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class MinRule implements RuleInterface
{

    public function validate(array $data, string $field, ...$params): bool
    {

        $value = isset($data[$field]) ? trim($data[$field]) : '';
        if ($value === '') {
            return false;
        }
        if (strlen($value) < $params[0]) {
            return false;
        }
        return true;
    }
    public function message(string $field, ...$params): string
    {

        return sprintf(ErrorMessage::MIN->getMessage(), $field, $params[0]);
    }
}
