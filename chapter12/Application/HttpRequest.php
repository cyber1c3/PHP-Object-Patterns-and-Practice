<?php


class HttpRequest extends Request
{
    private $properties;
    private string $path;

    public function init()
    {
        $this->properties = $_REQUEST;
        $this->path = $_SERVER['PATH_INFO'];
        $this->path = empty($this->path) ? '/' : $this->path;
    }

    public function forward(string $path)
    {
        header("Location: {$path}");
        exit;
    }
}