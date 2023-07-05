<?php
//starting the session
session_start();



// create the the constants to store the repeating values
define('SITEURL', 'http://localhost/zfood-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');


//execute query and save in the database ,, if the query executes the res is true or it will be false
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die("mysqli error");

$db_select = mysqli_select_db($conn, DB_NAME) or die("mysqli error");


?>