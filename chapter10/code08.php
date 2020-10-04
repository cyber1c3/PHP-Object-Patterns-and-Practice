<?php

namespace chapter10\code08;


use chapter10\code06\Product;
use function chapter10\code06\getIDFromLine;
use function chapter10\code06\getNameFromLine;
use function chapter10\code06\getProductFileLines;
use function chapter10\code06\getProductObjectFromId;

require_once 'code06.php';


class ProductFacade
{
    private array $products = [];
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
        $this->compile();
    }

    private function compile()
    {
        $lines = getProductFileLines($this->file);

        foreach ($lines as $line) {
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            $this->products[$id] = getProductObjectFromId($id, $name);
        }
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProduct(string $id): ?Product
    {
        if (isset($this->products[$id]))
            return $this->products[$id];

        return null;
    }
}

$facade = new ProductFacade(__DIR__.'/code07.txt');
$object = $facade->getProduct('234');
print_r($object);