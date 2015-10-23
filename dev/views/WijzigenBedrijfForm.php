<?php $aan = 1; ?>
<div class="row">
<div class="ContentPadding">
	<div class="col-xs-12">
		<h1>Wijzigen</h1>
		<form name="WijzigenFormulier" class="wijzigen" action="" method="post" enctype="multipart/form-data">
			<div class="col-xs-12 col-md-6">
				<div class="form-group">
					<label for="Bedrijfsnaam">Bedrijfsnaam:</label>
					<input type="text" class="form-control" id="bedrijf_naam" name="Bedrijfsnaam" value="<?php echo $bedrijfsnaam; ?>" />
					<?php echo $NameErr; ?>
				</div>
					
				<div class="form-group">
					<label for="Adres">Bezoekadres:</label>
					<input type="text" class="form-control" id="Adres" name="adres" value="<?php echo $bezoekadres; ?>"  />
				</div>
					
				<div class="form-group">
					<label for="Postcode">Postcode:</label>
					<input type="text" class="form-control" id="Postcode" name="postcode" value="<?php echo $postcode; ?>"  />
					<?php echo $ZipErr; ?>
				</div>
					
				<div class="form-group">
					<label for="Plaats">Plaats:</label>
					<input type="text" class="form-control" id="Plaats" name="plaats" value="<?php echo $plaats; ?>"  />
					<?php echo $CityErr; ?>
				</div>
					
				<div class="form-group">
					<label for="provincies">provincie:</label>
					<input type="text" class="form-control" id="provincie" name="provincie" value="<?php echo $provincie; ?>"  />
				</div>
					
				<div class="form-group">
					<label for="Telefoon">Telefoonnummer:</label>
					<input type="text" class="form-control" id="Telefoon" name="telefoon" value="<?php echo $telefoonnummer; ?>"  />
					<?php echo $TelErr; ?>
				</div>
					
				<div class="form-group">
					<label for="Fax">Mobielnummver:</label>
					<input type="text" class="form-control" id="Fax" name="fax" value="<?php echo $mobielnummer; ?>"  />
				</div>
					
				<div class="form-group">
					<label for="Email">E-mail:</label>
					<input type="text" class="form-control" id="bedrijfs_email" name="bedrijfs_email" value="<?php echo $email ?>" />
					<?php echo $MailErr; ?>
				</div>
				
				<div class="form-group">
					<label for="Weblink">Website:</label>
					<input input="text" class="form-control" id="website" name="website" value="<?php echo $website; ?>" />
				</div>				
				<div class="form-group">
					<label for="banner">Banner:</label>
					
					<?php if(empty($row['banner'])){ ?><input type="file" class="form-control" id="banner" name="banner" /><?php } ?>
					
					<?php if(!empty($row['banner'])){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $row['banner']; ?>" width="70px" role="banner" />
					<button class="btn btn-danger" type="submit" name="Del_Image" value="banner" />Verwijder</button> <?php } ?>
				</div>
				<div class="form-group">
					<label for="logo">Logo:</label>
					
					<?php if(empty($row['logo'])){ ?><input type="file" class="form-control" id="logo" name="logo" /> <?php } ?>
					
					<?php if(!empty($row['logo'])){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $row['logo']; ?>" width="70px" role="logo" />
					<button class="btn btn-danger" type="submit" name="Del_Image" value="logo" />Verwijder</button> <?php } ?>
				</div>
				<div class="form-group">
					<label for="foto">Foto:</label>
					<?php if(empty($row['afbeelding'])){ ?><input type="file" class="form-control" id="foto" name="foto" /> <?php } ?>
					<?php if(!empty($row['afbeelding'])){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $row['afbeelding']; ?>" width="70px" role="picture" />
					<button class="btn btn-danger" type="submit" name="Del_Image" value="afbeelding" />Verwijder</button> <?php } ?>
				</div>
					
			<div class="form-group">
					<label for="Facebook">Facebook:</label>
					<input type="text" class="form-control" id="Facebook" name="Facebook" value="<?php echo $facebook; ?>"  />
			</div>
		
			<div class="form-group">
					<label for="Twitter">Twitter:</label>
					<input type="text" class="form-control" id="Twitter" name="Twitter" value="<?php echo $twitter; ?>"  />
			</div>
					
			<div class="form-group">
					<label for="Google">Google+:</label>
					<input type="text" class="form-control" id="Google" name="Google" value="<?php echo $googleplus; ?>"  />
			</div>
			
			<div class="form-group">
					<label for="LinkedIn">LinkedIn:</label>
					<input type="text" class="form-control" id="LinkedIn" name="LinkedIn" value="<?php echo $linkedin; ?>"  />
			</div>
					
			<div class="form-group">
					<label for="Instagram">Youtube:</label>
					<input type="text" class="form-control" id="Instagram" name="Instagram" value="<?php echo $youtube; ?>"  />
			</div>
			
			<div class="form-group">
					<label for="Pinterest">Pinterest:</label>
					<input type="text" class="form-control" id="Pinterest" name="Pinterest" value="<?php echo $pinterest; ?>"  />
			</div>
			
			
			
			</div>
			<?php
				$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
				$sth = $pdo->prepare('select * from bedrijfs_specialiteiten where bedrijfs_id = :bedrijfs_id');
				$sth->execute($parameters);
				$row = $sth->fetch();
			?>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 1, $row['naam[0]'], $branche_id);
					
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 2, $row['specialiteit_2'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 3, $row['specialiteit_3'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 4, $row['specialiteit_4'], $branche_id); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 5, $row['specialiteit_5'], $branche_id); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 6, $row['specialiteit_6'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 7, $row['specialiteit_7'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 8, $row['specialiteit_8'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 9, $row['specialiteit_9'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 10, $row['specialiteit_10'], $branche_id); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 11, $row['specialiteit_11'], $branche_id); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 12, $row['specialiteit_12'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 13, $row['specialiteit_13'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 14, $row['specialiteit_14'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 15, $row['specialiteit_15'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 16, $row['specialiteit_16'], $branche_id); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 17, $row['specialiteit_17'], $branche_id); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 18, $row['specialiteit_18'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 19, $row['specialiteit_19'], $branche_id);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 20, $row['specialiteit_20'], $branche_id);
					?>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6">
				
				
				<div class="form-group">
					<label for="premium">Premium</label>
					<div class="radio">
						<?php
						if($premium == 'brons')
						{
						?>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_nee"  value="0" />
							nee
						</label>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_brons" value="brons" checked />
							brons
						</label>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_gold" value="gold" />
							gold
						</label>
						<?php
						}
						elseif($premium == 'gold')
						{
						?>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_nee"  value="0" />
							nee
						</label>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_brons" value="brons" />
							brons
						</label>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_gold" value="gold" checked />
							gold
						</label>
						<?php
						}
						else
						{
						?>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_nee"  value="0" checked />
							nee
						</label>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_brons" value="brons" />
							brons
						</label>
						<label class="radio-inline">
							<input type="radio" name="premium" id="premium_gold" value="gold" />
							gold
						</label>
						<?php
						}
						?>
					</div>
				</div>
			
				<div class="form-group">
					<label for="openingestijden">Openingstijden</label>
					
				</div>
				
					<div class="formgroup">
						<div class="col-xs-6">
						<label>Maandag</label>
						</div>
						<div class="col-xs-6">
						<label>Vrijdag</label>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($o_maandag, 'o_maandag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($d_maandag, 'd_maandag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($o_vrijdag, 'o_vrijdag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($d_vrijdag, 'd_vrijdag') ?>
						</div>
					</div>
					<div class="formgroup">
						<div class="col-xs-6">
						<label>Dinsdag</label>
						</div>
						<div class="col-xs-6">
						<label>Zaterdag</label>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($o_dinsdag, 'o_dinsdag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($d_dinsdag, 'd_dinsdag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($o_zaterdag, 'o_zaterdag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($d_zaterdag, 'd_zaterdag') ?>
						</div>
					</div>
					<div class="formgroup">
						<div class="col-xs-6">
						<label>Woensdag</label>
						</div>
						<div class="col-xs-6">
						<label>Zondag</label>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($o_woensdag, 'o_woensdag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($d_woensdag, 'd_woensdag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($o_zondag, 'o_zondag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($d_zondag, 'd_zondag') ?>
						</div>
					</div>
					<div class="formgroup">
						<div class="col-xs-12">
						<label>Donderdag</label>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($o_donderdag, 'o_donderdag') ?>
						</div>
						<div class="col-xs-3">
							<?php echo openingstijden($d_donderdag, 'd_donderdag') ?>
						</div>
						</div>
					</div>
					
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label for="beschrijving">Beschrijving:</label>
					<textarea id="beschrijving" class="form-control" name="beschrijving" rows="5" ><?php echo $beschrijving; ?></textarea>
					<script>
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace( 'beschrijving' );
					</script>
				</div>
			</div>
			<div class="col-xs-12" style="padding-bottom:40px;">
				<button class="btn btn-default" type="submit" name="Wijzigenbedrijf" value="Wijzigen!" />Wijzigen</button>
			</div>
		</form>
	</div>
	</div>
</div>