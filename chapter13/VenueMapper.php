<?php


class VenueMapper extends Mapper
{
    private $selectStmt;
    private $updateStmt;
    private $insertStmt;

    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = $this->pdo->prepare(
            "SELECT * FROM venue WHERE id=?"
        );

        $this->updateStmt = $this->pdo->prepare(
            "UPDATE venue SET name=?, id=? WHERE id=?"
        );

        $this->insertStmt = $this->pdo->prepare(
            "INSERT INTO venue(name) VALUES (?)"
        );
    }

    protected function targetClass(): string
    {
        return Venue::class;
    }

    public function getCollection(array $row): Collection
    {
        return new VenueCollection($row, $this);
    }

    public function update(DomainObject $object)
    {
        $values = [
            $object->getName(),
            $object->getId()
        ];

        $this->updateStmt->execute($values);
    }

    protected function doCreateObject(array $row): DomainObject
    {
        return new Venue(
            (int) $row['id'],
            $row['name']
        );
    }

    protected function doInsert(DomainObject $object)
    {
        $values = [$object->getName()];
        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        $object->setId((int) $id);
    }

    protected function selectStmt(): PDOStatement
    {
        return $this->selectStmt;
    }
}