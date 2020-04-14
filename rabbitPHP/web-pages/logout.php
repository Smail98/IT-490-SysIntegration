<?php
session_start();

$_SESSION = array();
session_destroy();

echo "<h1><b>LOGGED OUT -- Good Bye!</b></h1><br>";

header("refresh: 3; url = http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.html");

?>
