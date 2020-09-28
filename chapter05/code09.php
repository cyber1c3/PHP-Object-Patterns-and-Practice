<?php

set_include_path(get_include_path().PATH_SEPARATOR.'../chapter03');

print get_include_path().PHP_EOL;

require_once "code.php";

$product1 = new ShopProduct("My Antonia", "Willa", "Cathe", 5.99);

print "author: ".$product1->getProducer().PHP_EOL;

