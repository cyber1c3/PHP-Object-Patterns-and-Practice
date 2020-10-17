<?php


class DefaultCommand extends Command
{
    public function doExecute(Request $request)
    {
        $request->addFeedback("Welcome to Woo");
        include __DIR__."/main.php";
    }
}