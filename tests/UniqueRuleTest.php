<?php

use PHPUnit\Framework\TestCase;
use Validx\Message\ErrorMessage;
use Validx\Rules\UniqueRule;

class UniqueRuleTest extends TestCase
{
    protected UniqueRule $unique;
    protected  $mockDb;

    public function setUp(): void
    {
        $this->mockDb = $this->createMock(PDO::class);
        $this->unique = new UniqueRule($this->mockDb);
    }

    /**
     * @dataProvider providerValidationCase
     */
    public function testValidate(array $data, string $field, ?bool $exists, bool $expected)
    {
        if ($exists !== null) {
            $mockStmt = $this->createMock(PDOStatement::class);
            $mockStmt->expects($this->once())
                ->method('execute');
            $mockStmt->expects($this->once())
                ->method('fetchAll')
                ->willReturn([['count' => $exists ? 1 : 0]]);

            $this->mockDb->expects($this->once())
                ->method('prepare')
                ->willReturn($mockStmt);
        }

        $this->assertSame($expected, $this->unique->validate($data, $field, 'users'));
    }

    public static function providerValidationCase(): array
    {
        return [
            'value exists in table'        => [['email' => 'test@example.com'], 'email', true, false],
            'value not exists in table'    => [['email' => 'new@example.com'], 'email', false, true],
            'null value'                   => [['email' => null], 'email', null, false],
            'missing field'                => [[], 'email', null, false],
        ];
    }

    public function testValidateThrowsExceptionIfNoTableProvided()
    {
        $this->expectException(Exception::class);
        $this->unique->validate(['email' => 'test@example.com'], 'email');
    }

    public function testMessageReturnsCorrectErrorMessage()
    {
        $field = 'email';
        $msg = $this->unique->message($field);

        $this->assertStringContainsString($field, $msg);

        $this->assertStringContainsString('already exists', $msg);
    }
}
