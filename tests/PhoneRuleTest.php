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
    public function testValdation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->phone->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
            'valid international'    => [['phone' => '+1234567890'], 'phone', true],
            'valid local'            => [['phone' => '09123456789'], 'phone', true],
            'missing plus'           => [['phone' => '1234567890'], 'phone', true],
            'too short'              => [['phone' => '123'], 'phone', false],
            'alphabetic characters'  => [['phone' => '123abc456'], 'phone', false],
            'special characters'     => [['phone' => '+123-456-7890'], 'phone', false],
            'empty string'           => [['phone' => ''], 'phone', false],
            'spaces only'            => [['phone' => '   '], 'phone', false],
            'missing field'          => [[], 'phone', false],
            'null value'             => [['phone' => null], 'phone', false],
        ];
    }
}
