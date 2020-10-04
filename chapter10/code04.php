<?php

namespace chapter10\code04;


abstract class Tile
{
    abstract public function getWealthFactor(): int;
}


class Plains extends Tile
{
    private int $wealthfactor = 2;

    public function getWealthFactor(): int
    {
        return $this->wealthfactor;
    }
}


abstract class TileDecorator extends Tile
{
    protected Tile $tile;

    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }
}


class DiamondDecorator extends TileDecorator
{

    public function getWealthFactor(): int
    {
        return $this->tile->getWealthFactor() + 2;
    }
}


class PollutionDecorator extends TileDecorator
{

    public function getWealthFactor(): int
    {
        return $this->tile->getWealthFactor() - 4;
    }
}

$tile = new Plains();
print $tile->getWealthFactor().PHP_EOL;

$tile = new DiamondDecorator(new Plains());
print $tile->getWealthFactor().PHP_EOL;

$tile = new PollutionDecorator(new DiamondDecorator(new Plains()));
print $tile->getWealthFactor().PHP_EOL;