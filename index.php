<!DOCTYPE html>
<html>


  <h2>Login Form</h2>
  <form action="http://localhost/rabbitPHP/back-end/RabbitMQClient.php" method="POST">
    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="username"><br>
    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="password"><br><br>
    <input type="text" id="lname" name="type" value="login"><br><br>
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
