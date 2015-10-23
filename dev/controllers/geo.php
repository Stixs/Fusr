<?php
session_start();

if(isset($_GET['lat']) && isset($_GET['lng'])) {
    $_SESSION['latitude'] = $_GET['lat'];
    $_SESSION['longitude'] = $_GET['lng'];
}
?>