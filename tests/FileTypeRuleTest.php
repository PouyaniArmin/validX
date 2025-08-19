<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\FileTypeRule;

class FileTypeRuleTest extends TestCase
{
    protected FileTypeRule $file;
    public function setUp(): void
    {
        $this->file = new FileTypeRule;
    }

    /**
     * @dataProvider providerValidationCase
     */

    public function testValidation(array $data, string $field, array $allowed, $expected)
    {
        $this->assertSame($expected, $this->file->validate($data, $field, ...$allowed));
    }
    public static function providerValidationCase(): array
    {
        return [
            'vaild jpg' => [['file' => ['type' => 'image/jpeg']], 'file', ['jpeg', 'png'], true],
            'valid png' => [['file' => ['type' => 'image/png']], 'file', ['jpeg', 'png'], true],
            'valid gif' => [['file' => ['type' => 'image/gif']], 'file', ['jpeg', 'png'], false],
            'missing type' => [['file' => []], 'file', ['jpeg', 'png'], false],

        ];
    }
}
