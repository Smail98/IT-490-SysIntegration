<?php
session_start();

include ("fncs.php");

seshCheck();

$u = $_SESSION ["user"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Drink Search!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">What Are You Drinking?</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Search.php">Home</a></li>
        <li class="active"><a href="http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Profile.php">Profile</a></li>
        <li class="active"><a href="http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/CreateDrink.php">Create a drink</a></li>
        <li class="active"><a href="http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/recommend.php">Our Recommendations</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php

                //Remember 2 delete
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);


$ar = $_REQUEST["res"];
//$ar = json_decode($ar);

print_r($ar);
/*
extract($ar);

foreach($ar as $item){
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
}
 */
?>
</div>
</body>
</html>
