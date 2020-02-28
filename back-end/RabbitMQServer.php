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
//require_once('logErrorRMQ.php');

function doLogin($username, $password)
{
    echo 'Loging in...';

    # Run database query here to validate credentials
    if ($username == 'admin' && $password == 'pass') {
        return 'success';
    } else {
        return 'fail';
    }
}


# This proccess data picked up from rabbit queue
function requestProcessor($request)
{
    $returnCode = 0;
    $response = [];
    $message = "";
    $payload = "empty";
    // Perform appropriate action depending on type
    switch ($request['type']) {
            // Authenticate
            case "login":
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = doLogin($request['username'], $request['password']);
                break;

            case "register":
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = createAccount($request['firstName'], $request['lastName'], $request['username'], $request['password']);
                break;

            // Account details
            case "account":
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = getAccountDetails($request['userID']);
                break;

            case "profileValue":
                // do stuff here
                break;

            case "transaction":
                // do stuff here
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = makeTransaction($request['userID'], $request['details']);
                break;

            // Session Validation
            case "validate_session":
                //return doValidate($request['sessionId']);
                break;

            //Logging Errors
            case "error":
                $returnCode = 0;
                $message = "error occured while request was being processed";
                //$payload = logError($request['error']);
                break;

            case "test":
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = testQuery($request['userID']);
                break;

            default:
                // do nothing
                break;
    }
    $response = array("returnCode" => $returnCode, 'message'=> $message, 'payload' => $payload);
    return $response;
}

// Listen for incoming data from queue
$server = new rabbitMQServer("RabbitMQ.ini", "testServer");

// Process data
$server->process_requests('requestProcessor');
exit();

?>
