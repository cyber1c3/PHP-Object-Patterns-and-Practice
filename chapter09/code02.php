<?php

namespace chapter09\code02;


abstract class Employee
{

    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}


class NastyBoss
{

    private array $employees = [];

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function projectFails()
    {
        if (count($this->employees) > 0) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}


class Minion extends Employee
{

    public function fire()
    {
        print "{$this->name}: I'll clear my desk".PHP_EOL;
    }
}


class CluedUp extends Employee
{

    public function fire()
    {
        print "{$this->name}: I'll call my lawyer".PHP_EOL;
    }
}

$boss = new NastyBoss();
$boss->addEmployee(new Minion("harry"));
$boss->addEmployee(new CluedUp("bob"));
$boss->addEmployee(new Minion("mary"));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();