<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\IntegerRule;

class IntegerRuleTest extends TestCase
{
    protected IntegerRule $integer;

    public function setUp(): void
    {
        $this->integer = new IntegerRule;
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->integer->validate($data, $field));
    }

    public static function  providerValidationCase(): array
    {
        return [
            'valid positive' => [['age' => '123'], 'age', true],
            'valid positive' => [['age' => '-58'], 'age', true],
            'valid positive' => [['age' => '+99'], 'age', true],
            'valid positive' => [['age' => '12.5'], 'age', false],
            'valid positive' => [['age' => 'abc'], 'age', false],
            'valid positive' => [['age' => ''], 'age', false],
        ];
    }
}
