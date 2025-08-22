<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\InRule;

class InRuleTest extends TestCase
{
    protected InRule $in;
    public function setUp(): void
    {
        $this->in = new InRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, array $allowed, bool $expected)
    {
        $this->assertSame($expected, $this->in->validate($data, $field, ...$allowed));
    }
    public static function providerValidationCase(): array
    {
        return [
            'value in list'           => [['status' => 'active'], 'status', ['active', 'inactive'], true],
            'value not in list'       => [['status' => 'pending'], 'status', ['active', 'inactive'], false],
            'empty value'             => [['status' => ''], 'status', ['active', 'inactive'], false],
            'field missing'           => [[], 'status', ['active', 'inactive'], false],
            'null value'              => [['status' => null], 'status', ['active', 'inactive'], false],
            'numeric value in list'   => [['status' => 1], 'status', [1, 2, 3], true],
            'numeric value not in list' => [['status' => 4], 'status', [1, 2, 3], false],
            'array value'             => [['status' => ['active']], 'status', ['active', 'inactive'], false],
            'boolean true'            => [['status' => true], 'status', [true, false], true],
            'boolean false'           => [['status' => false], 'status', [true, false], true],
        ];
    }
}
