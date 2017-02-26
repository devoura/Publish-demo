<?php

error_reporting(E_ALL ^ E_DEPRECATED);
include("classes/DBQuery.php");
include("classes/DBConnection.php");
include("classes/MysqlDBQuery.php");
$username = "root";
$password = "test123";
$dbname = "coretrek";
$address = "localhost:3306";
$db = new DBConnection($username, $password, $dbname, $address);

?>
