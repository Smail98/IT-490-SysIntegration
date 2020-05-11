
<?php
session_start();

include ("fncs.php");

seshCheck();

$u = $_SESSION ["user"];

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
            <a class="navbar-brand" href="#">What Are You Drinking?</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
	    <ul class="nav navbar-nav" >
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
    <form action="https://www.drinksch.com/back-end/RabbitMQClient.php" class="form-inline my-2 my-lg-0" method="POST">
        <h3>Submit your recipe:</h3>
        <label for="DrinkName">Cocktail Name:</label><br>
        <input type="text" id="DrinkName" name="DrinkName"><br>
        <label for="alctype">Enter the type of alcohol: (separate with a comma)</label><br>
        <input type="text" id="alctype" name="alctype" class="alcsub"><br>
        <label for="ingredients">Enter the garnish:</label><br>
        <input type="text" id="ingredients" name="ingredients" class="ingsub"><br>
        <label for="instructions">Enter the instructions:</label><br>
        <input type="text" id="instructions" name="instructions" class="instsub"><br>
	<input type="hidden" id="drink" name="type" value="drink" readonly >  
	<input type="hidden" id="user" name="user" value="<?php echo htmlspecialchars($u);?>" readonly >   
 <!--  <input type="submit" value="Save Recipe"> -->
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Save Recipe</button>

    </form>

</div>
</body>
</html>
