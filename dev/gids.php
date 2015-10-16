<div id="geo" class="geolocation_data"></div>
<script type="text/javascript" src="./geolocation/geo.js"></script>

<?php
require('./controllers/header.php');
$distance = 100;

// Pagination
$nummer = 0;

if(isset($_GET['nr'])) {
	$nummer = $_GET['nr'];
}

if($nummer == 0 && !isset($_GET['nr'])) {
	session_unset();
}

$range = 50;
$start = $nummer * $range;

// Check users lat & long
if(isset($_SESSION['lat']) && isset($_SESSION['lon'])) {
	$latitude = $_SESSION['lat'];
	$longitude = $_SESSION['lon'];
} else {
	$latitude = null;
	$longitude = null;
}

// Check if "trefwoord" exists
if(isset($_POST['trefwoord'])) {
	$trefwoord = $_POST['trefwoord'];
	$_SESSION['trefwoord'] = $trefwoord;
} elseif($_SESSION['trefwoord']) {
	$trefwoord = $_SESSION['trefwoord'];
} else {
	$trefwoord = null;
}
?>

<div class="zoeken">
	<div class="row">
		<div class="col-sm-12 col-md-12 filter2">
			<form id="opnaam" method="post" action="gids.php">
				<div class="col-xs-9 col-sm-9 col-md-6">
					<input class="form-control" type="text" name="trefwoord" placeholder="Trefwoord" autofocus size="20" value="<?php echo $trefwoord; ?>" />
				</div>

				<div class="col-xs-6 col-sm-6 col-md-2 xs-pull-right">
					<button class="btn btn-default col-xs-12" type="submit" name="Zoek" value="Zoek">Zoek</button>
				</div>

				<div class="col-xs-6 col-sm-6 col-md-2 xs-pull-left">
					<a class="btn btn-default col-xs-6 col-sm-12" href="?nr=0">Reset</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['nr'])) {
	$select = "SELECT
				bedrijfgegevens.id,
				bedrijfgegevens.bedrijfsnaam,
				bedrijfgegevens.telefoonnummer,
				bedrijfgegevens.mobielnummer,
				bedrijfgegevens.premium,
				bedrijfgegevens.logo";

	if(isset($latitude) && isset($longitude)) {
		$select .= ", (6371
					* acos(cos(radians(" . $latitude . "))
					* cos(radians(bedrijfgegevens.latitude))
					* cos(radians(bedrijfgegevens.longitude)
					- radians(" . $longitude . "))
					+ sin (radians(" . $latitude . "))
					* sin (radians(bedrijfgegevens.latitude)))
					) AS distance";
	}

	$query = $select . " FROM
							bedrijfgegevens
						INNER JOIN
							subbranches on subbranches.id = bedrijfgegevens.subbranche_id
						INNER JOIN
							branches on branches.id = subbranches.branche_id
						WHERE
							branches.naam = :branche
						OR
							subbranches.naam = :subbranche
						";

	$companyQuery = $select . " FROM
									bedrijfgegevens
								WHERE
									locate('" . $trefwoord . "', bedrijfsnaam)
								UNION " . $select . "
								FROM
									specialiteiten
								INNER JOIN
									bedrijfgegevens_specialiteiten on bedrijfgegevens_specialiteiten.specialiteiten_id = specialiteiten.id
								INNER JOIN
									bedrijfgegevens on bedrijfgegevens.id = bedrijfgegevens_specialiteiten.bedrijfgegevens_id
								WHERE
									locate('" . $trefwoord . "', specialiteiten.naam)
								";



	if(!empty($trefwoord)) {
		if (strpos($trefwoord, '>')) {
			$branche = substr($trefwoord, 0, strrpos($trefwoord, ' >'));
			$subbranche = substr($trefwoord, strrpos($trefwoord, '> ') + 2);
		} else {
			$branche = $trefwoord;
			$subbranche = $trefwoord;
		}

		if(!isset($latitude) && !isset($longitude)) {
			$limit = " LIMIT " . $start . "," . ($range+1);
		} elseif(isset($latitude) && isset($longitude)) {
			$limit = " HAVING
						distance < " . $distance . "
					ORDER BY
						distance
					LIMIT " . $start . " , " . ($range+1);
		}

		$sth = $pdo->prepare($query.$limit);

		$sth->bindValue(':branche', $branche, PDO::PARAM_STR);
		$sth->bindValue(':subbranche', $subbranche, PDO::PARAM_STR);
		$sth->execute();

		if($sth->rowCount() == 0) {
			$sth = $pdo->prepare($companyQuery.$limit);
			$sth->execute();
		}
	}
	?>
	<div class="row search-result">
		<div class="col-xs-12">
			<?php
			$rows = 0;
			while($row = $sth->fetch()) {
				$rows++;

				if($rows > $range) {
					break;
				}

				if ($row['premium'] == 'gold') {
					echo '<a class="greylink" href="bedrijven.php?paginanr=' . $row['nummer'] . '&bedrijfs_id=' . $row['id'] . '" />';
				}
				?>
				<div class="search-container">
					<div class="search-image">
						<?php
						if ($row['premium'] == 'gold' && !empty($row['logo'])) {
							echo '<img src="images/bedrijf_images/' . $row['id'] . '/' . $row['logo'] . ' />';
						} elseif ($row['premium'] != 'gold') {
							echo '<span class="glyphicon glyphicon-search no-premium"></span>';
						}
						?>
					</div>
					<div class="search-naam">
						<?php
						if ($row['premium'] == 'gold' || $row['premium'] == 'brons') {
							echo $row['bedrijfsnaam'] . '<br />' . $row['telefoonnummer'] . '<br />';
						} else {
							echo $row['bedrijfsnaam'] . '<br />';
						}

						if (isset($row['distance'])) {
							$round = round($row['distance'], 1);
							echo number_format($round, 1, ',', '.') . ' km';
						}
						?>
					</div>
				</div>
				<?php
				if($row['premium'] == 'gold') {
					echo '</a>';
				}
			}
			?>
		</div>
		<div class="col-xs-12">
			<?php
			if($nummer == 0) {
				if($rows > 50) {
					echo '<a href="gids.php?nr='.($nummer+1).'" class="btn btn-default gids-btn-nav">Volgende</a>';
				}
			} else {
				if($rows > 50 && $nummer > 0) {
					echo '<a href="gids.php?nr='.($nummer-1).'" class="btn btn-default gids-btn-nav">Terug</a>';
					echo '<a href="gids.php?nr='.($nummer+1).'" class="btn btn-default gids-btn-nav">Volgende</a>';
				} else {
					echo '<a href="gids.php?nr='.($nummer-1).'" class="btn btn-default gids-btn-nav">Terug</a>';
				}
			}
			?>
		</div>
	</div>
<?php }
require('./controllers/footer.php');
?>

<script>
	analytics.js: ga('send', 'pageview', '/gids.php?q=$trefwoord');
</script>