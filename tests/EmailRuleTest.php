<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\EmailRule;

class EmailRuleTest extends TestCase
{

    protected EmailRule $email;

    public function setUp(): void
    {
        $this->email = new EmailRule;
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->email->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
            'valid email'        => [['email' => 'test@example.com'], 'email', true],
            'missing domain'     => [['email' => 'test@example'], 'email', false],
            'empty string'       => [['email' => ''], 'email', false],
            'multiple @'         => [['email' => 'test@@example.com'], 'email', false],
            'special chars'      => [['email' => 'test!#%&@example.com'], 'email', true],
            'xss'                => [['email' => '"><script>alert(1)</script>@example.com'], 'email', false],
            'field missing'      => [[], 'email', false],
            'numeric value'      => [['email' => 12345], 'email', false],
            'array value'        => [['email' => ['test@example.com']], 'email', false],
            'null value'         => [['email' => null], 'email', false],
        ];
    }
}
