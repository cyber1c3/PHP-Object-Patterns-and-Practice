<?php

namespace chapter05\code27;
require_once "../chapter04/code2.php";


class ClassInfo
{
    public static function argData(\ReflectionParameter $arg)
    {
        $details = "";
        $class = $arg->getDeclaringClass();
        $name = $arg->getName();
//        $class = $arg->getClass();
        $position = $arg->getPosition();

        $details .= "$$name has position $position".PHP_EOL;

        if (!empty($class)) {
            $classname = $class->getName();
            $details .= "$$name must be a $classname object".PHP_EOL;
        }

        if ($arg->isPassedByReference())
            $details .= "$$name is passed by reference".PHP_EOL;

        if ($arg->isDefaultValueAvailable()) {
            $def = $arg->getDefaultValue();
            $details .= "$$name has default: $def".PHP_EOL;
        }

        if ($arg->allowsNull())
            $details .= "$$name can be null".PHP_EOL;

        return $details;
    }
}


$class = new \ReflectionClass('chapter04\code2\CdProduct');

$method = $class->getMethod("__construct");
$params = $method->getParameters();

foreach ($params as $param) {
    print ClassInfo::argData($param).PHP_EOL;
}