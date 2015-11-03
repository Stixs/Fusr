<?php
if ($_POST['branche'] != 
$_SESSION['branche'])
{
	unset($_SESSION['beperk']);
}
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
$subbranche = $_POST['subbranche'];
$omschrijving = $_POST['omschrijving'];
$branche = $_POST['branche'];
var_dump($_POST);
$parameters = array(':subbranche'=>$subbranche,
					':branche'=>$branche,
					':omschrijving'=>$omschrijving
					);
	$sth = $pdo->prepare('INSERT INTO subbranches (branche_id, naam, omschrijving)VALUES(:branche, :subbranche, :omschrijving)');
	$sth->execute($parameters);
	
}


if(isset($_POST['edit_spec']))
{
$subbranche = $_POST['subbranche'];
$omschrijving = $_POST['omschrijving'];
$keuze = $_POST['edit_spec'];
$parameters = array(':naam'=>$subbranche[$keuze],
					':omschrijving'=>$omschrijving[$keuze],
					':keuze'=>$keuze);
$sth = $pdo->prepare('UPDATE subbranches SET naam=:naam, omschrijving=:omschrijving WHERE id = :keuze');
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
		echo 'Verwijderen niet mogelijk, deze subbranche is nog gekoppeld aan een bedrijf';
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
	$sth = $pdo->prepare("SELECT * FROM subbranches WHERE branche_id = " . $_SESSION['branche'] . " AND naam LIKE '%" . $beperk. "%'");
	$sth->execute();
	?>
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
	<label for="subbranche">Subbranche:</label>
	<form action="" method="post">
	<?php
	
	while($row = $sth->fetch())
	{
	?>
		
		<div class="col-xs-12 ">
				<div class="form-group specialiteit_wijzigen">
					<input type="hidden" name="branche" value="<?php echo $row['branche_id']; ?>" >
				<div class="col-xs-3 no-padding-left">
					<input type="text" class="form-control" name="subbranche[<?php echo $row['id'] ?>]" value="<?php echo $row['naam']; ?>">
				</div>
				<div class="col-xs-7 no-padding-left">
					<input type="text" class="form-control" name="omschrijving[<?php echo $row['id'] ?>]" value="<?php echo $row['omschrijving']; ?>">
				</div>
					<button type="submit" value="<?php echo $row['id'] ?>" name="edit_spec" class="btn btn-default">Wijzig</button>
					--><button type="submit" value="<?php echo $row['id'] ?>" name="del_spec" class="btn btn-danger">Verwijder</button>-->
					
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
		<label for="subbranche">Subbranche:</label>
		<form action="" method="post">

			<?php

			$sth = $pdo->prepare("select * from subbranches WHERE branche_id = " . $_SESSION['branche'] . " ORDER BY naam");
			$sth->execute();
			while($row = $sth->fetch())
			{
				?>
	
			<div class="col-xs-12 ">
				<div class="form-group specialiteit_wijzigen">
					<input type="hidden" name="branche" value="<?php echo $row['branche_id']; ?>" >
				<div class="col-xs-3 no-padding-left">
					<input type="text" class="form-control" name="subbranche[<?php echo $row['id'] ?>]" value="<?php echo $row['naam']; ?>">
				</div>
				<div class="col-xs-7 no-padding-left">
					<input type="text" class="form-control" name="omschrijving[<?php echo $row['id'] ?>]" value="<?php echo $row['omschrijving']; ?>">
				</div>
					<button type="submit" value="<?php echo $row['id'] ?>" name="edit_spec" class="btn btn-default">Wijzig</button>
					<!--<button type="submit" value="<?php echo $row['id'] ?>" name="del_spec" class="btn btn-danger">Verwijder</button>-->
					
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
		<form method="post" action="" >
			<div class="form-group spacer2">
				<input type="hidden" name="branche" value="<?php echo $_SESSION['branche']; ?>" >
			<div class="col-xs-3 no-padding-left">
				<input type="text" class="form-control"  id="subbranche" name="subbranche" placeholder="Naam">
			</div>
			<div class="col-xs-7 no-padding-left">
				<input type="text" class="form-control" id="subbranche" name="omschrijving" placeholder="Omschrijving">
			</div>
			<div class="col-xs-2 no-padding-left">
				<button type="submit" name="add_spec" class="btn btn-default">Toevoegen</button>
			</div>
			</div>
		</form>
	</div>
</div>
<?php
}
?>
