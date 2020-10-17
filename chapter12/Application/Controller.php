<?php

require_once "../Registry/Registry.php";


class Controller
{
    private Registry $reg;

    public function __construct()
    {
        $this->reg = Registry::instance();
    }

    public function handleRequest()
    {
        try {
            $request = $this->reg->getRequest();
            $controller = new AppController();
            $cmd = $controller->getCommand($request);
            $cmd->execute($request);
            $view = $controller->getView($request);
            $view->render($request);
        } catch (Exception $e) {
        }
    }
}