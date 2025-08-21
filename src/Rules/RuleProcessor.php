<?php

namespace Validx\Rules;

use Exception;
use Reflection;
use ReflectionClass;
use Validx\Exceptions\InvalidRuleException;
use Validx\Exceptions\MissingValidateMethodException;

/**
 * Class RuleProcessor
 *
 * This class dynamically loads and applies validation rules.
 * It uses reflection to instantiate rule classes and call their `validate` methods.
 * Supports rules that require a database connection (e.g., UniqueRule).
 */
class RuleProcessor
{
    /** @var ReflectionClass The reflection instance for the current rule class */
    protected ReflectionClass $reflection;

    /** @var string The fully-qualified name of the rule class */
    protected string $class;

    /** @var mixed The instantiated rule object */
    protected mixed $obj;

    /** @var mixed Database connection, required for rules like UniqueRule */
    protected $db;

    /**
     * Set the database connection for rules that need it.
     *
     * @param mixed $db
     */
    public function setDatabase($db)
    {
        $this->db = $db;
    }

    /**
     * Load a rule class by name and instantiate it.
     * Checks if the class exists and has a validate method.
     * Passes database connection to constructor if needed.
     *
     * @param string $rule_name
     * @return $this
     * @throws InvalidRuleException|MissingValidateMethodException
     */
    public function ruleName(string $rule_name): self
    {
        $this->class = 'Validx\\Rules\\' . ucfirst($rule_name) . 'Rule';

        if (class_exists($this->class)) {
            $this->reflection = new ReflectionClass($this->class);

            if ($this->reflection->hasMethod('validate')) {
                $constructor = $this->reflection->getConstructor();

                if ($constructor && $constructor->getNumberOfParameters() > 0) {
                    // Rule requires constructor arguments (e.g., database)
                    $this->obj = $this->reflection->newInstance($this->db);
                } else {
                    // Rule has no constructor parameters
                    $this->obj = $this->reflection->newInstance();
                }
            } else {
                // Rule class does not have validate method
                MissingValidateMethodException::throwWith("The class {$this->class} must implement a 'validate' method to be used as a validation rule.");
            }
        } else {
            // Rule class does not exist
            InvalidRuleException::throwWith("Invalid Rule. Please check ruleName : $this->class");
        }

        return $this;
    }

    /**
     * Apply the loaded rule to a given field in the data array.
     * Returns the error message if validation fails, otherwise null.
     *
     * @param array $data Input data
     * @param string $field Field name to validate
     * @param array $params Parameters to pass to the rule
     * @return string|null Error message if validation fails
     * @throws Exception
     */
    public function applyRule(array $data, string $field, array $params)
    {
        if (!isset($this->reflection)) {
            throw new Exception("Reflection for rule not set. Did you forget to call ruleName()?");
        }

        try {
            if ($this->obj instanceof UniqueRule && $this->db === null) {
                throw new Exception("Database not set for UniqueRule.");
            }

            $pass = $this->obj->validate($data, $field, ...$params);

            if (!$pass) {
                return $this->obj->message($field, ...$params);
            }
        } catch (Exception $e) {
            return "Validation failed for '$field': " . $e->getMessage();
        }
    }
}
