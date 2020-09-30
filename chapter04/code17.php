<?php


namespace chapter04\code17;


class Person
{
    protected $name;

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

    public function __destruct()
    {
        if (!empty($this->id)) {
            print "saving person".PHP_EOL;
        }
    }
}

//$person = new Person("Bob", 44);
//$person->setId(343);
//unset($person);