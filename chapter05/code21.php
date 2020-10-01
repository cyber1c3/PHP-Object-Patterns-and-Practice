<?php

interface A
{
    public function Hello(): void;
}

class B
{
    public $name = "0xGeekCat";
}

class C extends B implements A
{
    public function Hello(): void
    {
        print "hello, world".PHP_EOL;
    }
}

print_r(class_implements('C'));