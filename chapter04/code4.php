<?php


namespace chapter04\code4;


interface Chargeable
{
    public function getPrice(): float;
}


class ShopProduct  implements Chargeable
{
    protected $price;

    public function getPrice(): float
    {
        return $this->price;
    }
}


