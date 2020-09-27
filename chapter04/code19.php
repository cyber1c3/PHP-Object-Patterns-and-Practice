<?php


namespace chapter04\code19;


class Person
{
    private $name;
    private $age;
    private $id;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function __clone()
    {
        $this->id = 0;
    }
}

$person = new Person("Bob", 44);
$person->setId(343);
$person2 = clone $person;

print_r($person);
print_r($person2);