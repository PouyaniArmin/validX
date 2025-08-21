<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\AlphanumericRule;

class AlphanumericRuleTest extends TestCase
{
    protected AlphanumericRule $alphanumeric;

    public function setUp(): void
    {
        $this->alphanumeric = new AlphanumericRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->alphanumeric->validate($data, $field));
    }
    public static function providerValidationCase(): array
    {
        // return [
        //     'vaild alphanumeric'=>[['username'=>'Example125'],'username',true],
        //     'invalid alphanumeric'=>[['username'=>'Exampl#-15e125'],'username',false]
        // ];
        return [
            'valid alphanumeric lowercase' => [['username' => 'example123'], 'username', true],
            'valid alphanumeric uppercase' => [['username' => 'EXAMPLE123'], 'username', true],
            'valid alphanumeric mixed' => [['username' => 'ExAm123'], 'username', true],
            'invalid special chars' => [['username' => 'Example#123'], 'username', false],
            'invalid dash' => [['username' => 'Exampl-123'], 'username', false],
            'invalid underscore' => [['username' => 'Example_123'], 'username', false],
            'empty string' => [['username' => ''], 'username', false],
            'null value' => [['username' => null], 'username', false],
            'integer value' => [['username' => 12345], 'username', false],
            'string with space' => [['username' => 'Example 123'], 'username', false],
        ];
    }
}
