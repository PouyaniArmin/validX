<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\DateRule;

class DateRuleTest extends TestCase
{
    protected DateRule $date;


    public function setUp(): void
    {
        $this->date = new DateRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testVaildation(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->date->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
            'valid date' => [['birthdate' => '2025-08-17'], 'birthdate', true],
            'invalid date' => [['birthdate' => '2025-13-40'], 'birthdate', false],
            'worang format' => [['birthdate' => '17-08-2025'], 'birthdate', false]
        ];
    }
}
