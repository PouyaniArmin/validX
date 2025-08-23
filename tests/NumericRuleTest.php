<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\NumericRule;

class NumericRuleTest extends TestCase
{
    protected NumericRule $numeric;

    public function setUp(): void
    {
        $this->numeric = new NumericRule;
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->numeric->validate($data, $field));
    }
    public static function providerValidationCase(): array
    {
        return [
            'positive integer'       => [['number' => '123'], 'number', true],
            'zero'                   => [['number' => '0'], 'number', true],
            'negative integer'       => [['number' => '-123'], 'number', false],
            'decimal number'         => [['number' => '12.5'], 'number', false],
            'empty string'           => [['number' => ''], 'number', false],
            'spaces only'            => [['number' => '   '], 'number', false],
            'alphabetic string'      => [['number' => 'abc'], 'number', false],
            'alphanumeric string'    => [['number' => '12a'], 'number', false],
            'missing field'          => [[], 'number', false],
            'null value'             => [['number' => null], 'number', false],
            'newline char'           => [['number' => "123\n"], 'number', false],
            'tab char'               => [['number' => "456\t"], 'number', false],
            'multibyte digits'       => [['number' => '١٢٣'], 'number', false], // Arabic digits
            'emoji'                  => [['number' => '😊'], 'number', false],
        ];
    }
}
