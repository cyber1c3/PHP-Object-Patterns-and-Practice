<?php


abstract class Mapper
{
    protected PDO $pdo;

    public function __construct()
    {
        $reg = Registry::instance();
        $this->pdo = $reg->getPdo();
    }

    public function find(int $id): ?DomainObject
    {
        $this->selectStmt()->execute([$id]);
        $row = $this->selectStmt()->fetch();
        $this->selectStmt()->closeCursor();

        if (!is_array($row))
            return null;

        if (!$row['id'])
            return null;

        return $this->createObject($row);
    }

    public function createObject(array $row): DomainObject
    {
        return $this->doCreateObject($row);
    }

    public function insert(DomainObject $obj)
    {
        $this->doInsert($obj);
    }

    abstract public function update(DomainObject $object);
    abstract protected function doCreateObject(array $raw): DomainObject;
    abstract protected function doInsert(DomainObject $object);
    abstract protected function selectStmt(): PDOStatement;
    abstract protected function targetClass(): string;
}