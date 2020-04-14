<?php 





function saved($u){

$db = getDBconnect();
$sql = "SELECT id FROM Accounts WHERE username='$u' ";
$result = mysqli_query($db,$sql);
$num = mysqli_num_rows($result);
if ($num = 1){
	$row = mysqli_fetch_row($result);
	$id = $row[0];
	$db = getDBconnect();
	$query = "SELECT DrinkName, AlcType, Ingredients, Instructions from CustomRep WHERE id = '$id'";
	$results = mysqli_query($db, $query);
	$nums = mysqli_num_rows($results);
	if ($nums > 0){
		echo "Pulling Saved Items. ";
		$saved_items = array();
		while ($rows = mysqli_fetch_assoc($results)){
			//array_push($saved_items, $rows);
			$saved_items = [$rows];
		
		}
		print_r($saved_items);
		return $saved_items;
	}else {
		echo "No Saved Items.";
		return false;
	}
	
	}

else {
	$id = 0;
	echo "No user found. ";
	return false;
}
}


function recommend(){

$db = getDBconnect();
$query = "SELECT strDrink, stralc from cocktails ORDER BY RAND() LIMIT 1";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0){
	echo "found something ";
	while ($row = mysqli_fetch_array($result)){
		//array_push($resultset,$row);

		return $row;
	}



	//print_r($resultset);
	//echo "<h2> Try this on us </h2>";
	//foreach($resultset as $item)
	//	echo $item [0] . "<br>";
	//	echo $item [1] . "<br>";
	//return $resultset;
}
else {
	echo "No recommendations.";
	return false;
}
}


function pullid($u,$DrinkName,$alctype,$ingredients,$instructions)
{

$db = getDBconnect();
$sql = "SELECT id FROM Accounts WHERE username='$u'  limit 1";
$result = mysqli_query($db,$sql);
$num = mysqli_num_rows($result);



if ($num = 1){
	$row = mysqli_fetch_row($result);
	$id = $row[0];
	$recipe = "INSERT INTO CustomRep(DrinkName, AlcType, Ingredients, Instructions, id) VALUES ('$DrinkName','$alctype', '$ingredients', '$instructions', '$id')";
	if (!mysqli_query($db,$recipe)){
    		die('Error:' .mysqli_error());
	}

	echo "Your recipe was saved.";
	mysqli_close($db);

	return true;
}
else{
	$id = 0;
	return false;
 

}
}



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
$sql = "SELECT id FROM Accounts WHERE username='$u'  limit 1";
$result = mysqli_query($db,$sql);
$num = mysqli_num_rows($result);
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
$sql = "SELECT id FROM Accounts WHERE username='$u'  limit 1";
$result = mysqli_query($db,$sql);
$num = mysqli_num_rows($result);

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

    case "random":

	if(recommend() == false){
		$p = "Recommend fail";
		$rC = 6;
		$m = "fail";
	}else{
		$p = "Recommend list created";
		$rC = 7;
		$m = recommend();
		//array_push($m, recommend());
	}
	break;

    case "drink":
	    extract($request);
	    $u=$user;

	    if(pullid($u,$DrinkName,$alctype,$ingredients,$instructions) == false){
		$p="ID pull fail";
		$rC = 4;
		$m = "fail";		
	    }
	    else
	    {
		    $p="ID pulled";
		    $rC=5;
		    $m = "success";
	    }
	break;	    
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

            
            case "saved":
           	extract($request);
           	$u = $user;
        	if (saved($u) == false){
                	    $p = "Saved fail";
                    	$rc = 8;
                   	 $m = "fail";
        	}else{
                	$p = "Saved Items pulled";
                	$rc = 9;
                	$m = saved($u);
		}

		break;

	    default:

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
//    		$random = array ();
//		array_push($random, $returnCode);
//		array_push($random,$message);
		return $message;
	
    }
    else {
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
        header("refresh: $d; url= http://ec2-18-224-23-159.us-east-2.compute.amazonaws.com/rabbitPHP/web-pages/login.html");
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

