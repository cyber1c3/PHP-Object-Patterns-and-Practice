<?php

require_once "../chapter04/code2.php";

class Product
{
    public static function getProduct()
    {
        return new chapter04\code2\CdProduct(
            "Exile on Cold harbour Lane",
            "The",
            "Alabama 3",
            10.99,
            60.33
        );
    }

    public static function init()
    {
        $product = self::getProduct();

        if (get_class($product) === "chapter04\code2\CdProduct") {
            print "$product is a CdProduct object".PHP_EOL;
        }

        if ($product instanceof chapter04\code2\ShopProduct) {
            print "$product is an instance of ShopProduct".PHP_EOL;
        }
    }
}

$product = Product::getProduct();

$method = "getTitle";

if (in_array($method, get_class_methods($product))) {
    print $product->$method().PHP_EOL;
}

if (is_callable(array($product, $method))) {
    print $product->$method().PHP_EOL;
}

if (method_exists($product, $method)) {
    print $product->$method().PHP_EOL;
}

print_r(get_class_vars("chapter04\code2\CdProduct"));

print get_parent_class("chapter04\code2\CdProduct");

if (is_subclass_of($product, "chapter04\code2\ShopProduct")) {
    print get_class($product)." is a subclass of ShopProduct".PHP_EOL;
}