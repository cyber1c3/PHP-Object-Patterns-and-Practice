<?php


class HttpRequest extends Request
{

    public function init()
    {
        // 为了简洁期间，此处忽略POST/GET等区别
        // 实际中此操作不合规
        $this->properties = $_REQUEST;
        $this->path = $_SERVER['PATH_INFO'];
        $this->path = empty($this->path) ? '/' : $this->path;
    }
}