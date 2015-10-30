<?php
session_start();

if(isset($_GET['lat']) && isset($_GET['lng'])) {
    $geo = 'http://maps.google.com/maps/api/geocode/xml?latlng='.$_GET['lat'].','.$_GET['lng'].'&sensor=true';
    $xml = simplexml_load_file($geo);

    unset($_SESSION['latitude']);
    unset($_SESSION['longitude']);
    unset($_SESSION['plaats']);

    foreach($xml->result->address_component as $component){
        if($component->type=='locality'){
            $plaats = $component->long_name;
            $_SESSION['plaats'] = ' ' . $component->long_name;
        }
    }

    $_SESSION['latitude'] = $_GET['lat'];
    $_SESSION['longitude'] = $_GET['lng'];
}

if(isset($_GET['permission']) && $_GET['permissions'] == 0) {
    if(isset($_SESSION['latitude']) && isset($_SESSION['longitude'])) {
        unset($_SESSION['latitude']);
        unset($_SESSION['longitude']);
        unset($_SESSION['plaats']);
    }
}
?>