<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\BetweenRule;

class BetweenRuleTest extends TestCase
{
    protected BetweenRule $between;

    public function setUp(): void
    {
        $this->between = new BetweenRule;
    }
    /**
     * @dataProvider providerValidationCase
     */

    public function testValidation(array $data, string $field, int $min, int $max, bool $expected)
    {
        $this->assertSame($expected, $this->between->validate($data, $field, $min, $max));
    }
    public static function providerValidationCase(): array
    {
        return [
        'between valid'     => [['username' => 'example'], 'username', 5, 10, true],
        'too short'         => [['username' => 'e'], 'username', 5, 10, false],
        'too long'          => [['username' => 'eexampleexamplee'], 'username', 5, 10, false],
        'exactly min'       => [['username' => '12345'], 'username', 5, 10, true],
        'exactly max'       => [['username' => '1234567890'], 'username', 5, 10, true],
        'empty string'      => [['username' => ''], 'username', 5, 10, false],
        'field missing'     => [[], 'username', 5, 10, false], 
        'numeric value'     => [['username' => 12345], 'username', 5, 10, true], 
        'array value'       => [['username' => ['a','b']], 'username', 5, 10, false],
    ];
    }
}
