<?php


class Registry
{
    private static $instance = null;
    private Request $request;
    private ApplicationHelper $applicationHelper;
    private Conf $conf;
    private Conf $commands;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        if (is_null($this->request))
            throw new Exception("No request set");

        return $this->request;
    }

    public function getApplicationHelper(): ApplicationHelper
    {
        if (is_null($this->applicationHelper))
            $this->applicationHelper = new ApplicationHelper();

        return $this->applicationHelper;
    }

    /**
     * @param Conf $conf
     */
    public function setConf(Conf $conf): void
    {
        $this->conf = $conf;
    }

    /**
     * @return Conf
     */
    public function getConf(): Conf
    {
        return $this->conf;
    }

    public function setCommands(Conf $commands): void
    {
        $this->commands = $commands;
    }

    public function getCommands(): Conf
    {
        return $this->commands;
    }
}


