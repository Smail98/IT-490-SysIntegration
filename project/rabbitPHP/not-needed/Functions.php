<?php
if (isset($_POST)) {
    // echo '[x] sending...';

  // URL
  $url = 'http://localhost/rabbitPHP/back-end/RabbitMQClient.php';
  
  // build the urlencoded data
  // $payload = http_build_query($json);

  // $payload = file_get_contents('php://input');
  // $payload = json_decode($payload, true);
  // $payload = json_encode($_POST);

  // open connection
  $ch = curl_init();

  // set the url, number of POST vars, POST data
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  // curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

  // execute post
  $result = curl_exec($ch);

  // Print server response for debugging purposes
  // echo $result;

  // close connection
  curl_close($ch);

  echo $result;
  // Handle response
  if ($result['payload'] == 'success') {
    echo 'Logged in successfully';
  } else {
    echo 'Invalid credentials.';
  }
}
?>