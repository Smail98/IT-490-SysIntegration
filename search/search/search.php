 <?php

 $connect = mysqli_connect("localhost", "testuser", "passwd", "drinks");
 if (mysqli_connect_errno())
	{
	echo "Failed to connect" . mysqli_connect_error ( );
	exit ();
 }
     print "Successfully connected";
 

 $alc = $_GET ["search"];

 $query = "SELECT strDrink FROM cocktails WHERE stralc=$alc";
 ($h = mysqli_query($connect,$query));



 while ($q = mysqli_fetch_array($h, MYSQLI_ASSOC))
 {
	 $drink= $q["strDrink"];
	 print (" <br> Drink: $drink");

}


?>


 <!DOCTYPE html>
<html>
    <head>
        <title>What would you like to drink?</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="search.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table>
                <tr>
                    <th>Cocktail</th>
                    <th>Thumbnail</th>
                </tr>
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                
            </table>
        </form>

    </body>
</html>


