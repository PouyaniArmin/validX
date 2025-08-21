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
            'integer string positive' => [['age' => '123'], 'age', true],
            'integer string negative' => [['age' => '-58'], 'age', true],
            'integer string plus' => [['age' => '+99'], 'age', true],
            'integer float string' => [['age' => '12.5'], 'age', false],
            'integer non-numeric string' => [['age' => 'abc'], 'age', false],
            'integer empty string' => [['age' => ''], 'age', false],
            'integer zero string' => [['age' => '0'], 'age', true],
            'integer zero int' => [['age' => 0], 'age', true],
            'integer positive int' => [['age' => 42], 'age', true],
            'integer negative int' => [['age' => -7], 'age', true],
            'integer float number' => [['age' => 12.5], 'age', false],
            'integer null' => [['age' => null], 'age', false],
            'integer string with spaces' => [['age' => ' 123 '], 'age', false],
        ];
    }
}
