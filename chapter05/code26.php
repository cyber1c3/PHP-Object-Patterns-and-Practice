<?php

namespace chapter05\code26;
require_once "../chapter04/code2.php";


class ClassInfo
{
    public static function methodData(\ReflectionMethod $method) {

        $details = "";
        $name = $method->getName();

        if ($method->isUserDefined())
            $details .= "$name is user defined".PHP_EOL;

        if ($method->isInternal())
            $details .= "$name is build-in".PHP_EOL;

        if ($method->isAbstract())
            $details .= "$name is abstract".PHP_EOL;

        if ($method->isPublic())
            $details .= "$name is public".PHP_EOL;

        if ($method->isPrivate())
            $details .= "$name is private".PHP_EOL;

        if ($method->isStatic())
            $details .= "$name is static".PHP_EOL;

        if ($method->isFinal())
            $details .= "$name is final".PHP_EOL;

        if ($method->isConstructor())
            $details .= "$name is constructor".PHP_EOL;

        if ($method->returnsReference())
            $details .= "$name returns a reference (as opposed to a value)".PHP_EOL;

        return $details;
    }
}

$prodclass = new \ReflectionClass('chapter04\code2\CdProduct');
$methods = $prodclass->getMethods();

foreach ($methods as $method) {
    print ClassInfo::methodData($method);
    print PHP_EOL."----".PHP_EOL;
}