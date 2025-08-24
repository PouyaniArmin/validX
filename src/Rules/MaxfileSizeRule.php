<?php


namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * MaxfileSizeRule
 * 
 * Validates that the uploaded file does not exceed the specified maximum size.
 */
class MaxfileSizeRule implements RuleInterface
{
    /**
     * Validate if the file's size is less than or equal to the maximum allowed size.
     *
     * @param array<string, mixed> $data (expects file array with 'size')
     * @param string $field Field name containing the file
     * @param mixed ...$params First parameter should be the maximum allowed size
     * 
     * @return bool True if file size is valid, false otherwise
     */
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
    /**
     * Get the error message for files exceeding the maximum size.
     *
     * @param string $field Field name
     * @param mixed ...$params Maximum size parameter
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::MAXFILESIZE->getMessage(), $field, ...$params);
    }
}
