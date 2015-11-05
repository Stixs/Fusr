<?php

var_dump($_POST);
if(isset($_POST['add_brn']))
{
$branche = $_POST['branche'];
$parameters = array(':branche'=>$branche,
					);
	$sth = $pdo->prepare('INSERT INTO branches (naam)VALUES(:branche)');
	$sth->execute($parameters);
	
}


if(isset($_POST['edit_brn']))
{
$branche = $_POST['branche'];
$keuze = $_POST['edit_brn'];
$parameters = array(':branche'=>$branche[$keuze],
					':keuze'=>$keuze);
$sth = $pdo->prepare('UPDATE branches SET naam=:branche WHERE id = :keuze');
$sth->execute($parameters);

}


if(isset($_POST['del_brn']))
{
$keuze = $_POST['del_brn'];
	$parameters = array(':keuze'=>$keuze);
$sth = $pdo->prepare('DELETE FROM branches WHERE id = :keuze');
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
	$sth = $pdo->prepare("SELECT * FROM branches WHERE naam LIKE '%" . $beperk. "%'");
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
				<input type="text" class="form-control" name="branche[<?php echo $row['id'] ?>]" value="<?php echo $row['naam']; ?>">
				<button type="submit" value="<?php echo $row['id'] ?>" name="edit_brn" class="btn btn-default">Wijzig</button>
				<button type="submit" value="<?php echo $row['id'] ?>" name="del_brn" class="btn btn-danger">Verwijder</button>
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
					<input type="text" class="form-control" name="branche[<?php echo $row['id'] ?>]" value="<?php echo $row['naam']; ?>">
					<button type="submit" value="<?php echo $row['id'] ?>" name="edit_brn" class="btn btn-default">Wijzig</button>
					<button type="submit" value="<?php echo $row['id'] ?>" name="del_brn" class="btn btn-danger">Verwijder</button>
				</div>
			</div>
			
				<?php	
			}
			?>
		
		</form>
	</div>
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
		<form method="post" action="" >
			<div class="form-group spacer2">
			<div class="col-xs-10 no-padding-left">
				<input type="text" class="form-control"  id="branche" name="branche" placeholder="Branche">
			</div>
			<div class="col-xs-2 no-padding-left">
				<button type="submit" name="add_brn" class="btn btn-default">Toevoegen</button>
			</div>
			</div>
		</form>
	</div>
</div>
<?php
}
?>
