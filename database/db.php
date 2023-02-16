<?php
use Exception;

class Connection {
    private PDO $connection;
    private array $config;
    private static $instance = null;

    private function __construct()
    {
        $this->config = include('./config/database.php');
        $this->connection = $this->connect();
    }

    private function __clone(){}

    private function connect() {
        $driver = $this->config['driver'];
        $dbname = $this->config['dbname'];
        $host = $this->config['host'];
        $username = $this->config['username'];
        $password = $this->config['password'];

        $dsn = "$driver:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    }

    public function getConnection(){
        return $this->connection;
    }

    public static function getInstance(){

        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    private string $table;

    private array $columns = ['*'];

    private string $query = '';

    private array $where = [];

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

    public function orWhere(){}
}