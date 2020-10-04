<?php


class RequestHelper{}


abstract class ProcessRequest
{
    abstract public function process(RequestHelper $req);
}


class MainProcess extends ProcessRequest
{

    public function process(RequestHelper $req)
    {
        print __CLASS__.": doing something useful with request".PHP_EOL;
    }
}


abstract class DecorateProcess extends ProcessRequest
{
    protected ProcessRequest $processrequest;

    public function __construct(ProcessRequest $processrequest)
    {
        $this->processrequest = $processrequest;
    }
}


class LogRequest extends DecorateProcess
{

    public function process(RequestHelper $req)
    {
        print __CLASS__.": logging request".PHP_EOL;
        $this->processrequest->process($req);
    }
}


class AuthenticateRequest extends DecorateProcess
{

    public function process(RequestHelper $req)
    {
        print __CLASS__.": authenticating request".PHP_EOL;
        $this->processrequest->process($req);
    }
}


class StructureRequest extends DecorateProcess
{

    public function process(RequestHelper $req)
    {
        print __CLASS__.": structuring request".PHP_EOL;
        $this->processrequest->process($req);
    }
}

$process = new AuthenticateRequest(
    new StructureRequest(
        new LogRequest(
            new MainProcess()
        )
    )
);

$process->process(new RequestHelper());