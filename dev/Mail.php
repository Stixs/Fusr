<?php
$to = "info@computerselection.nl";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: jeroenbiggie@gmail.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);
?>