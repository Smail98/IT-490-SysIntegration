<?php
session_start();



$username = $_REQUEST['user'];

$password = $_REQUEST['pass'];


include ('fncs.php');


if(!doLogin($username, $password))
                {
                    //echo "WTF IS YOU DOING!";
                    header("refresh: 4; url = http://localhost/rabbitPHP/web-pages/login.html");
                    
                }
                else
                {
                    $_SESSION ["logged"] = true;
   
                    header("refresh: 2; url = http://localhost/rabbitPHP/web-pages/Search.php");
                }                  

?>
