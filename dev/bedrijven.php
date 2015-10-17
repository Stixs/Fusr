<?php

require('./controllers/header.php');
	$bedrijfs_id = $_GET['bedrijfs_id'];
	
	$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
	$sth = $pdo->prepare('select * from openingstijden where bedrijfs_id = :bedrijfs_id');
	$sth->execute();
	$row = $sth->fetch();
	

		
	$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
	$sth = $pdo->prepare('select * from bedrijfgegevens where bedrijfs_id = :bedrijfs_id');
	$sth->execute($parameters);
	$row = $sth->fetch();
	

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
			if ($row['Facebook'] == '' and $row['Twitter'] == '' and $row['Google'] == '' and $row['LinkedIn'] == '' and $row['Instagram'] == '' and $row['Pinterest'] == '' )
			{
			}
			Else
			{
			?>
			<tr>
			<td>Social media</td>
				<td>
					<?php
						if ($row['Facebook'] == '')
						{
						}
						Else
						{
						?>
							<a href="<?php echo $row['Facebook'] ?>" class="btn btn-social-icon btn-facebook social-edge">
								<i class="fa fa-facebook"></i>
							</a>
						<?php
						}
						
						if ($row['Twitter'] == '')
						{								
						}
						Else
						{
						?>
							<a href="<?php echo $row['Twitter'] ?>" class="btn btn-social-icon btn-twitter social-edge">
								<i class="fa fa-twitter"></i>
							</a>
						<?php
						}

						if ($row['Google'] == '')
						{									
						}
						Else
						{
						?>
							<a href="<?php echo $row['Google'] ?>" class="btn btn-social-icon btn-google social-edge">
								<i class="fa fa-google"></i>
							</a>
						<?php
						}
	
						if ($row['LinkedIn'] == '')
						{						
						}
						Else
						{
						?>
							<a href="<?php echo $row['LinkedIn'] ?>" class="btn btn-social-icon btn-linkedin social-edge">
								<i class="fa fa-linkedin"></i>
							</a>
						<?php
						}
					
						if ($row['Instagram'] == '')
						{								
						}
						Else
						{
						?>
							<a href="<?php echo $row['Instagram'] ?>" class="btn btn-social-icon btn-instagram social-edge">
								<i class="fa fa-instagram"></i>
							</a>
						<?php
						}
						
						if ($row['Pinterest'] == '')
						{							
						}
						Else
						{
						?>
							<a href="<?php echo $row['Pinterest'] ?>" class="btn btn-social-icon btn-pinterest social-edge">
								<i class="fa fa-pinterest"></i>
							</a>
						<?php
						}
					?>
				</td>
			</tr>
			<?php 
			}
			
			?>
			<tr>
				<td>Transport Manager:</td><td><?php echo $row['transport_manager']; ?></td>
			</tr>
			<tr>
				<td>Specialiteit:</td><td>
				<?php 
				
				$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
				$sth = $pdo->prepare('SELECT * FROM bedrijfs_specialiteiten WHERE bedrijfs_id = :bedrijfs_id');
				$sth->execute($parameters);
				
				$row = $sth->fetch();
				for($count = 1; $count <= 20; $count++){
					if(!empty($row['specialiteit_'.$count])){
					echo $row['specialiteit_'.$count].', ';
					}
				}
				
				?>
				</td>
			</tr>
			<?php
			$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
			$sth = $pdo->prepare('SELECT * FROM openingstijden WHERE bedrijfs_id = :bedrijfs_id');
			$sth->execute($parameters);
			
			if(isset($row['o_maandag']) or isset($row['o_dinsdag']) or isset($row['o_woensdag']) or isset($row['o_donderdag']) or isset($row['o_vrijdag']) or isset($row['o_zaterdag']) or isset($row['o_zondag']))
			{
			?>
			<tr>
				<td>
					<table>
						<tr><td>Maandag</td><td><?php echo 'test'; ?></td></tr>
						<tr><td>Dinsdag</td><td><?php echo 'test'; ?></td></tr>
						<tr><td>Woensdag</td><td><?php echo 'test'; ?></td></tr>
						<tr><td>Donderdag</td><td><?php echo 'test'; ?></td></tr>
						<tr><td>vrijdag</td><td><?php echo 'test'; ?></td></tr>
						<tr><td>zaterdag</td><td><?php echo 'test'; ?></td></tr>
						<tr><td>zondag</td><td><?php echo 'test'; ?></td></tr>
					</table>
				<td>
			</tr>
			<?php
			}
			?>
		</table>
		<div class="col-xs-12">
			<!-- video -->
		</div>
	</div>
	<div class="col-xs-12">
		<?php include('./controllers/sm_buttons.php'); ?>
	</div>
</div>
<?php
}
else
{
	
	$bedrijfsnaam = $row['bedrijfsnaam'];
	$_SESSION['bedrijfsnaam'] = $bedrijfsnaam;
	?>
	<br />
	<div class="row">
		<div class="col-xs-4 col-xs-offset-4">
			De Bedrijfs pagina die probeert te berijken is opgeheven.<br />
			Als u hierna naar de bedrijven gids gaat dan komt de naam van het bedrijf dat u zocht komt in de zoek balk te staan.<br />
			<br />
			<a href="gids.php">Klik hier om naar de bedrijven gids toe te gaan.</a>
		</div>
	</div>
	<?php
}

require('./controllers/footer.php');
?>
