<?php

$basic = function ($classname) {
    $file = __DIR__."/"."{$classname}.php";

    print $file.PHP_EOL;

    if (file_exists($file))
        require_once $file;
};

spl_autoload_register($basic);

$code11 = new Code11();
$code11->wave();