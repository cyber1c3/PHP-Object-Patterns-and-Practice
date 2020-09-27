<?php


namespace chapter04\code14;


class Person
{
    private $myname;
    private $myage;

    public function __get(string $property)
    {
        $method = "get{$property}";

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return null;
    }

    public function __isset(string $property)
    {
        $method = "get{$property}";

        return (method_exists($this, $method));
    }

    public function __set(string $property, string $value)
    {
        $method = "set{$property}";

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        return null;
    }

    public function __unset(string $property)
    {
        $method = "set{$property}";

        if (method_exists($this, $method)) {
            $this->$method(null);
        }
    }

    public function setName(string $name): void
    {
        $this->myname = $name;

        if (!is_null($name)) {
            $this->myname = strtoupper($this->myname);
        }
    }

    public function setAge(int $age): void
    {
        $this->myage = $age;
    }

    public function getName(): string
    {
        return $this->myname;
    }

    public function getAge(): int
    {
        return $this->myage;
    }
}

$p = new Person();

$p->name = "Bob";

print $p->name;