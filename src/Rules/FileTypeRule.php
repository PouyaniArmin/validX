<?php

namespace Validx\Rules;

use Validx\Message\ErrorMessage;

/**
 * FileTypeRule
 * 
 * Validates whether a given file field has an allowed MIME type.
 */
class FileTypeRule implements RuleInterface
{
    /**
     * Validate if the uploaded file's type is among allowed types.
     *
     * @param array<string, array{name?:string,type?:string,tmp_name?:string,error?:int,size?:int}> $data
     * @param string $field Field name to validate
     * @param mixed ...$params Allowed file extensions
     * 
     * @return bool True if file type is allowed, false otherwise
     */

    public function validate(array $data, string $field, ...$params): bool
    {
        // Check if the field exists and is an array (file upload structure)
        if (!isset($data[$field]) || !is_array($data[$field])) {
            return false;
        }
        // Check if 'type' key exists and is a string
        if (!isset($data[$field]['type']) || !is_string($data[$field]['type'])) {
            return false;
        }
        // Extract the MIME type and split into type/subtype
        $type = explode('/', $data[$field]['type']);
        if (count($type) !== 2) {
            return false;
        }
        $fileExtension = strtolower(trim($type[1]));
        // Check if file extension is in allowed list
        return in_array($fileExtension, $params, true);
    }
    /**
     * Get the error message for invalid file types.
     *
     * @param string $field Field name
     * @param mixed ...$params Allowed file types
     * 
     * @return string Error message
     */
    public function message(string $field, ...$params): string
    {
        return sprintf(ErrorMessage::FILETYPE->getMessage(), $field, ...$params);
    }
}
