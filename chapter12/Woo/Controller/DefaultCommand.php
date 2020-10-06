<?php


class DefaultCommand extends Command
{

    public function doExecute(Request $request)
    {
        $request->addFeedback("Welcome to WOO");
        include __DIR__.'../View/main.php';
    }
}