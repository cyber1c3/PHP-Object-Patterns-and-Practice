<?php


abstract class ParamHandler
{
    protected $source;
    protected $params = [];

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function addParam(string $key, string $val)
    {
        $this->params[$key] = $val;
    }

    public function getAllParams(): array
    {
        return $this->params;
    }

    public static function getInstance(string $filename): ParamHandler
    {
        if (preg_match("/.xml$/i", $filename))
            return new XmlParamHandler($filename);

        return new TextParamHandler($filename);
    }

    abstract public function write(): bool;

    abstract public function read(): bool;
}


class XmlParamHandler extends ParamHandler
{

    public function write(): bool
    {
        // TODO: Implement write() method.
    }

    public function read(): bool
    {
        // TODO: Implement read() method.
    }
}


class TextParamHandler extends ParamHandler
{

    public function write(): bool
    {
        // TODO: Implement write() method.
    }

    public function read(): bool
    {
        // TODO: Implement read() method.
    }
}