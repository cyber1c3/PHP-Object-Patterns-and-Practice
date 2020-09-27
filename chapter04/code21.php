<?php


namespace chapter04\code21;


class Person
{
    function getName(): string
    {
        return "Bob";
    }

    function getAge(): int
    {
        return 44;
    }

    public function __toString(): string
    {
        $desc = $this->getName()."(age ";
        $desc .= $this->getAge(). ")";

        return $desc;
    }
}

$person = new Person();
print $person;
