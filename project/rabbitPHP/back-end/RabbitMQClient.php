<?php
// Don't touch this. Used for request.
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Headers:Content-Type");
header("Access-Control-Allow-Credentials:true");

// Dont touch this. Keeps that weird text up there from polluting response.
// if (ob_get_level()) {lll ob_end_clean(); ob_start(); }
// echo 'hey';
// Includesl
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

// Grab POST data sent by axios in front-end
$request = file_get_contents('php://input');

// Decode from JSON into object
$request = json_decode($request, true);
print_r($request);

// Make connection as client
$client = new rabbitMQClient("RabbitMQ.ini", "testServer");

// Send request to rabbit server queue
$response = $client -> send_request($request);
$response = json_encode($response);

// Print respone for debugging purposes
print_r($response);
?>
