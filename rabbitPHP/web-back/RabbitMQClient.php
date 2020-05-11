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
$v = $val;
$r = $rating;

// Decode from JSON into object
// $request = json_decode($request, true);
// print_r($request);
 


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


if (is_array($response) == 1)
{
	
	extract($response);
	$rc = $response[0];
	$dn = $response[1];
	
}




//echo $response;

// Print respone for debugging purposes


//print_r($response);
//echo $response;

//$s=sizeof($response);
//echo $s;
if ($response === 0)
{
	echo "BAD LOG!";

	//echo $response;
    
    $d = 4;
    header("refresh: $d; url= https://www.drinksch.com/web-pages/login.php?response=$response&user=$u");
    //echo "Maybe this time";
}
elseif ($rc == 1)
{
    $d = 1;
    echo "GOOD LOG!";
    //echo $response;
    header("refresh: $d; url= https://www.drinksch.com/web-pages/login.php?response=$rc&user=$u&drink=$dn");
}
elseif ($response == 2)
{
    echo "User Already Exists -- Try Logging in";

    $d = 3;
    header("refresh: $d; url= https://www.drinksch.com/web-pages/login.html");
}
elseif ($response == 3)
{

    $d = 1;
    echo "New Account Has Been Created!";
    //echo $response;
    header("refresh: $d; url= https://www.drinksch.com/web-pages/login.php?response=$response&user=$u");
        
}
elseif ($response == 4)
{

    $d = 2;
    echo "ID was not found -- Try Again";
    //echo $response;
    header("refresh: $d; url= https://www.drinksch.com/web-pages/CreateDrink.php");
}
elseif ($response == 5)
{

    $d = 2;
    echo "Drink Was Successfully Created!";
    //echo $response;
    header("refresh: $d; url= https://www.drinksch.com/web-pages/CreateDrink.php");
}
elseif ($response == 6)
{

    $d = 1;
    echo "STRANGE ERROR HAS OCCURED!   and i oop...";
    //echo $response;
    header("refresh: $d; url= https://www.drinksch.com/web-pages/recommend.php");
}
elseif (sizeof($response) == 4) 
{

    $d = 1;
    echo "Generating... ball so hard mf wanna find me";
 
    extract($response);
    header("refresh: $d; url= https://www.drinksch.com/web-pages/recommend.php?drn=$response[0]&dra=$response[1]");
}
elseif (sizeof($response) == 2)
{

    $d = 1;
    echo "Rating... that mf so hard rn :D";

    extract($response);
    header("refresh: $d; url= https://www.drinksch.com/web-pages/display.php?rate=$r&res=$v");
}
else
{
//	print_r($response);
}






?>
