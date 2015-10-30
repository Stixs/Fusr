<?php
require('views/header.php');

$company = $_GET['bedrijf'];

if(isset($_SESSION['trefwoord'])) {
    $trefwoord = $_SESSION['trefwoord'];
}

require('views/headersection.php');

if(is_numeric($company)) {
    $socials = ['twitter', 'facebook', 'linkedin', 'pinterest', 'youtube', 'googleplus'];

    $sth = $pdo->prepare('SELECT
                            bedrijfgegevens.*,
                            openingstijden.*,
                            plaatsen.plaats,
                            plaatsen.provincie,
                            specialiteiten.naam as specialiteiten_naam
                        FROM
                            bedrijfgegevens
                        LEFT JOIN
                            openingstijden on openingstijden.bedrijfs_id = bedrijfgegevens.id
                        INNER JOIN
                            plaatsen on plaatsen.id = bedrijfgegevens.plaats_id
                        INNER JOIN
                          bedrijfgegevens_specialiteiten on bedrijfgegevens_specialiteiten.bedrijfgegevens_id = bedrijfgegevens.id
				        INNER JOIN
				          specialiteiten on specialiteiten.id = bedrijfgegevens_specialiteiten.specialiteiten_id
                        WHERE
                            bedrijfgegevens.id = :company');

    $sth->bindParam(':company', $company);
    $sth->execute();
    $row = $sth->fetch();

    if($row['premium'] == 'gold') {
        require('views/bedrijven.php');
    } else {
    }
}
?>