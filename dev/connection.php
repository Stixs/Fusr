<?php
function ConnectDB()
{
	$pdo = new PDO('mysql:host=localhost;dbname=fusr;charset=utf8',"root","root");

	return $pdo;
}
?>