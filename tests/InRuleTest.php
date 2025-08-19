<?php

use PHPUnit\Framework\TestCase;
use Validx\Rules\InRule;

class InRuleTest extends TestCase{
    protected InRule $in;
    public function setUp():void{
        $this->in=new InRule;
    }
    /**
     * @dataProvider providerValidationCase
     */
    public function testValidation(array $data,string $field,array $allowed,bool $expected){
        $this->assertSame($expected,$this->in->validate($data,$field,...$allowed));
    }
    public static function providerValidationCase():array{
        return [
            'value in list'=>[['status'=>'active'],'status',['active','inactive'],true],
            'value not in list'=>[['status'=>'pending'],'status',['active','inactive'],false],
            'empty value'=>[['status'=>''],'status',['active','inactive'],false],
        ];
    } 
    
}