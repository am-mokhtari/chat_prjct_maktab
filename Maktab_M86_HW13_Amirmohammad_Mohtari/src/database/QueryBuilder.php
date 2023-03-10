<?php

namespace src\database;

use Exception;
use src\helper\Test;

class QueryBuilder
{

    private $connection;

    private string $table;

    private static self $instance;

    private array $columns = ['*'];

    public string $query = '';

    public array $where = [];

    private array $having = [];

    private $statement;

    private array $values;

    private function __construct()
    {
        $this->connection = Connection::getInstance()
            ->getConnection();
    }

    public static function table(string $table)
    {
        self::$instance = new self();

        self::$instance->table = $table;

        return self::$instance;
    }

    public function select(array $columns = ['*'])
    {

        if (is_null($this->table)) {
            throw new Exception("table is not selected.");
        }

        $this->columns = $columns;

        $select = implode(', ', $this->columns);

        $this->query = "SELECT $select FROM $this->table";

        return $this;
    }

    public function get()
    {
        $this->statement = $this->connection->prepare($this->query);

        ($this->statement)->execute($this->where);

        return $this->statement->fetchAll();
    }

    public function create(array $values)
    {

        $key = implode(', ', array_keys($values));
        $placeHolders = implode(', :', array_keys($values));

        $query = "INSERT INTO $this->table ($key) VALUES (:$placeHolders)";

        return $this->connection->prepare($query)->execute($values);
    }

    public function delete()
    {
        $this->query = "DELETE FROM " . $this->table . $this->query;
        $this->statement = $this->connection->prepare($this->query);

        return $this->execute();
    }

    public function update(array $values)
    {
        $col_val = [];
        foreach ($values as $key => $value) {
            $col_val[] = "$key = :$key";
            $this->values[$key] = $value;
        }

        $set = implode(',', $col_val);
        $this->query = "UPDATE $this->table SET $set " . $this->query;
        $this->statement = $this->connection->prepare($this->query);
        return $this->execute();
    }

    public function where(string $column, string $value)
    {
        if (empty($this->where)) {
            $this->query = $this->query . " WHERE ";
        } else {
            $this->query = $this->query . " AND ";
        }

        $this->where[$column] = $value;
        $this->values[$column] = $value;

        $this->query = $this->query . "$column = :$column";

        return $this;
    }

    public function first()
    {
        $statement = $this->connection->prepare($this->query);
        $statement->execute($this->where);

        return $statement->fetch();
    }

    public function union(string $table = '', array $columns = ['*'])
    {
        $select = implode(', ', $columns);
        $this->query .= " UNION SELECT $select FROM $table";

        return $this;
    }

    public function having(string $column, string $value)
    {
        if (!is_null($this->having)) {
            $this->query = $this->query . " HAVING ";
        } else {
            $this->query = $this->query . " AND ";
        }

        $this->having[$column] = $value;

        $this->query = $this->query . "$column = :$column";

        return $this;
    }

    public function orWhere(string $column, string $value, int $counter = null)
    {
        if (empty($this->where)) {
            $this->query = $this->query . " WHERE ";
        } else {
            $this->query = $this->query . " OR ";
        }

        $this->where[$column.$counter] = $value;
        $this->values[$column.$counter] = $value;

        $this->query = $this->query . " " . $column . " = :" . $column.$counter;

        return $this;
    }

    public function like($column, $value)
    {
        if (empty($this->where)) {
            $this->query .= " WHERE ";
        } else {
            $this->query .= " AND ";
        }

        $this->query .= $column . " LIKE '%$value%' ";

        return $this;
    }

    public function join(string $table ,string $column1 , string $column2 ,string $type = 'INNER'){
        $this->query .= " $type JOIN $table ON $this->table.$column1 = $table.$column2";
        return $this;
    }

    public function execute()
    {
        return $this->statement->execute($this->values);
    }
}