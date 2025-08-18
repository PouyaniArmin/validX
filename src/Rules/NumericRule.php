<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class NumericRule implements RuleInterface
{

    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field]) || !is_string($data[$field])) {
            return false;
        }
        $pattern = '/^\d+$/';
        if (preg_match($pattern, $data[$field])) {
            return true;
        }
        return false;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::NUMERIC->getMessage(), $field);
    }
}
