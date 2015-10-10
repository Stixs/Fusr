<?php
require('./controllers/header.php');

$lat =51.61363;
$lon = 5.53695;

$search = 'veghel';

$start = 0;
$range = 300;

$sth = $pdo->prepare('SELECT *, ( 6371 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lon.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance FROM bedrijfgegevens WHERE MATCH (bedrijfsnaam, postcode, plaats, provincie, branche) AGAINST ("'.$search.'" IN BOOLEAN MODE) HAVING distance < 2000000 ORDER BY distance ASC LIMIT '.$start.','.$range
$sth->execute();

echo '<table>';
	while($row = $sth->fetch())
	{
		echo '<tr>';
			echo '<td width="400px">'.$row['bedrijfsnaam'].'</td><td width="100px;">'.$row['plaats'].'</td><td>'.$row['distance'].'</td>';
		echo '</tr>';
	}
echo '<table>';


$sth = $pdo->prepare('

SELECT
	bedrijfgegevens.bedrijfsnaam,
	bedrijfgegevens.provincie,
	bedrijfgegevens.postcode,
	bedrijfgegevens.plaats,
	bedrijfgegevens.branche,	
	(6371
	* acos(cos(radians(51.61363))
	* cos(radians(latitude))
	* cos(radians(longitude)
	- radians(5.53695))
	+ sin(radians(51.61363))
	* sin(radians(latitude))) 
	) AS distance,
	bedrijfs_specialiteiten.*
FROM 
	bedrijfgegevens
INNER JOIN
	bedrijfs_specialiteiten on bedrijfgegevens.bedrijfs_id = bedrijfs_specialiteiten.bedrijfs_id 
WHERE 
	MATCH (bedrijfgegevens.bedrijfsnaam, bedrijfgegevens.postcode, bedrijfgegevens.plaats, bedrijfgegevens.provincie, bedrijfgegevens.branche)
	AGAINST ("veghel transport" IN BOOLEAN MODE) 
	AND MATCH (bedrijfs_specialiteiten.specialiteit_1)
	AGAINST ("veghel transport" IN BOOLEAN MODE) 
	HAVING distance < 100
	ORDER BY distance ASC
	LIMIT 0,300

');

, specialiteit_2, specialiteit_3, specialiteit_4, specialiteit_5, specialiteit_6, specialiteit_7, specialiteit_8, specialiteit_9, specialiteit_10, specialiteit_11, specialiteit_12, specialiteit_13, specialiteit_14, specialiteit_15, specialiteit_16, specialiteit_17, specialiteit_18, specialiteit_19, specialiteit_20


require('./controllers/footer.php');
?>