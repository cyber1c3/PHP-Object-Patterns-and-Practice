<?php


namespace chapter04\code8;


trait TaxTools
{
    function calculateTax(float $price): float
    {
        return 222;
    }
}


trait PriceUtilities
{
    private static $taxrate = 17;

    public static function calculateTax(float $price): float
    {
        return ((self::$taxrate / 100) * $price);
    }
}

abstract class Service{}


class UtilityService extends Service
{
    use PriceUtilities, TaxTools {
        TaxTools::calculateTax insteadof PriceUtilities;
        PriceUtilities::calculateTax as basicTax;
    }
}

$u = new UtilityService();
print $u->basicTax(100).PHP_EOL;
print UtilityService::basicTax(100).PHP_EOL;