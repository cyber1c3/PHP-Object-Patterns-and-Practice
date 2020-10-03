<?php

namespace chapter08\code02;


abstract class Lesson
{

    private $duration;
    private $costSrategy;

    public function __construct(int $duration, CostStrategy $strategy)
    {
        $this->duration = $duration;
        $this->costSrategy = $strategy;
    }

    public function cost(): int
    {
        return $this->costSrategy->cost($this);
    }

    public function chargeType(): string
    {
        return $this->costSrategy->chargeType();
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}


class Lecture extends Lesson{}


class Seminar extends Lesson{}


abstract class CostStrategy
{
    abstract public function cost(Lesson $lesson): int;

    abstract public function chargeType(): string;
}


class TimeCostStrategy extends CostStrategy
{

    public function cost(Lesson $lesson): int
    {
        return $lesson->getDuration() * 5;
    }

    public function chargeType(): string
    {
        return "hourly rate";
    }
}


class FixedCostStrategy extends CostStrategy
{

    public function cost(Lesson $lesson): int
    {
        return 30;
    }

    public function chargeType(): string
    {
        return "fixed rate";
    }
}

$lessons[] = new Seminar(4, new TimeCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

foreach ($lessons as $lesson) {
    print "lesson charge {$lesson->cost()}. ";
    print "Charge type: {$lesson->chargeType()}".PHP_EOL;
}