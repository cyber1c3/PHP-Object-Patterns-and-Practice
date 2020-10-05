<?php

namespace chapter11\code05;


abstract class Unit
{
    abstract public function bombardStrength(): int;

    public function accept(ArmyVisitor $visitor)
    {
        try {
            $refthis = new \ReflectionClass(get_class($this));
        } catch (\ReflectionException $e) {

        }
        $method = "visit".$refthis->getShortName();
        $visitor->$method($this);
    }

    public function isNull()
    {
        return false;
    }
}


abstract class CompositeUnit extends Unit
{
    protected array $units = [];

    public function addUnit(Unit $unit)
    {
        foreach ($this->units as $thisunit) {
            if ($unit === $thisunit)
                return;
        }

        array_push($this->units, $unit);
    }

    public function accept(ArmyVisitor $visitor)
    {
        parent::accept($visitor);

        foreach ($this->units as $thisunit) {
            $thisunit->accept($visitor);
        }
    }
}


abstract class ArmyVisitor
{
    abstract public function visit(Unit $node);

    public function visitArcher(Archer $node)
    {
        $this->visit($node);
    }

    public function visitCavalry(Cavalry $node)
    {
        $this->visit($node);
    }

    public function visitLaserCannonUnit(LaserCannonUnit $node)
    {
        $this->visit($node);
    }

    public function visitArmy(Army $node)
    {
        $this->visit($node);
    }
}


class TextDumpArmyVisitor extends ArmyVisitor
{
    private string $text = "";

    public function visit(Unit $node)
    {
        $txt = "";
        $txt .= get_class($node).": ";
        $txt .= "bombard: ".$node->bombardStrength().PHP_EOL;
        $this->text .= $txt;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
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


class TaxCollectionVisitor extends ArmyVisitor
{
    private int $due = 0;
    private string $report = "";


    public function visit(Unit $node)
    {
        $this->levy($node, 1);
    }

    public function visitArcher(Archer $node)
    {
        $this->levy($node, 2);
    }

    public function visitCavalry(Cavalry $node)
    {
        $this->levy($node, 3);
    }

    private function levy(Unit $unit, int $amount)
    {
        $this->report .= "Tax levied for ".get_class($unit);
        $this->report .= ": $amount".PHP_EOL;
        $this->due += $amount;
    }

    /**
     * @return string
     */
    public function getReport(): string
    {
        return $this->report;
    }

    /**
     * @return int
     */
    public function getTax(): int
    {
        return $this->due;
    }
}


class TileForces
{
    private array $units = [];
    private int $x;
    private int $y;

    public function __construct(int $x, int $y, UnitAcquisition $acq)
    {
        $this->x = $x;
        $this->y = $y;
        $this->units = $acq->getUnits($this->x, $this->y);
    }

    public function firepower(): int
    {
        $power = 0;

        foreach ($this->units as $unit) {

            if (!$unit->isNull())
                $power += $unit->bombardStrength();
            else
                print "null - no action".PHP_EOL;
        }

        return $power;
    }
}


class UnitAcquisition
{
    public function getUnits(int $x, int $y): array
    {
        // 在本地数据中查找x和y并得到一份队伍id的列表
        // 在数据源中查找出队伍的完整数据

        // 下面直接实例化了几个Unit对象
        $army = new Army();
        $army->addUnit(new Archer());

        return [
            new Cavalry(),
//            null,
            new NullUnit(),
            new LaserCannonUnit(),
            $army
        ];
    }
}


class NullUnit extends Unit
{
    public function bombardStrength(): int
    {
        return 0;
    }

    public function getHealth(): int
    {
        return 0;
    }

    public function isNull()
    {
        return true;
    }
}

$acquirer = new UnitAcquisition();
$tileforces = new TileForces(4, 2, $acquirer);
$power = $tileforces->firepower();
print "power is ".$power.PHP_EOL;