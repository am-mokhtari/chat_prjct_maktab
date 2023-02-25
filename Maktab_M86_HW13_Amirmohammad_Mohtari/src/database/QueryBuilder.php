<?php 

namespace src\database;

use Cassandra\Varint;
use Exception;
use http\Encoding\Stream;

class QueryBuilder {

    private $connection;

    private string $table;

    private static self $instance;

    private array $columns = ['*'];

    private string $query = '';

    private array $where = [];

    private array $having= [];

    private function __construct()
    {
        $this->connection = Connection::getInstance()
            ->getConnection();
    }

    public static function table(string $table){
        self::$instance = new self();

        self::$instance->table = $table; 

        return self::$instance;
    }

    public function select(array $columns = ['*']){
        
        if(is_null($this->table)){
            throw new Exception("table is not selected.");
        }

        $this->columns =  $columns;
        
        $select = implode( ', ', $this->columns);

        $this->query = "SELECT $select FROM $this->table";

        return $this;
    }

    public function get() {
        $statement = $this->connection->prepare($this->query);
        
        $statement->execute($this->where);
        
        return $statement->fetchAll();
    }

    public function create(array $values){
        $value = implode(', ', $values);
        $key = implode(', ', array_keys($values));
        $placeHolders = implode(', :', array_keys($values));

        $query = "INSERT INTO $this->table ($key) VALUES (:$placeHolders)";
        
        $statement = $this->connection->prepare($query);
        return $statement->execute($values);
    }

    public function update(array $values){
        $col_val = [];

        foreach ($values as $key => $value){
            $col_val[]="$key:$value";
        }

        $set = implode(',', $col_val);

        $this->query = "UPDATE  $this->table  SET $set " . $this->query;

        $statement = $this->connection->prepare($this->query);
        return $statement->execute($values);
    }

    public function delete(){
    $this->query = "DELETE FROM  $this->table " . $this->query;

    $statement = $this->connection->prepare($this->query);
    return $statement->execute();
    }

    public function where(string $column, string $value){

        if(!is_null($this->where)) {
            $this->query = $this->query . " WHERE ";
        }else{
            $this->query = $this->query . " AND ";
        }
        
        $this->where[$column] = $value;

        $this->query = $this->query . "$column = :$column"; 

        return $this;
    }

    public function first() {
        $statement = $this->connection->prepare($this->query);

       $statement->execute($this->where);

        return $statement->fetch();
    }

    public function union(string $table = '', array $columns = ['*'])
    {
        $select = implode( ', ', $columns);
        $this->query .= " UNION SELECT $select FROM $table";

        return $this;
    }

    public function having(string $column, string $value){
        if(!is_null($this->having)) {
            $this->query = $this->query . " HAVING ";
        }else{
            $this->query = $this->query . " AND ";
        }

        $this->having[$column] = $value;

        $this->query = $this->query . "$column = :$column";

        return $this;
    }

    public function orWhere(){

    }
}