<?php
class Blog {
 
    // database connection and table name
    private $conn;
    private $table_name = "last_three_blogs";
     
    // object properties
    public $user_id;
    public $user_name;
    public $user_secret;
    public $user_email;
    public $user_fullname;
    public $user_avatar;
    public $date_created;
    public $date_updated;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}