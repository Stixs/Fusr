<?php
require('../connection.php');
$pdo = ConnectDB();
$term = trim(strip_tags($_GET['term']));

if(strpos($term, '>')) {
    $branche = trim(substr($term, 0, strrpos($term, '>')));
    $subbranche = trim(substr($term, strrpos($term, '>') + 1));

    $branche = "WHERE branches.naam = '" . $branche . "' AND locate('" . $subbranche . "', subbranches.naam)";
    $subbranche = $branche . " AND locate('" . $subbranche . "', subbranches.naam)";
} else {
    $branche = "WHERE locate('" . $term . "', branches.naam)";
    $subbranche = "WHERE locate('" . $term . "', subbranches.naam)";
}

$sth = $pdo->prepare("SELECT DISTINCT
                        branches.id as branche_id,
                        branches.naam as branche_naam,
                        subbranches.naam as subbranche_naam
                      FROM branches
                      INNER JOIN subbranches
                      ON branches.id = subbranches.branche_id
                      " . $branche . "
                      UNION
                      SELECT DISTINCT
                        branches.id as branche_id,
                        branches.naam as branche_naam,
                        subbranches.naam as subbranche_naam
                      FROM subbranches
                      INNER JOIN branches
                      ON subbranches.branche_id = branches.id
                      " . $subbranche . "
                      LIMIT 5");

$sth->execute();

$output = [];
while($row = $sth->fetch()) {
    //if(strtolower(trim($row['branche_naam'])) == strtolower(trim($row['subbranche_naam']))) {
    //    array_push($output, ['branche' => trim($row['branche_naam']));
    //} else {
        array_push($output, ['branche' => trim($row['branche_naam']), 'subbranche' => trim($row['subbranche_naam'])]);
    //}
}

echo json_encode($output);
?>