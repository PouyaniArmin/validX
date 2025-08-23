<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\UrlRule;
use Validx\Message\ErrorMessage;

class UrlRuleTest extends TestCase
{
    protected UrlRule $urlRule;

    public function setUp(): void
    {
        $this->urlRule = new UrlRule();
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidate(array $data, string $field, bool $expected)
    {
        $this->assertSame($expected, $this->urlRule->validate($data, $field));
    }

    public static function providerValidationCase(): array
    {
        return [
            'valid http url'           => [['website' => 'http://example.com'], 'website', true],
            'valid https url'          => [['website' => 'https://example.com'], 'website', true],
            'valid with www'           => [['website' => 'http://www.example.com'], 'website', true],
            'invalid url missing scheme' => [['website' => 'www.example.com'], 'website', false],
            'invalid url random text'  => [['website' => 'not a url'], 'website', false],
            'empty string'             => [['website' => ''], 'website', false],
            'null value'               => [['website' => null], 'website', false],
            'missing field'            => [[], 'website', false],
        ];
    }

    public function testMessageReturnsCorrectErrorMessage()
    {
        $field = 'website';
        $msg = $this->urlRule->message($field);

        $this->assertStringContainsString($field, $msg);
        $this->assertStringContainsString('URL', $msg);
    }
}
