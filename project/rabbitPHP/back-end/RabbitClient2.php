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
 //$request = file_get_contents('php://input');   //possibly remove

 //print_r($request);

 //$request = json_decode($request);
 //echo $request;


// echo '        [x] Payload sent', '<br><br><br>';
$request = $_GET["search"];
//print_r($request);

//echo $request;

// Decode from JSON into object
 //$request = json_decode($request, true);
// print_r($request);
 //echo $request;




// Make connection as client
$client = new rabbitMQClient("API.ini", "testServer");

// Send request to rabbit server queue
$response = $client -> send_request($request);
$response = json_encode($response);



//print_r($response);
// Print respone for debugging purposes
//print_r($response);

$response = str_replace("&","%26", $response);
$response = str_replace("#","%23", $response);
echo $response;


//echo $response;
if ($response != null)
{
    echo "Searching...";
    
    $d = 5;
    header("refresh: $d; url= http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/results.php?res=$response");
    //echo "Maybe this time";
}/*
elseif ($response == 1)
{
    $d = 1;
    //echo "GOOD LOG!";
    //echo $response;
    header("refresh: $d; url= http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.php?user=$u&pass=$pw");
}
elseif ($response == 2)
{
    echo "User Already Exists -- Try Logging in";

    $d = 3;
    header("refresh: $d; url= http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.html");
}
else{

    $d = 2;
    echo "New Account Has Been Created!";
    //echo $response;
    header("refresh: $d; url= http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.php?user=$u&pass=$pw");
    
    
}
 */



?>
