<?php

namespace Validx;

use ReflectionClass;
use Validx\Rules\RuleProcessor;

class Validation
{
    protected $db;

    // Constructor: store database connection
    public function __construct($db)
    {
        $this->db=$db;
    }

    // Main method to validate data against rules
    public function validate(array $data, array $rules)
    {
        $errors = [];

        // Helper function to split string and trim spaces
        $split = fn($str, $separator) => array_map('trim', explode($separator, $str));

        // Iterate over each field and its rules
        foreach ($rules as $field => $option) {
            $fieldRules = $split($option, '|'); // Split rules by |

            foreach ($fieldRules as $rule) {
                $params = [];

                // If rule has parameters (e.g. min:3)
                if (strpos($rule, ":")) {
                    [$rule_name, $param_str] = $split($rule, ":");
                    $params = $split($param_str, ','); // Extract parameters
                } else {
                    $rule_name = trim($rule); // Only rule name
                }

                // Create RuleProcessor for current rule
                $ruleReflection = new RuleProcessor;
                $ruleReflection->setDatabase($this->db);

                // Apply rule to data
                $error = $ruleReflection->ruleName($rule_name)->applyRule($data,$field,$params);

                // If validation fails, add error to list
                if (!empty($error)) {
                    $errors[$field][] = $error;
                }
            }
        }

        // Return all validation errors
        return $errors;
    }
}
