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
//require_once('fncs.php');
//require_once('logErrorRMQ.php');


function doLogin($username,$password)
{
    // lookup username in databas
    // check password
   // $login = new loginDB();
   // return $login->validateLogin($username,$password);
	//return false if not valid
	return true;
}


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}


// Listen for incoming data from queue
$server = new rabbitMQServer("RabbitMQ.ini", "testServer");

// Process data
$server->process_requests('requestProcessor');
exit();

?>
