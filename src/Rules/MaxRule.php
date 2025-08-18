<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class MaxRule implements RuleInterface
{

    public function validate(array $data, string $field, ...$params): bool
    {
        $value = isset($data[$field]) ? trim($data[$field]) : '';
        if ($value === '') {
            return false;
        }
        if (!empty($value)) {
            if (strlen($value) > $params[0]) {
                return false;
            }
        }
        return true;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::MAX->getMessage(), $field, $params[0]);
    }
}
