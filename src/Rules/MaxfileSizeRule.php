<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

class MaxfileSizeRule implements RuleInterface
{
    public function validate(array $data, string $field, ...$params): bool
    {
        $maxSize = $params[0];
        if (!$maxSize || !is_numeric($maxSize)) {
            return false;
        }
        if (!isset($data[$field]['size']) || !is_numeric($data[$field]['size'])) {
            return false;
        }

        return $data[$field]['size'] <= $maxSize;
    }
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::MAXFILESIZE->getMessage(), $field, ...$params);
    }
}
