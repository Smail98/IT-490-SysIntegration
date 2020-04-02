<?php
session_start();

include ("fncs.php");

seshCheck();


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
        <li class="active"><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Search.php">Home</a></li>
	<li class="active"><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Profile.php">Profile</a></li>
	<li class="active"><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/CustomRecipes/CreateDrink.php">Create a drink</a></li>
	<li class="active"><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Recommendation/recommend.php">Our Recommendations</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <form class="form-inline my-2 my-lg-0" action="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/back-end/RabbitClient2.php" method="get">
   <h3>Add an Ingredient</h3>
    <input id="search" name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>

</div>
</body>
</html>
