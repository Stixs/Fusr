<div id="geo" class="geolocation_data"></div>
<script type="text/JavaScript" src="./geolocation/geo.js"></script>
<?php

require('./controllers/header.php');

$trefwoord = null;

if(isset($_POST['Zoek']))
{
	unset($_GET);
	unset($_SESSION['trefwoord']);
}
if(isset($_GET['nr']))
{
$nr = $_GET['nr']; 
$start = $nr * 50;
$lat = $_SESSION['lat'];
$lon = $_SESSION['lon'];
$trefwoord = $_SESSION['trefwoord'];
$afstand = $_SESSION['afstand'];
$_POST['Zoek'] = 1;
$range = 50;
}
else
{
$start = 0;
$range = 50;
$_GET['nr'] = 0;
	if(isset($_POST['afstand'])){
	$afstand = $_POST['afstand'];}

	if(isset($_POST['trefwoord'])){
	$trefwoord = $_POST['trefwoord'];}
}


if(isset($_POST['Zoek']))
{
	$city = NULL;
	$checkcity = NULL;
	if (!isset($_SESSION['trefwoord'])){
	$trefwoord = NULL;}

	
	if(isset($_POST['trefwoord']))
	{
	$trefwoord = $_POST['trefwoord'];
			
	}		
	$sth = $pdo->prepare('SELECT DISTINCT plaats FROM bedrijfgegevens WHERE MATCH (plaats) AGAINST ("'.$trefwoord.'" IN BOOLEAN MODE)');
	$sth->execute();
	$row = $sth->fetch(PDO::FETCH_ASSOC);
	$city = $row['plaats'];
	
	if( ! $row)
	{
	if(!empty($_SESSION['lat'])){$lat = $_SESSION['lat'];}
	if(!empty($_SESSION['lon'])){$lon = $_SESSION['lon'];}
	}
	else
	{	
	$url = 'https://api.pro6pp.nl/v1/suggest?auth_key=9mPiDJVEjKZliA8I&per_page=1&nl_city='.$city.'&format=json';

	$response = file_get_contents($url);
 
	$json = json_decode($response,TRUE); 
 
	$city = $json['results'][0]['lat'].",".$json['results'][0]['lng'];
	

	
	$coords = (explode(",",$city));
	$lat = $coords[0];
	$lon = $coords[1];
	$_SESSION['lat'] = $lat;
	$_SESSION['lon'] = $lon;
	echo 'test2';
	}	
}


?>


<form id="opnaam" method="post" action="gids.php">

	<div class="zoeken">
		<div class="row">
			
			<div class="col-sm-12 col-md-12 filter2">
				<div class="col-xs-9 col-sm-9 col-md-6">
					<input class="form-control" type="text" name="trefwoord" placeholder="Trefwoord" autofocus size="20" value="<?php echo $trefwoord; ?>" >
				</div>
				<div class="col-xs-3 col-sm-3 col-md-2">
				<select class="form-control search-select col-xs-12 col-sm-4" id="sel1" name="afstand">
					
					<option value="1000">Alle afstanden</option>
					<option value="3">< 3 km</option>
					<option value="5">< 5 km</option>
					<option value="10">< 10 km</option>
					<option value="15">< 15 km</option>
					<option value="25">< 25 km</option>
					<option value="50">< 50 km</option>
					<option value="75">< 75 km</option>
					<option value="100">< 100 km</option>
					<option value="150">< 150 km</option>
					
	
				</select>		
			</div>
				<div class=" col-xs-6 col-sm-6 col-md-2 xs-pull-right">
					<button class="btn btn-default col-xs-12 " type="submit" name="Zoek" value="Zoek">Zoek</button>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-2 xs-pull-left">
					<a class="btn btn-default col-xs-6 col-sm-12" href="?paginanr=3">Reset</a>
				</div>
			</div>
		</div>
	</div>
</form>
 
<?php

