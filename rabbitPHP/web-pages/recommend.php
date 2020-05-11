<?php
session_start();

include ("fncs.php");

seshCheck();

$u = $_SESSION["user"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recommendations</title>
    <meta chiarset="utf-8">
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

tr:nth-child(even) {
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
<form class="form-inline my-2 my-lg-0" action="https://www.drinksch.com/back-end/RabbitMQClient.php" method="POST">
   <h3>Random Recommendation</h3>
    <input type="hidden" id="random" name="type" value="random" readonly >
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Generate</button>
  </form>

<?php
$drn = $_REQUEST['drn'];
$dra = $_REQUEST['dra'];

//echo "<hr>";
//echo "<h1>Try Some</h1>";
//echo "<p style='font-size:20px'>$drn, '\t', $dra</p>"
//echo "<font size="6">Drink Name:</font>";
?>

<hr>

<table>
  <tr>
    <th>Drink Name</th>
    <th>Alcohol</th>
  </tr>
  <tr>
    <td><?php echo $drn ?> </td>
    <td><?php echo $dra ?></td>
  </tr>
</table>
