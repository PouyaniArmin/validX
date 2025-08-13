<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class InRule implements RuleInterface
{
    public function validate(array $data, string $field, ...$params): bool
    {
        foreach ($params as $value) {
            if ($data[$field] == $value) {
                return true;
            }
        }
        return false;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::IN->getMessage(), $field);
    }
}
