<?php


class Venue extends DomainObject
{
    private string $name;
    private $spaces;

    public function __construct(int $id, string $name)
    {
        $this->name = $name;
        $this->spaces = self::getCollection(Space::class);
        parent::__construct($id);
    }

    public function setSpaces(Collection $spaces)
    {
        $this->spaces = $spaces;
    }

    public function getSpaces()
    {
        return $this->spaces;
    }

    public function addSpace(Space $space)
    {
        $this->spaces->add($space);
        $space->setVenue($this);
    }

    public function setName(StructureRequest $name)
    {
        $this->name = $name;
        $this->markDirty();
    }

    public function getName()
    {
        return $this->name;
    }
}