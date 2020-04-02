<?php

include ('accounts.php');
include ('fncs.php');



$db = getDBconnect();

//$userid="SELECT id from Accounts WHERE username='$user' AND password='$pass'";
//$result = mysqli_query($db,$s);


$recipe = "INSERT INTO CustomRep(DrinkName, AlcType, Ingredients, Instructions, id) VALUES ('$_POST[DrinkName]','$_POST[alctype]', '$_POST[ingredients]', '$_POST[instructions]', '$_SESSION[myid]')";
if (!mysqli_query($recipe,$db)){
    die('Error:' .mysql_error());
}

echo "Your recipe was saved.";
mysqli_close($db);
?>
