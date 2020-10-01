<?php

require_once "../chapter04/code2.php";

//print new ReflectionClass('chapter04\code2\CdProduct');
$product = new chapter04\code2\CdProduct("cd1", "bob", "bobbleson", 4, 50);
var_dump($product);