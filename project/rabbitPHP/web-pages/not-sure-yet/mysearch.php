
<h1> HEllo </h1>
<?php

include ("connect.php");

print "YOu read bruh?";

<table>
$sql=$db->prepare('SELECT * FROM cocktails WHERE stralc=gin');
    $sql->execute(array('stralc'=>$_REQUEST[searchcategory]));

    while ($row=$sql->fetch())
    {
       //Here is where you will loop through all the results for your search. If 
       //you had for example for each product name, price, and category, 
       //you might do the following
       echo "<tr><td>$row[strDrink]</td><td>$row[strDrinkThumb]</td>";
    }
 

    </table>
?>
