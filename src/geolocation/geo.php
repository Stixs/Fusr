<?php
session_start();

$geo = 'http://maps.google.com/maps/api/geocode/xml?latlng='.htmlentities(htmlspecialchars(strip_tags($_GET['latlng']))).'&sensor=true';
$xml = simplexml_load_file($geo);

foreach($xml->result->address_component as $component){
	if($component->type=='street_number'){
		$geodata['Huis nummer'] = $component->long_name;
	}
	if($component->type=='route'){
		$geodata['Straat'] = $component->long_name;
	}
	if($component->type=='locality'){
		$geodata['Plaats'] = $component->long_name;
	}
	if($component->type=='postal_code'){
		$geodata['Postcode'] = $component->long_name;
	}

}
var_dump($geodata);
var_dump($geodata);
var_dump($geodata);
list($lat,$long) = explode(',',htmlentities(htmlspecialchars(strip_tags($_GET['latlng']))));

$_SESSION['latitude'] = $lat;
$_SESSION['longitude'] = $long;

$huisnummer = $geodata['Huis nummer']->asXML();
$huisnummer = strip_tags($huisnummer);
$_SESSION['huisnummer'] = $huisnummer;

$straat = $geodata['Straat']->asXML();
$straat = strip_tags($straat);
$_SESSION['straat'] = $straat;

$plaats = $geodata['Plaats']->asXML();
$plaats = strip_tags($plaats);
$_SESSION['plaats'] = $plaats;

$postcode = $geodata['Postcode']->asXML();
$postcode = strip_tags($postcode);
$_SESSION['postcode'] = $postcode;
?>