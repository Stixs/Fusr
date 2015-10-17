<?php

$pdo = new PDO('mysql:host=localhost;dbname=fusr',"root","");

function branchekeuze($pdo, $name, $id, $keuze = NULL) {
	$html = '<label for="sel'.$id.'">Branche</label>';
    $html .= '<script type="text/javascript">
								function lastselected(value)
								{
									window.location.href = "toevoegenbedrijf.php?&branche=" + value;
								}
								</script>
								
								<select class="form-control" id="sel'.$id.'" name="'.$name.'" value="'.$name.'" onchange="lastselected(this.value)">';	
	$sth = $pdo->prepare('select * from sub_branches');
		$sth->execute();
			if(isset($_GET["branche"]))
			{$branche_id = $_GET["branche"];}
			else
			{$branche_id = null;}
			$html .= '<option style="display:none" value="">Selecteer branche</option>';
			while($row = $sth->fetch())
				{
					
					if($row['branche_id'] == $branche_id)
					{
						$html.= '<option value="'.$row['branche_id'].'" selected="selected">'.$row['subbranche'].'</option>';
					}
					else
					{
						$html .= '<option value="'.$row['branche_id'].'">'.$row['subbranche'].'</option>';
					}
				}
	$html .= '</select>';
    return $html;
}
	
echo branchekeuze($pdo, 'branche', 1, null);
	
?>