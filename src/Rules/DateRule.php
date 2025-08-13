<?php 


namespace Validx\Rules;

use DateTime;
use Validx\Message\ErrorMessage;

class DateRule implements RuleInterface{
    public function validate(array $data, string $field, ...$params): bool
    {
        $value=$data[$field];
        $date=DateTime::createFromFormat('Y-m-d',$value);
        if ($date && $date->format('Y-m-d')==$value) {
            return true;
        }
        return false;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::DATE->getMessage(),$field);
    }

}