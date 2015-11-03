<?php
require('views/header.php');

$distance = 10;
$range = 25;
$number = 0;

if(isset($_GET['nr'])) {
	$number = $_GET['nr'];
}

$start = $number * $range;

// Get user latitude and longitude
if(isset($_SESSION['latitude']) && isset($_SESSION['longitude'])) {
	$latitude = $_SESSION['latitude'];
	$longitude = $_SESSION['longitude'];
} else {
	$latitude = null;
	$longitude = null;
}

if($number == 0 && !isset($_GET['nr'])) {
	unset($_SESSION['trefwoord']);
	unset($_SESSION['branche']);
	unset($_SESSION['subbranche']);
}

// Check if "trefwoord" is filled in
if(isset($_GET['q'])) {
	$trefwoord = htmlentities($_GET['q']);
} elseif(isset($_SESSION['trefwoord'])) {
	$trefwoord = htmlentities($_SESSION['trefwoord']);
} elseif(isset($_GET['q'])) {
	$trefwoord = htmlentities($_GET['q']);
} else {
	$trefwoord = null;
}
$_SESSION['trefwoord'] = $trefwoord;
$url = "?q=" . $trefwoord;

if(isset($_GET['branche']) && isset($_GET['subbranche'])) {
	$branche = $_GET['branche'];
	$subbranche = $_GET['subbranche'];
	$url .= "&branche=" . $branche . "&subbranche=" . $subbranche;
} else {
	$branche = 0;
	$subbranche = 0;
}

require('views/headersection.php');

if(isset($_GET['specialiteit'])) {
	$specialiteiten = $_GET['specialiteit'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['nr']) || isset($_GET['q'])) {
	if(!empty($trefwoord)) {
		$select = 'SELECT
				count(*) as theCount,
				bedrijfgegevens.id,
				bedrijfgegevens.bedrijfsnaam,
				bedrijfgegevens.telefoonnummer,
				bedrijfgegevens.mobielnummer,
				bedrijfgegevens.premium,
				bedrijfgegevens.logo,
				bedrijfgegevens.bezoekadres,
				specialiteiten.naam as specialiteit,
				plaatsen.plaats as plaatsnaam
				';

		$selectFilter = 'SELECT
						branches.naam as branche_naam,
						subbranches.naam as subbranche_naam,
						specialiteiten.naam as specialiteiten_naam';

		$selectView = 'CREATE VIEW Bedrijven_speci as
							SELECT count(*) as theCount, bedrijfgegevens.id,
									bedrijfgegevens.subbranche_id
						';

		if(isset($latitude) && isset($longitude)) {
			$distanceQuery = ', (6371
					* acos(cos(radians(' . $latitude . '))
					* cos(radians(bedrijfgegevens.latitude))
					* cos(radians(bedrijfgegevens.longitude)
					- radians(' . $longitude . '))
					+ sin (radians(' . $latitude . '))
					* sin (radians(bedrijfgegevens.latitude)))
					) AS distance';

			$select .= $distanceQuery;
			$selectView .= $distanceQuery;
		}

		$query = ' FROM bedrijfgegevens
				INNER JOIN subbranches on subbranches.id = bedrijfgegevens.subbranche_id
				INNER JOIN branches on branches.id = subbranches.branche_id
				INNER JOIN bedrijfgegevens_specialiteiten on bedrijfgegevens_specialiteiten.bedrijfgegevens_id = bedrijfgegevens.id
				INNER JOIN specialiteiten on specialiteiten.id = bedrijfgegevens_specialiteiten.specialiteiten_id
				INNER JOIN plaatsen on plaatsen.id = bedrijfgegevens.plaats_id';

		$selectFilter .= ' FROM Bedrijven_speci
						INNER JOIN subbranches on subbranches.id = Bedrijven_speci.subbranche_id
						INNER JOIN branches on branches.id = subbranches.branche_id
						INNER JOIN bedrijfgegevens_specialiteiten on bedrijfgegevens_specialiteiten.bedrijfgegevens_id = Bedrijven_speci.id
						INNER JOIN specialiteiten on specialiteiten.id = bedrijfgegevens_specialiteiten.specialiteiten_id';

		if($branche != '' && $subbranche != '') {
			$where = ' WHERE branches.naam = "' . $branche . '" AND subbranches.naam = "' . $subbranche . '"';
		} else {
			$where = ' WHERE MATCH (branches.naam, subbranches.naam, bedrijfgegevens.bedrijfsnaam, specialiteiten.naam)
				AGAINST ("' . convertSearchString($trefwoord) . '*" IN BOOLEAN MODE)';
		}

		$query .= $where;
		$selectView .= $query;

		if(isset($specialiteiten)) {
			$query .= ' AND specialiteiten.naam in ("' . implode('","',$specialiteiten) . '")';
			$selectView .= ' AND specialiteiten.naam in ("' . implode('","',$specialiteiten) . '")';
		}

		if(!isset($latitude) && !isset($longitude)) {
			if(isset($specialiteiten)) {
				$query .= ' GROUP BY bedrijfgegevens.id HAVING theCount = ' . count($specialiteiten) . ' LIMIT ' . $start . ',' . ($range + 1);
				$selectView .= ' GROUP BY bedrijfgegevens.id HAVING theCount = ' . count($specialiteiten);
			} else {
				$query .= ' GROUP BY bedrijfgegevens.id LIMIT ' . $start . ',' . ($range + 1);
				$selectView .= 'GROUP BY bedrijfgegevens.id';
			}
		} else {
			if(isset($specialiteiten)) {
				$query .= ' GROUP BY
						bedrijfgegevens.id
					HAVING
						distance < ' . $distance . '
					AND
						theCount = ' . count($specialiteiten) . '
					ORDER BY
						distance
					LIMIT ' . $start . ',' . ($range + 1);
				$selectView .= ' GROUP BY
									bedrijfgegevens.id
								HAVING
									distance < ' . $distance . '
								AND
									theCount = ' . count($specialiteiten);
			} else {
				$query .= ' GROUP BY
						bedrijfgegevens.id
					HAVING
						distance < ' . $distance . '
					ORDER BY
						distance
					LIMIT ' . $start . ',' . ($range + 1);

				$selectView .= 'GROUP BY bedrijfgegevens.id HAVING distance < ' . $distance;
			}
		}

		$sth = $pdo->prepare($select . $query);
		$sth->execute();
		$result = $sth->fetchAll();

		$querytest = 'DROP VIEW IF EXISTS Bedrijven_speci';
		$querytest = $pdo->prepare($querytest);
		$querytest->execute();

		$querytest = $selectView;
		$querytest = $pdo->prepare($querytest);
		$querytest->execute();

		$querytest = $selectFilter;
		$sthtest = $pdo->prepare($querytest);
		$sthtest->execute();

		$resultFilter = $sthtest->fetchAll(PDO::FETCH_ASSOC);

		$branches = [];
		$subbranches = [];
		$specialiteiten = [];
		foreach($resultFilter as $row) {
			if (!in_array(trim($row['branche_naam']), $branches)) {
				$branches[] = trim($row['branche_naam']);
			}

			if (!in_array(trim($row['subbranche_naam']), $subbranches)) {
				$subbranches[] = trim($row['subbranche_naam']);
			}

			if (!in_array(trim($row['specialiteiten_naam']), $specialiteiten)) {
				$specialiteiten[] = trim($row['specialiteiten_naam']);
			}
		}
	} else {
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
		die();
	}
}

// Require gids view
require('views/gids.php');

require('views/footer.php');
?>