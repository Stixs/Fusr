<?php
require('./controllers/header.php');


//Controleert of je wel bent ingelogd.
if(LoginCheck($pdo))
{
	
	//init fields
	$inlognaam = $Email =  NULL;

	//init error fields
	$InlogErr = $oudErr = $nieuwErr = $herhaalErr = NULL;


var_dump($_POST);
	
	
	//controleert of de knop aanpassen of verwijderen is ingedurkt.
	if(isset($_POST['Wijzigen']))
	{
		//haalt gegevens uit de link via Get om tekijken of het wijzigen of verwijderen is en om welk bedrijf het gaat.

		$Inlognaam = $_POST['Inlognaam'];
		$O_wachtwoord = $_POST['O_wachtwoord'];
		$N_wachtwoord = $_POST['N_wachtwoord'];
		$H_wachtwoord = $_POST['H_wachtwoord'];
		
					
					
					if(is_Username_Unique($Inlognaam, $pdo) == false)
					{
						$InlogErr = 'Inlognaam is al in gebruik';
						$CheckOnErrors = true;
					}
					
					if($N_wachtwoord != $H_wachtwoord)
					{
						$herhaalErr = 'Uw wachtwoord komt niet overeen';
						$CheckOnErrors = true;
					}
					
					if(passwordcheck($O_wachtwoord, $pdo) == false)
					{
						$oudErr = 'Uw wachtwoord is onjuist';
						$CheckOnErrors = true;
					}
					
					
					//als er fouten zijn dan wordt je terug gestuurd naar het formulier met wat er verbeterd moet worden.
					if($CheckOnErrors == true) 
					{
					require('./views/AccountForm.php');
					}
					else
					{
					//update
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
		$email = $row['email'];
		require('./views/AccountForm.php');
	}

}
else
{
	echo'U moet ingelogd zijn om deze pagina te kunnen gebruiken.';
}

require('./controllers/footer.php');
?>
