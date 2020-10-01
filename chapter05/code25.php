<?php

require_once "../chapter04/code2.php";


class ReflectionUtil
{
    public static function getClassSource(ReflectionClass $class): string
    {
        $path = $class->getFileName();
        $lines = file($path);
        $from = $class->getStartLine();
        $to = $class->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from - 1, $len));
    }
}

print ReflectionUtil::getClassSource(
    new ReflectionClass('chapter04\code2\CdProduct')
);