<?php
// This example requires the PHP Curl module installed
// In php.ini: extension=php_curl.dll
// Set account + address parameters
$auth_key = "9mPiDJVEjKZliA8I";
$nl_sixpp = "5421TP";
// Optional
$streetnumber = "52";

// Optionally, set a timeout (in ms)
$timeout = 0;

$url = "https://api.pro6pp.nl/v1/autocomplete?auth_key=" . $auth_key .
       "&nl_sixpp=" . $nl_sixpp .
       "&streetnumber=" . $streetnumber;

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);

$result = curl_exec($ch);
curl_close($ch);

echo $url;

if ($result)
{
  // Show raw output
  print("Output: " . $result . "<br/>");

  $output = json_decode($result);
  $status = $output->{"status"};

  if ($status === "ok")
  {
    print("Found results. The first one:<br/>");
    print($output->{"results"}[0]->{"street"} . ",<br/>" .
          $output->{"results"}[0]->{"nl_sixpp"} . ",<br/>" .
          $output->{"results"}[0]->{"city"});
  }
  else
  {
    // Error.
    $message = $output->{"error"}->{"message"};
    print("Error message: " . $message);
  }
} else {
  // Timeout occured. Either the service is down or you should
  // increase the timeout to at least 5000ms.
  print("Pro6PP is unavailable at this time");
}

?>