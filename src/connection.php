<?php
function ConnectDB()
{
	$pdo = new PDO('mysql:host=localhost;dbname=vervoerders',"root","");

	return $pdo;
}
?>