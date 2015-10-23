<?php
require('views/header.php');

$distance = 10;
$range = 50;
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

// Check if "trefwoord" exists
if(isset($_POST['trefwoord'])) {
    $trefwoord = $_POST['trefwoord'];
    $_SESSION['trefwoord'] = $trefwoord;
} elseif($_SESSION['trefwoord']) {
    $trefwoord = $_SESSION['trefwoord'];
} elseif($_GET['q']) {
	$trefwoord = $_GET['q'];
} else {
    $trefwoord = null;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['nr']) || isset($_GET['q'])) {
    $select = "SELECT
				bedrijfgegevens.id,
				bedrijfgegevens.bedrijfsnaam,
				bedrijfgegevens.telefoonnummer,
				bedrijfgegevens.mobielnummer,
				bedrijfgegevens.premium,
				bedrijfgegevens.logo
				";

	$selectFilter = "SELECT
						branches.naam as branche_naam,
						specialiteiten.naam as specialiteiten_naam";

    if (isset($latitude) && isset($longitude)) {
        $select .= ", (6371
					* acos(cos(radians(" . $latitude . "))
					* cos(radians(bedrijfgegevens.latitude))
					* cos(radians(bedrijfgegevens.longitude)
					- radians(" . $longitude . "))
					+ sin (radians(" . $latitude . "))
					* sin (radians(bedrijfgegevens.latitude)))
					) AS distance";
    }

    if (!empty($trefwoord)) {
		$query = " FROM bedrijfgegevens
				INNER JOIN subbranches on subbranches.id = bedrijfgegevens.subbranche_id
				INNER JOIN branches on branches.id = subbranches.branche_id
				INNER JOIN bedrijfgegevens_specialiteiten on bedrijfgegevens_specialiteiten.bedrijfgegevens_id = bedrijfgegevens.id
				INNER JOIN specialiteiten on specialiteiten.id = bedrijfgegevens_specialiteiten.specialiteiten_id
				WHERE MATCH (branches.naam, subbranches.naam, bedrijfgegevens.bedrijfsnaam, specialiteiten.naam)
				AGAINST ('" . convertSearchString($trefwoord) . "*' IN BOOLEAN MODE)";

		if (!isset($latitude) && !isset($longitude)) {
			$limit = " GROUP BY bedrijfgegevens.bedrijfsnaam LIMIT " . $start . "," . ($range + 1);
		} elseif (isset($latitude) && isset($longitude)) {
			$limit = " GROUP BY
						bedrijfgegevens.bedrijfsnaam
					HAVING
						distance < " . $distance . "
					ORDER BY
						distance
					LIMIT " . $start . " , " . ($range + 1);
		}

        $sth = $pdo->prepare($select . $query . $limit);
        $sth->execute();

		$result = $sth->fetchAll();
    }

	$sthFilter = $pdo->prepare($selectFilter . $query);
	$sthFilter->execute();
	$results = $sthFilter->fetchAll(PDO::FETCH_ASSOC);

    $branches = [];
    $specialiteiten = [];
    foreach ($results as $row) {
        if (!in_array(trim($row['branche_naam']), $branches)) {
            $branches[] = trim($row['branche_naam']);
        }

        if (!in_array(trim($row['specialiteiten_naam']), $specialiteiten)) {
            $specialiteiten[] = trim($row['specialiteiten_naam']);
        }
    }
}

$trefwoord = htmlspecialchars($trefwoord);
$trefwoord = htmlspecialchars_decode($trefwoord, ENT_NOQUOTES);

// Require gids view
require('views/gids.php');

require('view/footer.php');
?>