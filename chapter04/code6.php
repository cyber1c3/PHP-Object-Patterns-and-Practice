<?php


namespace chapter04\code6;


trait PriceUtilities
{
    private $taxrate = 17;

    public function calculateTax(float $price): float
    {
        return (($this->taxrate / 100) * $price);
    }
}


trait IdentityTrait
{
    public function generateId(): string
    {
        return uniqid();
    }
}


class ShopProduct
{
    use PriceUtilities, IdentityTrait;
}


abstract class Service{}


class UtilityService extends Service
{
    use PriceUtilities;
}

$p = new ShopProduct();
print $p->calculateTax(100).PHP_EOL;
print $p->generateId().PHP_EOL;

$u = new ShopProduct();
print $p->calculateTax(100).PHP_EOL;