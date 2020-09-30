<?php

namespace chapter04\code2;


class ShopProduct
{
    private $title;
    private $producerMainName;
    private $producerFirstName;
    private $discount = 0;

    protected $price;

    const AVAILABLE = 0;
    const OUT_OF_STOCK = 1;

    /**
     * 新增属性
     * @var int
     */
    private $id = 0;

    public function __construct(string $title, string $firstName, string $mainName,string $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getProducerFirstName(): string
    {
        return $this->producerFirstName;
    }

    /**
     * @return string
     */
    public function getProducerMainName(): string
    {
        return $this->producerMainName;
    }

    /**
     * @param int $discount
     */
    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return ($this->price - $this->discount);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getProducer()
    {
        return $this->producerFirstName." ".$this->producerMainName;
    }

    public function getSummaryLine()
    {
        $base = "{$this->title} ({$this->producerMainName}, ";
        $base .= "{$this->producerFirstName})";
        return $base;
    }

    /**
     * 新增方法
     * @param int $id
     */
    public function setID(int $id)
    {
        $this->id = $id;
    }

    /**
     * 新增方法
     * @param int $id
     * @param \PDO $PDO
     * @return ShopProduct|null
     */
    public static function getInstance(int $id, \PDO $PDO): ?ShopProduct
    {
        $stmt = $PDO->prepare("select * from products where id=?");
        $result = $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (empty($row))
            return null;

        if ($row['type'] == "book") {
            $product = new BookProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                (float) $row['price'],
                (int) $row['numpages']
            );
        }elseif ($row['type'] == "cd") {
            $product = new CdProduct(
                $row['title'],
                $row['firstname'],
                $row['mainname'],
                (float) $row['price'],
                (int) $row['playlength']
            );
        } else {
            $firstname = (is_null($row['firstname']) ? "" : $row['firstname']);
            $product = new ShopProduct(
                $row['title'],
                $firstname,
                $row['mainname'],
                (float) $row['price']
            );
        }

        $product->setID((int) $row['id']);
        $product->setDiscount((int) $row['discount']);

        return $product;
    }
}


class CdProduct extends ShopProduct
{
    private $playLength;

    public function __construct(string $title, string $firstName, string $mainName, string $price, string $playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLength;
    }

    public function getPlayLength()
    {
        return $this->playLength;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": page count - $this->playLength";
        return $base;
    }

    public function __toString(): string
    {
        return __CLASS__;
    }
}


class BookProduct extends ShopProduct
{
    private $numPages;

    public function __construct(string $title, string $firstName, string $mainName, string $price, string $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }

    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= $base .= ": page count - $this->numPages";
        return $base;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}

//$dsn = "sqlite:/".__DIR__."/products.db";
//$pdo = new \PDO($dsn, null, null);
//$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//$obj = ShopProduct::getInstance(1, $pdo);
//
//print ShopProduct::AVAILABLE;