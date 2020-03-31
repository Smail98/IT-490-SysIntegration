<?php

function display($alc, $db)
{
/*	$s = "SELECT * FROM cocktails WHERE type = '$alc'";

	($h = mysqli_query($db, $s)) or die (mysqli_error($db));

	while ($q = mysqli_fetch_array($h, MYSQLI_ASSOC))
	{
		$alc = $q["type"];
		$ing = $q["ingredients"];
		print ("<br>alcohol: $alc || ingredients: $ing<br>");
	
	}*/

	$query = "SELECT strDrink FROM cocktails WHERE stralc='$alc'";
       
//	($h = mysqli_query($connect,$query));
	($h = mysqli_query($db, $query)) or die (mysqli_error($db));


	 while ($q = mysqli_fetch_array($h, MYSQLI_ASSOC))
	 {
		 $drink= $q["strDrink"];
		 print (" <br> Drink: $drink");

	 }
}

?>
