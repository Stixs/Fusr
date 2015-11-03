<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    require('beheer.php');
} else {
    require('inloggen.php');
}
?>