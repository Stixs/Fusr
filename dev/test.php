<?php

require('./connection.php');
$pdo = ConnectDB();
$bedrijfs_id = 2;
$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
					$sth = $pdo->prepare('SELECT *
					FROM
					bedrijfgegevens_specialiteiten
					INNER JOIN
					specialiteiten on bedrijfgegevens_specialiteiten.specialiteiten_id = specialiteiten.id
					INNER JOIN
					bedrijfgegevens on bedrijfgegevens_specialiteiten.bedrijfgegevens_id = bedrijfgegevens.id
					INNER JOIN
					plaatsen on bedrijfgegevens.plaats_id = plaatsen.id
					WHERE
					bedrijfgegevens_id = '.$bedrijfs_id);
					$sth->execute($parameters);
					while ($row = $sth->fetch())
					{
					$naam[] = $row['naam'];
					}



function specialiteitkeuze($pdo, $name, $id, $keuze = NULL, $id = null) {


	$html = '<label for="sel'.$id.'">Specialiteit:</label>';
    $html .= '<select class="form-control" id="sel'.$id.'" name="'.$name.'">';	
	$sth = $pdo->prepare('SELECT * FROM specialiteiten where id = '.$id);
		$sth->execute();
			$html .= '<option value=""></option>';
			while($row = $sth->fetch())
				{
					
					if($row['id'] == $keuze)
					{
						$html .= '<option value="'.$row['id'].'" selected="selected">'.$row['id'].'</option>';
					}
					else
					{
						$html .= '<option value="'.$row['id'].'">'.$row['id'].'</option>';
					}
				}
	$html .= '</select>';
    return $html;
}

echo specialiteitkeuze($pdo, 'specialiteit[]', 1, $row['naam[0]']);


?>