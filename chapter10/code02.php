<?php

namespace chapter10\code01;


class UnitException extends \Exception{}


abstract class Unit
{

    public function getComposite()
    {
        return null;
    }

    abstract public function bombardStrength(): int;
}


abstract class CompositeUnit extends Unit
{

    protected array $units = [];

    public function getComposite(): CompositeUnit
    {
        return $this;
    }

    public function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, true))
            return;

        array_push($this->units, $unit);
    }

    public function removeUnit(Unit $unit)
    {
        $idx = array_search($unit, $this->units, true);

        if (is_int($idx))
            array_splice($this->units, $idx, 1, []);
    }

    private function getUnits(): array
    {
        return $this->units;
    }
}


class Army extends CompositeUnit
{

    public function bombardStrength(): int
    {
        $ret = 0;

        foreach ($this->units as $unit)
            $ret += $unit->bombardStrength();

        return $ret;
    }
}


class TroopCarrier extends CompositeUnit
{
    public function addUnit(Unit $unit)
    {
        if ($unit instanceof Cavalry)
            throw new UnitException("can't get a horse on the vehicle");

        parent::addUnit($unit);
    }

    public function bombardStrength(): int
    {
        return 0;
    }
}


class Archer extends Unit
{

    public function bombardStrength(): int
    {
        return 4;
    }
}


class LaserCannonUnit extends Unit
{

    public function bombardStrength(): int
    {
        return 44;
    }
}


class Cavalry extends Unit
{

    public function bombardStrength(): int
    {
        return 20;
    }
}


class UnitScript
{
    public static function joinExisting(Unit $newUnit, Unit $occupyingUnit): CompositeUnit
    {
        $comp = $occupyingUnit->getComposite();

        if (!is_null($comp))
            $comp->addUnit($newUnit);
        else {
            $comp = new Army();
            $comp->addUnit($occupyingUnit);
            $comp->addUnit($newUnit);
        }

        return $comp;
    }
}