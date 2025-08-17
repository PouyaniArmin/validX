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
     * @dataProvider ProviderValidationCase
     */
    public function testVaildation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->email->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
            'vaild email' => [['email' => 'test@exmaple.com'], 'email', true],
            'missing domain' => [['email' => 'test@exmaple'], 'email', false],
            'empty string' => [['email' => ''], 'email', false],
            'multiple @' => [['email' => 'test@@@exmaple.com'], 'email', false],
            'invalid email' => [['email' => 'test!#%&@example.com'], 'email', true],
            'xss' => [['email' => '"><script>alert(1)</script>@example.com'], 'email', false]
        ];
    }
}
