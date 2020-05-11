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


	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #ffffff;
  text-align: left;
  padding: 8px;
}



</style>


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
        <li class="active"><a href="https://www.drinksch.com/web-pages/Search.php">Home</a></li>
        <li class="active"><a href="https://www.drinksch.com/web-pages/Profile.php">Profile</a></li>
        <li class="active"><a href="https://www.drinksch.com/web-pages/CreateDrink.php">Create a drink</a></li>
        <li class="active"><a href="https://www.drinksch.com/web-pages/recommend.php">Our Recommendations</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.drinksch.com/web-pages/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php

                //Remember 2 delete
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$r = null;

if (strpos($url,'rate') !== false) {
    $r = $_REQUEST["rate"];
} 


$ar = $_REQUEST["res"];
$ar = json_decode($ar);


$arr = (array) $ar;
$arr = str_replace("&","%26", $arr);
$arr = str_replace("#","%23", $arr);

//echo $ar['strDrink'];
//print_r($arr);

extract($arr);


//$size = sizeof($arr);
echo "<h2>$strDrink</h2>";
echo "<h3>$strInstructions</h3>";
echo "<hr>";

$imageData = base64_encode(file_get_contents($strDrinkThumb));


echo '<img src="data:image/jpeg;base64,'.$imageData.'" height="400" width="400" align="right">';



echo "<table>";

for($i=1; $i<16; $i++)
{
	echo "<tr><td>";
	echo ${'strIngredient' . $i};
	echo "</td><td>";
	echo ${'strMeasure' . $i};
	echo "</td></tr>";
	//echo "<td>";
        //echo ${'strMeasure' . $i};
        //echo "</td>";
}

echo "</table>";

/*
$imageData = base64_encode(file_get_contents($strDrinkThumb));


echo '<img src="data:image/jpeg;base64,'.$imageData.'" height="500" width="500" align="right">';

 */



$ar = json_encode($ar);


//$("#input-id").rating();

?>

</div>
<form class="form-inline my-2 my-lg-0" action="https://www.drinksch.com/back-end/RabbitMQClient.php" method="POST">
<div class="row container">
<div class="col-md-4 ">
	<h3 align="center"><b>Rating</b></h3>

			<h3 align="center"><b><?php if($r != null){ echo $r;}?></b> <i data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h3>
		</div>
	</div>
			<label align="center" for="input-1" class="control-label">Leave a Rating</label>
			<input id="input-1" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
	
			<input type="hidden" name="type" class="rating-value" value="ratedrink">
			<input type="hidden" name="val" class="rating-value" value="<?php echo htmlspecialchars($ar); ?>">
			<input type="hidden" name="d_name" class="rating-value" value="<?php echo htmlspecialchars($strDrink); ?>">
		</div>
	</div>
</div>
</div><br>
<div class="col-md-4">
<p><button  class="btn btn-default btn-sm btn-info" id="srr_rating">Submit</button></p>
</div>

</form>
</body>
</html>
