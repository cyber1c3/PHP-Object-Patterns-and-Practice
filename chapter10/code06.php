<?php

namespace chapter10\code06;

function getProductFileLines($file)
{
    return file($file);
}

function getProductObjectFromId($id, $productname)
{
    return new Product($id, $productname);
}

function getNameFromLine($line)
{
    if (preg_match('/.*-(.*)\s\d/', $line, $array))
        return str_replace('_', ' ', $array[1]);

    return '';
}

function getIDFromLine($line)
{
    if (preg_match('/^(\d{1,3})-/', $line, $array))
        return $array[1];

    return -1;
}

class Product
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

//$lines = getProductFileLines(__DIR__.'/code07.txt');
//$objects = [];
//
//foreach ($lines as $line) {
//    $id = getIDFromLine($line);
//    $name = getNameFromLine($line);
//    $objects[$id] = getProductObjectFromId($id, $name);
//}
//
//print_r($objects);