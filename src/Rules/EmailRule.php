<?php 

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class EmailRule implements RuleInterface{

    public function validate(array $data, string $field, ...$params): bool
    {
        return filter_var($data[$field],FILTER_VALIDATE_EMAIL);    
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::EMAIL->getMessage(),ucfirst($field));
    }
}
