<?php 


namespace Validx\Rules;

use ReflectionFunctionAbstract;

interface RuleInterface{
    public function validate(array $data,string $field,...$params):bool;
    public function message(string $field,...$params):string;
}