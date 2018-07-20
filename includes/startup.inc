<?php
define(MYSQL_SERVER, getenv('MYSQL_SERVER'));
define(MYSQL_DB, getenv('MYSQL_DB'));
define(MYSQL_USER, getenv('MYSQL_USER'));
define(MYSQL_PASSWORD, getenv('MYSQL_PASSWORD'));

$DBConnection = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

// print_r($DBConnection);
?>