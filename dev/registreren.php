<?php

require('./connection.php');
$pdo = ConnectDB();
//init fields
$bedrijf_naam = $adres = $postcode = $plaats = $land = $telefoon = $fax = $type = $naar = $specialiteit = $bedrijf_email = $Username = $Password = $email = NULL;

//init error fields
//= NULL;

if(isset($_POST['Registreerbedrijf']))
{
	$CheckOnErrors = false;
	
	$Username=$_POST['Username'];
	$Password=$_POST['Password'];
	$email = $_POST["email"];
	
	if($CheckOnErrors == true) 
	{
	require('./RegistreerBedrijfForm.php');
	}
	else
	{
		//formulier is succesvol gevalideerd

		//maak unieke salt
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		//hash het paswoord met de Salt
		$Password = hash('sha512', $Password . $salt);

		
		$parameters = array(':email'=>$email,
							':Inlognaam'=>$Username,
							':Password'=>$Password,
							':salt'=>$salt,
							':level'=>5
							);
		$sth = $pdo->prepare('INSERT INTO gebruikers (Inlognaam, email, wachtwoord, salt, level) VALUES (:Inlognaam, :email, :Password, :salt, :level)');
		$sth->execute($parameters);
		echo 'test';
	}
}
else
{
	require('./RegistreerBedrijfForm.php');
}

?>