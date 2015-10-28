<?php


session_start();

$geo = 'http://maps.google.com/maps/api/geocode/json?latlng='.htmlentities(htmlspecialchars(strip_tags($_GET['latlng']))).'&sensor=true';

$response = file_get_contents($geo);
	 
	$json = json_decode($response,TRUE);

	var_dump ($json);


?>
