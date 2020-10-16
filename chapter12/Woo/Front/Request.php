<?php


abstract class Request
{
    protected $properties;
    protected array $feedback = [];
    protected string $path = '/';

    public function __construct()
    {
        $this->init();
    }

    abstract public function init();

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getProperty(string $key)
    {
        if (isset($this->properties[$key]))
            return $this->properties[$key];
    }

    public function setProperty(string $key, $val)
    {
        $this->properties[$key] = $val;
    }

    /**
     * @param string $msg
     */
    public function addFeedback(string $msg)
    {
        array_push($this->feedback, $msg);
    }

    /**
     * @return array
     */
    public function getFeedback(): array
    {
        return $this->feedback;
    }

    public function getFeedbackString($separator = '\n'): string
    {
        return implode($separator, $this->feedback);
    }

    public function clearFeedback()
    {
        $this->feedback = [];
    }
}