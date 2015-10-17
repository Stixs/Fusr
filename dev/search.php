<?php
require('connection.php');
$pdo = ConnectDB();
$term = trim(strip_tags($_GET['term']));

$sth = $pdo->prepare("SELECT DISTINCT
                        branches.id,
                        branches.naam as branche_naam,
                        subbranches.naam as subbranche_naam
                      FROM branches
                      INNER JOIN subbranches
                      ON branches.id = subbranches.branche_id
                      WHERE locate('" . $term . "', branches.naam)
                      UNION
                      SELECT DISTINCT
                        branches.id,
                        branches.naam,
                        subbranches.naam
                      FROM subbranches
                      INNER JOIN branches
                      ON subbranches.branche_id = branches.id
                      WHERE locate('" . $term . "', subbranches.naam)
                      LIMIT 5
                    ");

$sth->execute();

$array = [];
while($row = $sth->fetch()) {
    if(strtolower($row['branche_naam']) == strtolower($row['subbranche_naam'])) {
        array_push($array, $row['branche_naam']);
    } else {
        array_push($array, $row['branche_naam'] . ' > ' . $row['subbranche_naam']);
    }
}

echo json_encode($array);
?>
