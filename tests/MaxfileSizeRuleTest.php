<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\MaxfileSizeRule;

class MaxfileSizeRuleTest extends TestCase
{
    protected MaxfileSizeRule $maxFile;

    public function setUp(): void
    {
        $this->maxFile = new MaxfileSizeRule;
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data, string $field, $size, $expected)
    {
        $this->assertSame($expected, $this->maxFile->validate($data, $field, $size));
    }

    public static function providerValidationCase(): array
    {
        return [
            'valid size'       => [['file' => ['size' => 220]], 'file', 230, true],
            'equal size'       => [['file' => ['size' => 265]], 'file', 265, true],
            'exceeds size'     => [['file' => ['size' => 300]], 'file', 230, false],
            'missing size'     => [['file' => []], 'file', 230, false],
            'non numeric size' => [['file' => ['size' => 'abc']], 'file', 230, false],
            'size zero valid'  => [['file' => ['size' => 0]], 'file', 100, true],
            'no max size param' => [['file' => ['size' => 100]], 'file', null, false],
        ];
    }
}
