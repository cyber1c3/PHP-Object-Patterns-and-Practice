<?php


namespace chapter04\code7;


interface IdentityObject
{
    public function generateId(): string;
}


trait IdentityTrait
{
    public function generateId(): string
    {
        return uniqid();
    }
}


class ShopProduct implements IdentityObject
{
    use IdentityTrait;

    public static function storeIdentityObject(IdentityObject $idobj)
    {

    }
}

$p = new ShopProduct();
ShopProduct::storeIdentityObject($p);
print $p->generateId();