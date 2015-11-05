<?php
require('./controllers/header.php');

var_dump($pdo);

//Controleert of je wel bent ingelogd.
if(LoginCheck($pdo))
{
	//init fields
$bedrijfsnaam = $beschrijving = $adres = $toevoeging = $postcode = $plaats = $telefoonnummer = $mobielnummer = $email = $website = $premium = $Picture = $facebook = $twitter = $googleplus = $linkedin = $youtube = $pinterest = $branche = NULL;
	$subbranche_id = $_GET['branche'];
	if(!empty($_POST['branche'])){$subbranche_id = $_POST['branche'];}
	
	for ($x = 0; $x <= 19; $x++){
	$specialiteiten[$x] = null;
	}
	
	//init error fields
	$NameErr = $ZipErr = $CityErr = $TelErr = $MailErr = $OpeningsErr = NULL;
	
	if(empty($_POST['add_spec']) and empty($_POST['Registrerenbedrijf']) and !empty($_POST['branche']))
	{
	$facebook = $_POST['facebook'];
	$twitter = $_POST['twitter'];
	$googleplus = $_POST['googleplus'];
	$linkedin = $_POST['linkedin'];
	$youtube = $_POST['youtube'];
	$pinterest = $_POST['pinterest'];
	$adres = $_POST['adres'];
	$toevoeging = $_POST['toevoeging'];
	$premium = $_POST['premium'];
	$bedrijfsnaam = $_POST["bedrijfsnaam"];
	$beschrijving = $_POST['beschrijving'];
	$postcode = $_POST["postcode"];
	$plaats = $_POST['plaats'];
	$website = $_POST['website'];
	$telefoonnummer = $_POST['telefoonnummer'];
	$mobielnummer = $_POST['mobielnummer'];
	$email = $_POST['email'];
	$specialiteiten = $_POST['specialiteit'];
	}
	
	
	if(isset($_POST['add_spec']) or isset($_POST['Registrerenbedrijf']))
	{
	$bedrijfsnaam = $_POST["bedrijfsnaam"];
	$beschrijving = $_POST['beschrijving'];
	$postcode = $_POST["postcode"];
	$plaats = $_POST['plaats'];
	$website = $_POST['website'];
	$telefoonnummer = $_POST['telefoonnummer'];
	$mobielnummer = $_POST['mobielnummer'];
	$email = $_POST['email'];
	$specialiteiten = $_POST['specialiteit'];
	$premium = $_POST['premium'];
	
	$foto = basename($_FILES["foto"]["name"]);
	$banner = basename($_FILES["banner"]["name"]);
	$logo = basename($_FILES["logo"]["name"]);
	
	$facebook = $_POST['facebook'];
	$twitter = $_POST['twitter'];
	$googleplus = $_POST['googleplus'];
	$linkedin = $_POST['linkedin'];
	$youtube = $_POST['youtube'];
	$pinterest = $_POST['pinterest'];
	
	$adres = $_POST['adres'];
	$toevoeging = $_POST['toevoeging'];
	$bezoekadres = $adres.' '.$toevoeging;


	$huisnummer = preg_replace("/[^0-9,.]/", "", $adres);
	$url = 'https://api.pro6pp.nl/v1/autocomplete?auth_key=9mPiDJVEjKZliA8I&nl_sixpp='.$postcode.'&streetnumber='.$huisnummer . $toevoeging.'&format=json';
	$response = file_get_contents($url);
	$json = json_decode($response,TRUE);
	if(!isset($postcode) or !isset($huisnummer)){}
	else
	{
		$latitude = $json['results'][0]['lat'];
		$longitude = $json['results'][0]['lng'];
	}
	$provincie = $json['results'][0]['province'];
	//var_dump($json);
	
	$plaats = strtoupper($plaats);
	$parameters = array(':plaats'=>$plaats);
	$sth = $pdo->prepare('SELECT plaats FROM plaatsen WHERE plaats = :plaats LIMIT 1');

	$sth->execute($parameters);

	// controleren of de plaats voorkomt in de DB
	if ($sth->rowCount() == 1)
	{
		$parameters = array(':plaats'=>$plaats);
		$sth = $pdo->prepare('SELECT id FROM plaatsen WHERE plaats = :plaats LIMIT 1');
		$sth->execute($parameters);
		$row = $sth->fetch();
		$plaats_id = $row['id'];
	}
	else
	{
	$parameters = array(':plaats'=>$plaats,
						':provincie'=>$provincie
						);
	$sth = $pdo->prepare('INSERT INTO plaatsen (plaats, provincie) VALUES (:plaats, :provincie)');
	$sth->execute($parameters);
	$plaats_id = $pdo->lastInsertId();
	}
	

	
	}
	$Specialiteiten = specialiteitenlijst($pdo);
	if(isset($_POST['add_spec']) AND !empty($_POST['add_specialiteit']))
	{
		
	$add_specialiteit = $_POST['add_specialiteit'];
	$parameters = array(':add_specialiteit'=>$add_specialiteit,
						':branche_id'=>$subbranche_id
						);
	$sth = $pdo->prepare('INSERT INTO specialiteiten (naam, branche_id)VALUES(:add_specialiteit, :branche_id)');
	$sth->execute($parameters);
	
	}
	
	
	if(isset($_POST['Registrerenbedrijf']))
	{
		$CheckOnErrors = false;
		
	

		//begin controlles
		
		//Controleert bedrijs naam
		/*
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
		if(!isset($telefoon))
		{
			$CheckOnErrors = true;
			$TelErr = 'U moet een telefoon nummer invullen.';
		}
		elseif(!is_minlength($telefoon, 10))
		{
			$CheckOnErrors = true;
			$TelErr = 'Dit is geen geldig telefoon nummer.';
		}
		//Controlleert plaats
		if(!isset($plaats))
		{
			$CheckOnErrors = true;
			$CityErr = 'U moet een dorp/stad invullen.';
		}
		*/
		
		if (file_exists($foto) or file_exists($banner) or file_exists($logo)) {
		$CheckOnErrors = true;
		}
		
		if($CheckOnErrors == true) 
		{
		require('./views/ToevoegenBedrijfForm.php');
		}
		else
		{
			
		echo 'Subbranche_id = '.$subbranche_id.'</br>';
		echo 'Bedrijfsnaam = '.$bedrijfsnaam.'</br>';
		echo 'Beschrijving = '.$beschrijving.'</br>';
		echo 'Bezoekadres = '.$bezoekadres.'</br>';
		echo 'Postcode = '.$postcode.'</br>';
		echo 'Plaats_id = '.$plaats_id.'</br>';
		echo 'Telefoonnummer = '.$telefoonnummer.'</br>';
		echo 'Mobielnummer = '.$mobielnummer.'</br>';
		echo 'Website = '.$website.'</br>';
		echo 'Email = '.$email.'</br>';
		echo 'Latitude = '.$latitude.'</br>';
		echo 'Longitude = '.$longitude.'</br>';
		echo 'Facebook = '.$facebook.'</br>';
		echo 'Twitter = '.$twitter.'</br>';
		echo 'LinkedIn = '.$linkedin.'</br>';
		echo 'Pinterest = '.$pinterest.'</br>';
		echo 'GooglePlus = '.$googleplus.'</br>';
		echo 'youtube = '.$youtube.'</br>';
		echo 'premium = '.$premium.'</br>';
		echo 'logo = '.$logo.'</br>';
		echo 'banner = '.$banner.'</br>';
		echo 'foto = '.$foto.'</br>';
		
		echo '</br>';
		
		echo 'Plaats = '.$plaats.'</br>';
		echo 'Provincie = '.$provincie.'</br>';
		
			
		
			$parameters = array(
				':subbranche_id'=>$subbranche_id,
				':bedrijfsnaam'=>$bedrijfsnaam,
				':beschrijving'=>$beschrijving,
				':bezoekadres'=>$bezoekadres,
				':postcode'=>$postcode,
				':plaats_id'=>$plaats_id,
				':telefoonnummer'=>$telefoonnummer,
				':mobielnummer'=>$mobielnummer,
				':website'=>$website,
				':email'=>$email,
				':latitude'=>$latitude,
				':longitude'=>$longitude,
				':facebook'=>$facebook,
				':twitter'=>$twitter,
				':linkedin'=>$linkedin,
				':pinterest'=>$pinterest,
				':googleplus'=>$googleplus,
				':youtube'=>$youtube,
				':premium'=>$premium,
				':logo'=>$logo,
				':banner'=>$banner,
				':foto'=>$foto
				);
								
				$sth = $pdo->prepare('INSERT INTO bedrijfgegevens (subbranche_id, bedrijfsnaam, beschrijving, bezoekadres, postcode, plaats_id, telefoonnummer, mobielnummer, website, email, latitude, longitude, facebook, twitter, linkedin, pinterest, googleplus, youtube, premium, logo, banner, foto) VALUES(:subbranche_id, :bedrijfsnaam, :beschrijving, :bezoekadres, :postcode, :plaats_id, :telefoonnummer, :mobielnummer, :website, :email, :latitude, :longitude, :facebook, :twitter, :linkedin, :pinterest, :googleplus, :youtube, :premium, :logo, :banner, :foto)');
				$sth->execute($parameters);
				$bedrijfgegevens_id = $pdo->lastInsertId();

			
				var_dump($specialiteiten);
				foreach ($specialiteiten as $value)
				{
					if($value != null)
					{
						$parameters = array(':specialiteiten_id'=>$value,
											':bedrijfgegevens_id'=>$bedrijfgegevens_id
											);
						$sth = $pdo->prepare('INSERT INTO bedrijfgegevens_specialiteiten (bedrijfgegevens_id, specialiteiten_id)VALUES(:bedrijfgegevens_id, :specialiteiten_id)');
						$sth->execute($parameters);
					}
				} 
				
			
			
			echo'De bedrijf gegevens zijn geregistreerd.<br />';
			//echo '<META http-equiv="refresh" content="5;URL=index.php">';
			
			if (!file_exists('images/bedrijf_images/'.$bedrijfgegevens_id)) {
			mkdir('images/bedrijf_images/'.$bedrijfgegevens_id, 0777, true);
			}
			$target_dir = "images/bedrijf_images/".$bedrijfgegevens_id."/";
			$target_file = $target_dir . basename($_FILES["foto"]["name"]);
			if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)){} 
			$target_file = $target_dir . basename($_FILES["banner"]["name"]);
			if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)){} 
			$target_file = $target_dir . basename($_FILES["logo"]["name"]);
			if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)){}
			
		}
	}
	else
		
	{
		require('./views/ToevoegenBedrijfForm.php');
	}
}
else
{
	echo'U moet ingelogd zijn om deze pagina te kunnen gebruiken.';
}


require('./controllers/footer.php');
?>
