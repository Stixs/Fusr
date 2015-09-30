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
				<td>Email:</td><td><a href="mailto:<?php echo $row['bedrijfs_email']; ?>&subject=Contact via Fusr"><?php echo $row['bedrijfs_email']; ?></a></td>
			</tr>
			<tr>
				<td>Website:</td><td><a href="http://<?php echo $row['website']; ?>" target="_blank" alt="<?php echo $row['bedrijfsnaam']; ?>"><?php echo $row['website']; ?></a></td>
			</tr>
			<?php
			//if(isset
			//{
			?>
			<tr>
				<td>Social media</td>
				<td>
					<table>
						<?php 
						
						?>
						<tr>
							<td>
								<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
							</td>
						</tr>
						<?php
						
						?>
						<tr>
							<td>
								<a data-pin-do="embedPin" href="https://www.pinterest.com/pin/99360735500167749/"></a>
								<!-- Please call pinit.js only once per page -->
								<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
							</td>
						</tr>
						<?php
						
						?>
						<tr>
							<td>
								<a href="https://twitter.com/share" class="twitter-share-button" data-counturl="<?php echo $row[''];?>" >Tweet</a>
							</td>
						</tr>
						<?php
							
						?>
						<tr>
							<td>
								<div class="g-plusone" data-annotation="none" data-size="tall" data-url="<?php echo $row['']; ?>" ... ></div>
							</td>
						</tr>
						<?php
						
						?>
						<tr>
							<td>
								<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
								<script type="IN/Share" data-url="<?php echo $row['']; ?>" data-counter="top"></script>
							</td>
						</tr>
						<?php
						
						?>
						<tr>
							<td>
								<span class="ig-follow" data-id="5479dee" data-handle="igfbdotcom" data-count="true" data-size="large" data-username="true"></span>
							</td>
						</tr>
						<?php
						
						?>
					</table>
				</td>
			</tr>
			<?php 
			//}
			?>
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
		<div class="col-xs-12">
			<!-- video -->
		</div>
	</div>
	<div class="col-xs-12">
		<?php include_once('./controllers/sm_buttons.php'); ?>
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
