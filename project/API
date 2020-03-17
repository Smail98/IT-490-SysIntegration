#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("API.ini","testServer");//connect to MQ exchange

echo"A";//test echo

echo "B"; //test echo





//conenct and pull data from API
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://the-cocktail-db.p.rapidapi.com/list.php?i=gin",//api data
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: the-cocktail-db.p.rapidapi.com",
		"x-rapidapi-key: f1ba87b70emsh49a2316b2620f92p12a26ejsnee56ecfc2c46" //api key
	),
));



$respons= curl_exec($curl);
echo $respons;//test to see if $respons contains api data
$err = curl_error($curl);
curl_close($curl);

$respons = $client->publish($respons); //print response
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $respons;
//MQshovel queues test
//PUT /api/parameters/shovel/%2f/my-shovel
//{"value":{"src-protocol": "amqp091", "src-uri":  "amqp://",
  //        "src-queue":  "my-queue",
    //      "dest-protocol": "amqp091", "dest-uri": "amqp://remote-server",
      //    "dest-queue": "another-queue"}}
//}
