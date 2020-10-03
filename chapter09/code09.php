<?php

class Settings
{

    static string $COMMSTYPE = "Bloggs";
}


class AppConfig
{

    private static $instance;
    private $commsManager;

    private function __construct()
    {
        $this->init();
    }

    private function init()
    {
        switch (Settings::$COMMSTYPE) {
            case "Mega":
                $this->commsManager = new MegaCommsManager();
            default:
                $this->commsManager = new BloggsCommsManager();
        }
    }

    public static function getInstance(): AppConfig
    {
        if (empty(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    public function getCommsManager(): CommsManager
    {
        return $this->commsManager;
    }
}


class CommsManager{}


class MegaCommsManager extends CommsManager{}


class BloggsCommsManager extends CommsManager{}

$commsMgr = AppConfig::getInstance()->getCommsManager();