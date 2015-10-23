<?php
require('./controllers/header.php');

//Controleert of je wel bent ingelogd.
if(LoginCheck($pdo))
{
	
	//init fields
	$inlognaam = $emailadres =  NULL;

	//init error fields
	$InlogErr = $oudErr = $nieuwErr = $herhaalErr = NULL;

	
	//controleert of de knop aanpassen of verwijderen is ingedurkt.
	if(isset($_POST['Wijzigen']))
	{
		//haalt gegevens uit de link via Get om tekijken of het wijzigen of verwijderen is en om welk bedrijf het gaat.
		$user_id = $_SESSION['user_id'];
		$inlognaam = $_POST['inlognaam'];
		$emailadres = $_POST['emailadres'];
		$O_wachtwoord = $_POST['O_wachtwoord'];
		$N_wachtwoord = $_POST['N_wachtwoord'];
		$H_wachtwoord = $_POST['H_wachtwoord'];
		
					$CheckOnErrors = false;
					$password = true;
					
					if(is_Username_Unique($inlognaam, $pdo) == false)
					{
						$InlogErr = 'Inlognaam is al in gebruik';
						$CheckOnErrors = true;
					}
					
					if($N_wachtwoord != $H_wachtwoord)
					{
						$herhaalErr = 'Uw wachtwoord komt niet overeen';
						$CheckOnErrors = true;
						$password = false;
					}
					
					if($O_wachtwoord == '')
					{
						$oudErr = 'Uw wachtwoord mag niet leeg zijn';
						$CheckOnErrors = true;
						$password = false;
					}
					elseif(passwordcheck($O_wachtwoord, $pdo) == false)
					{
						$oudErr = 'Uw wachtwoord is onjuist';
						$CheckOnErrors = true;
						$password = false;
					}
					if ($N_wachtwoord == '' or $H_wachtwoord == '')
					{
						$password = false;
					}
					
					if($password == true)
					{
					$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
					
					$wachtwoord = hash('sha512', $N_wachtwoord . $salt);
					}
					
					
					
					//als er fouten zijn dan wordt je terug gestuurd naar het formulier met wat er verbeterd moet worden.
					if($CheckOnErrors == true) 
					{
					require('./views/AccountForm.php');
					}
					else
					{
					$parameters = array(
					':inlognaam'=>$inlognaam,
					':email'=>$emailadres,
					':user_id'=>$user_id
					);
					
					if($password == true)
					{
					$parameterspass = array( 
					':wachtwoord'=>$wachtwoord,
					':salt'=>$salt);
					
					$parameters = array_merge($parameters, $parameterspass);
					}
					
					$query = 'UPDATE gebruikers SET inlognaam=:inlognaam, email=:email';
					
					if($password == true){
					$query.= ', wachtwoord=:wachtwoord, salt=:salt';
					}
					$query.= ' WHERE gebruiker_id = :user_id';
					
					$sth = $pdo->prepare($query);
					$sth->execute($parameters);
					
					echo 'Uw gegevens worden gewijzigd';
					echo '<META http-equiv="refresh" content="1;URL=mijnaccount.php">';
					
					}
			
		
	}
	else
	{
		$gebruiker_id = $_SESSION['user_id'];
		$parameters = array(':gebruiker_id'=>$gebruiker_id);
		$sth = $pdo->prepare('select * from gebruikers where gebruiker_id = :gebruiker_id');
		$sth->execute($parameters);
		$row = $sth->fetch();
	  
		$inlognaam = $row['inlognaam'];
		$emailadres = $row['email'];
		require('./views/AccountForm.php');
	}

}
else
{
	if(isset($_SESSION['login_string']))
	{
	echo '<META http-equiv="refresh" content="1;URL=inloggen.php?edit=true">';
	}
	else
	{
	echo'U moet ingelogd zijn om deze pagina te kunnen gebruiken.';
	}
}

require('./controllers/footer.php');
?>
