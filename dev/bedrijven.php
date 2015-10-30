<?php

require('./controllers/header.php');
	$bedrijfs_id = $_GET['bedrijfs_id'];
	

		
	$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
	$sth = $pdo->prepare('SELECT *
					FROM
					bedrijfgegevens_specialiteiten
					INNER JOIN
					specialiteiten on bedrijfgegevens_specialiteiten.specialiteiten_id = specialiteiten.id
					INNER JOIN
					bedrijfgegevens on bedrijfgegevens_specialiteiten.bedrijfgegevens_id = bedrijfgegevens.id
					INNER JOIN
					plaatsen on bedrijfgegevens.plaats_id = plaatsen.id
					WHERE
					bedrijfgegevens_id = '.$bedrijfs_id);
	$sth->execute($parameters);
	while($row = $sth->fetch())
		{
		$premium = $row['premium'];
		$facebook = $row['facebook'];
		$twitter = $row['twitter'];
		$googleplus = $row['googleplus'];
		$linkedin = $row['linkedin'];
		$youtube = $row['youtube'];
		$pinterest = $row['pinterest'];			
		$bedrijfsnaam = $row['bedrijfsnaam'];
		$beschrijving = $row['beschrijving'];
		$bezoekadres = $row['bezoekadres'];
		$postcode = $row['postcode'];
		$plaats = $row['plaats'];
		$provincie = $row['provincie'];
		$website = $row['website'];
		$telefoonnummer = $row['telefoonnummer'];
		$mobielnummer = $row['mobielnummer'];
		$email = $row['email'];
		$logo = $row['logo'];
		$banner = $row['banner'];
		$foto = $row['foto'];
		$specialiteiten[] = $row['naam'];
		}
	
	
$krpano = 0;
if ($premium == 'gold')
{
?>
<div class="row">
	<?php if($krpano == 1) { ?>
		<script src="embedpano.js"></script>
		
		<div id="pano" style="width:600px; height:400px;"></div>

		<script>
			embedpano({swf:"krpano.swf", xml:"pano.xml", target:"pano"});
		</script>
	<?php } else { ?>
	<div class="col-xs-12">
		<?php if(!empty($banner)){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $banner; ?>" width="100%" role="banner" /> <?php } ?>
	</div>
	<?php  } ?>
</div>
<div class="rand row">
	<div class="col-xs-12 naam-bedrijf">
		<?php echo $bedrijfsnaam; ?>
	</div>
	
	<div class="col-xs-6 beschrijving">
	<?php if(!empty($logo)){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $logo; ?>" width="200px"><br> <?php } ?>
	<?php echo $beschrijving; ?>
	<?php if(!empty($afbeelding)){ ?> <img src="images/bedrijf_images/<?php echo$bedrijfs_id .'/'. $afbeelding; ?>" width="500px"/><br /> <?php } ?>
	</div>
	
	<div class="col-xs-offset-1 col-xs-4 bedrijfSpecs">
		<table class="table">
			<tr>
				<td colspan="2" class="titel">Bedrijfsinfo</td>
			</tr>
			<tr>
				<td>Adres:</td><td><?php echo $bezoekadres; ?></td>
			</tr>
			<tr>
				<td>Plaats:</td><td><?php echo $plaats; ?></td>
			</tr>
			<tr>
				<td>Postcode:</td><td><?php echo $postcode; ?></td>
			</tr>
			<tr>
				<td>Provincie:</td><td><?php echo $provincie; ?></td>
			</tr>
			<tr>
				<td>Telefoon:</td><td><a href="tel:<?php echo $telefoonnummer; ?>"><?php echo $telefoonnummer; ?></a></td>
			</tr>
			<tr>
				<td>Mobiel:</td><td><a href="tel:<?php echo $mobielnummer; ?>"><?php echo $mobielnummer; ?></a></td>
			</tr>
			<tr>
				<td>Email:</td><td><a href="mailto:<?php echo $email; ?>&subject=Contact via Fusr"><?php echo $email; ?></a></td>
			</tr>
			<tr>
				<td>Website:</td><td><a href="http://<?php echo $website; ?>" target="_blank" alt="<?php echo $bedrijfsnaam; ?>"><?php echo $website; ?></a></td>
			</tr>
			<?php
			if ($facebook == '' and $twitter == '' and $googleplus == '' and $linkedin == '' and $youtube == '' and $pinterest == '' )
			{
			}
			Else
			{
			?>
			<tr>
			<td>Social media</td>
				<td>
					<?php
						if ($facebook == '')
						{
						}
						Else
						{
						?>
							<a href="<?php echo $facebook ?>" class="btn btn-social-icon btn-facebook social-edge">
								<i class="fa fa-facebook"></i>
							</a>
						<?php
						}
						
						if ($twitter == '')
						{								
						}
						Else
						{
						?>
							<a href="<?php echo $twitter ?>" class="btn btn-social-icon btn-twitter social-edge">
								<i class="fa fa-twitter"></i>
							</a>
						<?php
						}

						if ($googleplus == '')
						{									
						}
						Else
						{
						?>
							<a href="<?php echo $googleplus ?>" class="btn btn-social-icon btn-google social-edge">
								<i class="fa fa-google"></i>
							</a>
						<?php
						}
	
						if ($linkedin == '')
						{						
						}
						Else
						{
						?>
							<a href="<?php echo $linkedin
							?>" class="btn btn-social-icon btn-linkedin social-edge">
								<i class="fa fa-linkedin"></i>
							</a>
						<?php
						}
					
						if ($youtube == '')
						{								
						}
						Else
						{
						?>
							<a href="<?php echo $youtube ?>" class="btn btn-social-icon btn-instagram social-edge">
								<i class="fa fa-instagram"></i>
							</a>
						<?php
						}
						
						if ($pinterest == '')
						{							
						}
						Else
						{
						?>
							<a href="<?php echo $pinterest ?>" class="btn btn-social-icon btn-pinterest social-edge">
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
				<td>Specialiteit:</td><td>
				<?php 
				
				foreach ($specialiteiten as $value){
					if (end($specialiteiten) == $value)
						{
						echo $value;
						}
						else
						{
						echo $value.', ';
						}
					}
				
				
				
				
				
				?>
				</td>
			</tr>
		
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
	
	$bedrijfsnaam = $bedrijfsnaam;
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
