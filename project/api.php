#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//log file system
$log = new rabbitMQClient("log.ini","testServer");
//$vara="1";

$file=file_get_contents('/var/log/rabbitmq/rabbit@ip-10-0-0-101.log',false);

//$open=fopen($file,'r');
//$read=fread($open,1);
//$close=fclose($open);
$queue= $log->publish($file);

//request process function to API
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  echo $request;
  $curl = curl_init();
curl_setopt_array($curl, array(
        CURLOPT_URL => "https://the-cocktail-db.p.rapidapi.com/filter.php?i=$request",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: the-cocktail-db.p.rapidapi.com",
                "x-rapidapi-key: 5c33d202f2mshc239b396dcc95e6p107449jsna786468fa173"
        ),
));

//formating API data 
$respons= curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$re = json_decode($respons, true);
//print_r($re);
extract($re);



print_r($drinks);

extract($drinks);
//print_r($drinks['0']);
//print_r($drinks['2']);

$size = sizeof($drinks);
$dName = array();
$dThumb = array();
$dID = array();
$idName=array();
for($i=0; $i<$size; $i++)
{

        extract($drinks[$i]);

        array_push($dName, $strDrink,$idDrink);
        array_push($dThumb, $strDrinkThumb);
        array_push($dID, $idDrink);
}
return $dName;



}




//Coomunication between front/api
$server = new rabbitMQServer("API.ini","testServer");

$server->process_requests('requestProcessor');

$client = new rabbitMQClient("API.ini","testServer");//connect to MQ exchange

if ($err) {
        echo "cURL Error #:" . $err;
} else {

//$database=print_r(json_decode($respons),true); uncoomment working to queue
//store and reformat API JSON into PHP OBJECT
//echo"-------------";

	
	//echo $database;//test to double php format
//$filter= $response;
//$filter= str_replace("&","%26",$response);


//echo $strDrink;
$database=$client->publish($drinks);//upload to queue
$search=$client->publish($respons);//upload to queue
}
//------------------------
?>

