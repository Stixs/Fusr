<?php
function ConnectDB()
{
	$pdo = new PDO('mysql:host=localhost;dbname=fusr',"root","");

	return $pdo;
}
?>