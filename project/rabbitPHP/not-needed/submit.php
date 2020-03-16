<?php


function submit2() {
   echo '    [x] sending...';

  // URL
  $url = 'http://localhost/rabbitPHP/New-wpages/Search.html';
  
  // build the urlencoded data
   $postvars = http_build_query($json);

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

  // Handle response
  if ($result['message'] == 'success') {
    echo 'Logged in successfully';
  } else {
    echo 'Invalid credentials.';
  }
}
?>