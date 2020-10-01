<?php

require_once "../chapter04/code2.php";


class ClassInfo
{
    public static function getData(ReflectionClass $class) {

        $details = "";
        $name = $class->getName();

        if ($class->isUserDefined())
            $details .= "$name is user defined".PHP_EOL;

        if ($class->isInternal())
            $details .= "$name is build-in".PHP_EOL;

        if ($class->isAbstract())
            $details .= "$name is an abstract class".PHP_EOL;

        if ($class->isFinal())
            $details .= "$name is a final class".PHP_EOL;

        if ($class->isInstantiable())
            $details .= "$name can be instantiated".PHP_EOL;
        else
            $details .= "$name can not be instantiated".PHP_EOL;

        if ($class->isCloneable())
            $details .= "$name can be cloned".PHP_EOL;
        else
            $details .= "$name can not be cloned".PHP_EOL;

        return $details;
    }
}

$prodclass = new ReflectionClass('chapter04\code2\CdProduct');
print ClassInfo::getData($prodclass);