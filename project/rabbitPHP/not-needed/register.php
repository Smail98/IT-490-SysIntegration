<?php
print("Hello");
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
include( 'RabbitMQServer.php' );

$user = $_GET ["inputUsername"];
$fname = $_GET ["inputFirstName"];
$lname = $_GET ["inputLastName"];
$pass = $_GET ["inputPassword2"]

newAccount($user,$pass,$fname,$lname)
mysqli_select_db($db, $testDB);

$delay = 2;
header("refresh: $delay; url= login.html")
?>