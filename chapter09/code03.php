<?php

namespace chapter09\code03;


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


abstract class Employee
{

    protected string $name;
    private static array $types = ['Minion', 'CluedUp', 'WellConnected'];

    public static function recruit(string $name)
    {
        $num = rand(1, count(self::$types)) - 1;
        $class = __NAMESPACE__.'\\'.self::$types[$num];
        return new $class($name);
    }

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


class CluedUp extends Employee
{

    public function fire()
    {
        print "{$this->name}: I'll call my lawyer".PHP_EOL;
    }
}


class WellConnected extends Employee
{

    public function fire()
    {
        print "{$this->name}: I'll call my dad".PHP_EOL;
    }
}

$boss = new NastyBoss();
$boss->addEmployee(Employee::recruit("harry"));
$boss->addEmployee(Employee::recruit("bob"));
$boss->addEmployee(Employee::recruit("mary"));