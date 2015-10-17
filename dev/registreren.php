<?php




require('/Usernamegenerate.php');
require('/Passwordgenerate.php');
require('/connection.php');
$pdo = ConnectDB();

$CheckOnErrors = false;
	
$Username= $username;
$Password= $pw;
	
	
	if($CheckOnErrors == true) 
	{
	require('.\RegistreerBedrijfForm.php');
	}
	else
	{
		//formulier is succesvol gevalideerd

		//maak unieke salt
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		//hash het paswoord met de Salt
		$Password = hash('sha512', $Password . $salt);

		
		$parameters = array(':Inlognaam'=>$Username,
							':Password'=>$Password,
							':salt'=>$salt,
							':level'=>5
							);
		$sth = $pdo->prepare('INSERT INTO gebruikers (Inlognaam, wachtwoord, salt, level) VALUES (:Inlognaam, :Password, :salt, :level)');
		$sth->execute($parameters);
	}


?>