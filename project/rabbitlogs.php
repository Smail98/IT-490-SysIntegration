//error_log ( string $message [, int $message_type = 0 [, string $destination [, string $extra_headers ]]] ) : bool

<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//$log = 'hello2';
$client = new rabbitMQClient("log.ini","testServer");//connect to MQ exchange
$search=$client->publish($log);
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
$server = new rabbitMQServer("log.ini","testServer");
$server->process_requests('requestProcessor');

//$search=$client->publish($log);
//echo copy("rabbit@ip-10-0-0-89.log","log.txt");
?>
