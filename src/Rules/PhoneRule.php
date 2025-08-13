<?php 


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class PhoneRule implements RuleInterface{

    public function validate(array $data, string $field, ...$params): bool
    {
        $pattern='/^\+?\d{1,3}?\d{4,14}$/';
        if (preg_match($pattern,$data[$field])) {
            return true;
        }
        return false;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::PHONE->getMessage(),$field);
    }
}