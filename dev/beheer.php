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
$oudenaam = $_POST['oudenaam'];
$parameters = array(':specialiteit'=>$specialiteit[$keuze],
					':keuze'=>$keuze);
$sth = $pdo->prepare('UPDATE specialiteiten SET specialiteit=:specialiteit WHERE specialiteit_id = :keuze');
$sth->execute($parameters);

for ($N = 1; $N <20000; $N++)
{
	echo $N.'<br>';
	$parameters = array(':specialiteit'=>$specialiteit[$keuze],
						':oudenaam'=>$oudenaam[$keuze]);
	
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_1=:specialiteit WHERE specialiteit_1=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_2=:specialiteit WHERE specialiteit_2=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_3=:specialiteit WHERE specialiteit_3=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_4=:specialiteit WHERE specialiteit_4=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_5=:specialiteit WHERE specialiteit_5=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_6=:specialiteit WHERE specialiteit_6=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_7=:specialiteit WHERE specialiteit_7=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_8=:specialiteit WHERE specialiteit_8=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_9=:specialiteit WHERE specialiteit_9=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_10=:specialiteit WHERE specialiteit_10=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_11=:specialiteit WHERE specialiteit_11=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_12=:specialiteit WHERE specialiteit_12=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_13=:specialiteit WHERE specialiteit_13=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_14=:specialiteit WHERE specialiteit_14=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_15=:specialiteit WHERE specialiteit_15=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_16=:specialiteit WHERE specialiteit_16=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_17=:specialiteit WHERE specialiteit_17=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_18=:specialiteit WHERE specialiteit_18=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_19=:specialiteit WHERE specialiteit_19=:oudenaam');
	$sth->execute($parameters);
	$sth = $pdo->prepare('UPDATE bedrijfs_specialiteiten SET specialiteit_20=:specialiteit WHERE specialiteit_20=:oudenaam');
	$sth->execute($parameters);
	
	}





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
	<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
		<label for="specialiteit">Specialiteit:</label>
		<form class="form-inline" action="" method="post">

			<?php
			$sth = $pdo->prepare('select * from specialiteiten ORDER BY specialiteit');
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
			}
			?>
		
		</form>
	</div>
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

require('./controllers/footer.php');
?>
