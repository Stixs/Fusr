<?php

$sth = $pdo->prepare("SELECT * FROM bedrijfgegevens");
$sth->execute();

while($row = $sth->fetch())
{
	$bedrijfs_id = $row['bedrijfs_id'];
	
	$sth2 = $pdo->prepare('INSERT INTO gebruikers (gebruikers_id, ) VALUES ('.$bedrijfs_id.',)');
	$sth2->execute();
}

?>