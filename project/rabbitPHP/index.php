<!DOCTYPE html>
<html>


  <h2>Login Form</h2>
  <form action="index.php" method="POST">
    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="username"><br>
    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="password"><br><br>
    <input type="submit">
  </form>


<?php
if (isset($_POST)) {
    $data = array(
    'type' => 'login',
    'username' => $_POST['username'],
    'password' => $_POST['password']
  );

  // Convert into json format
    $payload = json_encode($data);

    // URL
    $url = 'http://please.com/back-end/RabbitMQClient.php';
  
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
    echo $result;

    // close connection
    curl_close($ch);
}
?>

</html>
