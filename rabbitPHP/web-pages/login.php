<?php
session_start();



$username = $_REQUEST['user'];
//$password = $_REQUEST['pass'];

$res = $_REQUEST['response'];

$dn = $_REQUEST['drink'];

//echo $res;
//echo $username;



//include ('fncs.php');


if($res < 1)
                {
                    echo "INVALID LOGIN - TRY AGAIN";
                    header("refresh: 3; url = https://www.drinksch.com/web-pages/login.html");
                    
                }
                else
		{
			$_SESSION ["drink"] = $dn;
			$_SESSION ["user"] = $username;
			$_SESSION ["logged"] = true;
			echo "Logging In!";
			
   
                    header("refresh: 1; url = https://www.drinksch.com/web-pages/Search.php");
                }                  

?>
