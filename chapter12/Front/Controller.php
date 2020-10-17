<?php

require_once '../Registry/Registry.php';


class Controller
{
    private Registry $reg;

    public function __construct()
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
            $resolver = new CommandResolver();
            $cmd = $resolver->getCommand($request);
            $cmd->execute($request);
        } catch (Exception $e) {
        }
    }
}