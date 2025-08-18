<?php


namespace Validx\Rules;

use Exception;
use Reflection;
use ReflectionClass;
use Validx\Exceptions\InvalidRuleException;
use Validx\Exceptions\MissingValidateMethodException;

class RuleProcessor
{
    protected ReflectionClass $reflection;
    protected string $class;
    protected mixed $obj;
    protected $db;
    public function setDatabase($db)
    {
        $this->db = $db;
    }

    public function ruleName(string $rule_name): self
    {
        $this->class = 'Validx\\Rules\\' . ucfirst($rule_name) . 'Rule';
        if (class_exists($this->class)) {
            $this->reflection = new ReflectionClass($this->class);
            if ($this->reflection->hasMethod('validate')) {
                $constructor = $this->reflection->getConstructor();
                if ($constructor && $constructor->getNumberOfParameters() > 0) {
                    $this->obj = $this->reflection->newInstance($this->db);
                } else {
                    $this->obj = $this->reflection->newInstance();
                }
            } else {
                MissingValidateMethodException::throwWith("The class {$this->class} must implement a 'validate' method to be used as a validation rule.");
            }
        } else {
            InvalidRuleException::throwWith("Invalid Rule. Please check ruleName : $this->class");
        }

        return $this;
    }

    public function applyRule(array $data, string $field, array $params)
    {

        if (!isset($this->reflection)) {
            throw new Exception("Reflection for rule not set. Did you forget to call ruleName()?");
        }
        if ($this->obj instanceof UniqueRule && $this->db === null) {
            throw new Exception("Database not set for UniqueRule.");
        }
        $pass = $this->obj->validate($data, $field, ...$params);
        if (!$pass) {
            return $this->obj->message($field, ...$params);
        }
    }
}
