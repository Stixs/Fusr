<?php
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
	require('./views/RegistreerBedrijfForm.php');
	}
	else
	{
		//formulier is succesvol gevalideerd

		//maak unieke salt
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		//hash het paswoord met de Salt
		$wachtwoord = hash('sha512', $wachtwoord . $salt);

		
		$parameters = array(':Email'=>$Email,
							':Inlognaam'=>$Username,
							':Paswoord'=>$Password,
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
	require('./views/RegistreerBedrijfForm.php');
}

?>