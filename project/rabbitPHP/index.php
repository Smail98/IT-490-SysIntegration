<!DOCTYPE html>
<html>


  <h2>Login Form</h2>
  <form action="http://localhost/rabbitPHP/back-end/RabbitMQClient.php" method="POST">
    <label for="user">User:</label><br>
    <input type="text" id="user" name="username"><br><br>
    <label for="pass">Pass:</label><br>
    <input type="text" id="pass" name="password"><br><br>
    <label for="fname">Firstname:</label><br>
    <input type="text" id="fname" name="firstname"><br><br>
    <label for="lname">Lastname:</label><br>
    <input type="text" id="lname" name="lastname"><br><br>
    <input type="text" id="login" name="type" value="login" readonly ><br><br>
   <input type="submit">
  </form>


<?php
return;
function submit2() {
  // echo '[x] sending...'

  // URL
  $url = 'http://localhost/rabbitPHP/back-end/RabbitMQClient.php';
  
  // build the urlencoded data
  // $postvars = http_build_query($json);

  // open connection
  $ch = curl_init();

  // set the url, number of POST vars, POST data
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

  // execute post
  $result = curl_exec($ch);

  // Print server response for debugging purposes
  // echo $result;

  // close connection
  curl_close($ch);

  // Handle response
  if ($result['payload'] == 'success') {
    echo 'Logged in successfully';
  } else {
    echo 'Invalid credentials.';
  }
}
?>

</html>
