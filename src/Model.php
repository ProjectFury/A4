<?php


namespace Rentit;


use PDO;

abstract class Model
{
    /**
     * @var Database
     */
    protected $db;
    /**
     * @var \PDOStatement
     */
    protected $stmt;
    protected $data;

    /**
     * Model constructor.
     */
    function __construct()
    {

        $this->db = Database::getInstance();
    }

    /**
     * We prepare the query to be executed
     * @param string $sql
     */
    public function query(string $sql): void
    {

        $this->stmt = $this->db->prepare($sql);
    }

    /**
     * Parameter binding function
     * @param $param
     * @param $value
     */
    public function bind($param, $value): void
    {
        switch ($value) {
            case is_int($value):
                //PDO --> PHP DATA OBJECT
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Query execution function
     * @return bool
     */
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    /**
     * Query results fetch function
     * @return array
     */
    public function resultSet(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    public function singleSet()
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Count rows of the query result
     * @return int
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Return the object with the highest ID
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }
}