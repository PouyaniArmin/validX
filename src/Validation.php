<?php

namespace Validx;

use ReflectionClass;
use Validx\Rules\RuleProcessor;

use function PHPSTORM_META\map;

use const Dom\VALIDATION_ERR;

class Validation
{
    protected $db;
    public function __construct($db)
    {
        $this->db=$db;
    }
    public function validate(array $data, array $rules)
    {
        $errors = [];
        $split = fn($str, $separator) => array_map('trim', explode($separator, $str));
        foreach ($rules as $field => $option) {
            $fieldRules = $split($option, '|');
            foreach ($fieldRules as $rule) {
                $params = [];
                if (strpos($rule, ":")) {
                    [$rule_name, $param_str] = $split($rule, ":");
                    $params = $split($param_str, ',');
                } else {
                    $rule_name = trim($rule);
                }
                $ruleReflection=new RuleProcessor;
                $ruleReflection->setDatabase($this->db);
                $error=$ruleReflection->ruleName($rule_name)->applyRule($data,$field,$params);   
                if (!empty($error)) {
                    $errors[$field][]=$error;
                }
            }
        }
        return $errors;
    }
}
