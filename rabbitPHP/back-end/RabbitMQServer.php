#!/usr/bin/php
<?php

# This is needed to allow cross-origin requests
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Header:Content-Type");
header("Access-Control-Allow-Credentials:true");

# Need all these imports
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('fncs.php');
//require_once('logErrorRMQ.php');



// Listen for incoming data from queue
$server = new rabbitMQServer("RabbitMQ.ini", "testServer");

// Process data
$server->process_requests('requestProcessor');
exit();

?>
