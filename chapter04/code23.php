<?php


namespace chapter04\code23;


class Person
{
    public function output(PersonWriter $writer)
    {
        $writer->write($this);
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


interface PersonWriter
{
    public function write(Person $person);
}

$person = new Person();
$person->output(
    new class implements PersonWriter {
        public function write(Person $person)
        {
            print $person->getName()." ".$person->getAge().PHP_EOL;
        }
    }
);

$person->output(
    new class('persondump') implements PersonWriter {
        private $path;

        public function __construct(string $path)
        {
            $this->path = $path;
        }

        public function write(Person $person)
        {
            file_put_contents($this->path, $person->getName()." ".$person->getAge()."\n");
        }
    }
);