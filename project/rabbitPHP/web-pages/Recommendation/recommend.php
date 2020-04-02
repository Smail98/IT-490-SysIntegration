

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recommendations</title>
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
            <a class="navbar-brand" href="#">Cocktail Finder</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/rabbitPHP/web-pages/Search.php">Home</a></li>
                <li class="active"><a href="http://localhost/rabbitPHP/web-pages/Profile.php">Profile</a></li>
		<li class="active"><a href="http://localhost/rabbitPHP/web-pages/CustomRecipe.php">Custom Recipe</a></li>
		<li class="active"><a href="http://localhost/rabbitPHP/web-pages/CustomRecipes/CreateDrink.php">Create a drink</a></li>
		<li class="active"><a href="http://localhost/rabbitPHP/web-pages/Recommendation.php">Our Recommendations</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://localhost/rabbitPHP/web-pages/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


session_start();

include ("fncs.php");
$db = getDBconnect();
$user = $_GET["username"];
$sql = "SELECT id FROM Accounts WHERE username='$user'  limit 1";
$result = mysqli_query($db,$sql);
$value = mysql_fetch_object($result);
$_SESSION['myid'] = $value->id;
seshCheck();

if (isset($_SESSION['myid'])){
                $request['username'] = $username;
                $response = $client -> send_request($request);
                process_response($response);
        }

function response_processor($response){
        $user = $_SESSION['myid'];

        foreach ($response as $column){

                echo '<div class ="recommended">';
		echo "<h2> Try this on us </h2>";
		echo "Drink: " . $column [1] . " | Type " . $column[2] . "<br>";
		echo "</div>";
	}
}


?>





