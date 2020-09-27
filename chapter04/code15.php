<?php


namespace chapter04\code15;


class PersonWriter
{
    public function writeName(Person $p)
    {
        print $p->getName().PHP_EOL;
    }

    public function writeAge(Person $p)
    {
        print $p->getAge().PHP_EOL;
    }
}


class Person
{
    private $writer;

    public function __construct(PersonWriter $writer)
    {
        $this->writer = $writer;
    }

    public function __call(string $method, array $args)
    {
        if (method_exists($this->writer, $method)) {
            return $this->writer->$method($this);
        }

        return null;
    }

    public function getName(): string
    {
        return "Bob";
    }

    public function getAge(): int
    {
        return 44;
    }
}

$person = new Person(new PersonWriter());
$person->writeName();