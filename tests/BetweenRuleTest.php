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
     * @dataProvider ProviderVaildationCase
     */

    public function testValidation(array $data, string $field, int $min, int $max, bool $expected)
    {
        $this->assertSame($expected, $this->between->validate($data, $field, $min, $max));
    }
    public static function ProviderVaildationCase(): array
    {
        return [
            'between valid' => [['username' => 'example'], 'username', 5, 10, true],
            'too short' => [['username' => 'e'], 'username', 5, 10, false],
            'too long' => [['username' => 'eexampleexamplee'], 'username', 5, 10, false],
        ];
    }
}
