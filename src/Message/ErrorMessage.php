<?php

namespace Validx\Message;
// Enum containing default error messages for validation rules
// Each case represents a specific validation error
enum ErrorMessage: string
{
    // cases
    case REQUIRED = 'Please Enter The %s';
    case EMAIL = 'The %s is not a valid email address';
    case MIN = 'The %s must have at least %s characters';
    case MAX = 'The %s must have at most %s characters';
    case BETWEEN = 'The %s must have between %d and %d characters';
    case SAME = 'The %s must match with %s';
    case ALPHANUMERIC = 'The %s should have only letters and numbers';
    case SECURE = 'The %s must have between 8 and 64 characters and contain at least one number, one upper case letter, one lower case letter and one special character';
    case UNIQUE = 'The %s already exists';
    case NUMERIC = 'The %s must contain only numbers';
    case INTEGER = 'The %s must be an integer';
    case URL = 'The %s is not a valid URL';
    case DATE = 'The %s is not a valid date';
    case PHONE = 'The %s is not a valid phone number';
    case IN = 'The %s must be one of the allowed values';
    case FILETYPE = 'The %s must be a valid file type: %s';
    case MAXFILESIZE = 'The %s must not be larger than %s';
    // Returns the message string for the error
    public function getMessage(): string
    {
        return $this->value;
    }
}
