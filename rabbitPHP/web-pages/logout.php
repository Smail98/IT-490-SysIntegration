<?php
session_start();

$_SESSION = array();
session_destroy();

echo "<h1><b>LOGGED OUT -- Good Bye!</b></h1><br>";

header("refresh: 3; url = http://localhost/rabbitPHP/web-pages/login.html");

?>