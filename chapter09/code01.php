<?php

namespace chapter09\code01;


abstract class Employee
{

    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}


class Minion extends Employee
{

    public function fire()
    {
        print "{$this->name}: I'll clear my desk".PHP_EOL;
    }
}


class NastyBoss
{

    private array $employees = [];

    public function addEmployee(string $employeeName)
    {
        $this->employees[] = new Minion($employeeName);
    }

    public function projectFails()
    {
        if (count($this->employees) > 0) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

$boss = new NastyBoss();
$boss->addEmployee("harry");
$boss->addEmployee("bob");
$boss->addEmployee("mary");
$boss->projectFails();