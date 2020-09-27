<?php


namespace chapter04\code10;


trait PriceUtilities
{
    public abstract function getTaxRate(): float;

    public function calculateTax(float $price): float
    {
        return (($this->getTaxRate() / 100) * $price);
    }
}


abstract class Service{};


class UtilityService extends Service
{
    use PriceUtilities {
        PriceUtilities::calculateTax as private;
    }

    private $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getTaxRate(): float
    {
        return 17;
    }

    /**
     * @return float
     */
    public function getFinalPrice(): float
    {
        return $this->price + $this->calculateTax($this->price);
    }
}

$u = new UtilityService(100);
print $u->getFinalPrice();