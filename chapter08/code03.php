<?php


class RegistrationMgr
{

    public function register(Lesson $lesson)
    {
        // 使用这个Lesson对象进行处理

        // 发送通知
        $notifier = Notifier::getNotifier();
        $notifier->inform("new lesson: cost ({$lesson->cost()})");
    }
}


abstract class Notifier
{

    public static function getNotifier(): Notifier
    {
        // 根据配置文件或其他逻辑得到具体类

        if (rand(1, 2) === 1)
            return new MailNotifier();
        else
            return new TextNotifier();
    }

    abstract public function inform($message);
}


class MailNotifier extends Notifier
{

    public function inform($message)
    {
        print "MAIL notification: {$message}".PHP_EOL;
    }
}


class TextNotifier extends Notifier
{

    public function inform($message)
    {
        print "TEXT notification: {$message}".PHP_EOL;
    }
}