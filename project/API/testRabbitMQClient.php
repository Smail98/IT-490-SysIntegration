#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");


$request = array();
$request['type'] = "login";
//$request['username'] = $argv[1];
//$request['password'] = $argv[2];
$request['message'] = "HI";
echo"A";
//$response = $client->send_request($request);
//$response = $client->publish($request);
echo "B";
//echo "client received response: ".PHP_EOL;
//print_r($response);
echo "\n\n";

//echo $argv[0]." END".PHP_EOL;




$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://the-cocktail-db.p.rapidapi.com/list.php?i=list",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: the-cocktail-db.p.rapidapi.com",
		"x-rapidapi-key: f1ba87b70emsh49a2316b2620f92p12a26ejsnee56ecfc2c46"
	),
));



$respons= curl_exec($curl);
echo $respons;
$err = curl_error($curl);
curl_close($curl);

$respons = $client->publish($respons);
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $respons;
//$respons = $client->send_request($curl);
//$respons = $client->publish($curl);

}
