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
        // return [
        //     'vaild character' => [['password' => 'SE5'], 'password', 3, true],
        //     'mix character' => [['password' => 'Se5F'], 'password', 3, true],
        //     'fail character' => [['password' => ''], 'password', 3, false],
        //     'spaces only' => [['password' => ' '], 'password', 3, false],
        //     'missing field' => [[], 'password', 3, false],
            
        // ];
        return [
        'valid min length' => [['password' => 'SE'], 'password', 2, true],
        'valid longer string' => [['password' => 'Se5F'], 'password', 2, true],
        'empty string' => [['password' => ''], 'password', 2, false],
        'spaces only' => [['password' => '  '], 'password', 2, false],
        'missing field' => [[], 'password', 2, false],
        'exact min length' => [['password' => 'AB'], 'password', 2, true],
        'shorter than min' => [['password' => 'A'], 'password', 2, false],
        'multibyte string valid' => [['name' => 'علی'], 'name', 2, true],
        'multibyte string too short' => [['name' => 'س'], 'name', 2, false],
        'with leading/trailing spaces' => [['username' => ' ab '], 'username', 2, true],
        'long string' => [['password' => str_repeat('x', 20)], 'password', 2, true],
    ];
    }
}
