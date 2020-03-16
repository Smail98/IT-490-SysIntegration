<?php
session_start();
//No
//$username = $_GET["username"];
//$pass = $_GET["password"];

include ('fncs.php');
include ('RabbitMQServer.php');

#need authneticate funciton

$username = getData("username");
$pass = getData("password");

echo $username;
echo $pass;

if(!doLogin($username, $pass))
                {
                    return;
                }
                else
                {
                    $_SESSION ["logged"] = true;
                    $_SESSION["username"] = $username;
                    header("refresh: 3; url = http://localhost/rabbitPHP/New-wpages/Search.html");
                }                  
/*
$_SESSION ["logged"] = true;
$_SESSION["username"] = $username;
dologin($username, $pass);
header("refresh: 3; url = Search.php");*/
?>
