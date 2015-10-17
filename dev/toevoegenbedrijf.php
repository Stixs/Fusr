<?php
require('./controllers/header.php');

//Controleert of je wel bent ingelogd.
if(LoginCheck($pdo))
{
	//init fields
$specialiteit_1 = $specialiteit_2 = $specialiteit_3 = $specialiteit_4 = $specialiteit_5 = $specialiteit_6 = $specialiteit_7 = $specialiteit_8 = $specialiteit_9 = $specialiteit_10 = $specialiteit_11 = $specialiteit_12 = $specialiteit_13 = $specialiteit_14 = $specialiteit_15 = $specialiteit_16 = $specialiteit_17 = $specialiteit_18 = $specialiteit_19 = $specialiteit_20 = $bedrijfs_naam = $beschrijving = $adres = $postcode = $plaats = $provincie = $telefoon = $fax = $bedrijfs_email = $specialiteit = $type = $bereik = $transport_manager = $aantal = $rechtsvorm = $vergunning = $geldigtot = $website = $premium = $Picture = $o_maandag = $o_dinsdag = $o_woensdag = $o_donderdag = $o_vrijdag = $o_zaterdag = $o_zondag = $d_maandag = $d_dinsdag = $d_woensdag = $d_donderdag = $d_vrijdag = $d_zaterdag = $d_zondag = $Facebook = $Twitter = $Google = $LinkedIn = $Instagram = $Pinterest = $branche = NULL;
$branche_id = $_GET['branche'];
	//init error fields
	$NameErr = $ZipErr = $CityErr = $TelErr = $MailErr = $OpeningsErr = NULL;
	if(isset($_POST['add_spec']) or isset($_POST['Registrerenbedrijf']))
	{
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
	
	$foto = basename($_FILES["foto"]["name"]);
	$banner = basename($_FILES["banner"]["name"]);
	$logo = basename($_FILES["logo"]["name"]);
	
	$Facebook = $_POST['Facebook'];
	$Twitter = $_POST['Twitter'];
	$Google = $_POST['Google'];
	$LinkedIn = $_POST['LinkedIn'];
	$Instagram = $_POST['Instagram'];
	$Pinterest = $_POST['Pinterest'];
	
	$o_maandag = $_POST['o_maandag'];
	$o_dinsdag = $_POST['o_dinsdag'];
	$o_woensdag = $_POST['o_woensdag'];
	$o_donderdag = $_POST['o_donderdag'];
	$o_vrijdag = $_POST['o_vrijdag']; 
	$o_zaterdag = $_POST['o_zaterdag'];
	$o_zondag = $_POST['o_zondag'];
	$d_maandag = $_POST['d_maandag'];
	$d_dinsdag = $_POST['d_dinsdag'];
	$d_woensdag = $_POST['d_woensdag'];
	$d_donderdag = $_POST['d_donderdag'];
	$d_vrijdag = $_POST['d_vrijdag']; 
	$d_zaterdag = $_POST['d_zaterdag'];
	$d_zondag = $_POST['d_zondag'];
	}
	$Specialiteiten = specialiteitenlijst($pdo);
	if(isset($_POST['add_spec']) AND !empty($_POST['add_specialiteit']))
		{
		$N = 0;
		$X = 1;
		foreach($specialiteit as $value) 
			{	
				${'specialiteit_'.$X} = $value;
				$N++;
				$X++;
			}
			
	$add_specialiteit = $_POST['add_specialiteit'];
	$parameters = array(':add_specialiteit'=>$add_specialiteit);
	$sth = $pdo->prepare('INSERT INTO specialiteiten (specialiteit)VALUES(:add_specialiteit)');
	$sth->execute($parameters);
	}
	
	
	if(isset($_POST['Registrerenbedrijf']))
	{
		$CheckOnErrors = false;
		
		$special = NULL;
		$specialZ = "'";
		$specialname = NULL;
		
		$N = 0;
		$X = 1;
		foreach($specialiteit as $value) 
		{
			
			${'specialiteit_'.$X} = $value;
			$N++;
			$X++;
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
			
			
		
		
			
			$parameters = array(
				':bedrijfsnaam'=>$bedrijfs_naam,
				':beschrijving'=>$beschrijving,
				':adres'=>$adres,
				':postcode'=>$postcode,
				':plaats'=>$plaats,
				':provincie'=>$provincie,
				':website'=>$website,
				':telefoon'=>$telefoon,
				':fax'=>$fax,
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
				':branche_id'=>$branche_id);
								
				$sth = $pdo->prepare('INSERT INTO bedrijfgegevens (bedrijfsnaam, beschrijving, adres, postcode, plaats, provincie, website, telefoon, fax, transport_manager, aantal, rechtsvorm, vergunning, bedrijfs_email, premium, Facebook, Twitter, Google, LinkedIn, Instagram, Pinterest, afbeelding, banner, logo, branche_id) VALUES( :bedrijfsnaam, :beschrijving, :adres, :postcode, :plaats, :provincie, :website, :telefoon, :fax, :transport_manager, :aantal, :rechtsvorm, :vergunning, :bedrijfs_email, :premium, :Facebook, :Twitter, :Google, :LinkedIn, :Instagram, :Pinterest, :foto, :banner, :logo, :branche_id)');
				$sth->execute($parameters);
				
				$bedrijfs_id = $pdo->lastInsertId();
				$N = 0;
					foreach($specialiteit as $value) 
					{
						$N++;
						${'specialiteit_'.$N} = $value;
					}
				
				$parameters = array(
				':bedrijfs_id'=>$bedrijfs_id,':specialiteit_1'=>$specialiteit_1,':specialiteit_2'=>$specialiteit_2,':specialiteit_3'=>$specialiteit_3,':specialiteit_4'=>$specialiteit_4,':specialiteit_5'=>$specialiteit_5,':specialiteit_6'=>$specialiteit_6,':specialiteit_7'=>$specialiteit_7,':specialiteit_8'=>$specialiteit_8,':specialiteit_9'=>$specialiteit_9,':specialiteit_10'=>$specialiteit_10,':specialiteit_11'=>$specialiteit_11,':specialiteit_12'=>$specialiteit_12,':specialiteit_13'=>$specialiteit_13,':specialiteit_14'=>$specialiteit_14,':specialiteit_15'=>$specialiteit_15,':specialiteit_16'=>$specialiteit_16,':specialiteit_17'=>$specialiteit_17,':specialiteit_18'=>$specialiteit_18,':specialiteit_19'=>$specialiteit_19,':specialiteit_20'=>$specialiteit_20);
				
				$sth = $pdo->prepare('INSERT INTO bedrijfs_specialiteiten (bedrijfs_id, specialiteit_1, specialiteit_2, specialiteit_3, specialiteit_4, specialiteit_5, specialiteit_6, specialiteit_7, specialiteit_8, specialiteit_9, specialiteit_10, specialiteit_11, specialiteit_12, specialiteit_13, specialiteit_14, specialiteit_15, specialiteit_16, specialiteit_17, specialiteit_18, specialiteit_19, specialiteit_20) VALUES (:bedrijfs_id, :specialiteit_1, :specialiteit_2, :specialiteit_3, :specialiteit_4, :specialiteit_5, :specialiteit_6, :specialiteit_7, :specialiteit_8, :specialiteit_9, :specialiteit_10, :specialiteit_11, :specialiteit_12, :specialiteit_13, :specialiteit_14, :specialiteit_15, :specialiteit_16, :specialiteit_17, :specialiteit_18, :specialiteit_19, :specialiteit_20)');
				$sth->execute($parameters);
					
				
				$parameters = array(
						':bedrijfs_id'=>$bedrijfs_id,
						':o_maandag'=>$o_maandag,
						':o_dinsdag'=>$o_dinsdag,
						':o_woensdag'=>$o_woensdag,
						':o_donderdag'=>$o_donderdag,
						':o_vrijdag'=>$o_vrijdag,
						':o_zaterdag'=>$o_zaterdag,
						':o_zondag'=>$o_zondag,
						':d_maandag'=>$d_maandag,
						':d_dinsdag'=>$d_dinsdag,
						':d_woensdag'=>$d_woensdag,
						':d_donderdag'=>$d_donderdag,
						':d_vrijdag'=>$d_vrijdag,
						':d_zaterdag'=>$d_zaterdag,
						':d_zondag'=>$d_zondag);
				$sth = $pdo->prepare('INSERT INTO openingstijden (bedrijfs_id, o_maandag, o_dinsdag, o_woensdag, o_donderdag, o_vrijdag, o_zaterdag, o_zondag, d_maandag, d_dinsdag, d_woensdag, d_donderdag, d_vrijdag, d_zaterdag, d_zondag) VALUES (:bedrijfs_id, :o_maandag, :o_dinsdag, :o_woensdag, :o_donderdag, :o_vrijdag, :o_zaterdag, :o_zondag, :d_maandag, :d_dinsdag, :d_woensdag, :d_donderdag, :d_vrijdag , :d_zaterdag, :d_zondag)');
				$sth->execute($parameters);
			echo'De bedrijf gegevens zijn geregistreerd.<br />';
			//echo '<META http-equiv="refresh" content="5;URL=index.php">';
			
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
