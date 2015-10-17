<?php



if(isset($_POST['branche']))
{
$_SESSION['branche'] = $_POST['branche'];
}


if(isset($_POST['add_sbr']))
{
$subbranche = $_POST['subbranche'];
$branche = $_SESSION['branche'];
$parameters = array(':subbranche'=>$subbranche,
					':branche'=>$branche
					);
	$sth = $pdo->prepare('INSERT INTO sub_branches (subbranche, branche_id)VALUES(:subbranche, :branche)');
	$sth->execute($parameters);
	echo 'test';
	
}


if(isset($_POST['edit_sbr']))
{
$subbranche = $_POST['subbranche'];
$keuze = $_POST['edit_sbr'];
$oudenaam = $_POST['oudenaam'];
$parameters = array(':subbranche'=>$subbranche[$keuze],
					':keuze'=>$keuze);
$sth = $pdo->prepare('UPDATE sub_branches SET subbranche=:subbranche WHERE subbranche_id = :keuze');
$sth->execute($parameters);

}


if(isset($_POST['del_sbr']))
{
$keuze = $_POST['del_sbr'];
	$parameters = array(':keuze'=>$keuze);
$sth = $pdo->prepare('DELETE FROM sub_branches WHERE subbranche_id = :keuze');
$sth->execute($parameters);
}

echo '<form method="POST">';
echo '<select name="branche" onchange="this.form.submit()">';
echo '<option value="">Selecteer branche</option>';
$sth = $pdo->prepare("SELECT * FROM branches");
$sth->execute();

while($row = $sth->fetch())
	{
		if($row['branche_id'] == $_SESSION['branche'])
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

if(isset($_POST['branche']) or isset($_POST['edit_sbr']) or isset($_POST['del_sbr']) or isset($_POST['add_sbr']))
{
?>


<form  method="post">
	<div class="col-xs-6">
		<div class="form-group beperk">
		<br>
			<input class="form-control" type="text" placeholder="Zoek"  name="beperk" autofocus size="1" value="" >
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
	$sth = $pdo->prepare("SELECT * FROM sub_branches WHERE branche_id = " . $_SESSION['branche'] . " AND subbranche LIKE '%" . $beperk. "%'");
	$sth->execute();
	
	?>
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
	<label for="subbranche">Sub-branche:</label>
	<form class="form-inline" action="" method="post">
	<?php
	
	while($row = $sth->fetch())
	{
	?>
		
		<div class="col-xs-6">
			<div class="form-group specialiteit_wijzigen">
				<input type="hidden" class="form-control" name="oudenaam[<?php echo $row['subbranche_id'] ?>]" value="<?php echo $row['subbranche']; ?>">
				<input type="text" class="form-control" name="subbranche[<?php echo $row['subbranche_id'] ?>]" value="<?php echo $row['subbranche']; ?>">
				<button type="submit" value="<?php echo $row['subbranche_id'] ?>" name="edit_sbr" class="btn btn-default">Wijzig</button>
				<button type="submit" value="<?php echo $row['subbranche_id'] ?>" name="del_sbr" class="btn btn-danger">Verwijder</button>
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
		<label for="specialiteit">Sub-branche:</label>
		<form class="form-inline" action="" method="post">

			<?php

			$sth = $pdo->prepare("select * from sub_branches WHERE branche_id = " . $_SESSION['branche'] . " ORDER BY subbranche");
			$sth->execute();
			while($row = $sth->fetch())
			{
				?>
	
			<div class="col-xs-6">
				<div class="form-group specialiteit_wijzigen">
					<input type="hidden" class="form-control" name="oudenaam[<?php echo $row['subbranche_id'] ?>]" value="<?php echo $row['subbranche']; ?>">
					<input type="text" class="form-control" name="subbranche[<?php echo $row['subbranche_id'] ?>]" value="<?php echo $row['subbranche']; ?>">
					<button type="submit" value="<?php echo $row['subbranche_id'] ?>" name="edit_sbr" class="btn btn-default">Wijzig</button>
					<button type="submit" value="<?php echo $row['subbranche_id'] ?>" name="del_sbr" class="btn btn-danger">Verwijder</button>
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
				<input type="text" class="form-control" id="subbranche" name="subbranche">
				<button type="submit" name="add_sbr" class="btn btn-default">Toevoegen</button>
			</div>
		</form>
	</div>
</div>
<?php
}
?>
