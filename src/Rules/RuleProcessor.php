<?php


namespace Validx\Rules;

use Exception;
use Reflection;
use ReflectionClass;

class RuleProcessor
{


    protected ReflectionClass $reflection;
    protected string $class;
    protected mixed $obj;

    public function ruleName(string $rule_name): self
    {

        $this->class = 'Validx\\Rules\\' . ucfirst($rule_name) . 'Rule';
        if (class_exists($this->class)) {
            $this->reflection = new ReflectionClass($this->class);
            if ($this->reflection->hasMethod('validate')) {
                $this->obj = $this->reflection->newInstance();
            } else {
                throw new Exception("Class does not have 'validate' method.");
            }
        } else {
            throw new Exception("Class {$this->class} not found.");
        }

        return $this;
    }

    public function applyRule(array $data, string $field, array $params)
    {
        
        if (!isset($this->reflection)) {
            throw new Exception("Reflection for rule not set. Did you forget to call ruleName()?");
        }
        $pass = $this->obj->validate($data, $field, ...$params);
        if (!$pass) {
            return $this->obj->message($field, ...$params);
        }
    }
}
