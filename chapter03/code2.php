<?php

declare(strict_types=1);

class AddressManager
{
    private $addresses = ["209.131.36.159", "216.58.213.174"];

    public function outputAddresses(bool $resolve) {

        foreach ($this->addresses as $address) {
            print $address;
            if ($resolve) {
                print "(".gethostbyaddr($address).")";
            }
            print PHP_EOL;
        }
    }
}

$settings = simplexml_load_file(__DIR__ . "/code2.xml");
$manager = new AddressManager();
$manager->outputAddresses((bool)$settings->resolvedomains);