<?php


class CliRequest extends Request
{

    public function init()
    {
        $args = $_SERVER['argv'];

        foreach ($args as $arg) {
            if (preg_match("/^path:(S+)/", $arg, $matches))
                $this->path = $matches[1];
            else
                if (strpos($arg, '=')) {
                    list($key, $val) = explode('=', $arg);
                    $this->setProperty($key, $val);
                }
        }

        $this->path = empty($this->path) ? '/' : $this->path;
    }

    public function forward(string $path)
    {
        $_SERVER['argv'][] = "path:{$path}";
        Registry::reset();
        Controller::run();
    }
}