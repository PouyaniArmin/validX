<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class UrlRule implements RuleInterface{
    public function validate(array $data, string $field, ...$params): bool
    {
        return filter_var($data[$field],FILTER_VALIDATE_URL);
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::URL->getMessage(),$field);
    }
}