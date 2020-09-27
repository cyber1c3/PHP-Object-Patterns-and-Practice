<?php


namespace chapter04\code9;


trait PriceUtilities
{
    abstract function getTaxRate(): float;

    function calculateTax(float $price): float
    {
        return (($this->getTaxRate() / 100) * $price);
    }
}


abstract class Service{}


class UtilityService extends Service
{
    use PriceUtilities;

    function getTaxRate(): float
    {
        return 17;
    }
}

$u = new UtilityService();
print $u->calculateTax(100);