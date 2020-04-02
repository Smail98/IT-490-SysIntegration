<?php
session_start();



//$username = $_REQUEST['user'];
//$password = $_REQUEST['pass'];

$res = $_REQUEST['response'];

echo $res;




//include ('fncs.php');


if($res < 1)
                {
                    echo "INVALID LOGIN - TRY AGAIN";
                    header("refresh: 4; url = http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.html");
                    
                }
                else
                {
			$_SESSION ["logged"] = true;
			echo "YESSSS MF!";
   
                    header("refresh: 2; url = http://ec2-18-216-75-25.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/Search.php");
                }                  

?>
