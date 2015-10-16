<?php
$openingstijd = "8:30";

$dag = 'maandag';

function openingstijden($openingstijd = NULL, $dag) {
	$options = array("6:00", "6:30", "7:00", "7:30", "8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00", "23:30");
    $html= '<select class="form-control" name="'.$dag.'">';
	foreach ($options as $option => $value) {
        if($value == $openingstijd)
            $html.= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
        else
            $html.= '<option value="'.$value.'">'.$value.'</option>';
	}
    $html.= '</select>';
    return $html;
}

echo openingstijden($openingstijd, $dag)


$html = '<form method="POST">';
$html.= '<select name="subbranche" onchange="this.form.submit()">';
$html.= '<option value="">Selecteer sub-branche</option>';
$sth = $pdo->prepare("SELECT * FROM sub_branches");
$sth->execute();
while($row = $sth->fetch())
	{
		if($row['subbranche_id'] == $_SESSION['subbranche'])
		{
		$html.= '<option selected value="'.$row['subbranche_id'].'">'.$row['subbranche'].'</option>';
		}
		else
		{
		$html.= '<option value="'.$row['subbranche_id'].'">'.$row['subbranche'].'</option>';
		}
	}
$html.= '</select>';
$html.= '<noscript><input type="submit" value="branche"></noscript>';
$html.= '</form>';

return $html


?>