<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\PhoneRule;

class PhoneRuleTest extends TestCase
{
    protected PhoneRule $phone;
    public function setUp(): void
    {
        $this->phone = new PhoneRule;
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->phone->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
        'valid international'        => [['phone' => '+1234567890'], 'phone', true],
        'valid local'                => [['phone' => '09123456789'], 'phone', true],
        'missing plus'               => [['phone' => '1234567890'], 'phone', true],
        'minimum length'             => [['phone' => '12345'], 'phone', true],
        'maximum length'             => [['phone' => str_repeat('1', 17)], 'phone', true],
        'too short'                  => [['phone' => '123'], 'phone', false],
        'too long'                   => [['phone' => str_repeat('1', 18)], 'phone', false],
        'alphabetic characters'      => [['phone' => '123abc456'], 'phone', false],
        'special characters'         => [['phone' => '+123-456-7890'], 'phone', false],
        'plus only'                  => [['phone' => '+'], 'phone', false],
        'empty string'               => [['phone' => ''], 'phone', false],
        'spaces only'                => [['phone' => '   '], 'phone', false],
        'missing field'              => [[], 'phone', false],
        'null value'                 => [['phone' => null], 'phone', false],
        'non latin digits'           => [['phone' => '۱۲۳۴۵۶۷۸۹۰'], 'phone', false],
        'emoji included'             => [['phone' => '📱12345'], 'phone', false],
        'newline char'               => [['phone' => "12345\n"], 'phone', false],
        'tab char'                   => [['phone' => "12345\t"], 'phone', false],
    ];
    }
}
