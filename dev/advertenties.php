<?php
require('./controllers/header.php');

if(isset($_POST['Add_advert']))
{
$titel = $_POST['titel'];
$afbeelding = basename($_FILES["afbeelding"]["name"]);
$vanaf_datum = $_POST['vanaf_datum'];
$tot_datum = $_POST['tot_datum'];
$url = $_POST['url'];
$type = $_POST['type'];

$vanaf_datum = STRTOTIME($vanaf_datum);
$tot_datum = STRTOTIME($tot_datum);

$friendlytitle = friendly_url($titel);

	if (!file_exists('images/advertentie_images/'.$friendlytitle)) {
		mkdir('images/advertentie_images/'.$friendlytitle, 0777, true);
		}
		$target_dir = "images/advertentie_images/".$friendlytitle."/";
		$target_file = $target_dir . basename($_FILES["afbeelding"]["name"]);
		if (move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $target_file)){} 
		
$parameters = array(':titel'=>$titel,
					':afbeelding'=>$afbeelding,
					':vanaf_datum'=>$vanaf_datum,
					':tot_datum'=>$tot_datum,
					':url'=>$url,
					':type'=>$type
					);
	$sth = $pdo->prepare('INSERT INTO advertenties (titel, afbeelding, vanaf_datum, tot_datum, url, type)VALUES(:titel, :afbeelding, :vanaf_datum, :tot_datum, :url, :type)');
	$sth->execute($parameters);
	unset($_POST['Add_advert']);
}


if(isset($_POST['Edit_advert']))
{
$keuze = $_POST['Edit_advert'];
$titel = $_POST['titel'];
$vanaf_datum = $_POST['vanaf_datum'];
$tot_datum = $_POST['tot_datum'];
$url = $_POST['url'];
$type = $_POST['type'];
$vanaf_datum = $vanaf_datum[$keuze];
$tot_datum = $tot_datum[$keuze];
$vanaf_datum = STRTOTIME($vanaf_datum);
$tot_datum = STRTOTIME($tot_datum);
$friendlytitle = friendly_url($titel[$keuze]);

if (!file_exists('images/advertentie_images/'.$friendlytitle))
{
	$tmp_titel = $_SESSION['titel'][$keuze];
	$tmp_friendlytitle = friendly_url($tmp_titel);
	rmdir('images/advertentie_images/'.$tmp_friendlytitle);
	mkdir('images/advertentie_images/'.$friendlytitle);
}



	$sth = $pdo->prepare('SELECT * FROM advertenties WHERE advertentie_id = '. $keuze);
	$sth->execute(); $row = $sth->fetch();
	
	if(empty($row['afbeelding']))
	{
		if (basename($_FILES["afbeelding"]["name"][$keuze]) == null)
		{$afbeelding = $row['afbeelding'];}
		else
		{$afbeelding = basename($_FILES["afbeelding"]["name"][$keuze]);}


			if (!file_exists('images/advertentie_images/'.$friendlytitle)) {
			mkdir('images/advertentie_images/'.$friendlytitle, 0777, true);
			}
			
			
			$target_dir = "images/advertentie_images/".$friendlytitle."/";
			$target_file = $target_dir . basename($_FILES["afbeelding"]["name"][$keuze]);
			if (move_uploaded_file($_FILES["afbeelding"]["tmp_name"][$keuze], $target_file)){} 
	}
	else
	{
		$afbeelding = $row['afbeelding'];
	}

$parameters = array(':titel'=>$titel[$keuze],
					':afbeelding'=>$afbeelding,
					':vanaf_datum'=>$vanaf_datum,
					':tot_datum'=>$tot_datum,
					':url'=>$url[$keuze],
					':type'=>$type[$keuze],
					':keuze'=>$keuze
					);
$sth = $pdo->prepare('UPDATE advertenties SET titel=:titel, afbeelding=:afbeelding, vanaf_datum=:vanaf_datum, tot_datum=:tot_datum, url=:url, type=:type WHERE advertentie_id = :keuze');
$sth->execute($parameters);
}


if(isset($_POST['Del_advert']))
{
$keuze = $_POST['Del_advert'];
$titel = $_POST['titel'];

$friendlytitle = friendly_url($titel[$keuze]);
$parameters = array(':keuze'=>$keuze);
$sth = $pdo->prepare('DELETE FROM advertenties WHERE advertentie_id = :keuze');
$sth->execute($parameters);
rmdir('images/advertentie_images/'.$friendlytitle);
}

if(isset($_POST['Del_Image']))
	{
	$keuze = $_POST['Del_Image'];
	$titel = $_POST['titelf'];
	$afbeelding = $_POST['afbeelding'];
	$leeg = "0";
	
	$parameter = array(':leeg'=>$leeg, ':advertentie_id'=>$keuze);
	$sth = $pdo->prepare('UPDATE advertenties SET afbeelding=:leeg WHERE advertentie_id = :advertentie_id');
	$sth->execute($parameter);
	
	unlink('images/advertentie_images/'. $titel[$keuze] .'/'. $afbeelding);
	}
