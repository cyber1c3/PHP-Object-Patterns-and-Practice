<?php


function hello() {
    print "hello, 0xGeekCat".PHP_EOL;
}

class B
{
    public $a;
    public $b;

    public function hello() {
        print "hello, world".PHP_EOL;
    }

    public function sum(int $a, int $b) {
        print $a + $b.PHP_EOL;
    }
}

call_user_func('hello');
call_user_func([new B(), 'hello']);
call_user_func([new B(), 'sum'], 2, 3);
call_user_func_array(array(new B(), 'sum'), array(2, 3));