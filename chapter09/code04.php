<?php

namespace chapter09\code04;


class Preferences
{

    private array $props = [];
    private static Preferences $instance;

    private function __construct(){}

    public static function getInstance()
    {
        if (empty(self::$instance))
            self::$instance = new Preferences();

        return self::$instance;
    }

    public function setProperty(string $key, string $val)
    {
        $this->props[$key] = $val;
    }

    public function getProperty(string $key)
    {
        return $this->props[$key];
    }
}

$pref = Preferences::getInstance();
$pref->setProperty("name", "matt");
unset($pref); // 移除引用
$pref2 = Preferences::getInstance();
print $pref2->getProperty("name").PHP_EOL;
