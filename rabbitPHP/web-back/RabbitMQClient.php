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


 echo '        [x] Payload sent', '<br><br><br>';
$request = $_POST;
//print_r($request);

extract($request);
$u = $username;
$pw = $password;
$t = $type;

$pro = $_REQUEST['t'];

// Decode from JSON into object
 //$request = json_decode($request, true);
// print_r($request);
 //echo $request;
//echo $u,'<br>';
//echo $pw, '<br>';
//echo $t;
if ($request == null)
{
	$request = array("user"=>$pro, "type"=>"saved");
	print_r($request);
	
}


// Make connection as client
$client = new rabbitMQClient("RabbitMQ.ini", "testServer");

// Send request to rabbit server queue
$response = $client -> send_request($request);
//$response = json_encode($response);


//echo $response;

// Print respone for debugging purposes



//print_r($response);
//echo $response;



if ($response === 0)
{
	echo "BAD LOG!";

	//echo $response;
    
    $d = 1;
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.php?response=$response&user=$u");
    //echo "Maybe this time";
}
elseif ($response == 1)
{
    $d = 1;
    echo "GOOD LOG!";
    //echo $response;
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.php?response=$response&user=$u");
}
elseif ($response == 2)
{
    echo "User Already Exists -- Try Logging in";

    $d = 3;
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.html");
}
elseif ($response == 3)
{

    $d = 1;
    echo "New Account Has Been Created!";
    //echo $response;
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.php?response=$response&user=$u");
        
}
elseif ($response == 4)
{

    $d = 2;
    echo "ID was not found -- Try Again";
    //echo $response;
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/CreateDrink.php");
}
elseif ($response == 5)
{

    $d = 2;
    echo "Drink Was Successfully Created!";
    //echo $response;
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/CreateDrink.php");
}
elseif ($response == 6)
{

    $d = 1;
    echo "STRANGE ERROR HAS OCCURED!   and i oop...";
    //echo $response;
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/recommend.php");
}
elseif (is_array($response) != null) 
{

    $d = 1;
    echo "Generating... ball so hard mf wanna find me";
 
    extract($response);
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/recommend.php?drn=$response[0]&dra=$response[1]");
}







?>
