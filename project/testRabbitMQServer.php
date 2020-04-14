#!/usr/bin/php
<?php
// This is needed to allow cross-origin requests
//header("Access-Control-Allow-Origin:*");
//header("Access-Control-Allow-Methods:GET");
//header("Access-Control-Allow-Header:Content-Type");
//header("Access-Control-Allow-Credentials:true");

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once("local.ini");

//Grabs data from Search.php through rabbit
//if ($_SERVER["search"] == "GET") {
//    // collect value of input field
//    $name = htmlspecialchars($_REQUEST['search']);
//    
//    }
//if (empty($drink)) {
//        echo "drink is empty";
//} //
//else {
//echo $drink;

function doLogin($username,$password)
{
    // lookup username in databas
    // check password
    return true;
    //return false if not valid
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

$server = new rabbitMQServer("API.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
//must be moved to the bottom of the page dont forget!!
//Grabs data from Search.php through rabbit
if ($_SERVER["search"] == "GET") {
    // collect value of input field
    $name = htmlspecialchars($_REQUEST['search']);
   }
if (empty($drink)) {
        echo "drink is empty";
}
else {
echo $drink;
include 'api.php';
}
?>
