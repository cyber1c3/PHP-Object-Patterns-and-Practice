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

Product::init();