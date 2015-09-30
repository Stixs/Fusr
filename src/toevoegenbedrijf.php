<?php
require('./controllers/header.php');

//Controleert of je wel bent ingelogd.
if(LoginCheck($pdo))
{
	//init fields
	$bedrijfs_naam = $beschrijving = $adres = $postcode = $plaats = $provincie = $telefoon = $fax = $bedrijfs_email = $specialiteit = $type = $bereik = $transport_manager = $aantal = $rechtsvorm = $vergunning = $geldigtot = $website = $premium = $Picture = NULL;

	//init error fields
	$NameErr = $ZipErr = $CityErr = $TelErr = $MailErr = NULL;
	
	$Specialiteiten = specialiteitenlijst($pdo);
	$Branches = branchelijst($pdo);
	
		if(isset($_POST['Registrerenbedrijf']))
	{
		$CheckOnErrors = false;
		
		$bedrijfs_naam = $_POST["Bedrijfsnaam"];
		$adres = $_POST["adres"];
		$postcode = $_POST["postcode"];
		$plaats = $_POST['plaats'];
		$provincie = $_POST['provincie'];
		$website = $_POST['website'];
		$telefoon = $_POST['telefoon'];
		$fax = $_POST['fax'];
		$specialiteit = $_POST['specialiteit'];
		$br_id = $_POST['branche'];
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
		$foto = basename($_FILES["foto"]["name"]);
		$banner = basename($_FILES["banner"]["name"]);
		$logo = basename($_FILES["logo"]["name"]);
		$special = NULL;
		$specialZ = "'";
		$specialname = NULL;
		
		
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
		$sth->execute();
		while($row = $sth->fetch())
		{
			$specialname.= $row['specialiteit'].', ';
		}
		
		$specialname = substr($specialname, 0, -2);

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
		
		if(empty($foto))
		{
			$foto = 'foto.jpg';
		}
		if(empty($banner))
		{
			$banner = 'banner.png';
		}	
		if(empty($logo))
		{
			$logo = 'logo.png';
		}			
			
			
			$parameters = array(':bedrijfsnaam'=>$bedrijfs_naam,
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
								':logo'=>$logo,
								':branche_id'=>$br_id);
								
			$sth = $pdo->prepare('INSERT INTO bedrijfgegevens (
								bedrijfsnaam, 
								beschrijving, 
								adres, 
								postcode, 
								plaats, 
								provincie, 
								website, 
								telefoon,
								fax,
								specialiteit,
								specialiteitnaam, 
								type, 
								bereik, 
								transport_manager, 
								aantal, 
								rechtsvorm, 
								vergunning, 
								geldig_tot, 
								bedrijfs_email, 
								premium,
								afbeelding,
								banner,
								logo,
								branche_id) 
								VALUES(
								:bedrijfsnaam, 
								:beschrijving, 
								:adres, 
								:postcode, 
								:plaats, 
								:provincie, 
								:website, 
								:telefoon,
								:fax,
								:specialiteit,	
								:specialiteitnaam, 
								:type, 
								:bereik, 
								:transport_manager, 
								:aantal, 
								:rechtsvorm, 
								:vergunning, 
								:geldig_tot, 
								:bedrijfs_email, 
								:premium,
								:foto,
								:banner,
								:logo,
								:branche_id)');
			$sth->execute($parameters);
			
			echo'De bedrijf gegevens zijn geregistreerd.<br />';
			RedirectNaarPagina(5);
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
