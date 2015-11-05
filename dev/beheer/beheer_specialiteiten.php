<?php

if(isset($_POST['branche']))
{
$_SESSION['branche'] = $_POST['branche'];
}
else
{
	unset($_SESSION['beperk']);
}

if(isset($_POST['add_spec']))
{
$specialiteit = $_POST['specialiteit'];
$branche = $_POST['branche'];
$parameters = array(':specialiteit'=>$specialiteit,
					':branche'=>$branche
					);
	$sth = $pdo->prepare('INSERT INTO specialiteiten (branche_id, naam)VALUES(:branche, :specialiteit)');
	$sth->execute($parameters);
	
}


if(isset($_POST['edit_spec']))
{
$specialiteit = $_POST['specialiteit'];
$keuze = $_POST['edit_spec'];
$parameters = array(':naam'=>$specialiteit[$keuze],
					':keuze'=>$keuze);
$sth = $pdo->prepare('UPDATE specialiteiten SET naam=:naam WHERE id = :keuze');
$sth->execute($parameters);

}


if(isset($_POST['del_spec']))
{
$keuze = $_POST['del_spec'];
$parameters = array(':keuze'=>$keuze);
$sth = $pdo->prepare('SELECT specialiteiten_id FROM bedrijfgegevens_specialiteiten WHERE specialiteiten_id = :keuze limit 1');

	$sth->execute($parameters);
	if ($sth->rowCount() >= 1)
	{
		echo 'Verwijderen niet mogelijk, deze specialiteit is nog gekoppeld aan een bedrijf';
	}
	else
	{
	$parameters = array(':keuze'=>$keuze);
	$sth = $pdo->prepare('DELETE FROM specialiteiten WHERE id = :keuze');
	$sth->execute($parameters);
	}
}


echo '<form method="POST">';
echo '<select name="branche" onchange="this.form.submit()">';
echo '<option value="">Selecteer branche</option>';
$sth = $pdo->prepare("SELECT * FROM branches order by naam");
$sth->execute();
while($row = $sth->fetch())
	{
		if($row['id'] == $_SESSION['branche'])
		{
		echo '<option selected value="'.$row['id'].'">'.$row['naam'].'</option>';
		}
		else
		{
		echo '<option value="'.$row['id'].'">'.$row['naam'].'</option>';
		}
	}
echo '</select>';
echo '<noscript><input type="submit" value="Submit"></noscript>';
echo '</form>';

if(isset($_POST['branche']) or isset($_POST['edit_spec']) or isset($_POST['del_spec']) or isset($_POST['add_spec']))
{
	
if(isset($_POST['beperk']))
{
	$_SESSION['beperk'] = $_POST['beperk'];
	$beperk = $_SESSION['beperk'];
}
elseif (isset($_SESSION['beperk']))
{
	$beperk = $_SESSION['beperk'];
}
else
{
	
	$_SESSION['beperk'] = null;
}
?>


<form  method="post">
	<div class="col-xs-6">
	<br>
		<div class="form-$branche = $_POST['branche'];group beperk">
			<input class="form-control" type="text" placeholder="Zoek" name="beperk" autofocus size="1" value="<?php echo $_SESSION['beperk']; ?>" >
			<input type="hidden" name="branche" value="<?php echo $_SESSION['branche']; ?>" >
		</div>
	</div>
</form>

<div class="row">
<?php



if(isset($_SESSION['beperk']))
{
	$sth = $pdo->prepare("SELECT * FROM specialiteiten WHERE branche_id = " . $_SESSION['branche'] . " AND naam LIKE '%" . $beperk. "%'");
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
				<input type="hidden" name="branche" value="<?php echo $_SESSION['branche']; ?>" >
				<input type="text" class="form-control" name="specialiteit[<?php echo $row['id'] ?>]" value="<?php echo $row['naam']; ?>">
				<button type="submit" value="<?php echo $row['id'] ?>" name="edit_spec" class="btn btn-default">Wijzig</button>
				<button type="submit" value="<?php echo $row['id'] ?>" name="del_spec" class="btn btn-danger">Verwijder</button>
				
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

			$sth = $pdo->prepare("select * from specialiteiten WHERE branche_id = " . $_SESSION['branche'] . " ORDER BY naam");
			$sth->execute();
			while($row = $sth->fetch())
			{
				?>
	
			<div class="col-xs-6">
				<div class="form-group specialiteit_wijzigen">
					<input type="hidden" name="branche" value="<?php echo $row['branche_id']; ?>" >
					<input type="text" class="form-control" name="specialiteit[<?php echo $row['id'] ?>]" value="<?php echo $row['naam']; ?>">
					<button type="submit" value="<?php echo $row['id'] ?>" name="edit_spec" class="btn btn-default">Wijzig</button>
					<button type="submit" value="<?php echo $row['id'] ?>" name="del_spec" class="btn btn-danger">Verwijder</button>
					
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
				<input type="hidden" name="branche" value="<?php echo $_SESSION['branche']; ?>" >
				<input type="text" class="form-control" id="specialiteit" name="specialiteit">
				<button type="submit" name="add_spec" class="btn btn-default">Toevoegen</button>
			</div>
		</form>
	</div>
</div>
<?php
}
?>
