<?php
class Database {
 
    // specify your own database credentials
    // private $host = "localhost";
    // private $db_name = "api_db";
    // private $username = "root";
    // private $password = "";
    public $conn;
 
    // get the database connection
    public function __construct(){
 
        $this->conn = null;
 
        try{
            $this->conn = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
            // $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }

    public function executeQuery($query) {
        // echo $query;
        return mysqli_query($this->conn, $query);
    }

    public function getNextRow($result) {
        // print_r($result->fetch_assoc());
        return $result->fetch_assoc();
    }

    public function getOne($object, $search, $id, $columns = '') {
        $query = "select * from latest_three_" . $object . "s where " . $search . " = '" . $id . "'";
        $result = $this->executeQuery($query);
        if ($row = $this->getNextRow($result)) {
            return $row;
        }
    }

    public function getAll($object, $columns = '') {
        $query = "select * from last_three_" . $object . "s";
    }
}
?>