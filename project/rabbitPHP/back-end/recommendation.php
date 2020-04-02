#!/usr/bin/php
<?php 

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQlib.inc');



$db = getDBconnect();


session_start();


include ("fncs.php");
$db = getDBconnect();
$user = $_GET["username"];
$sql = "SELECT id FROM Accounts WHERE username='$user'  limit 1";
$result = mysqli_query($db,$sql);
$value = mysql_fetch_object($result);
$_SESSION['myid'] = $value->id;
seshCheck()

if(isset($_SESSION['myid'])){
		

	function requestProcessor($request){
		$query = "SELECT strDrink, stralc from cocktails ORDER BY RAND() LIMIT 1";
		$result = mysqli_query($db, $query);

		if (mysqli_num_rows($result) > 0){
			$result = array();
				while ($row = mysqli_fetch_array($result)){
					$result[] = $row;
				}
			print_r($result);

			foreach($result as $item)
				echo $item[0] . "<br>";
				echo $item[1] . "<br>";
				echo $item[2] . "<br>";
				echo $item[3] . "<br>";
			}
			return $result;
	}else{
		echo "No recommendations.";
		}
}

$server = new rabbitMQServer("rabbitMQ.ini", "testServer");
$server ->process_requests('requestProcessor');
$server->send_request($row);
