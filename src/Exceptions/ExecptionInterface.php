<?php

namespace Validx\Exceptions;

interface ExecptionInterface{
    public static function throwWith(string $context):void;
}