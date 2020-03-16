<?php


$db = mysqli_connect("localhost","testuser","passwd","drinks"); //will need valid creds
    if (!$db)
    {
        echo "database fail";
        die ("The Connection has failed: ".mysqli_connect_error());
    }
    echo "database success";
    return $db;




?>
