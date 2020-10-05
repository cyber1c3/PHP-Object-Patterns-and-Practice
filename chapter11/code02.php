<?php


abstract class Question
{
    protected string $prompt;
    protected Marker $marker;

    public function __construct(string $prompt, Marker $marker)
    {
        $this->prompt = $prompt;
        $this->marker = $marker;
    }

    public function mark(string $response): bool
    {
        return $this->marker->mark($response);
    }
}


class TextQuestion extends Question
{
    // 处理文本题目特有的操作
}


class AVQuestion extends Question
{
    // 处理视听题目特有的操作
}


abstract class Marker
{
    protected string $test;

    public function __construct(string $test)
    {
        $this->test = $test;
    }

    abstract public function mark(string $response): bool;
}


class MatchMarker extends Marker
{
    public function mark(string $response): bool
    {
        return $this->test == $response;
    }
}


class RegexpMarker extends Marker
{
    public function mark(string $response): bool
    {
        return preg_match($this->test, $response) === 1;
    }
}

$markers = [
    new RegexpMarker("/f.ve/"),
    new MatchMarker("five")
];

foreach ($markers as $marker) {
    print get_class($marker).PHP_EOL;
    $question = new TextQuestion("how many beans make five", $marker);

    foreach (['five', 'four'] as $response) {
        print "  response: $response - ";

        if ($question->mark($response))
            print "well done".PHP_EOL;
        else
            print "never mind".PHP_EOL;
    }
}