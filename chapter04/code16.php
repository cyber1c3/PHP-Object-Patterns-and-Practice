<?php


namespace chapter04\code16;


use function Sodium\add;

class Address
{
    private $number;
    private $street;

    public function __construct(string $maybenumber, string $maybestreet = null)
    {
        if (is_null($maybestreet)) {
            $this->streetaddress = $maybenumber;
        } else {
            $this->number = $maybenumber;
            $this->street = $maybestreet;
        }
    }

    public function __set(string $property, string $value)
    {
        if ($property === "streetaddress") {
            if (preg_match("/^(\d+.*?)[\s,]+(.+)$/", $value, $matches)) {

                $this->number = $matches[1];
                $this->street = $matches[2];
            } else {
                throw new \Exception("unable to parse street address: '{$value}'");
            }
        }
    }

    public function __get(string $property)
    {
        if ($property === "streetaddress") {
            return $this->number." ".$this->street;
        }

        return null;
    }
}

$address = new Address("441b Bakers Street");
print "street address: {$address->streetaddress}".PHP_EOL;

$address = new Address("15", "Albert Mews");
print "street address: {$address->streetaddress}".PHP_EOL;

$address->streetaddress = "34, West 24th Avenue";
print "street address: {$address->streetaddress}".PHP_EOL;

$address = new Address("441b Bakers Street");
print_r($address);