?> 

<div class="row">
	<div class="col-xs-12 ContentPadding" style="padding-bottom:20px;">
		<h3>Beheer Advertenties</h3>
		<br>
		<h4>Advertenties Bewerken</h4>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 ContentPadding" style="padding-top:0;">
		<form class="" action="" method="post" enctype="multipart/form-data">
			<?php
			$sth = $pdo->prepare('select * from advertenties ORDER BY titel');
			$sth->execute();
			
			?>
			
			<?php
			while($row = $sth->fetch())
			{
				?>
					<table class="table table-bordered aanpassen">
					<tr>
						<th>Titel</th>
						<th>Afbeelding</th>
						<th>Vanaf</th>
						<th>Tot</th>
					</tr>
					<tr>
						<td><input type="text" class="form-control" name="titel[<?php echo $row['advertentie_id'] ?>]" value="<?php echo $row['titel']; ?>"></td>
						<?php $_SESSION['titel'][$row['advertentie_id']] = $row['titel'] ?>
						<td>
						<?php if(empty($row['afbeelding'])){ ?><input type="file" class="form-control" name="afbeelding[<?php echo $row['advertentie_id'] ?>]" /> <?php } ?>
						
						<?php if(!empty($row['afbeelding'])){ ?> <a href="images/advertentie_images/<?php echo $friendlytitle = friendly_url($row['titel']) .'/'. $row['afbeelding']; ?>">
						<img src="images/advertentie_images/<?php echo $friendlytitle = friendly_url($row['titel']) .'/'. $row['afbeelding']; ?>" role="Picture" height="30px" /></a>
						<input type="hidden" name="titelf[<?php echo $row['advertentie_id'] ?>]" value="<?php echo $friendlytitle = friendly_url($row['titel']); ?>">
						<input type="hidden" name="afbeelding" value="<?php echo  $row['afbeelding']; ?>">
						<button type="submit" name="Del_Image" class="btn btn-warning" value="<?php echo $row['advertentie_id'] ?>" />Verwijder</button> <?php } ?>

						</td>
					
						<td><input type="text" class="form-control" name="vanaf_datum[<?php echo $row['advertentie_id'] ?>]" value="<?php echo date('d-m-Y',$row['vanaf_datum']); ?>" placeholder="dd-mm-jjjj"></td>
						<td><input type="text" class="form-control" name="tot_datum[<?php echo $row['advertentie_id'] ?>]" value="<?php echo date('d-m-Y',$row['tot_datum']); ?>" placeholder="dd-mm-jjjj" ></td>
					</tr>
					<tr>
						<th>Url</th>
						<th>Type</th>
						<th>Aanpassen</th>
						<th>Verwijderen</th>
					</tr>
					<tr>
						<td><input type="text" class="form-control" name="url[<?php echo $row['advertentie_id'] ?>]" value="<?php echo $row['url']; ?>"></td>
						<td><input type="text" class="form-control" name="type[<?php echo $row['advertentie_id'] ?>]" value="<?php echo $row['type']; ?>" size="38"></td>
						<td><button type="submit" name="Edit_advert" class="btn btn-default" value="<?php echo $row['advertentie_id'] ?>">Aanpassen</button></td>
						<td><button type="submit" name="Del_advert" class="btn btn-danger" value="<?php echo $row['advertentie_id'] ?>">Verwijderen</button></td>
					</tr>
					</table>
				<?php
				
			}
			?>
			
			</form>
		
		<h4>Advertentie Toevoegen</h4>
		<form class="" method="post" action="" enctype="multipart/form-data">
			<table class="table table-bordered aanpassen">
					<tr>
						<th>Titel</th>
						<th>Afbeelding</th>
						<th>Vanaf</th>
						<th>Tot</th>
					</tr>
					<tr>
						<td><input type="text" class="form-control" name="titel"></td>
						<td><input type="file" class="form-control" name="afbeelding"></td>
						<td><input type="text" class="form-control" name="vanaf_datum" placeholder="dd-mm-jjjj"></td>
						<td><input type="text" class="form-control" name="tot_datum" placeholder="dd-mm-jjjj" ></td>
					</tr>
					<tr>
						<th colspan="2">Url</th>
						<th colspan="2">Type</th>
					</tr>
					<tr>
						<td colspan="2"><input type="text" class="form-control" name="url"></td>
						<td colspan="2"><input type="text" class="form-control" name="type"></td>
					</tr>
					<tr>
						<td colspan="4"><button type="submit" name="Add_advert" class="btn btn-default">Advertentie toevoegen</button></td>
					</tr>
					</table>
		</form>
	</div>
</div>
<?php

require('./controllers/footer.php');
?>
