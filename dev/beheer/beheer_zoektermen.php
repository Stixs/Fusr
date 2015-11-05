<?php
if(isset($_GET['branche']))
{
	if(isset($_POST['edit_zoekterm']))
	{
		$zoekterm = $_POST['zoekterm'];
		$keuze = $_POST['edit_zoekterm'];
		$parameters = array(':zoekterm'=>$zoekterm[$keuze],
							':keuze'=>$keuze);
							
		$sth = $pdo->prepare('UPDATE zoektermen_branches SET naam=:zoekterm WHERE id = :keuze');
		$sth->execute($parameters);	
	}
	
	if(isset($_POST['del_zoekterm']))
	{
		$keuze = $_POST['del_zoekterm'];
		$parameters = array(':keuze'=>$keuze);
		
		$sth = $pdo->prepare('DELETE FROM zoektermen_branches WHERE id = :keuze');
		$sth->execute($parameters);
	}
	
	if(isset($_POST['add_zoekterm']))
	{
		$zoekterm = $_POST['addzoekterm'];
		$branche_id = $_GET['branche'];
		$parameters = array(':zoekterm'=>$zoekterm,
							':branche_id'=>$branche_id
							);
		$sth = $pdo->prepare('INSERT INTO zoektermen_branches (naam, branche_id)VALUES(:zoekterm, :branche_id)');
		$sth->execute($parameters);
		}
	
	
	$sth = $pdo->prepare("SELECT naam FROM branches WHERE id = ".$_GET['branche']);
		$sth->execute();
		$row = $sth->fetch();
		$branche = $row['naam'];
		?>
		<div class="row">
			<div class="col-xs-12 ContentPadding" style="padding-top:20px;">
			<h2><?php echo $branche; ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 ContentPadding" style="padding-top:00px;">
				<form class="form-inline" method="POST">
		<?php

		$sth = $pdo->prepare("SELECT * FROM zoektermen_branches WHERE branche_id =".$_GET['branche']);
		$sth->execute();
		while($row = $sth->fetch())
		{
		?>
		
			
				<div class="col-xs-6">
					<div class="form-group zoektermen">
						<input type="text" class="form-control" name="zoekterm[<?php echo $row['id']; ?>]" value="<?php echo $row['naam']; ?>">
						<button type="submit" value="<?php echo $row['id'] ?>" name="edit_zoekterm" class="btn btn-default">Wijzig</button>
						<button type="submit" value="<?php echo $row['id'] ?>" name="del_zoekterm" class="btn btn-danger">Verwijder</button>
						
					</div>
				</div>
			
			
		
		<?php
		}
		?>
				<div class="col-xs-12" style="padding-top:20px;">
					<input type="text" class="form-control" name="addzoekterm">
					<button type="submit" value="<?php echo $row['id'] ?>" name="add_zoekterm" class="btn btn-default">Toevoegen</button>
				</div>
		
				</form>
			</div>
			
		</div>
		<?php
}
else
{
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
		
			<div class="col-xs-3">
				<div class="form-group specialiteit_wijzigen">
					<?php
					echo '<a href="beheer.php?wijzig=4&branche='.$row['id'].'" class="btn btn-info btn-zoekterm" role="button">'.$row['naam'].'</a>';
					?>
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

			$sth = $pdo->prepare("select * from branches order by naam");
			$sth->execute();
			while($row = $sth->fetch())
			{
				?>
	
			<div class="col-xs-3">
				<div class="form-group specialiteit_wijzigen">
					<?php
					echo '<a href="beheer.php?wijzig=4&branche='.$row['id'].'" class="btn btn-info btn-zoekterm" role="button">'.$row['naam'].'</a>';
					?>
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
				<input type="text" class="form-control" id="zoekterm" name="addzoekterm" placeholder="zoekterm">
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
}
?>
