<?php

abstract class Command
{
    abstract public function execute(CommandContext $context): bool;
}


class LoginCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $manager = Registry::getAccessManager();

        $user = $context->get('username');
        $pass = $context->get('pass');

        $user_obj = $manager->login($user, $pass);

        if (is_null($user_obj)) {
            $context->setError("login error");
            return false;
        }

        $context->addParam("user", $user_obj);

        return true;
    }
}


class CommandContext
{
    private array $params;
    private string $error = "";

    public function __construct()
    {
        $this->params = $_REQUEST;
    }

    public function addParam(string $key, $val)
    {
        $this->params[$key] = $val;
    }

    public function get(string $key): ?string
    {
        if (isset($this->params[$key]))
            return $this->params[$key];

        return null;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getError(): string
    {
        return $this->error;
    }
}


class CommandFactory
{
    public static function getCommand(string $action = "Default"): Command
    {
        if (preg_match('/\W/', $action))
            throw new Exception("illegal characters in action");

        $class = __NAMESPACE__.UCFirst(strtolower($action))."Command";

        print '[+]:'.$class.PHP_EOL;

        if (!class_exists($class))
            throw new Exception("no '$class' class located");

        return new $class();
    }
}

class Controller
{
    private CommandContext $context;

    public function __construct()
    {
        $this->context = new CommandContext();
    }

    public function getContext(): CommandContext
    {
        return $this->context;
    }

    public function process()
    {
        $action = $this->context->get('action');
        $action = is_null($action) ? "default": $action;

        try {
            $cmd = CommandFactory::getCommand($action);
        } catch (Exception $e) {
            throw new Exception("something error");
        }

        if (!$cmd->execute($this->context)) {
            // 错误处理
        } else {
            // 成功处理
        }
    }
}


class Registry
{
    public static function getAccessManager()
    {
        return new AccessManager();
    }
}


class AccessManager
{

    public function login($user, $pass)
    {
        return [$user, $pass];
    }
}

$controller = new Controller();
$context = $controller->getContext();

$context->addParam('action', 'login');
$context->addParam('username', 'bob');
$context->addParam('pass', 'tiddles');

$controller->process();

print $context->getError();