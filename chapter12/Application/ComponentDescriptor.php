<?php


class ComponentDescriptor
{
    private string $path;
    private static ReflectionClass $refcmd;
    private string $cmdstr;

    public function __construct(string $path, string $cmdstr)
    {
        self::$refcmd = new ReflectionClass(Command::class);
        $this->path = $path;
        $this->cmdstr = $cmdstr;
    }

    public function getCommand(): object
    {
        return $this->resolveCommand($this->cmdstr);
    }

    public function setView(int $status, ViewComponent $view)
    {
        $this->views[$status] = $view;
    }

    public function getView(Request $request): ViewComponent
    {
        $status = $request->getCmdStatus();
        $status = is_null($status) ? 0 : $status;

        if (isset($this->views[$status]))
            return $this->views[$status];

        if (isset($this->views[0]))
            return $this->views[0];

        throw new AppException("no view found");
    }

    public function resolveCommand(string $class): object
    {
        if (is_null($class))
            throw new AppException("unknown class '$class'");

        if (!class_exists($class))
            throw new AppException("class '$class' not found");

        $refclass = new ReflectionClass($class);

        if (!$refclass->isSubclassOf(self::$refcmd))
            throw new AppException("Command '$class' is not a Command");

        return $refclass->newInstace();
    }
}