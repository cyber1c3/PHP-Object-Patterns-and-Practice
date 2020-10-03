<?php

require_once 'code07.php';


class ObjectAssembler
{

    private array $components = [];

    public function __construct(string $conf)
    {
        $this->configure($conf);
    }

    private function configure(string $conf)
    {
        $data = simplexml_load_file($conf);

        foreach ($data->class as $class) {
            $args = [];
            $name = (string) $class['name'];

            foreach ($class->arg as $arg) {
                $argclass = (string) $arg['inst'];
                $args[(int) $arg['num']] = $argclass;
            }

            ksort($args);

            $this->components[$name] = function () use ($name, $args) {
                $expandedargs = [];

                foreach ($args as $arg)
                    $expandedargs[] = new $arg();

                $rclass = new ReflectionClass($name);

                return $rclass->newInstanceArgs($expandedargs);
            };
        }
    }

    public function getComponent(string $class)
    {
        if (!isset($this->components[$class]))
            throw new Exception("unknown component '$class'");

        $ret = $this->components[$class]();

        return $ret;
    }
}

$assembler = new ObjectAssembler('code10.xml');
$appmaker = $assembler->getComponent('\chapter09\code07\TerrainFactory');
$out = $appmaker->getSea();
print_r($out);