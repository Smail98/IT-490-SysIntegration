<?php

function display($alc, $db)
{
	$s = "SELECT * FROM alc WHERE type = '$alc'";

	($h = mysqli_query($db, $s)) or die (mysqli_error($db));

	while ($q = mysqli_fetch_array($h, MYSQLI_ASSOC))
	{
		$alc = $q["type"];
		$ing = $q["ingredients"];
		print ("<br>alcohol: $alc || ingredients: $ing<br>");
	
	}
}

?>
