<?php

namespace code3;


class CdProduct
{
    public $playLength;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct(string $title, string $firstName, string $mainName,string $price, string $playLength)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ({$this->producerMainName}, ";
        $base .= "{$this->producerFirstName})";
        $base .= ": playing time - {$this->playLength}";
        return $base;
    }

    public function getProducer()
    {
        return $this->producerFirstName." ".$this->producerMainName;
    }
}


class BookProduct
{
    public $numPages;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    public function __construct(string $title, string $firstName, string $mainName, string $price, int $numPages)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
        $this->numPages = $numPages;
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ({$this->producerMainName}, ";
        $base .= "{$this->producerFirstName})";
        $base .= ": playing time - {$this->numPages}";
        return $base;
    }

    public function getProducer()
    {
        return $this->producerFirstName." ".$this->producerMainName;
    }
}


class ShopProductWrite
{
    public function write($shopProduct)
    {
        if (!($shopProduct instanceof CdProduct) && !($shopProduct instanceof BookProduct)) {
            die("wrong type supplied");
        }

        $str = $shopProduct->title.": ".$shopProduct->getProducer()."(".$shopProduct->price.")";
        print $str;
    }
}