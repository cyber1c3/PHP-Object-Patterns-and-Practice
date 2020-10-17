<?php


abstract class PageController
{
    private Registry $reg;

    abstract public function process();

    public function __construct()
    {
        $this->reg = Registry::instance();
    }

    public function init()
    {
        if (isset($_SERVER['REQUEST_METHOD']))
            $request = new HttpRequest();
        else
            $request = new CliRequest();
    }

    public function forward(string $resource)
    {
        $request = $this->getRequest();
        $request->forward($resource);
    }

    public function render(string $resource, Request $request)
    {
        include "$resource";
    }

    public function getRequest()
    {
        return $this->reg->getRequest();
    }
}