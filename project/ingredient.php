#!/usr/bin/php
<?php

	$curl=curl_init();	
curl_setopt_array($curl, array(
        CURLOPT_URL => "https://the-cocktail-db.p.rapidapi.com/list.php?i=list",
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
//curl_close($curl);

$res=json_decode($respons, true);
extract($res);
//print_r($res);
//print_r($drinks); full array
extract($drinks);
//print_r($drinks['0']); will print strIngredient1=>"gin"
$size =sizeof($drinks);
$name=array();
for($i=0; $i<$size; $i++)
{

        extract($drinks[$i]);

	array_push($name,$strIngredient1);
	//return $name;empty unpopulated
//print_r($name);//prints 3 seperate arrays with drink ingredient
}
//print_r ($name);//creates a single array ex. [0]strIngredeint=>"gin"

//$ingredient=json_decode($name,true);already an array.
extract($name);
print_r($name);//stays the same

/*
$respons = curl_exec($curl);
//$err = curl_error($curl);
//curl_close($curl);
$res =json_decode($repons,true);
extract($res);
extract($drinks);
print_r($drinks['0']);
$size = sizeof($drinks);
$strIngredient1=array();
for($i=0; $i<$size; $i++)
{

        extract($drinks[$i]);

        array_push($strIngredient1, $name);
}

if ($err) {
        echo "cURL Error #:" . $err;
} else {
//print_r($strIngredient);
}
//$database=$client-> publish($dName)
//;*/
?>

