<?php

use PHPUnit\Framework\TestCase;
use Validx\Message\ErrorMessage;
use Validx\Rules\RuleProcessor;

class RuleProcessorIntegrationTest extends TestCase
{
    protected RuleProcessor $processor;
    public function setUp(): void
    {
        $this->processor = new RuleProcessor;
        $pdo = new PDO('sqlite::memory:');
        $pdo->exec("CREATE TABLE users (email TEXT)");
        $pdo->exec("INSERT INTO users (email) VALUES ('exists@example.com')");
        $this->processor->setDatabase($pdo);
    }

    /**
     * @dataProvider providerRuleApplication
     */

    public function testApplyRule(array $data, string $rule, string $field, array $params, ?string $expectedMessage)
    {
        $this->processor->ruleName($rule);
        $message = $this->processor->applyRule($data, $field, $params);
        $this->assertSame($expectedMessage, $message);
    }
    public function testUniqueRuleWithoutDatabase()
    {
        $this->processor = new RuleProcessor;
        $this->processor->ruleName('Unique');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Database not set for UniqueRule.');

        $this->processor->applyRule(['email' => 'anything@example.com'], 'email', ['users', 'email']);
    }

    public static function providerRuleApplication(): array
    {
        return [
            'valid max' => [['password' => 'abc'], 'Max', 'password', [5], null],
            'exceed max' => [['password' => 'abcdef'], 'Max', 'password', [5], sprintf(ErrorMessage::MAX->getMessage(), 'password', 5)],
            'missing field' => [[], 'Max', 'password', [5], sprintf(ErrorMessage::MAX->getMessage(), 'password', 5)],
            'valid min' => [['username' => 'abcd'], 'Min', 'username', [3], null],
            'below min' => [['username' => 'ab'], 'Min', 'username', [3], sprintf(ErrorMessage::MIN->getMessage(), 'username', 3)],
            'numeric valid' => [['age' => '123'], 'Numeric', 'age', [], null],
            'numeric invalid' => [['age' => '12a'], 'Numeric', 'age', [], sprintf(ErrorMessage::NUMERIC->getMessage(), 'age')],
            'phone valid' => [['phone' => '+1234567890'], 'Phone', 'phone', [], null],
            'phone invalid' => [['phone' => 'abc123'], 'Phone', 'phone', [], sprintf(ErrorMessage::PHONE->getMessage(), 'phone')],
            'unique valid' => [['email' => 'new@example.com'], 'Unique', 'email', ['users', 'email'], null],
            'unique exists' => [['email' => 'exists@example.com'], 'Unique', 'email', ['users', 'email'], sprintf(ErrorMessage::UNIQUE->getMessage(), 'email')],
        ];
    }
}
