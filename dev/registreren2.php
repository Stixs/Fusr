<?php
<<<<<<< HEAD
=======

require('./connection.php');
$pdo = ConnectDB();
//init fields
$bedrijf_naam = $adres = $postcode = $plaats = $land = $telefoon = $fax = $type = $naar = $specialiteit = $bedrijf_email = $Username = $Password = $email = NULL;
>>>>>>> origin/master




require('/Usernamegenerate.php');
require('/Passwordgenerate.php');
require('/connection.php');
$pdo = ConnectDB();

$CheckOnErrors = false;
	
$Username= $username;
$Password= $pw;
	
	
	if($CheckOnErrors == true) 
	{
<<<<<<< HEAD
	require('.\RegistreerBedrijfForm.php');
=======
	require('./RegistreerBedrijfForm.php');
>>>>>>> origin/master
	}
	else
	{
		//formulier is succesvol gevalideerd

		//maak unieke salt
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		//hash het paswoord met de Salt
		$Password = hash('sha512', $Password . $salt);

		
<<<<<<< HEAD
		$parameters = array(':Inlognaam'=>$Username,
=======
		$parameters = array(':email'=>$email,
							':Inlognaam'=>$Username,
>>>>>>> origin/master
							':Password'=>$Password,
							':salt'=>$salt,
							':level'=>5
							);
		$sth = $pdo->prepare('INSERT INTO gebruikers (Inlognaam, wachtwoord, salt, level) VALUES (:Inlognaam, :Password, :salt, :level)');
		$sth->execute($parameters);
	}
<<<<<<< HEAD

=======
}
else
{
	require('./RegistreerBedrijfForm.php');
}
>>>>>>> origin/master

?>