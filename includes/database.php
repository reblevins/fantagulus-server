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

    // public function executeQuery($query) {
    //     // echo $query;
    //     return mysqli_query($this->conn, $query);
    // }

    public function executeQuery($query,$parameters = array(),$prepareOnly = false,$statementQuery = "") {
        $executeOnly = (is_object($query) && get_class($query) == "mysqli_stmt");
        $resultSet = array();
        if (!is_array($parameters)) {
            $parameters = func_get_args();
            unset($parameters[0]);
            $prepareOnly = false;
            $statementQuery = "";
        }
        if ((!is_array($parameters) || count($parameters) == 0) && !$prepareOnly && !$executeOnly) {
            $result = $this->conn->query($query);
        } else {
            $types = "";
            foreach($parameters as $index => $parameter) {
                if (strlen(trim($parameter,"\0 \t")) == 0) {
                    $parameters[$index] = null;
                    $types .= "s";
                } else if (is_int($parameter)) {
                    $types .= 'i';
                } else if (is_float($parameter)) {
                    $types .= 'd';
                } else if (is_string($parameter)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
            }
            $parameterReferences = array();
            $parameterReferences[] = $types;
            foreach ($parameters as $index => $parameter) {
                $parameterReferences[] = &$parameters[$index];
            }
            if (!$executeOnly) {
                $statement = $this->conn->prepare($query);
            } else {
                $statement = $query;
                $query = $statementQuery;
            }
            if ($statement && !$prepareOnly) {
                if (call_user_func_array(array($statement, 'bind_param'), $parameterReferences)) {
                    $statement->execute();
                    $result = $statement->get_result();
                }
            }
            $resultSet['parameters'] = $parameterReferences;
        }
        $resultSet['query'] = $query;
        $resultSet['sql_error'] = $this->conn->error;
        $resultSet['sql_error_number'] = $this->conn->errno;
        $resultSet['affected_rows'] = $this->conn->affected_rows;
        $resultSet['insert_id'] = $this->conn->insert_id;
        if (!$prepareOnly && !$executeOnly && is_object($statement) && get_class($statement) == "mysqli_stmt") {
            $statement->close();
        }
        if ($prepareOnly) {
            $resultSet['statement'] = $statement;
        } else {
            $resultSet['result'] = $result;
            if (is_object($result)) {
                $resultSet['row_count'] = $result->num_rows;
            }
        }
        return $resultSet;
    }

    public function getNextRow($resultSet) {
        if (!is_object($resultSet['result'])) {
            return array();
        }
        if ($row = $resultSet['result']->fetch_assoc()) {
            return $row;
        }
        return array();
    }

    // public function getNextRow($result) {
    //     // print_r($result->fetch_assoc());
    //     return $result->fetch_assoc();
    // }

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