<?php
session_start();



$username = $_REQUEST['user'];
//$password = $_REQUEST['pass'];

$res = $_REQUEST['response'];

//echo $res;
//echo $username;



//include ('fncs.php');


if($res < 1)
                {
                    echo "INVALID LOGIN - TRY AGAIN";
                    header("refresh: 3; url = http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.html");
                    
                }
                else
                {
			$_SESSION ["user"] = $username;
			$_SESSION ["logged"] = true;
			echo "Logging In!";
			
   
                    header("refresh: 1; url = http://ec2-13-59-27-110.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Search.php");
                }                  

?>
