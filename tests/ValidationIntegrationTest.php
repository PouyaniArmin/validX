<?php

use PHPUnit\Framework\TestCase;
use Validx\Validation;

class ValidationIntegrationTest extends TestCase
{
    protected Validation $validation;
    public function setUp(): void
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->exec('CREATE TABLE users (email TEXT)');
        $pdo->exec("INSERT INTO users (email) VALUES ('exists@example.com')");
        $this->validation = new Validation($pdo);
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, array $rules, $expectedErrors)
    {
        $this->assertSame($expectedErrors, $this->validation->validate($data, $rules));
    }

     public static function providerValidationCase(): array
    {
        
        return [
            'all valid' => [
                [
                    'username' => 'Armin',
                    'email' => 'new@example.com',
                    'password' => '1Az@3rmin',
                    'phone' => '+12025550123'
                ],
                [
                    'username' => 'required | between: 2,15',
                    'email' => 'required | email | unique:users,email',
                    'password' => 'required | min:6 | max:12 | secure',
                    'phone' => 'required | phone'
                ],
                []
            ],
            'invalid username and email' => [
                [
                    'username' => 'A',
                    'email' => 'exists@example.com',
                    'password' => '123456',
                    'phone' => 'invalidphone'
                ],
                [
                    'username' => 'required | between: 2,15',
                    'email' => 'required | email | unique:users,email',
                    'password' => 'required | min:6 | max:12',
                    'phone' => 'required | phone'
                ],
                [
                    'username' => ['The username must have between 2 and 15 characters'],
                    'email' => ['The email already exists'],
                    'phone' => ['The phone is not a valid phone number'],
                ]
            ],
        ];
    
    }
}
