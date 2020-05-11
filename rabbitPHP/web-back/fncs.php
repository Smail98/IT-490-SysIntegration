<?php



// AUTH FOR DB [JL]
function getDBconnect()
{
    include ('accounts.php');
    $db = mysqli_connect($hostname,$username,$password,$project); //will need valid creds
    if (!$db)
    {
        echo "DB Fail  ";
        die ("The Connection has failed: ".mysqli_connect_error());
    }
    echo " [DB Connect Successful]  ";
    return $db;
}



//CREATING A NEW ACCOUNT
function newAccount($user,$pass,$fname,$lname)
{
    $db = getDBconnect();    //connect 2 DB
    
    //Select by ID
    //$id = null;
    $s2 = "SELECT id FROM Accounts WHERE username= '$user'";
    $result = mysqli_query($db,$s2);
    $num = mysqli_num_rows ($result);

    if($num > 0)
    {
        echo "User Account Already Exists --- ";
        echo " Please Log in.";
        return false;
    }
    else
    {
         //SQL STATEMENT
        $s = "INSERT INTO Accounts (username, password, firstname, lastname) VALUES 
        ('$user', '$pass', '$fname', '$lname')";
        $result = mysqli_query($db, $s);

        echo ' New User has been created!';
    
        if (!$result) 
        {
            echo mysqli_error($db);
        }
        return true;
    }
   


    mysqli_close($db);	//was un-commented

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
   

    # Run database query here to validate credentials
    $db = getDBconnect();
    $s = "SELECT * FROM Accounts WHERE username='$user' AND 
    password='$pass'";
    $result = mysqli_query($db, $s);

    /*$yes = false;
    $id = "";
    $text = "";*/

    $num = mysqli_num_rows($result);

    if($num == 0)
    {
        echo '  LOGIN FAIL --- Invalid Credentials  ';
       return false;
    }
    elseif($user == 'admin' && $pass == 'pass')
    {
    
        echo 'Logging in...  ';
        return true;
        
    }
    else
    {
       
        echo 'Logging in...  ';
        return true;
        
        
    }
    
    //GET ACCOUNT DETAILS FROM DB/ADD TO RESPONSE
    /*return array(
        "success" => $yes, //or "yes"
        "id" => $id,
        "text" => $text,*/
   


   
}


function authorize($user, $pass)
{
    $db = getDBconnect();
    $s = "SELECT * FROM Accounts WHERE username='$user' AND 
    password='$pass' ";

    ($result = mysqli_query($db,$s) ) or die (mysqli_error($db) );
    $num = mysqli_num_rows($result);

    if($num == 0)
    {
        return false;
    }
    return true;
}


# This proccess data picked up from rabbit queue
function requestProcessor($request)
{
    $rC = 0;
    $response = [];
    $m = "";
    $p = "empty";
    // Perform appropriate action depending on type
    switch ($request['type']) {
            // Authenticate
            case "login":
                if(!doLogin($request['username'], $request['password']))
                {
                    $p = 'LOGIN FAIL';
                    $rC = 0;
                    $m = "fail";
                }
                else
                {
                    $p = 'LOGIN SUCCESSFUL';
                    $rC = 1;
                    $m = "success"; 
                }                  
               // $p = showAccount($request['username']);                 /*PAYLOAD FOR SHOWING ACCOUNT*/
               //$p = doLogin($request['username'], $request['password']);  /*PAYLOAD FOR LOGGING IN*/
                break;

            case "register":
                if(newAccount($request['username'],          
                $request['password'], $request['firstname'], 
                $request['lastname']) == false)
                {
                    $p = 'REGISTER FAIL';
                    $rC = 2;
                    $m = "fail";
                }
                else
                {
                    $p = 'REGISTER SUCCESSFUL';
                    $rC = 3;
                    $m = "success";
                }
                //$rC = 2;
                
                break;

            
            default:
                // do nothing
                break;
    }
    $response = array('returnCode'=>$rC,'message'=>$m,'payload'=>$p);
    extract($response);
    if($returnCode > 0 && $returnCode < 7 )
    {
        return $returnCode;
    }
    elseif($returnCode == 7)
    {
	    $random = array();
	    array_push($random, $returnCode);
	    array_push($random, $message);
	    return $random;
    }
    else
    {
        $returnCode = 0;
        return $returnCode;
    }
 
}

function seshCheck()
{
    if(!isset($_SESSION["logged"]))
    {
        $d = 3;
        echo "Please Login First -- Redirecting...";
        header("refresh: $d; url= http://ec2-18-218-134-170.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.html");
        exit();
    }
}


function getData($o)
{
    $db = getDBconnect();

    $o1 = $_GET[$o];
    $o1 = mysqli_real_escape_string($db,$o1);
    return $o1;
}
?>

