<?php


class ShopProduct
{
    public $title = "default product";
    public $producerMainName = "main name";
    public $producerFirstName = 'first name';
    public $price = 0;

    public function __construct(string $title, string $producerFirstName, string $producerMainName, float $price){
        $this->title = $title;
        $this->producerFirstName = $producerFirstName;
        $this->producerMainName = $producerMainName;
        $this->price = $price;
    }

    public function getProducer() {
        return $this->producerFirstName." ".$this->producerMainName;
    }
}

class ShopProductWriter
{
    public function write(ShopProduct $shopProduct) {
        $str = $shopProduct->title.": ".$shopProduct->getProducer()."(".$shopProduct->price.")";
        print $str;
    }
}

$product1 = new ShopProduct("My Antonia", "Willa", "Cathe", 5.99);
$product2 = new ShopProduct("Exile on Coldharbour Lane", "The", "Alabama 3", 10.99);

print "author: ".$product1->getProducer().PHP_EOL;
print "artist: ".$product2->getProducer().PHP_EOL;