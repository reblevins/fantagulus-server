<?php
define(MYSQL_SERVER, getenv('MYSQL_SERVER'));
define(MYSQL_DB, getenv('MYSQL_DB'));
define(MYSQL_USER, getenv('MYSQL_USER'));
define(MYSQL_PASSWORD, getenv('MYSQL_PASSWORD'));
require_once 'includes/database.php';

// instantiate database and product object
$GLOBALS['database'] = new Database();
// $db = $database->getConnection();

\Cloudinary::config(array( 
	"cloud_name" => "reblevins", 
	"api_key" => "229545941256154", 
	"api_secret" => "fptyIZbANnfY2Cz08egAQKnILWI" 
));
?>