<?php


if(isset($_POST['add_brn']))
{
$branche = $_POST['branche'];
$parameters = array(':branche'=>$branche,
					);
	$sth = $pdo->prepare('INSERT INTO branches (branche)VALUES(:branche)');
	$sth->execute($parameters);
	echo 'test';
	
}


if(isset($_POST['edit_brn']))
{
$branche = $_POST['branche'];
$keuze = $_POST['edit_brn'];
$oudenaam = $_POST['oudenaam'];
$parameters = array(':branche'=>$branche[$keuze],
					':keuze'=>$keuze);
$sth = $pdo->prepare('UPDATE branches SET branche=:branche WHERE branche_id = :keuze');
$sth->execute($parameters);

}


if(isset($_POST['del_brn']))
{
$keuze = $_POST['del_brn'];
	$parameters = array(':keuze'=>$keuze);
$sth = $pdo->prepare('DELETE FROM branches WHERE branche_id = :keuze');
$sth->execute($parameters);
}


?>


<form  method="post">
	<div class="col-xs-6">
		<div class="form-group beperk">
		<br>
			<input class="form-control" placeholder="Zoek" type="text" name="beperk" autofocus size="1" value="" >
		</div>
	</div>
</form>

<div class="row">
<?php

if(isset($_POST['beperk']))
{
	$beperk = $_POST['beperk'];
	$branche = $_SESSION['branche'];
	$sth = $pdo->prepare("SELECT * FROM branches WHERE branche LIKE '%" . $beperk. "%'");
	$sth->execute();
	
	?>
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
	<label for="branche">Sub-branche:</label>
	<form class="form-inline" action="" method="post">
	<?php
	
	while($row = $sth->fetch())
	{
	?>
		
		<div class="col-xs-6">
			<div class="form-group specialiteit_wijzigen">
				<input type="hidden" class="form-control" name="oudenaam[<?php echo $row['branche_id'] ?>]" value="<?php echo $row['branche']; ?>">
				<input type="text" class="form-control" name="branche[<?php echo $row['branche_id'] ?>]" value="<?php echo $row['branche']; ?>">
				<button type="submit" value="<?php echo $row['branche_id'] ?>" name="edit_brn" class="btn btn-default">Wijzig</button>
				<button type="submit" value="<?php echo $row['branche_id'] ?>" name="del_brn" class="btn btn-danger">Verwijder</button>
			</div>
		</div>
		
	<?php
	}
	?>
		</form>
		</div>
	<?php
	
	
}
else
{
?>

	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
		<label for="branche">Branche:</label>
		<form class="form-inline" action="" method="post">

			<?php

			$sth = $pdo->prepare("select * from branches");
			$sth->execute();
			while($row = $sth->fetch())
			{
				?>
	
			<div class="col-xs-6">
				<div class="form-group specialiteit_wijzigen">
					<input type="hidden" class="form-control" name="oudenaam[<?php echo $row['branche_id'] ?>]" value="<?php echo $row['branche']; ?>">
					<input type="text" class="form-control" name="branche[<?php echo $row['branche_id'] ?>]" value="<?php echo $row['branche']; ?>">
					<button type="submit" value="<?php echo $row['branche_id'] ?>" name="edit_brn" class="btn btn-default">Wijzig</button>
					<button type="submit" value="<?php echo $row['branche_id'] ?>" name="del_brn" class="btn btn-danger">Verwijder</button>
				</div>
			</div>
			
				<?php	
			}
			?>
		
		</form>
	</div>
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
		<form class="form-inline" method="post" action="" >
			<div class="form-group spacer2">
				<label for="specialiteit">Specialiteit</label>
				<input type="text" class="form-control" id="branche" name="branche">
				<button type="submit" name="add_brn" class="btn btn-default">Toevoegen</button>
			</div>
		</form>
	</div>
</div>
<?php
}
?>
