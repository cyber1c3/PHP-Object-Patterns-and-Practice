<?php


namespace chapter04\code20;


class Account
{
    public $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}


class Person
{
    private $name;
    private $age;
    private $id;

    public $account;

    public function __construct(string $name, int $age, Account $account)
    {
        $this->name = $name;
        $this->age = $age;
        $this->account = $account;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function __clone()
    {
        $this->id = 0;
        $this->account = clone $this->account;
    }
}

$person = new Person("Bob", 44, new Account(200));
$person->setId(343);
$person2 = clone $person;

$person->account->balance += 10;

print $person2->account->balance;