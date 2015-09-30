<?php
require('./controllers/header.php');

	$bedrijfs_id = $_GET['bedrijfs_id'];	
	$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
	$sth = $pdo->prepare('select * from bedrijfgegevens where bedrijfs_id = :bedrijfs_id');
	$sth->execute($parameters);
	$row = $sth->fetch();
	
	$specialarr = (explode(", ",$row['specialiteit']));
					
	$special = "'[[:<:]]".$specialarr[0]."[[:>:]]|";
	$special .= "[[:<:]]".$specialarr[1]."[[:>:]]|";
	$special .= "[[:<:]]".$specialarr[2]."[[:>:]]|";
	$special .= "[[:<:]]".$specialarr[3]."[[:>:]]|";
	$special .= "[[:<:]]".$specialarr[4]."[[:>:]]|";
	$special .= "[[:<:]]".$specialarr[5]."[[:>:]]'";

if ($row['premium'] == 'gold')
{	
?>
<div class="row">
	<div class="col-xs-12">
		<?php if(!empty($row['banner'])){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $row['banner']; ?>" width="100%" role="banner" /> <?php } ?>
	</div>
</div>
<div class="rand row">
	<div class="col-xs-12 naam-bedrijf">
		<?php echo $row['bedrijfsnaam']; ?>
	</div>
	
	<div class="col-xs-6 beschrijving">
	<?php if(!empty($row['logo'])){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $row['logo']; ?>" width="200px"><br> <?php } ?>
	<?php echo $row['beschrijving']; ?>
	<?php if(!empty($row['afbeelding'])){ ?> <img src="images/bedrijf_images/<?php echo$bedrijfs_id .'/'. $row['afbeelding']; ?>" width="500px"/><br /> <?php } ?>
	</div>
	
	<div class="col-xs-offset-1 col-xs-4 bedrijfSpecs">
		<table class="table">
			<tr>
				<td colspan="2" class="titel">Bedrijfsinfo</td>
			</tr>
			<tr>
				<td>Adres:</td><td><?php echo $row['adres']; ?></td>
			</tr>
			<tr>
				<td>Plaats:</td><td><?php echo $row['plaats']; ?></td>
			</tr>
			<tr>
				<td>Postcode:</td><td><?php echo $row['postcode']; ?></td>
			</tr>
			<tr>
				<td>Provincie:</td><td><?php echo $row['provincie']; ?></td>
			</tr>
			<tr>
				<td>Telefoon:</td><td><a href="tel:<?php echo $row['telefoon']; ?>"><?php echo $row['telefoon']; ?></a></td>
			</tr>
			<tr>
				<td>Fax:</td><td><?php echo $row['fax']; ?></td>
			</tr>
			<tr>
				<td>Email:</td><td><a href="mailto:<?php echo $row['bedrijfs_email']; ?>&subject=Contact via TransportPlaza"><?php echo $row['bedrijfs_email']; ?></a></td>
			</tr>
			<tr>
				<td>Website:</td><td><a href="http://<?php echo $row['website']; ?>" target="_blank" alt="<?php echo $row['bedrijfsnaam']; ?>"><?php echo $row['website']; ?></a></td>
			</tr>
			<tr>
				<td>Transport Manager:</td><td><?php echo $row['transport_manager']; ?></td>
			</tr>
			<tr>
				<td>Specialiteit:</td><td>
				<?php 
				
				
				$sth = $pdo->prepare('SELECT * FROM specialiteiten WHERE specialiteit_id REGEXP '.$special);
				$sth->execute($parameters);
				$specialiteiten = NULL;
				while($row = $sth->fetch())
				{
				$specialiteiten .= $row['specialiteit'].'<br>'; 
				}
				$specialiteiten = substr($specialiteiten, 0, -4);
				echo $specialiteiten;
				
				?></td>
			</tr>
		</table>
	</div>
</div>
<?php
}
else
{
	header("Refresh: ;URL=index.php");
}

require('./controllers/footer.php');
?>
