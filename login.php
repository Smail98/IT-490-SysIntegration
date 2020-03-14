<?php
session_start();

$username = $_GET["Username"];
$pass = $_GET["Password"];

include ('RabbitMQServer.php');

#need authneticate funciton

$_SESSION ["logged"] = true;
$_SESSION["username"] = $username;
dologin($username, $pass);
header("refresh: 3; url = Search.php");
?>