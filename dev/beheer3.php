<?php

if(isset($_POST['branche']))
{
$_SESSION['branche'] = $_POST['branche'];
}


if(isset($_POST['add_spec']))
{
$specialiteit = $_POST['specialiteit'];
$branche = $_SESSION['branche'];
$parameters = array(':specialiteit'=>$specialiteit,
					':branche'=>$branche
					);
	$sth = $pdo->prepare('INSERT INTO specialiteiten (specialiteit, subbranche_id)VALUES(:specialiteit, :branche)');
	$sth->execute($parameters);
	echo 'test';
	
}


if(isset($_POST['edit_spec']))
{
$specialiteit = $_POST['specialiteit'];
$keuze = $_POST['edit_spec'];
$oudenaam = $_POST['oudenaam'];
$parameters = array(':specialiteit'=>$specialiteit[$keuze],
					':keuze'=>$keuze);
$sth = $pdo->prepare('UPDATE specialiteiten SET specialiteit=:specialiteit WHERE specialiteit_id = :keuze');
$sth->execute($parameters);

}


if(isset($_POST['del_spec']))
{
$keuze = $_POST['del_spec'];
	$parameters = array(':keuze'=>$keuze);
$sth = $pdo->prepare('DELETE FROM specialiteiten WHERE specialiteit_id = :keuze');
$sth->execute($parameters);
}




echo '<form method="POST">';
echo '<select name="branche" onchange="this.form.submit()">';
echo '<option value="">Selecteer branche</option>';
$sth = $pdo->prepare("SELECT * FROM branches");
$sth->execute();
while($row = $sth->fetch())
	{
		if($row['branche_id'] == $_POST['branche'])
		{
		echo '<option selected value="'.$row['branche_id'].'">'.$row['branche'].'</option>';
		}
		else
		{
		echo '<option value="'.$row['branche_id'].'">'.$row['branche'].'</option>';
		}
	}
echo '</select>';
echo '<noscript><input type="submit" value="Submit"></noscript>';
echo '</form>';

if(isset($_POST['branche']) or isset($_POST['edit_spec']) or isset($_POST['del_spec']) or isset($_POST['add_spec']))
{
?>


<form  method="post">
	<div class="col-xs-12">
		<div class="form-group beperk">
			<input class="form-control" type="text" name="beperk" autofocus size="1" value="" >
			<input type="hidden" name="branche" value="<?php echo $_SESSION['branche']; ?>" >
		</div>
	</div>
</form>

<div class="row">
<?php

if(isset($_POST['beperk']))
{
	$beperk = $_POST['beperk'];
}
else
{
	$beperk = NULL;
}
if(isset($_POST['beperk']))
{
	$branche = $_SESSION['branche'];
	$sth = $pdo->prepare("SELECT * FROM specialiteiten WHERE subbranche_id = " . $_SESSION['branche'] . " AND specialiteit LIKE '%" . $beperk. "%'");
	$sth->execute();
	
	?>
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
	<label for="specialiteit">Specialiteit:</label>
	<form class="form-inline" action="" method="post">
	<?php
	
	while($row = $sth->fetch())
	{
	?>
		
		<div class="col-xs-6">
			<div class="form-group specialiteit_wijzigen">
				<input type="hidden" class="form-control" name="oudenaam[<?php echo $row['specialiteit_id'] ?>]" value="<?php echo $row['specialiteit']; ?>">
				<input type="text" class="form-control" name="specialiteit[<?php echo $row['specialiteit_id'] ?>]" value="<?php echo $row['specialiteit']; ?>">
				<button type="submit" value="<?php echo $row['specialiteit_id'] ?>" name="edit_spec" class="btn btn-default">Wijzig</button>
				<button type="submit" value="<?php echo $row['specialiteit_id'] ?>" name="del_spec" class="btn btn-danger">Verwijder</button>
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
		<label for="specialiteit">Specialiteit:</label>
		<form class="form-inline" action="" method="post">

			<?php

			$sth = $pdo->prepare("select * from specialiteiten WHERE subbranche_id = " . $_SESSION['branche'] . " ORDER BY specialiteit");
			$sth->execute();
			$first = true;
			while($row = $sth->fetch())
			{
				?>
	
			<div class="col-xs-6">
				<div class="form-group specialiteit_wijzigen">
					<input type="hidden" class="form-control" name="oudenaam[<?php echo $row['specialiteit_id'] ?>]" value="<?php echo $row['specialiteit']; ?>">
					<input type="text" class="form-control" name="specialiteit[<?php echo $row['specialiteit_id'] ?>]" value="<?php echo $row['specialiteit']; ?>">
					<button type="submit" value="<?php echo $row['specialiteit_id'] ?>" name="edit_spec" class="btn btn-default">Wijzig</button>
					<button type="submit" value="<?php echo $row['specialiteit_id'] ?>" name="del_spec" class="btn btn-danger">Verwijder</button>
				</div>
			</div>
			
				<?php	
			}
			?>
		
		</form>
	</div>
	<?php
	}
	?>
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
		<form class="form-inline" method="post" action="" >
			<div class="form-group spacer2">
				<label for="specialiteit">Specialiteit</label>
				<input type="text" class="form-control" id="specialiteit" name="specialiteit">
				<button type="submit" name="add_spec" class="btn btn-default">Toevoegen</button>
			</div>
		</form>
	</div>
</div>
<?php
}
?>