if(isset($_POST['Zoek']))
{

	//De zoek query
	$search = NULL;
	if(!empty($trefwoord))
		{
		$trefwoorden = (explode(" ",$trefwoord));
		//var_dump($trefwoorden);
		
		foreach ($trefwoorden as $value2)
			{	
				if(!empty($value2))
				{
					$search.= ''.$value2.'* ';
				}
			}
		}
	
	if(!isset($lat) and !isset($lon) and $search != '')
	{
		$sth = $pdo->prepare('
		SELECT
		bedrijfgegevens.bedrijfsnaam,
		bedrijfgegevens.provincie,
		bedrijfgegevens.postcode,
		bedrijfgegevens.plaats,
		bedrijfgegevens.branche,
		bedrijfgegevens.premium,
		bedrijfgegevens.telefoon,
		bedrijfgegevens.logo,
		bedrijfs_specialiteiten.*
	FROM 
		bedrijfgegevens
	INNER JOIN
		bedrijfs_specialiteiten on bedrijfgegevens.bedrijfs_id = bedrijfs_specialiteiten.bedrijfs_id 
	WHERE 
		MATCH (bedrijfgegevens.bedrijfsnaam, bedrijfgegevens.postcode, bedrijfgegevens.plaats, bedrijfgegevens.provincie, bedrijfgegevens.branche)
		AGAINST ("'.$search.'" IN BOOLEAN MODE) 
		OR MATCH (bedrijfs_specialiteiten.specialiteit_1)
		AGAINST ("'.$search.'" IN BOOLEAN MODE)
		LIMIT '.$start.','.$range
		);	
	}
	
	elseif(isset($lat) and isset($lon) and $search == '')
	{
		
		
		$sth = $pdo->prepare('
		SELECT
		bedrijfgegevens.bedrijfsnaam,
		bedrijfgegevens.provincie,
		bedrijfgegevens.postcode,
		bedrijfgegevens.plaats,
		bedrijfgegevens.branche,
		bedrijfgegevens.premium,
		bedrijfgegevens.telefoon,
		bedrijfgegevens.logo,
		(6371
		* acos(cos(radians('.$lat.'))
		* cos(radians(latitude))
		* cos(radians(longitude)
		- radians('.$lon.'))
		+ sin(radians('.$lat.'))
		* sin(radians(latitude))) 
		) AS distance,
		bedrijfs_specialiteiten.*
	FROM 
		bedrijfgegevens
	INNER JOIN
		bedrijfs_specialiteiten on bedrijfgegevens.bedrijfs_id = bedrijfs_specialiteiten.bedrijfs_id 
		HAVING distance < '.$afstand.'
		ORDER BY distance ASC
		LIMIT '.$start.','.$range
		);
	}
	
	elseif(isset($lat) and isset($lon) and $search != '')
	{
		$sth = $pdo->prepare('
		SELECT
		bedrijfgegevens.bedrijfsnaam,
		bedrijfgegevens.provincie,
		bedrijfgegevens.postcode,
		bedrijfgegevens.plaats,
		bedrijfgegevens.branche,
		bedrijfgegevens.premium,
		bedrijfgegevens.telefoon,
		bedrijfgegevens.logo,
		(6371
		* acos(cos(radians('.$lat.'))
		* cos(radians(latitude))
		* cos(radians(longitude)
		- radians('.$lon.'))
		+ sin(radians('.$lat.'))
		* sin(radians(latitude))) 
		) AS distance,
		bedrijfs_specialiteiten.*
	FROM 
		bedrijfgegevens
	INNER JOIN
		bedrijfs_specialiteiten on bedrijfgegevens.bedrijfs_id = bedrijfs_specialiteiten.bedrijfs_id 
	WHERE 
		MATCH (bedrijfgegevens.bedrijfsnaam, bedrijfgegevens.postcode, bedrijfgegevens.plaats, bedrijfgegevens.provincie, bedrijfgegevens.branche)
		AGAINST ("'.$search.'" IN BOOLEAN MODE) 
		OR MATCH (bedrijfs_specialiteiten.specialiteit_1)
		AGAINST ("'.$search.'" IN BOOLEAN MODE) 
		HAVING distance < '.$afstand.'
		ORDER BY distance ASC
		LIMIT '.$start.','.$range
		);
	}
	
	else
	{
		$sth = $pdo->prepare('SELECT * FROM bedrijfgegevens ORDER BY premium DESC LIMIT '.$start.','.$range);
	
	}
	$sth->execute();

if(isset($row['distance']))
{
$_SESSION['lat'] = $lat;
$_SESSION['lon'] = $lon;
}
$_SESSION['trefwoord'] = $trefwoord;
$_SESSION['afstand'] = $afstand;



	echo '<div class="row search-result">';
		echo '<div class="col-xs-12">';
			$rows = 0;
			while($row = $sth->fetch())
			{
				$rows++;
				if($row['premium'] == 'gold')
				{
					echo '<a class="greylink" href="bedrijven.php?paginanr=6&bedrijfs_id='.$row['bedrijfs_id'].'">';
				?>
					<div class="search-container">
						<div class="search-image">
							<img src="images/bedrijf_images/<?php echo $row['bedrijfs_id'].'/'.$row['logo']; ?>" />
						</div>
						<span class="glyphicon glyphicon-search premium"></span>
						<div class="search-naam">
							<?php echo $row['bedrijfsnaam']. '<br/>' .$row['telefoon']. '<br/>';
							if(isset($row['distance']))
							{
							$round = round($row['distance'], 1);
							echo number_format($round,1,",",".");
							}
							?>
						</div>
					</div>
				<?php
				echo '</a>';
				}
				elseif($row['premium'] == 'brons')
				{
				
				?>
					<div class="search-container">
						<div class="search-image">
						
							<span class="glyphicon glyphicon-search no-premium"></span>
							<img src="images/truck.jpg">
						</div>
						<div class="search-naam">
							<<?php echo $row['bedrijfsnaam']. '<br/>' .$row['telefoon']. '<br/>';
							if(isset($row['distance']))
							{
							$round = round($row['distance'], 1);
							echo number_format($round,1,",",".");
							}
							?>
						</div>
					</div>
				<?php
				}
				else
				{
				?>
					<div class="search-container">
						<div class="search-image">
						
							<span class="glyphicon glyphicon-search no-premium"></span>
							<img src="images/truck.jpg">
						</div>
						<div class="search-naam">
							<?php echo $row['bedrijfsnaam'].'<br/>';
							if(isset($row['distance']))
							{
							$round = round($row['distance'], 1);
							echo number_format($round,1,",",".");
							}
							?>
							km
						</div>
					</div>
				<?php
				}
				 
			}
			
		echo '</div>';
		echo '<div class="col-xs-12">';
			if($_GET['nr'] == 0)
				{
					$nr1 = $_GET['nr'] - 1; 
					echo '<a href="gids.php?nr='.$nr1.'" class="btn btn-default gids-btn-nav disabled">Terug</a>';
					
				}
				else
				{
					$nr1 = $_GET['nr'] - 1; 
					echo '<a href="gids.php?nr='.$nr1.'" class="btn btn-default gids-btn-nav">Terug</a>';
				}
			if($rows < 50)
				{
					$nr2 = $_GET['nr'] + 1; 
					echo '<a href="gids.php?nr='.$nr2.'" class="btn btn-default gids-btn-nav disabled">Volgende</a>';
				}
			else
				{
					$nr2 = $_GET['nr'] + 1; 
					echo '<a href="gids.php?nr='.$nr2.'" class="btn btn-default gids-btn-nav">Volgende</a>';
				}
		echo '</div>';
	echo '</div>';
}
require('./controllers/footer.php');
?>
<script>
analytics.js: ga('send', 'pageview', '/gids.php?q=$trefwoord'); 
</script>