<?php


interface Observable
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}


class Login implements Observable
{
    private array $observers = [];

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    private array $status = [];

    public function attach(Observer $observer)
    {
        array_push($this->observers, $observer);
    }

    public function detach(Observer $observer)
    {
        $this->observers = array_filter(
            $this->observers,
            function ($a) use ($observer) {
                return !($a === $observer);
            });
    }

    public function notify()
    {
        foreach ($this->observers as $observer)
            $observer->update($this);
    }

    public function handleLogin(string $user, string $pass, string $ip)
    {
        $isvalid = false;

        switch (rand(1, 3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $isvalid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $isvalid = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $isvalid = false;
                break;
        }

        $this->notify();

        return $isvalid;
    }

    /**
     * @param int $status
     * @param string $user
     * @param string $ip
     */
    public function setStatus(int $status, string $user, string $ip): void
    {
        $this->status = [$status, $user, $ip];
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status;
    }
}


interface Observer
{
    public function update(Observable $observable);
}


abstract class LoginObserver implements Observer
{
    private Login $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    public function update(Observable $observable)
    {
        if ($observable === $this->login)
            $this->doUpdate($observable);
    }

    abstract public function doUpdate(Login $login);
}


class SecurityMonitor extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();

        if ($status[0] == Login::LOGIN_WRONG_PASS)
            // 发送邮件给系统管理员
            print __CLASS__.": sending mail to sysadmin".PHP_EOL;
    }
}


class GeneralLogger extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        // 将登陆数据添加到日志
        print __CLASS__.": add login data to log".PHP_EOL;
    }
}


class PartnershipTool extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        // 检查ip地址若匹配则设置cookie
        print __CLASS__.": set cookie if it matches a list".PHP_EOL;
    }
}

$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnershipTool($login);