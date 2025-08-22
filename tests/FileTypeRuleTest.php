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
            'valid jpg'             => [['file' => ['type' => 'image/jpeg']], 'file', ['jpeg', 'png'], true],
            'valid png'             => [['file' => ['type' => 'image/png']], 'file', ['jpeg', 'png'], true],
            'invalid gif'           => [['file' => ['type' => 'image/gif']], 'file', ['jpeg', 'png'], false],
            'missing type'          => [['file' => []], 'file', ['jpeg', 'png'], false],
            'field missing'         => [[], 'file', ['jpeg', 'png'], false],
            'type as null'          => [['file' => ['type' => null]], 'file', ['jpeg', 'png'], false],
            'type as numeric'       => [['file' => ['type' => 123]], 'file', ['jpeg', 'png'], false],
            'malformed type'        => [['file' => ['type' => 'imagejpeg']], 'file', ['jpeg', 'png'], false],
            'uppercase extension'   => [['file' => ['type' => 'image/JPEG']], 'file', ['jpeg', 'png'], true],
            'extra spaces'          => [['file' => ['type' => 'image/ png ']], 'file', ['jpeg', 'png'], true],
        ];
    }
}
