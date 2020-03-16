<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
include ('accounts.php');
include('functions.php');
$db = mysqli_connect($hostname, $username, $password);
if (mysqli_connect_errno())
{
	echo "Failed to connect to MYSQL. <br>";
	exit ();
}

mysqli_select_db($db,$project);

$alc = $_GET["search"];

display ($alc, $db)

?>
