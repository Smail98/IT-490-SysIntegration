#!/usr/bin/php
<?php

# This is needed to allow cross-origin requests
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Header:Content-Type");
header("Access-Control-Allow-Credentials:true");

# Need all these imports
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//require_once('logErrorRMQ.php');


// AUTH FOR DB [JL]
function getDBconnect()
{
    $db = mysqli_connect("localhost","testU","pass","testDB"); //will need valid creds
    if (!$db)
    {
        echo "database fail  ";
        die ("The Connection has failed: ".mysqli_connect_error());
    }
    echo " database success    ";
    return $db;
}

//CREATING A NEW ACCOUNT
function newAccount($user,$pass,$fname,$lname)
{
    $db = getDBconnect();    //connect 2 DB
    // echo 'hello';
    //$x = 1;
    //SQL STATEMENT
    $s = "INSERT INTO Accounts (username, password, firstname, lastname) VALUES 
    ('$user', '$pass', '$fname', '$lname')";
    $result = mysqli_query($db, $s);

    echo ' New User has been created!';
    
    if (!$result) {
        echo mysqli_error($db);
    }
    //echo $result;

    //Select by ID
    $id = null;
    $s2 = "SELECT * FROM Accounts WHERE username= '$user'";
    $result = mysqli_query($db,$s2);
    $num = mysqli_num_rows ($result);

    if($num > 0)
    {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $id = $row['id'];
        }
    }
    //else could be here

    //Returns array
    return array(
        "username" => $user,
        "password" => $pass,
        "firstname" => $fname,
        "lastname" => $lname,
        "id" => $id,
    );
    mysqli_close($db);

} 


function showAccount($user)
{
   //$user = "";
    $fname = "";
   $lname = "";

    //SQL STATEMENT
    $db = getDBconnect();
    $s = "SELECT username, firstname, lastname FROM Accounts WHERE username = '$user'";
    $result = mysqli_query($db, $s);

    $num = mysqli_num_rows($result);
    if($num > 0)
    {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            //TO SHOW THE OUTPUT
            $user = $row['username'];
            $fname = $row['firstname'];
            $lname = $row['lastname'];

            echo "    User: $user | ";
            echo "First Name: $fname  |";
            echo "Last Name: $lname   "; 

        }
    }
    else{
        echo "     No Valid Users to Show";
    }
    
    //GET ACCOUNT DETAILS FROM DB/ADD TO RESPONSE
    return array(
        "username" => $user,
        "firstname" => $fname,
        "lastname" => $lname,
    );

    mysqli_close($db);
}



function doLogin($user, $pass)
{
    echo 'Logging in...';

    # Run database query here to validate credentials
    $db = getDBconnect();
    $s = "SELECT * FROM Accounts WHERE username='$user' AND 
    password='$pass'";
   // echo $db;
    $result = mysqli_query($db, $s);

    /*$yes = false;
    $id = "";
    $text = "";*/

    $num = mysqli_num_rows($result);

    if($num == 0)
    {
       return '    Fail --- Invalid credentials';
    }
    elseif($user == 'admin' && $pass == 'pass')
    {
        return 'success';
    }
    else
    {
        return '   SUCCESSFUL LOGIN';
        /* return 'Fail';
        $text = "User does not exist.";*/
    }
    //GET ACCOUNT DETAILS FROM DB/ADD TO RESPONSE
    return array(
        "success" => $yes, //or "yes"
        "id" => $id,
        "text" => $text,
    ); 


   
}


# This proccess data picked up from rabbit queue
function requestProcessor($request)
{
    $returnCode = 0;
    $response = [];
    $message = "";
    $payload = "empty";
    // Perform appropriate action depending on type
    switch ($request['type']) {
            // Authenticate
            case "login":
                $returnCode = 0;
                $message = "request recieved successfully  ";
            /* $payload = newAccount($request['username'],          
                $request['password'], $request['firstname'], 
                $request['lastname']); */                                       /*PAYLOAD FOR CREATING NEW ACCOUNT*/
               // $payload = showAccount($request['username']);                 /*PAYLOAD FOR SHOWING ACCOUNT*/
               $payload = doLogin($request['username'], $request['password']);  /*PAYLOAD FOR LOGGING IN*/
                break;

            case "register":
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = createAccount($request['username'], $request['password'], $request['firstname'], $request['lastname']);
                break;

            // Account details
            case "account":
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = getAccountDetails($request['userID']);
                break;

            case "profileValue":
                // do stuff here
                break;

            case "transaction":
                // do stuff here
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = makeTransaction($request['userID'], $request['details']);
                break;

            // Session Validation
            case "validate_session":
                //return doValidate($request['sessionId']);
                break;

            //Logging Errors
            case "error":
                $returnCode = 0;
                $message = "error occured while request was being processed";
                //$payload = logError($request['error']);
                break;

            case "test":
                $returnCode = 0;
                $message = "request recieved successfully";
                $payload = testQuery($request['userID']);
                break;

            default:
                // do nothing
                break;
    }
    $response = array("returnCode" => $returnCode, 'message'=> $message, 'payload' => $payload);
    return $response;
}

// Listen for incoming data from queue
$server = new rabbitMQServer("RabbitMQ.ini", "testServer");

// Process data
$server->process_requests('requestProcessor');
exit();

?>
