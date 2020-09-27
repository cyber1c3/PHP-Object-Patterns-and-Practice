<?php


namespace chapter04\code22;


class Product
{
    public $name;
    public $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}


class ProcessSale
{
    private $callbacks;

    public function registerCallback(callable $callback)
    {
        if (!is_callable($callback)) {
            throw new \Exception("it is not callable");
        }

        $this->callbacks[] = $callback;
    }

    public function sale(Product $product)
    {
        print "{$product->name}: processing".PHP_EOL;

        foreach ($this->callbacks as $callback) {
            call_user_func($callback, $product);
        }
    }
}

$logger = function ($product) {
    print "logging({$product->name})".PHP_EOL;
};


class Mailer
{
    public function doMail(Product $product)
    {
        print "mailing({$product->name})".PHP_EOL;
    }
}


class Totalizer
{
    public static function warnAmount()
    {
        return function (Product $product) {
            if ($product->price > 5)
                print "reached high price: $product->price".PHP_EOL;
        };
    }
}


class Totalizer2
{
    public static function warnAmount($amt)
    {
        $count = 0;

        return function (Product $product) use ($amt, &$count) {
            $count += $product->price;
            print "count: $count".PHP_EOL;

            if ($count > $amt)
                print "high price reached: $count".PHP_EOL;
        };
    }
}

$processor = new ProcessSale();
$processor->registerCallback(Totalizer2::warnAmount(11));
$processor->registerCallback($logger);
$processor->sale(new Product("shoes", 6)).PHP_EOL;
$processor->registerCallback([new Mailer(), "doMail"]);
$processor->sale(new Product("coffee", 6)).PHP_EOL;