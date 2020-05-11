<?php
session_start();

include ("fncs.php");

seshCheck();


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

!tr:nth-child(even) {
  background-color: #dddddd;
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
		<li class="active"><a href="https://www.drinksch.com/web-pages/CreateDrink.php">Create a Drink</a></li>
     		<li class="active"><a href="https://www.drinksch.com/web-pages/recommend.php">Our Recommendations</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.drinksch.com/web-pages/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <form class="form-inline my-2 my-lg-0" action="https://www.drinksch.com/back-end/RabbitClient2.php" method="get">
   <h3>Add an Ingredient</h3>
    <input id="search" name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>

 
  <?php

		//Remember 2 delete
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);


$alc = $_REQUEST["n"];
$alc = json_decode($alc);

$id = $_REQUEST["i"];
$id = json_decode($id);
//print_r($alc);
//extract($alc);


$size = sizeof($alc);

echo "<hr>";
echo "<table>";
$alc = str_replace("%26","&", $alc);
$alc = str_replace("%23","#", $alc);

for($i=0; $i<$size; $i++)
{
	echo "<tr><td>";
	extract($alc);
	extract($id);
	echo "<a href='https://www.drinksch.com/back-end/R3Client.php?id=$id[$i]'>$alc[$i]</a>";
	//echo $alc[$i];
	echo "</td></tr>";
	//echo "<tr><td>";
	//echo "<button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Search</button>";
}

echo "</tr> </table>";

//print_r($alc);
//display ($alc)
//echo $alc;
?>

</div>
</body>
</html>
