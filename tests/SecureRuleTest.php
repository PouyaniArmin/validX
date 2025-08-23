<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\SecureRule;

class SecureRuleTest extends TestCase
{
    protected SecureRule $secure;

    public function setUp(): void
    {
        $this->secure = new SecureRule;
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->secure->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
            'valid strong password'                => [['password' => 'Abcdef1!'], 'password', true],
            'valid strong password long'           => [['password' => 'StrongPass123@'], 'password', true],
            'valid with special char at start'    => [['password' => '!Abcdef1'], 'password', true],
            'valid with special char at end'      => [['password' => 'Abcdef1!'], 'password', true],
            'missing uppercase'                    => [['password' => 'abcdef1!'], 'password', false],
            'missing lowercase'                    => [['password' => 'ABCDEF1!'], 'password', false],
            'missing number'                       => [['password' => 'Abcdefg!'], 'password', false],
            'missing special char'                 => [['password' => 'Abcdef12'], 'password', false],
            'too short'                            => [['password' => 'Ab1!'], 'password', false],
            'empty string'                         => [['password' => ''], 'password', false],
            'spaces only'                          => [['password' => '        '], 'password', false],
            'null value'                           => [['password' => null], 'password', false],
            'missing field'                        => [[], 'password', false],
            'password with spaces around'          => [['password' => ' Abcdef1! '], 'password', false],
            'password with unicode chars'          => [['password' => 'Ābcdef1!'], 'password', true],
            'password with emoji'                  => [['password' => 'Abcdef1😊'], 'password', false],
            'very long valid password'             => [['password' => str_repeat('A1a!', 250)], 'password', true],
            'very long invalid password'           => [['password' => str_repeat('Aa!', 250)], 'password', false],
        ];
    }
}
