<?php 

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "booktopia";


define('DB_HOST', $db['db_host']);
define('DB_USER', $db['db_user']);
define('DB_PASS', $db['db_pass']);
define('DB_NAME', $db['db_name']);



$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


?>