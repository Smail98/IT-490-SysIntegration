<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #2F2F31;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #2F2F31;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
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
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Profile</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<table>
<tr>
<th>Cocktail</th>
<th>Presentation</th>
</tr>
<?php

function display($alc)
{

	$db = getDBconnect();
	$s="SELECT * FROM cocktails WHERE stralc = '$alc'";

	($h = mysqli_query($db, $s)) or die (mysqli_error());
if ($h-> num_rows > 0){
	while ($q = mysqli_fetch_array($h, MYSQLI_ASSOC))
		{
			$alc = $q["strDrink"];
			$ing = $q["strDrinkThumb"];
			
			echo "<tr><td>" .$alc ."</td><td>" .$ing ."</td></tr>";
		}
	echo "</table>";	
}
else {
	echo "0 results";
}
}
?>
</table>
</body>
</html>
