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




// echo '        [x] Payload sent', '<br><br><br>';
$request = $_REQUEST["id"];


//echo $request;

// Decode from JSON into object
 //$request = json_decode($request, true);




// Make connection as client
$client = new rabbitMQClient("DESC.ini", "testServer");

// Send request to rabbit server queue
$response = $client -> send_request($request);
//$response = json_encode($response);




// Print respone for debugging purposes
//print_r($response);

$response = str_replace("&","%26", $response);
$response = str_replace("#","%23", $response);


//print_r($response);
if ($response != null)
{
    //$response = json_decode($response);
   
    
	extract($response['0']);
	//print_r($response['0']);
	//extract($drinks['0']);

//format to pull specific data from api while check to see if data is there
/*	
foreach($response as $item){
        echo $item['strDrink'];
        echo $item['strDrinkThumb'];
        echo $item['idDrink'];
        echo $item['strInstructions'];

        echo $item['strIngredient1'];

        echo $item['strIngredient2'];
	echo $item['strIngredient3'];

        echo $item['strIngredient4'];

        echo $item['strIngredient5'];
	echo $item['stringredient6'];

        echo $item['stringredient7'];
        echo $item['stringredient8'];

        
        echo $item['stringredient9'];
        echo $item['stringredient10'];

       
        echo $item['strMeasure1'];
        echo $item['strMeasure2'];

        if(isset($dMeasure))
        {echo $item['strMeasure3'];}

        if(isset($dMeasure))
        {echo $item['strMeasure4'];}

        if(isset($dMeasure))
        {echo $item['strMeasure5'];}

        if(isset($dMeasure))
        {echo $item['strMeasure6'];}

        if(isset($dMeasure))
        {echo $item['strMeasure7'];}

        if(isset($dMeasure))
        {echo $item['strMeasure8'];}

        if(isset($dMeasure))
        {echo $item['strMeasure9'];}

        if(isset($dMeasure))
        {echo $item['strMeasure10'];}
}*/

//print_r($response['0']);
    $f = $response['0'];
    $f = json_encode($f);
    echo "Bussin it down...";
   	
     
    $d = 1;
   
    header("refresh: $d; url= http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/display.php?res=$f");
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
