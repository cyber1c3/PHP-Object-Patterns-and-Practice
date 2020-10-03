<?php

class Contained{}


class Container
{

    public Contained $contained;

    public function __construct()
    {
        $this->contained = new Contained();
    }

    public function __clone()
    {
        $this->contained = clone $this->contained;
    }
}

$container = new Container();
var_dump($container);
$container2 = clone $container;
var_dump($container2);