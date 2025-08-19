<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\AlphanumericRule;

class AlphanumericRuleTest extends TestCase{
    protected AlphanumericRule $alphanumeric;

    public function setUp():void{
        $this->alphanumeric=new AlphanumericRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data,string $field,bool $expected){
        $this->assertSame($expected,$this->alphanumeric->validate($data,$field));
    }
    public static function providerValidationCase():array{
        return [
            'vaild alphanumeric'=>[['username'=>'Example125'],'username',true],
            'invalid alphanumeric'=>[['username'=>'Exampl#-15e125'],'username',false]
        ];
    }
}