<?php


namespace chapter04\code5;


class ShopProduct
{
    /**
     * 新增属性
     * @var int
     */
    private $taxrate = 17;

    private $title;
    private $producerMainName;
    private $producerFirstName;

    protected $price;

    public function __construct(string $title, string $firstName, string $mainName,string $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    /**
     * 新增方法
     * @param float $price
     * @return float
     */
    public function calculate(float $price): float
    {
        return (($this->taxrate / 100) * $price);
    }
}


$p = new ShopProduct("Fine Soap", "", "Bob's Bathroom", 1.33);
print $p->calculate(100);