<div class="row">
	<div class="col-xs-12 ContentPadding">
		<h1>Registreren</h1>
		<div class="col-xs-6 col-xs-offset-6">
	
		<form name="RegistrerenFormulier" class="registreren" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="text" class="form-control" id="specialiteit" name="add_specialiteit" placeholder="Specialiteit">
				<button type="submit" name="add_spec" class="btn btn-default">Toevoegen</button>
			</div>
		
	</div>
		<form name="RegistrerenFormulier" class="registreren" action="" method="post" enctype="multipart/form-data">
			<div class="col-xs-12 col-md-6">
				<div class="form-group">
					<?php echo branchekeuze($pdo, 'branche', 1); ?>
				</div>
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
					<input type="file" class="form-control" id="banner" name="banner" />
				</div>
				<div class="form-group">
					<label for="logo">Logo:</label>
					<input type="file" class="form-control" id="logo" name="logo" />
				</div>
				<div class="form-group">
					<label for="foto">Foto:</label>
					<input type="file" class="form-control" id="foto" name="foto" />
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
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 1, $specialiteit_1);
					
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 2, $specialiteit_2);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 3, $specialiteit_3);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 4, $specialiteit_4); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 5, $specialiteit_5); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 6, $specialiteit_6);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 7, $specialiteit_7);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 8, $specialiteit_8);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 9, $specialiteit_9);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 10, $specialiteit_10); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 11, $specialiteit_11); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 12, $specialiteit_12);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 13, $specialiteit_13);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 14, $specialiteit_14);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 15, $specialiteit_15);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 16, $specialiteit_16); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 17, $specialiteit_17); 
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 18, $specialiteit_18);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 19, $specialiteit_19);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					echo specialiteitkeuze($pdo, 'specialiteit[]', 20, $specialiteit_20);
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
			<div class="col-xs-12">
				<button class="btn btn-default" type="submit" name="Registrerenbedrijf" value="Registreren!" />Registreren</button>
			</div>
		</form>
	</div>
</div>