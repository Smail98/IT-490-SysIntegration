<?php

class loginDB
{
public $logindb;

public function __construct()
{
	$this->logindb = new mysqli("127.0.0.1", "tricia", "12345", "trialrun2");

	if ($this->logindb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->logindb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "Correctly connected to database".PHP_EOL."\n";

}

public function validateLogin($username,$password)
{
	echo "Validating Login Credentials...\n";

	$un = $this->logindb->real_escape_string($username);
	$pw = $this->logindb->real_escape_string($password);
	$statement = "select * from accounts where username = '$un'";
	$response = $this->logindb->query($statement);
	//echo "query sent";

	while ($row = $response->fetch_assoc())
	{
		echo "checking password for $username".PHP_EOL;
		if ($row["password"] == $pw)
		{
			echo "passwords match for $username".PHP_EOL;
			return 1;// password match
		}
		echo "passwords did not match for $username".PHP_EOL;

	}
	echo 'NO MATCHING USER FOUND';
	return 0;//no users matched username
 }
}
?>
