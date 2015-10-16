<?php $aan = 1; ?>
<div class="row">
<div class="ContentPadding">
	<div class="col-xs-12">
		<h1>Wijzigen</h1>
		<form name="WijzigenFormulier" class="wijzigen" action="" method="post" enctype="multipart/form-data">
			<div class="col-xs-12 col-md-6">
				<div class="form-group">
					<label for="Bedrijfsnaam">Bedrijfsnaam:</label>
					<input type="text" class="form-control" id="bedrijf_naam" name="Bedrijfsnaam" value="<?php echo $bedrijfs_naam; ?>" />
					<?php echo $NameErr; ?>
				</div>
					
				<div class="form-group">
					<label for="Adres">Adres:</label>
					<input type="text" class="form-control" id="Adres" name="adres" value="<?php echo $adres; ?>"  />
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
					<label for="Telefoon">Telefoon:</label>
					<input type="text" class="form-control" id="Telefoon" name="telefoon" value="<?php echo $telefoon; ?>"  />
					<?php echo $TelErr; ?>
				</div>
					
				<div class="form-group">
					<label for="Fax">Fax:</label>
					<input type="text" class="form-control" id="Fax" name="fax" value="<?php echo $fax; ?>"  />
				</div>
					
				<div class="form-group">
					<label for="Email">Bedrijfs E-mail:</label>
					<input type="text" class="form-control" id="bedrijfs_email" name="bedrijfs_email" value="<?php echo $bedrijfs_email ?>" />
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
					<input type="text" class="form-control" id="Facebook" name="Facebook" value="<?php echo $Facebook; ?>"  />
			</div>
		
			<div class="form-group">
					<label for="Twitter">Twitter:</label>
					<input type="text" class="form-control" id="Twitter" name="Twitter" value="<?php echo $Twitter; ?>"  />
			</div>
					
			<div class="form-group">
					<label for="Google">Google+:</label>
					<input type="text" class="form-control" id="Google" name="Google" value="<?php echo $Google; ?>"  />
			</div>
			
			<div class="form-group">
					<label for="LinkedIn">LinkedIn:</label>
					<input type="text" class="form-control" id="LinkedIn" name="LinkedIn" value="<?php echo $LinkedIn; ?>"  />
			</div>
					
			<div class="form-group">
					<label for="Instagram">Instagram:</label>
					<input type="text" class="form-control" id="Instagram" name="Instagram" value="<?php echo $Instagram; ?>"  />
			</div>
			
			<div class="form-group">
					<label for="Pinterest">Pinterest:</label>
					<input type="text" class="form-control" id="Pinterest" name="Pinterest" value="<?php echo $Pinterest; ?>"  />
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
					echo specialiteitkeuze($pdo, 'specialiteit[]', 1, $row['specialiteit_1']);
					
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 2, $row['specialiteit_2']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 3, $row['specialiteit_3']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 4, $row['specialiteit_4']); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 5, $row['specialiteit_5']); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 6, $row['specialiteit_6']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 7, $row['specialiteit_7']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 8, $row['specialiteit_8']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 9, $row['specialiteit_9']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 10, $row['specialiteit_10']); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 11, $row['specialiteit_11']); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 12, $row['specialiteit_12']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 13, $row['specialiteit_13']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 14, $row['specialiteit_14']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 15, $row['specialiteit_15']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 16, $row['specialiteit_16']); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 17, $row['specialiteit_17']); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 18, $row['specialiteit_18']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 19, $row['specialiteit_19']);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 20, $row['specialiteit_20']);
					?>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6">
				
					
					
				<div class="form-group">
					<label for="aantal">Aantal:</label>
					<input type="number" class="form-control" id="aantal" name="aantal" value="<?php echo $aantal; ?>"  />
				</div>
					
				<div class="form-group">
					<label for="transportmanager">Transport-manager:</label>
					<input type="text" class="form-control" id="transport_manager" name="transport_manager" value="<?php echo $transport_manager; ?>"  />
				</div>
				
				<div class="form-group">
					<label for="rechtsvorm">Rechtsvorm:</label>
					<input type="text" class="form-control" id="rechtsvorm" name="rechtsvorm" value="<?php echo $rechtsvorm; ?>"  />
				</div>
				
				<div class="form-group">
					<label for="vergunning">Vergunning:</label>
					<input type="text" class="form-control" id="vergunning" name="vergunning" value="<?php echo $vergunning ?>" />
				</div>
				
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
			<?php if($aan == 1) { ?>
				<div class="form-group">
					<label for="openingestijden">Openingstijden</label>
					<div class="radio">
						<?php 
						if($openingstijden =='ja')
						{
						?>
						<label class="radio-inline">
							<input type="radio" name="openingstijden" id="openingstijden_ja" value="ja" checked />
							Ja
						</label>
						<label class="radio-inline">
							<input type="radio" name="openingstijden" id="openingestijden_nee" value="nee" />
							nee
						</label>
						<?php
						}
						else
						{
						?>
						<label class="radio-inline">
							<input type="radio" name="openingstijden" id="openingstijden_ja" value="ja" />
							Ja
						</label>
						<label class="radio-inline">
							<input type="radio" name="openingstijden" id="openingestijden_nee" value="nee" checked />
							nee
						</label>
						<?php
						}
						?>
					</div>
				</div>
				
				<div class="col-xs-6">
					<div class="formgroup">
						<label for="otmaandag">Maandag:</label>
						<input type="text" class="form-control" name="maandag" id="otmaandag" value="<?php echo $otmaandag; ?>" />
					</div>
				</div>
				
				<div class="col-xs-6">
					<div class="formgroup">
						<label for="otdinsdag">Dinsdag:</label>
						<input type="text" class="form-control" name="dinsdag" id="otdinsdag" value="<?php echo $otdinsdag; ?>" />
					</div>
				</div>
				
				<div class="col-xs-6">
					<div class="formgroup">
						<label for="otwoensdag">Woensdag:</label>
						<input type="text" class="form-control" name="Woensdag" id="otWoensdag" value="<?php echo $otwoensdag; ?>" />
					</div>
				</div>
				
				<div class="col-xs-6">
					<div class="formgroup">
						<label for="otdonderdag">Donderdag:</label>
						<input type="text" class="form-control" name="donderdag" id="otdonderdag" value="<?php echo $otdonderdag; ?>" />
					</div>
				</div>
				
				<div class="col-xs-6">
					<div class="formgroup">
						<label for="otvrijdag">Vrijdag:</label>
						<input type="text" class="form-control" name="vrijdag" id="otvrijdag" value="<?php echo $otvrijdag; ?>" />
					</div>
				</div>
				
				<div class="col-xs-6">
					<div class="formgroup">
						<label for="otzaterdag">Zaterdag:</label>
						<input type="text" class="form-control" name="zaterdag" id="otzaterdag" value="<?php echo $otzaterdag; ?>" />
					</div>
				</div>
				
				<div class="col-xs-6">
					<div class="formgroup">
						<label for="otzondag">Zondag:</label>
						<input type="text" class="form-control" name="zondag" id="otzondag" value="<?php echo $otzondag; ?>" />
					</div>
				</div>
			<?php } ?>
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