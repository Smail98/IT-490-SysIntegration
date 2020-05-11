<?php
// Don't touch this. Used for request.
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Headers:Content-Type");
header("Access-Control-Allow-Credentials:true");

// Dont touch this. Keeps that weird text up there from polluting response.
// Includesl
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');



 //print_r($request);




// echo '        [x] Payload sent', '<br><br><br>';
$request = $_GET["search"];
//print_r($request);



// Decode from JSON into object
 //$request = json_decode($request, true);





// Make connection as client
$client = new rabbitMQClient("API.ini", "testServer");

// Send request to rabbit server queue
$response = $client -> send_request($request);
//$response = json_encode($response);




// Print respone for debugging purposes
//print_r($response);

$response = str_replace("&","%26", $response);
$response = str_replace("#","%23", $response);



if ($response != null)
{
    //$response = json_decode($response);
   // print_r($response);
    $size = sizeof($response);
    $name = array();
    $id = array();
    for($i=0; $i<$size; $i++)
    {
	    extract($response);
	    array_push($name, $response[$i]);
	    $i++;
	    array_push($id, $response[$i]);
    }
    $name = json_encode($name);
    $id = json_encode($id);
 
    echo "Bussin it down...";
   	
     
    $d = 1;
   
    header("refresh: $d; url= https://www.drinksch.com/web-pages/results.php?n=$name&i=$id");
    //echo "Maybe this time";
}


/*
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
