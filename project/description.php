#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');



function requestProcessor($ID){
	echo "received request".PHP_EOL;
	$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://the-cocktail-db.p.rapidapi.com/lookup.php?i=$ID",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: the-cocktail-db.p.rapidapi.com",
		"x-rapidapi-key: 55a41020edmsh29d5dc34322ce60p11eb7ajsn3b220792f20d"
	),
));
$respons= curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$re = json_decode($respons, true);
//print_r($re);
extract($re);


//print_r($re);
//print_r($drinks);
//multi-dimensional array
extract($drinks);
//print_r($drinks['0']);
//print_r($drinks['2']);

$size = sizeof($drinks);
$dName = array();
$dThumb = array();
$dID = array();
$dInstruct= array();
$dIngredient=array();
$dMeasure=array();
for($i=0; $i<$size; $i++)
{

        extract($drinks[$i]);

        array_push($dName, $strDrink);
        array_push($dThumb, $strDrinkThumb);
        array_push($dID, $idDrink);
        array_push($dInstruct,$strInstructions);
        array_push($dIngredient,$strIngredient1);
        //array_push($dIngredient,$strIngredient2);
        //array_push($dIngredient,$strIngredient3);
        //array_push($dingredient,$strIngredient4);
        //array_push($dMeasure,$strMeasure);

}

//two dimensional array
extract($drinks);

$size = sizeof($drinks);
$dName = array();
$dThumb = array();
$dID = array();
$dInstruct= array();
$dIngredient=array();
$dMeasure=array();
for($i=0; $i<$size; $i++)
{

        extract($drinks[$i]);

        array_push($dName, $strDrink);
        array_push($dThumb, $strDrinkThumb);
        array_push($dID, $idDrink);
        array_push($dInstruct,$strInstructions);
        array_push($dIngredient,$strIngredient1);
        //array_push($dIngredient,$strIngredient2);
        //array_push($dIngredient,$strIngredient3);
        //array_push($dingredient,$strIngredient4);
        //array_push($dMeasure,$strMeasure);
//print_r(array_values($drinks));
}
//single array
extract($drinks);

$size = sizeof($drinks);
$dName = array();
$dThumb = array();
$dID = array();
$dInstruct= array();
$dIngredient=array();
$dMeasure=array();
for($i=0; $i<$size; $i++)
{

        extract($drinks[$i]);
//api contains individual records of each measurment
        array_push($dName, $strDrink);
        array_push($dThumb, $strDrinkThumb);
        array_push($dID, $idDrink);
        array_push($dInstruct,$strInstructions);
        array_push($dIngredient,$strIngredient1);
        array_push($dIngredient,$strIngredient2);
        array_push($dIngredient,$strIngredient3);
        array_push($dIngredient,$strIngredient4);
        array_push($dIngredient,$strIngredient5);
        array_push($dIngredient,$strIngredient6);
        array_push($dIngredient,$strIngredient7);
        array_push($dIngredient,$strIngredient8);
        array_push($dIngredient,$strIngredient9);
        array_push($dIngredient,$strIngredient10);
        array_push($dMeasure,$strMeasure1);
        array_push($dMeasure,$strMeasure2);
        array_push($dMeasure,$strMeasure3);
        array_push($dMeasure,$strMeasure4);
        array_push($dMeasure,$strMeasure5);
        array_push($dMeasure,$strMeasure6);
        array_push($dMeasure,$strMeasure7);
        array_push($dMeasure,$strMeasure8);
        array_push($dMeasure,$strMeasure9);
        array_push($dMeasure,$strMeasure10);
}

extract($drinks['0']);
/*
//extract($drinks['0']);
//format to pull specific data from api while check to see if data is there
foreach($drinks as $item){
        echo $item['strDrink'];
        echo $item['strDrinkThumb'];
        echo $item['idDrink'];
        echo $item['strInstructions'];

        if(isset($dIngredient))

        {echo $item['strIngredient1'];}

        if(isset($dIngredient))

        {echo $item['strIngredient2'];}

        if(isset($dIngredient))
        {       echo $item['strIngredient3'];}
        if(isset($dIngredient))
        {echo $item['strIngredient4'];}
        if (isset($dIngredient))
        {echo $item['strIngredient5'];}
        if (empty($dIngredient))
        {echo $item['stringredient6'];}

        if(empty($dIngredient))
        {echo $item['stringredient7'];}

          if(empty($dIngredient))
        {echo $item['stringredient8'];}

        if(empty($dIngredient))
        {echo $item['stringredient9'];}

         if(empty($dIngredient))
        {echo $item['stringredient10'];}

        if(isset($dMeasure))
        {echo $item['strMeasure1'];}

        if(isset($dMeasure))
        {echo $item['strMeasure2'];}

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
}
 */

return ($drinks);
//print_r($drinks);
}
$getid = new rabbitMQServer("desc.ini","testServer");

$getid->process_requests('requestProcessor');

$gotid = new rabbitMQClient("desc.ini","testServer");
//if ($err) {
  //      echo "cURL Error #:" . $err;
//} else {
$iddrink=$getid->publish($drinks['0']);


?>

