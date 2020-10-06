<?php


abstract class Command
{
    const CMD_DEFAULT = 0;
    const CMD_OK = 1;
    const CMD_ERROR = 2;
    const CMD_INSUFFICIENT_DATA = 3;

    final public function __construct()
    {
    }

    public function execute(Request $request)
    {
        $this->doExecute($request);
    }

    abstract public function doExecute(Request $request);
}