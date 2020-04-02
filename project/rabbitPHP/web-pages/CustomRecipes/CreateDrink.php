#!/usr/bin/php
<?php
session_start();

include ("fncs.php");
$db = getDBconnect();
$user = $_GET["username"];
$sql = "SELECT id FROM Accounts WHERE username='$user'  limit 1";
$result = mysqli_query($db,$sql);
$value = mysql_fetch_object($result);
$_SESSION['myid'] = $value->id;
seshCheck();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Custom Recipe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .ingsub { width: 300px; height: 100px; border: 1px solid #999999; padding: 5px; }
       .instsub { width: 300px; height: 100px; border: 1px solid #999999; padding: 5px; }
       .alcsub { width: 300px; border: 1px solid #999999; padding 5px; }
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
            <a class="navbar-brand" href="#">Cocktail Finder</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
	    <ul class="nav navbar-nav"
		<li class="active"><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Search.php">Home</a></li>
                <li class="active"><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Profile.php">Profile</a></li>
		<li class="active"><a href="http://http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/CustomRecipes/CustomRecipe.php">Custom Recipe</a></li>
		<li class="active"><a href="http://http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Recommendation/recommend.php">Custom Recipe</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/rabbitPHP/web-pages/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <br action="http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/CustomRecipes/CustomRecipe.php" class="form-inline my-2 my-lg-0" >
        <h3>Submit your recipe:</h3>
        <label for="DrinkName">Cocktail Name:</label><br>
        <input type="text" id="DrinkName" name="DrinkName"><br>
        <label for="alctype">Enter the type of alcohol: (separate with a comma)</label><br>
        <input type="text" id="alctype" name="alctype" class="alcsub"><br>
        <label for="ingredients">Enter the garnish:</label><br>
        <input type="text" id="ingredients" name="ingredients" class="ingsub"><br>
        <label for="instructions">Enter the instructions:</label><br>
        <input type="text" id="instructions" name="instructions" class="instsub"><br>
        <input type="submit" value="Save Recipe">

    </form>

</div>
</body>

