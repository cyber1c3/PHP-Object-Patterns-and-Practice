<?php


namespace chapter04\code18;


class CopyMe
{

}


$first = new CopyMe();
$second = clone $first;

var_dump($first);
var_dump($second);