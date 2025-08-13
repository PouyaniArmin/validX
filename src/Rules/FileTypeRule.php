<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class FileTypeRule implements RuleInterface{
    public function validate(array $data, string $field, ...$params): bool
    {
        if (!isset($data[$field])|| !is_array($data[$field])) {
            return false;
        }
        if (!isset($data[$field]['type']) || !is_string($data[$field]['type'])) {
            return false;
        }
        $type=explode('/',$data[$field]['type']);
        if (count($type)!==2) {
            return false;
        }
        $fileExtension=strtolower($type[1]);
        return in_array($fileExtension,$params,true);
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::FILETYPE->getMessage(),$field,...$params);
    }
}