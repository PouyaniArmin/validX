<?php

namespace Validx\Message;

enum ErrorMessage: string
{
    case REQUIRED = 'Please Enter The %s';
    case EMAIL = 'The %s is not a valid email address';
    case MIN = 'The %s must have at least %s characters';
    case MAX = 'The %s must have at most %s characters';
    case BETWEEN = 'The %s must have between %d and %d characters';
    case SAME = 'The %s must match with %s';
    case ALPHANUMERIC = 'The %s should have only letters and numbers';
    case SECURE = 'The %s must have between 8 and 64 characters and contain at least one number, one upper case letter, one lower case letter and one special character';
    case UNIQUE = 'The %s already exists';

    public function getMessage(): string
    {
        return $this->value;
    }
}
