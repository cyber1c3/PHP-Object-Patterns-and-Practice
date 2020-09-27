<?php


namespace chapter04\code11;


abstract class DomainObject
{
    private $group;

    public function __construct()
    {
        $this->group = static::getGroup();
    }

    public static function create(): DomainObject
    {
        return new static();
    }

    public static function getGroup(): string
    {
        return "default";
    }
}


class User extends DomainObject
{

}


class Document extends DomainObject
{
    public static function getGroup(): string
    {
        return "document";
    }
}


class SpreadSheet extends Document
{

}

print_r(User::create());
print_r(SpreadSheet::create());