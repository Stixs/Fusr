<?php
session_start();

if(isset($_POST['plaats'])) {
    $geo = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $_POST['plaats'] . '|country:NETHERLANDS';
    $response = file_get_contents($geo);
    $response = json_decode($response, true);

    $latitude = $response['results'][0]['geometry']['location']['lat'];
    $longitude = $response['results'][0]['geometry']['location']['lng'];

    if($latitude != 0 && $longitude != 0) {
        $_SESSION['plaats'] = $_POST['plaats'];
        $_SESSION['latitude'] = $latitude;
        $_SESSION['longitude'] = $longitude;
    }

    header('Location: gids.php?q=fotografie');
}
?>