<?php


class DomainObject
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function getCollection(string $type): Collection
    {
        return Collection::getCollection($type);
    }

    public function markDirty()
    {

    }
}