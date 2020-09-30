<?php

$base = __DIR__;
$classname = "Code14";
$path = "{$base}/{$classname}.php";

if (!file_exists($path)) {
    throw new Exception("No such file as $path");
}

require_once $path;
$classname = "code14\\$classname";

if (!class_exists($classname)) {
    throw new Exception("No such class as $classname");
}

$obj = new $classname();
$obj->doSpeak();