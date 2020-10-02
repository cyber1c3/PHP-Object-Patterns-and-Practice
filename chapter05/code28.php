<?php


class Person
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}


interface Module
{
    public function execute();
}


class FtpModule implements Module
{
    public function setHost($host)
    {
        print "FtpModule::setHost(): $host".PHP_EOL;
    }

    public function setUser($user)
    {
        print "FtpModule::setUser(): $user".PHP_EOL;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}


class PersonModule implements Module
{
    public function setPerson(Person $person)
    {
        print "PersonModule::setPerson(): {$person->name}".PHP_EOL;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}


class ModuleRunner
{
    private $configData = [
        "PersonModule" => ['person' => 'bob'],
        "FtpModule"    => [
            'host'  => 'example.com',
            'user'  => 'anon'
        ]
    ];

    private $modules = [];

    public function init()
    {
        $interface = new ReflectionClass('Module');

        foreach ($this->configData as $modulename => $params) {
            $module_class = new ReflectionClass($modulename);

            if (!$module_class->isSubclassOf($interface))
                throw new Exception("unknown module type: $modulename");

            $module = $module_class->newInstance();

            foreach ($module_class->getMethods() as $method) {
                $this->handleMethod($module, $method, $params);
            }

            array_push($this->modules, $module);
        }
    }

    public function handleMethod(Module $module, ReflectionMethod $method, $params)
    {
        $name = $method->getName();
        $args = $method->getParameters();

        if (count($args) != 1 || substr($name, 0, 3) != "set")
            return false;

        $property = strtolower(substr($name, 3));

        if (!isset($params[$property]))
            return false;

        $arg_class = $args[0]->getClass();

        if (empty($arg_class))
            $method->invoke($module, $params[$property]);
        else
            $method->invoke($module, $arg_class->newInstance($params[$property]));

        return true;
    }
}

$test = new ModuleRunner();
$test->init();