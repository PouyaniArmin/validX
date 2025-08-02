<?php 


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class RequiredRule implements RuleInterface{
 
    public function validate(array $data, string $field, ...$params):bool
    {
        return isset($data[$field]) && $data[$field]!=='';
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::REQUIRED->getMessage(),ucfirst($field));
    }
}