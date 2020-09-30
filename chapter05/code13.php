<?php

$namespaces = function ($path) {

    print $path.PHP_EOL;

    if (preg_match('/\\\\/', $path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }

    print $path.PHP_EOL;

    if (file_exists("{$path}.php")) {
        require_once "{$path}.php";
    }
};


spl_autoload_register($namespaces);

$obj = new chapter05\Code12();
$obj->wave();