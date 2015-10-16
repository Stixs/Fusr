<?php
require('./controllers/header.php');


//Controleert of je wel bent ingelogd.
if(LoginCheck($pdo))
{
	
	//init fields
	$bedrijfs_naam = $beschrijving = $adres = $postcode = $plaats = $provincie = $telefoon = $fax = $bedrijfs_email = $specialiteit = $type = $bereik = $transport_manager = $aantal = $rechtsvorm = $vergunning = $geldig_tot = $website = $branche_id = $openingstijden = $otmaandag = $otdinsdag = $otwoensdag = $otdonderdag = $otvrijdag = $otzaterdag = $otzondag = NULL;

	//init error fields
	$NameErr = $ZipErr = $CityErr = $TelErr = $MailErr = $OpeningsErr = NULL;

	$Specialiteiten = specialiteitenlijst($pdo);

	
	//controleert of de knop aanpassen of verwijderen is ingedurkt.
	if(isset($_GET['action']))
	{
		//haalt gegevens uit de link via Get om tekijken of het wijzigen of verwijderen is en om welk bedrijf het gaat.
		$action = $_GET['action'];
		$bedrijfs_id = $_GET['bedrijfs_id'];
		
		//Kijkt of het wijzigen of verwijderen is.
		switch($action)
		{
			case'edit':
					
					$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
					$sth = $pdo->prepare('select * from bedrijfs_specialiteiten where bedrijfs_id = :bedrijfs_id');
					$sth->execute($parameters);
					$row = $sth->fetch();
					
					
					//SQL query om de gegevens van het juiste bedrijf uit de database halen
					$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
					$sth = $pdo->prepare('select * from bedrijfgegevens where bedrijfs_id = :bedrijfs_id');
					$sth->execute($parameters);
					$row = $sth->fetch();
					
					//Gegevens uit de database halen
					$bedrijfs_naam = $row['bedrijfsnaam'];
					$beschrijving = $row['beschrijving'];
					$adres = $row['adres'];
					$postcode = $row['postcode'];
					$plaats = $row['plaats'];
					$provincie = $row['provincie'];
					$website = $row['website'];
					$telefoon = $row['telefoon'];
					$fax = $row['fax'];
					$type = $row['type'];
					$bereik = $row['bereik'];
					$transport_manager = $row['transport_manager'];
					$aantal = $row['aantal'];
					$rechtsvorm = $row['rechtsvorm'];
					$vergunning = $row['vergunning'];
					$geldigtot = $row['geldig_tot'];
					$bedrijfs_email = $row['bedrijfs_email'];
					$premium = $row['premium'];
					
					$Facebook = $row['Facebook'];
					$Twitter = $row['Twitter'];
					$Google = $row['Google'];
					$LinkedIn = $row['LinkedIn'];
					$Instagram = $row['Instagram'];
					$Pinterest = $row['Pinterest'];
					
					
				$aan = 1;	
				if($aan == 1){		
					$openingstijden = $row['openingstijden'];
					if($openingstijden != '')
					{
						$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
						$sth = $pdo->prepare('select * from openingstijden where bedrijfs_id = :bedrijfs_id');
						$sth->execute($parameters);
						$row = $sth->fetch();
						
						$otmaandag = $row['maandag'];
						$otdinsdag = $row['dinsdag'];
						$otwoensdag = $row['woensdag'];
						$otdonderdag = $row['donderdag'];
						$otvrijdag = $row['vrijdag'];
						$otzaterdag = $row['zaterdag'];
						$otzondag = $row['zondag'];
					}
				}
					
					//controleert of de submit knop wijzigenbedrijf in het formulier is ingedurkt.
					if(isset($_POST['Del_Image']))
					{
					$image = $_POST['Del_Image'];
					$leeg = "0";
					
					$parameter = array(':leeg'=>$leeg, ':bedrijfs_id'=>$bedrijfs_id);
					$sth = $pdo->prepare('UPDATE bedrijfgegevens SET '.$image.'=:leeg WHERE bedrijfs_id = :bedrijfs_id');
					$sth->execute($parameter);
					
					//unlink('images/bedrijf_images/'.$bedrijfs_id .'/'. $row[$image]);
					
					}
					
					if(isset($_POST['Wijzigenbedrijf']))
					{
					$CheckOnErrors = false;
					
					//Gegevens uit het formulier halen
					$special = NULL;
					$specialZ = "'";
					$specialname = NULL;
					
					$bedrijfs_naam = $_POST["Bedrijfsnaam"];
					$adres = $_POST["adres"];
					$postcode = $_POST["postcode"];
					$plaats = $_POST['plaats'];
					$provincie = $_POST['provincie'];
					$website = $_POST['website'];
					$telefoon = $_POST['telefoon'];
					$fax = $_POST['fax'];
					$specialiteit = $_POST['specialiteit'];
					$transport_manager = $_POST['transport_manager'];
					$aantal = $_POST['aantal'];
					$rechtsvorm = $_POST['rechtsvorm'];
					$vergunning = $_POST['vergunning'];
					$bedrijfs_email = $_POST['bedrijfs_email'];
					$beschrijving = $_POST['beschrijving'];
					$premium = $_POST['premium'];
					
					$Facebook = $_POST['Facebook'];
					$Twitter = $_POST['Twitter'];
					$Google = $_POST['Google'];
					$LinkedIn = $_POST['LinkedIn'];
					$Instagram = $_POST['Instagram'];
					$Pinterest = $_POST['Pinterest'];
					
				if($aan == 1){		
					$openingstijden = $_POST['openingstijden'];
					if($openingstijden != 'nee' && $openingstijden == 'ja')
					{
						$otmaandag = $_POST['maandag'];
						$otdinsdag = $_POST['dinsdag'];
						$otwoensdag = $_POST['woensdag'];
						$otdonderdag = $_POST['donderdag'];
						$otvrijdag = $_POST['vrijdag'];
						$otzaterdag = $_POST['zaterdag'];
						$otzondag = $_POST['zondag'];
					}
				}	
					
					if (basename($_FILES["foto"]["name"]) == null)
								{
								$foto = $_SESSION['foto'];
								}
								else
								{
								$foto = basename($_FILES["foto"]["name"]);
								}
					if (basename($_FILES["banner"]["name"]) == null)
								{
								$banner = $_SESSION['banner'];
								}
								else
								{
								$banner = basename($_FILES["banner"]["name"]);
								}
					if (basename($_FILES["logo"]["name"]) == null)
								{
								$logo = $_SESSION['logo'];
								}
								else
								{
								$logo = basename($_FILES["logo"]["name"]);
								}
					
					
					$N = 0;
					foreach($specialiteit as $value) 
					{
						$N++;
						${'specialiteit_'.$N} = $value;
					}
					
					
					
					
					//begin controlles
					/*
					//Controleert bedrijs naam
					if(!isset($bedrijfs_naam))
					{
						$NameErr = 'U moet een naam van uw bedrijf invullen';
						$CheckOnErrors = true;
					}
					//controleert bedrijfs E-mail
					if(isset($bedrijfs_email))
					{
						if(!is_email($bedrijfs_email))
						{
							$CheckOnErrors = true;
							$MailErr = 'Dit is geen geldig E-mail adres.';
						}
					}
					//Controleert postcode
					if(!isset($postcode))
					{
						$CheckOnErrors = true;
						$ZipErr = 'U moet een postcode invullen';
					}
					elseif(!is_NL_PostalCode($postcode))
					{
						$CheckOnErrors = true;
						$ZipErr = 'Dit is geen geldig postcode.';
					}
					//Controleert telefoon nummer
					if(isset($telefoon))
					{
						if(!is_minlength($telefoon, 10))
						{
							$CheckOnErrors = true;
							$TelErr = 'Dit is geen geldig telefoon nummer.';
						}
					}
					//Controleert plaats
					if(!isset($plaats))
					{
						$CheckOnErrors = true;
						$CityErr = 'U moet een dorp/stad invullen.';
					}
					*/
					//als er fouten zijn dan wordt je terug gestuurd naar het formulier met wat er verbeterd moet worden.
					if($CheckOnErrors == true) 
					{
					require('./views/WijzigenBedrijfForm.php');
					}
					else
					{
						if (!file_exists('images/bedrijf_images/'.$bedrijfs_id)) {
						mkdir('images/bedrijf_images/'.$bedrijfs_id, 0777, true);
						}
						$target_dir = "images/bedrijf_images/".$bedrijfs_id."/";
						$target_file = $target_dir . basename($_FILES["foto"]["name"]);
						if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)){} 
						$target_file = $target_dir . basename($_FILES["banner"]["name"]);
						if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)){} 
						$target_file = $target_dir . basename($_FILES["logo"]["name"]);
						if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)){}
						//De gegevens die uit het formulier komen en die correct zijn worden in de array parameters gezet
						
						$parameters = array(
						':bedrijfs_id'=>$bedrijfs_id,
						':bedrijfsnaam'=>$bedrijfs_naam,
						':beschrijving'=>$beschrijving,
						':adres'=>$adres,
						':postcode'=>$postcode,
						':plaats'=>$plaats,
						':provincie'=>$provincie,
						':website'=>$website,
						':telefoon'=>$telefoon,
						':fax'=>$fax,
						':specialiteit'=>$special,
						':specialiteitnaam'=>$specialname,
						':transport_manager'=>$transport_manager,
						':aantal'=>$aantal,
						':rechtsvorm'=>$rechtsvorm,
						':vergunning'=>$vergunning,
						':bedrijfs_email'=>$bedrijfs_email,
						':premium'=>$premium,
						':Facebook'=>$Facebook,
						':Twitter'=>$Twitter,
						':Google'=>$Google,
						':LinkedIn'=>$LinkedIn,
						':Instagram'=>$Instagram,
						':Pinterest'=>$Pinterest,
						':foto'=>$foto,
						':banner'=>$banner,
						':logo'=>$logo,
						':openingstijden'=>$openingstijden);
						
						//de SQL query om de gegevens in de database te veranderen.
						
						$sth = $pdo->prepare('UPDATE bedrijfgegevens SET bedrijfsnaam=:bedrijfsnaam, beschrijving=:beschrijving,   adres=:adres, postcode=:postcode, plaats=:plaats, provincie=:provincie, website=:website, telefoon=:telefoon,  fax=:fax, specialiteit=:specialiteit, specialiteit=:specialiteit, specialiteitnaam=:specialiteitnaam,  transport_manager=:transport_manager, aantal=:aantal, rechtsvorm=:rechtsvorm, vergunning=:vergunning, bedrijfs_email=:bedrijfs_email, premium=:premium, Facebook=:Facebook, Twitter=:Twitter, Google=:Google, LinkedIn=:LinkedIn, Instagram=:Instagram, Pinterest=:Pinterest, afbeelding=:foto, logo=:logo, banner=:banner, openingstijden=:openingstijden WHERE bedrijfs_id = :bedrijfs_id');
						//De variabele parameters wordt uitgevoerd
						$sth->execute($parameters);
						
						
						
						echo $specialiteit_1;
						
						$parameters = array(
						':bedrijfs_id'=>$bedrijfs_id,':specialiteit_1'=>$specialiteit_1,':specialiteit_2'=>$specialiteit_2,':specialiteit_3'=>$specialiteit_3,':specialiteit_4'=>$specialiteit_4,':specialiteit_5'=>$specialiteit_5,':specialiteit_6'=>$specialiteit_6,':specialiteit_7'=>$specialiteit_7,':specialiteit_8'=>$specialiteit_8,':specialiteit_9'=>$specialiteit_9,':specialiteit_10'=>$specialiteit_10,':specialiteit_11'=>$specialiteit_11,':specialiteit_12'=>$specialiteit_12,':specialiteit_13'=>$specialiteit_13,':specialiteit_14'=>$specialiteit_14,':specialiteit_15'=>$specialiteit_15,':specialiteit_16'=>$specialiteit_16,':specialiteit_17'=>$specialiteit_17,':specialiteit_18'=>$specialiteit_18,':specialiteit_19'=>$specialiteit_19,':specialiteit_20'=>$specialiteit_20);
						
						$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET 
						specialiteit_1=:specialiteit_1, specialiteit_2=:specialiteit_2, specialiteit_3=:specialiteit_3, specialiteit_4=:specialiteit_4, specialiteit_5=:specialiteit_5, specialiteit_6=:specialiteit_6, specialiteit_7=:specialiteit_7, specialiteit_8=:specialiteit_8, specialiteit_9=:specialiteit_9, specialiteit_10=:specialiteit_10, specialiteit_11=:specialiteit_11, specialiteit_12=:specialiteit_12, specialiteit_13=:specialiteit_13, specialiteit_14=:specialiteit_14, specialiteit_15=:specialiteit_15, specialiteit_16=:specialiteit_16, specialiteit_17=:specialiteit_17, specialiteit_18=:specialiteit_18, specialiteit_19=:specialiteit_19, specialiteit_20=:specialiteit_20 WHERE bedrijfs_id = :bedrijfs_id');
						$sth->execute($parameters);
						
						if($openingstijden == 'ja' && $openingstijden != 'nee' )
						{
							$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
							$sth = $pdo->prepare('SELECT bedrijfs_id FROM openingstijden WHERE bedrijfs_id = :bedrijfs_id');
							$sth->execute($parameters);
							$row = $sth->fetch();
							
							if($row['bedrijfs_id'] == NULL || $row['bedrijfs_id'] == '' )
							{
								$parameters = array(':bedrijfs_id'=>$bedrijfs_id,
													':maandag'=>$otmaandag,
													':dinsdag'=>$otdinsdag,
													':woensdag'=>$otwoensdag,
													':donderdag'=>$otdonderdag,
													':vrijdag'=>$otvrijdag,
													':zaterdag'=>$otzaterdag,
													':zondag'=>$otzondag);
								$sth = $pdo->prepare('INSERT INTO openingstijden (bedrijfs_id, maandag, dinsdag, woensdag, donderdag, vrijdag, zaterdag, zondag) VALUES (:bedrijfs_id, :maandag, :dinsdag, :woensdag, :donderdag, :vrijdag, :zaterdag, :zondag)');
								$sth->execute($parameters);	
							}
							else
							{
								$parameters = array(':bedrijfs_id'=>$bedrijfs_id,
													':maandag'=>$otmaandag,
													':dinsdag'=>$otdinsdag,
													':woensdag'=>$otwoensdag,
													':donderdag'=>$otdonderdag,
													':vrijdag'=>$otvrijdag,
													':zaterdag'=>$otzaterdag,
													':zondag'=>$otzondag);
								$sth = $pdo->prepare('UPDATE openingstijden SET maandag=:maandag, dinsdag=:dinsdag, woensdag=:woensdag, donderdag=:donderdag, vrijdag=:vrijdag, zaterdag=:zaterdag, zondag=:zondag WHERE bedrijfs_id = :bedrijfs_id ');
								$sth->execute($parameters);
							}
						}
						
						echo'De gegvens van '. $bedrijfs_naam.' zijn bijgewerkt.<br />';
						echo '<META http-equiv="refresh" content="5;URL=wijzigen.php?action=edit&bedrijfs_id='.$bedrijfs_id.'">';
					}
				}
				else
				{
					
					
					$_SESSION['logo'] = $row['logo'];
					$_SESSION['foto'] = $row['afbeelding'];
					$_SESSION['banner'] = $row['banner'];
					//laat het formulier WijzigenBedrijfForm zien als de knop wijzigenbedrijf nog niet is ingedurkt.
					require('./views/WijzigenBedrijfForm.php');
				}
				break;
			case'del':
					
					//SQL query om de gegevens van het juiste bedrijf uit de database halen
					$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
					$sth = $pdo->prepare('select * from bedrijfgegevens where bedrijfs_id = :bedrijfs_id');
					$sth->execute($parameters);
					$row = $sth->fetch();
					$bedrijfsnaam = $row['bedrijfsnaam'];
					
					if(isset($_POST['verwijderen']))
					{
						$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
						$sth = $pdo->prepare('delete from bedrijfgegevens where bedrijfs_id = :bedrijfs_id');
						$sth->execute($parameters);
						echo $bedrijfsnaam.' is verwijderd';
						RedirectNaarPagina(4);
					}
					elseif(isset($_POST['annuleren']))
					{
						header("Refresh: ;URL=index.php?paginanr=4");
					}
					else
					{
					echo'<form action="" method="post">';
					echo'<label>Weet u het zeker of u '.$row['bedrijfsnaam'].' wilt verwijderen</label><br />';
					echo'<button type="submit" class="btn btn-default" name="verwijderen">Verwijderen</button>';
					echo'<button type="submit" class="btn btn-default" name="annuleren">Annuleren</button>';
					echo'</form>';
					}
				break;
		}
	}
	else
	{
	require('./views/AanpassenTabel.php');
	}

}
else
{
	echo'U moet ingelogd zijn om deze pagina te kunnen gebruiken.';
}

require('./controllers/footer.php');
?>
