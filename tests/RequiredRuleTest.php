<?php

use PHPUnit\Framework\TestCase;
use Validx\Message\ErrorMessage;
use Validx\Rules\RequiredRule;

class RequiredRuleTest extends TestCase
{
    protected  RequiredRule $rule;

    public function setUp(): void
    {
        $this->rule = new RequiredRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->rule->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
            'value exists' => [['name' => 'Armin'], 'name', true],
            'empty string' => [['name' => ''], 'name', false],
            'null value'   => [['name' => null], 'name', false],
            'field missing' => [[], 'name', false],
        ];
    }
}
