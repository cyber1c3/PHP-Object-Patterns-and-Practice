<?php


class ForwardViewComponent implements ViewComponent
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function render(Request $request)
    {
        $request->forward($this->path);
    }
}