<?php


namespace chapter04\code3;
use chapter04\code2\ShopProduct;


abstract class ShopProductWriter
{
    protected $products = [];

    public function addProduct(ShopProduct $shopProduct)
    {
        $this->products[] = $shopProduct;
    }

    abstract public function write();
}


class ErroredWriter extends ShopProductWriter
{

    public function write(){}
}


class XmlProductWriter extends ShopProductWriter
{

    public function write()
    {
        $writer = new \XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement("products");

        foreach ($this->products as $shopProduct) {
            $writer->startElement("product");
            $writer->writeAttribute("title", $shopProduct->getTitle());
            $writer->startElement("summary");
            $writer->text($shopProduct->getSummaryLine());
            $writer->endElement(); // summary
            $writer->endElement(); // product
        }

        $writer->endElement(); // products
        $writer->endDocument();
        print $writer->flush();
    }
}


class TextProductWriter extends ShopProductWriter
{

    public function write()
    {
        $str = "PRODUCTS:".PHP_EOL;

        foreach ($this->products as $shopProduct) {
            $str .= $shopProduct->getSummaryLine().PHP_EOL;
        }

        print $str;
    }
}