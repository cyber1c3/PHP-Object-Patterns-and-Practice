<?php

require_once '../Registry/Registry.php';


class Controller
{
    private $reg;

    private function __construct()
    {
        $this->reg = Registry::instance();
    }

    public static function run()
    {
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();
    }

    private function init()
    {
        $this->reg->getApplicationHelper()->init();
    }

    private function handleRequest()
    {
        try {
            $request = $this->reg->getRequest();
        } catch (Exception $e) {
            throw new Exception("get request error");
        }

        $controller = new AppController();
        $cmd = $controller->getCommand($request);
        $cmd->execute($request);
        $view = $controller->getView($request);
        $view->render($request);
    }
}