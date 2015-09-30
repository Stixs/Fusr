<?php
require('./controllers/header.php');


//Controleert of je wel bent ingelogd.
if(LoginCheck($pdo))
{
	
	//init fields
	$bedrijfs_naam = $beschrijving = $adres = $postcode = $plaats = $provincie = $telefoon = $fax = $bedrijfs_email = $specialiteit = $type = $bereik = $transport_manager = $aantal = $rechtsvorm = $vergunning = $geldig_tot = $website = $branche_id = NULL;

	//init error fields
	$NameErr = $ZipErr = $CityErr = $TelErr = $MailErr = NULL;

	$Specialiteiten = specialiteitenlijst($pdo);
	$Branches = branchelijst($pdo);

	
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
					$specialiteit = $row['specialiteit'];
					$type = $row['type'];
					$bereik = $row['bereik'];
					$transport_manager = $row['transport_manager'];
					$aantal = $row['aantal'];
					$rechtsvorm = $row['rechtsvorm'];
					$vergunning = $row['vergunning'];
					$geldigtot = $row['geldig_tot'];
					$bedrijfs_email = $row['bedrijfs_email'];
					$premium = $row['premium'];
					
					
					$specialarr = (explode(", ",$specialiteit));
					if(!isset($specialarr[0]))
						{$specialarr[0] = NULL;}
					if(!isset($specialarr[1]))
						{$specialarr[1] = NULL;}
					if(!isset($specialarr[2]))
						{$specialarr[2] = NULL;}
					if(!isset($specialarr[3]))
						{$specialarr[3] = NULL;}
					if(!isset($specialarr[4]))
						{$specialarr[4] = NULL;}
					if(!isset($specialarr[5]))
						{$specialarr[5] = NULL;}
					
					
					
					//controleert of de submit knop wijzigenbedrijf in het formulier is ingedurkt.
					if(isset($_POST['Del_Image']))
					{
					$image = $_POST['Del_Image'];
					$leeg = "0";
					
					$parameter = array(':leeg'=>$leeg, ':bedrijfs_id'=>$bedrijfs_id);
					$sth = $pdo->prepare('UPDATE bedrijfgegevens SET '.$image.'=:leeg WHERE bedrijfs_id = :bedrijfs_id');
					$sth->execute($parameter);
					
					unlink('images/bedrijf_images/'.$bedrijfs_id .'/'. $row[$image]);
					header("Refresh: ;URL=wijzigen.php?action=edit&bedrijfs_id=".$bedrijfs_id);
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
					$type = $_POST['type'];
					$bereik = $_POST['bereik'];
					$transport_manager = $_POST['transport_manager'];
					$aantal = $_POST['aantal'];
					$rechtsvorm = $_POST['rechtsvorm'];
					$vergunning = $_POST['vergunning'];
					$geldigtot = $_POST['geldigtot'];
					$bedrijfs_email = $_POST['bedrijfs_email'];
					$beschrijving = $_POST['beschrijving'];
					$premium = $_POST['premium'];
					
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
					
					
					
					foreach($specialiteit as $value) 
					{
						if(!next($specialiteit)) 
						{
							$special.= $value;
							$specialZ.= "[[:<:]]".$value."[[:>:]]'";
						}
						else
						{
							$special.= $value.', ';
							$specialZ.= "[[:<:]]".$value."[[:>:]]|";
						}
					}
					
					$sth = $pdo->prepare('SELECT * FROM specialiteiten WHERE specialiteit_id REGEXP '.$specialZ);
					$sth->execute($parameters);
					while($row = $sth->fetch())
					{
						$specialname.= $row['specialiteit'].', ';
					}
					
					$specialname = substr($specialname, 0, -2);
					
					
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
						$parameters = array(':bedrijfs_id'=>$bedrijfs_id,
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
											':type'=>$type,
											':bereik'=>$bereik,
											':transport_manager'=>$transport_manager,
											':aantal'=>$aantal,
											':rechtsvorm'=>$rechtsvorm,
											':vergunning'=>$vergunning,
											':geldig_tot'=>$geldigtot,
											':bedrijfs_email'=>$bedrijfs_email,
											':premium'=>$premium,
											':foto'=>$foto,
											':banner'=>$banner,
											':logo'=>$logo);
						//de SQL query om de gegevens in de database te veranderen.
						$sth = $pdo->prepare('UPDATE bedrijfgegevens 
											  SET bedrijfsnaam=:bedrijfsnaam,
												  beschrijving=:beschrijving,
												  adres=:adres,
												  postcode=:postcode,
												  plaats=:plaats,
												  provincie=:provincie,
												  website=:website,
												  telefoon=:telefoon,
												  fax=:fax,
												  specialiteit=:specialiteit,
												  specialiteitnaam=:specialiteitnaam,
												  type=:type,
												  bereik=:bereik,
												  transport_manager=:transport_manager,
												  aantal=:aantal,
												  rechtsvorm=:rechtsvorm,
												  vergunning=:vergunning,
												  geldig_tot=:geldig_tot,
												  bedrijfs_email=:bedrijfs_email,
												  premium=:premium,
												  afbeelding=:foto,
												  logo=:logo,
												  banner=:banner
												  WHERE bedrijfs_id = :bedrijfs_id');
						//De variabele parameters wordt uitgevoerd
						$sth->execute($parameters);
						
						echo'De gegvens van '. $bedrijfs_naam.' zijn bijgewerkt.<br />';
						?> <script> location.replace("wijzigen.php"); </script> <?php
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
