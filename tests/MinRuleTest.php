<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\MaxRule;
use Validx\Rules\MinRule;

class MinRuleTest extends TestCase
{
    protected MinRule $min;

    public function setUp(): void
    {
        parent::setUp();
        $this->min = new MinRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, int $min, bool $expected)
    {
        $this->assertSame($expected, $this->min->validate($data, $field, $min));
    }

    public static function providerValidationCase(): array
    {
        return [
            'vaild character' => [['password' => 'SE5'], 'password', 3, true],
            'mix character' => [['password' => 'Se5F'], 'password', 3, true],
            'fail character' => [['password' => ''], 'password', 3, false],
            'spaces only' => [['password' => ' '], 'password', 3, false],
            'missing field' => [[], 'password', 3, false],
            
        ];
    }
}
