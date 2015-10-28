<?php $aan = 1; ?>
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
					<?php echo branchekeuze($pdo, 'branche', 1, null); ?>
				</div>
				<div class="form-group">
					<label for="Bedrijfsnaam">Bedrijfsnaam:</label>
					<input type="text" class="form-control" id="bedrijf_naam" name="bedrijfsnaam" value="<?php echo $bedrijfsnaam; ?>" />
					<?php echo $NameErr; ?>
				</div>
			<div class="col-xs-8 no-padding-left">	
				<div class="form-group">
					<label for="Adres">Adres:</label>
					<input type="text" class="form-control" id="Adres" name="adres" value="<?php echo $adres; ?>"  />
				</div>
			</div>
			<div class="col-xs-4 no-padding-right">	
				<div class="form-group">
					<label for="toevoeging">Toevoeging:</label>
					<input type="text" class="form-control" id="toevoeging" name="toevoeging" value="<?php echo $toevoeging; ?>"  />
				</div>
			</div>
			<div class="col-xs-8 no-padding-left">	
				<div class="form-group">
					<label for="Plaats">Plaats:</label>
					<input type="text" class="form-control" id="Plaats" name="plaats" value="<?php echo $plaats; ?>"  />
					<?php echo $CityErr; ?>
				</div>
			</div>
			<div class="col-xs-4 no-padding-right">	
				<div class="form-group">
					<label for="Postcode">Postcode:</label>
					<input type="text" class="form-control" id="Postcode" name="postcode" value="<?php echo $postcode; ?>"  />
					<?php echo $ZipErr; ?>
				</div>
			</div>
				<div class="form-group">
					<label for="Telefoon">Telefoon:</label>
					<input type="text" class="form-control" id="Telefoon" name="telefoonnummer" value="<?php echo $telefoonnummer; ?>"  />
					<?php echo $TelErr; ?>
				</div>
					
				<div class="form-group">
					<label for="mobiel">Mobielnummer:</label>
					<input type="text" class="form-control" id="mobiel" name="mobielnummer" value="<?php echo $mobielnummer; ?>"  />
				</div>
					
				<div class="form-group">
					<label for="email">E-mailadres:</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" />
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
					<input type="text" class="form-control" id="Facebook" name="facebook" value="<?php echo $facebook; ?>"  />
				</div>
			
				<div class="form-group">
						<label for="Twitter">Twitter:</label>
						<input type="text" class="form-control" id="Twitter" name="twitter" value="<?php echo $twitter; ?>"  />
				</div>
						
				<div class="form-group">
						<label for="Google">Google+:</label>
						<input type="text" class="form-control" id="Google" name="googleplus" value="<?php echo $googleplus; ?>"  />
				</div>
				
				<div class="form-group">
						<label for="LinkedIn">LinkedIn:</label>
						<input type="text" class="form-control" id="LinkedIn" name="linkedin" value="<?php echo $linkedin; ?>"  />
				</div>
						
				<div class="form-group">
						<label for="youtube">YouTube:</label>
						<input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $youtube; ?>"  />
				</div>
				
				<div class="form-group">
						<label for="Pinterest">Pinterest:</label>
						<input type="text" class="form-control" id="Pinterest" name="pinterest" value="<?php echo $pinterest; ?>"  />
				</div>
				
				
			</div>

			<div class="col-xs-3">
				<div class="form-group">
					<?php
					if(!isset($naam[0])){
						$naam[0] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[0]);
					
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[1])){
						$naam[1] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[1]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[2])){
						$naam[2] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[2]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[3])){
						$naam[3] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[3]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[4])){
						$naam[4] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[4]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[5])){
						$naam[5] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[5]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[6])){
						$naam[6] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[6]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[7])){
						$naam[7] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[7]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[8])){
						$naam[8] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[8]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[9])){
						$naam[9] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[9]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[10])){
						$naam[10] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[10]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[11])){
						$naam[11] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[11]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[12])){
						$naam[12] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[12]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[13])){
						$naam[13] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[13]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[14])){
						$naam[14] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[14]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[15])){
						$naam[15] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[15]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[16])){
						$naam[16] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[16]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[17])){
						$naam[17] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[17]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[18])){
						$naam[18] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[18]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[19])){
						$naam[19] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, false, 'specialiteit[]', 1, $naam[19]);
					?>
				</div>
			</div>
				<div class="col-xs-12 col-md-6">
				
				
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