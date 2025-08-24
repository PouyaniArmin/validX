# Validx

A lightweight and extensible PHP validation library.  
Validx provides a simple and readable way to validate data in PHP projects.

## Features (v1)

- Basic validation rules: `required`, `email`, `min`, `max`, `between`, `numeric`, `integer`, `phone`, `url`, `secure`, `unique`, `in`, `alphanumeric`, `date`, `fileType`, `maxfileSize`.
- Supports arrays and nested fields.
- Optional PDO database injection for rules like `unique`.
- Integration-ready for forms, APIs, and any PHP project.

## Quick Start

```php
use Validx\Validation;

$validation = new Validation();

$data = [
    'username' => 'exampleuser',
    'email' => 'example@example.com',
];

$rules = [
    'username' => 'required | between:2,15',
    'email' => 'required | email',
];

$errors = $validation->validate($data, $rules);

if (!empty($errors)) {
    print_r($errors);
} else {
    echo "All fields are valid!";
}

## Example Error Output

```php
[
    'username' => ['The username must have between 2 and 15 characters'],
    'email' => ['The email already exists'],
]
```

## Available Rules (v1)

- `required`
- `email`
- `min`
- `max`
- `between`
- `numeric`
- `integer`
- `phone`
- `url`
- `secure`
- `unique`
- `in`
- `alphanumeric`
- `date`
- `fileType`
- `maxfileSize`

## Writing Validation Rules

> Note: All keys defined in your validation rules must exist in the input data array.

Validation rules are defined as strings using pipe `|` separators. You can combine multiple rules per field.

### Examples:

```php
$rules = [
    'username' => 'required | between:3,20',
    'email' => 'required | email | unique:email',
    'password' => 'required | min:6 | max:12 | secure',
    'age' => 'integer | min:18',
];
```
required — The field must not be empty.

email — Must be a valid email address.

unique:email — Must be unique in the database (requires PDO).

min:value / max:value — Minimum or maximum length/value.

between:min,max — Value must be within the given range.

integer — Must be an integer.

secure — Must meet password security criteria
## Error Messages

Validx returns error messages from an internal enum class.  
Currently, messages are **not customizable**, but each rule has a predefined message.

### Available Messages Per Rule

| Rule        | Default Message |
|------------|----------------|
| REQUIRED    | Please Enter The %s |
| EMAIL       | The %s is not a valid email address |
| MIN         | The %s must have at least %s characters |
| MAX         | The %s must have at most %s characters |
| BETWEEN     | The %s must have between %d and %d characters |
| SAME        | The %s must match with %s |
| ALPHANUMERIC| The %s should have only letters and numbers |
| SECURE      | The %s must have between 8 and 64 characters and contain at least one number, one upper case letter, one lower case letter and one special character |
| UNIQUE      | The %s already exists |
| NUMERIC     | The %s must contain only numbers |
| INTEGER     | The %s must be an integer |
| URL         | The %s is not a valid URL |
| DATE        | The %s is not a valid date |
| PHONE       | The %s is not a valid phone number |
| IN          | The %s must be one of the allowed values |
| FILETYPE    | The %s must be a valid file type: %s |
| MAXFILESIZE | The %s must not be larger than %s |

**Note:** `%s` and `%d` are placeholders that will be replaced with field names, min/max values, or file size as appropriate.
