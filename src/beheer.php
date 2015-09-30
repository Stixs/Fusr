<?php
require('./controllers/header.php');

if(isset($_POST['add_spec']))
{
$specialiteit = $_POST['specialiteit'];
$parameters = array(':specialiteit'=>$specialiteit);
	$sth = $pdo->prepare('INSERT INTO specialiteiten (specialiteit)VALUES(:specialiteit)');
	$sth->execute($parameters);
}


if(isset($_POST['edit_spec']))
{
$specialiteit = $_POST['specialiteit'];
$keuze = $_POST['edit_spec'];
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
?> 

<div class="row">
	<div class="col-xs-12 ContentPadding" style="padding-bottom:0;">
		<h3>Beheer Transportplaza</h3>
		<br>
		<h4>Beheer Specialiteiten</h4>
	</div>
</div>
<div class="row">
	<div class="col-xs-7 ContentPadding" style="padding-top:20px;">
		<label for="specialiteit">Specialiteit:</label>
		<form class="form-inline" action="" method="post">

			<?php
			$sth = $pdo->prepare('select * from specialiteiten');
			$sth->execute();
			$first = true;
			while($row = $sth->fetch())
			{
				if($first == true)
				{
					$first = false;
				}
				else
				{
				?>
				
					<div class="form-group specialiteit_wijzigen">
					
					<input type="text" class="form-control" name="specialiteit[<?php echo $row['specialiteit_id'] ?>]" value="<?php echo $row['specialiteit']; ?>">
					<button type="submit" value="<?php echo $row['specialiteit_id'] ?>" name="edit_spec" class="btn btn-default">Wijzig</button>
					<button type="submit" value="<?php echo $row['specialiteit_id'] ?>" name="del_spec" class="btn btn-danger">Verwijder</button>
					</div>
				<?php
				}
			}
			?> 
		</form>
	
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

require('./controllers/footer.php');
?>
