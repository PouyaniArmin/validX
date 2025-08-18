<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\MaxRule;

class MaxRuleTest extends TestCase
{
    protected MaxRule $max;

    public function setUp(): void
    {
        parent::setUp();
        $this->max = new MaxRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, int $max, bool $expected)
    {
        $this->assertSame($expected, $this->max->validate($data, $field, $max));
    }

    public static function providerValidationCase(): array
    {
        return [
            'vaild character' => [['password' => 'aW152?@'], 'password', 8, true],
            'max character' => [['password' => 'aW152?@!'], 'password', 8, true],
            'overflow character' => [['password' => 'aW152?@581'], 'password', 8, false],
            'fail character' => [['password' => ''], 'password', 8, false],
            'spaces only' => [['password' => ' '], 'password', 8, false],
            'missing field' => [[], 'password', 8, false],
            'exact max' => [['password' => '12345678'], 'password', 8, true],
        ];
    }
}
