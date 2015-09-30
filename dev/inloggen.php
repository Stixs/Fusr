<?php
require('./controllers/header.php');

function login($Username, $password, $pdo)
{
	
	$parameter = array(':Inlognaam'=>$Username);
	$sth = $pdo->prepare('select * from gebruikers where Inlognaam = :Inlognaam');
	
	$sth->execute($parameter);

	//Kijkt over er maar een user is.
	if ($sth->rowCount() == 1) 
	{
		// Variabelen inlezen uit query
		$row = $sth->fetch();
		
		//Het wachtwoord wordt encrypt.
		$password = hash('sha512', $password . $row['salt']);

		//Controleert of het wachtwoord correct is.
		if ($row['wachtwoord'] == $password) 
		{
			//Controleert of het de zelfde browser is.
			$user_browser = $_SERVER['HTTP_USER_AGENT'];


			$_SESSION['user_id'] = $row['gebruiker_id'];
			$_SESSION['username'] = $row['inlognaam'];
			$_SESSION['level'] = $row['level'];
			$_SESSION['login_string'] = hash('sha512',
					  $password . $user_browser);
			
			// Login successful.
			return true;
		 } 
		 else 
		 {
			// password incorrect
			return false;
		 }
	}
	else
	{
		// username bestaat niet
		return false;
	}
}

//begin pagina

//het knopje inloggen van het formulier is ingedrukt.
if(isset($_POST['Inloggen']))
{
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	if(login($Username, $Password, $pdo))
	{
		echo'U bent succesvol ingelogd';
		header("Location: index.php");;
	}
	else
	{
		echo'Inloggen mislukt';
		
		require('./views/InloggenForm.php');
		
	}
}
else
{	
	//er is nog niet op het knopje gedrukt, het formulier wordt weergegeven
	require('./views/InloggenForm.php');
}

require('./controllers/footer.php');
?>
