<?php $aan = 1; ?>
<div class="row">
<div class="ContentPadding">
	<div class="col-xs-12">
		<h1>Wijzigen</h1>
		<form name="WijzigenFormulier" class="wijzigen" action="" method="post" enctype="multipart/form-data">
			<div class="col-xs-12 col-md-6">
				<div class="form-group">
					<label for="Bedrijfsnaam">Bedrijfsnaam:</label>
					<input type="text" class="form-control" id="bedrijf_naam" name="bedrijfsnaam" value="<?php echo $bedrijfsnaam; ?>" />
					<?php echo $NameErr; ?>
				</div>
					
				<div class="form-group">
					<label for="Adres">Bezoekadres:</label>
					<input type="text" class="form-control" id="Adres" name="bezoekadres" value="<?php echo $bezoekadres; ?>"  />
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
					<input type="text" class="form-control" id="Telefoon" name="telefoonnummer" value="<?php echo $telefoonnummer; ?>"  />
					<?php echo $TelErr; ?>
				</div>
					
				<div class="form-group">
					<label for="mobielnummer">Mobielnummver:</label>
					<input type="text" class="form-control" id="mobielnummer" name="mobielnummer" value="<?php echo $mobielnummer; ?>"  />
				</div>
					
				<div class="form-group">
					<label for="email">E-mail:</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" />
					<?php echo $MailErr; ?>
				</div>
				
				<div class="form-group">
					<label for="Weblink">Website:</label>
					<input input="text" class="form-control" id="website" name="website" value="<?php echo $website; ?>" />
				</div>				
				<div class="form-group">
					<label for="banner">Banner:</label>
					
					<?php if(empty($banner)){ ?><input type="file" class="form-control" id="banner" name="banner" /><?php } ?>
					<?php if(!empty($banner)){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $banner; ?>" width="70px" role="banner" />
					<button class="btn btn-danger" type="submit" name="Del_Image" value="banner" />Verwijder</button> <?php } ?>
				</div>
				<div class="form-group">
					<label for="logo">Logo:</label>
					
					<?php if(empty($logo)){ ?><input type="file" class="form-control" id="logo" name="logo" /> <?php } ?>
					<?php if(!empty($logo)){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $logo; ?>" width="70px" role="logo" />
					<button class="btn btn-danger" type="submit" name="Del_Image" value="logo" />Verwijder</button> <?php } ?>
				</div>
				<div class="form-group">
					<label for="foto">Foto:</label>
					<?php if(empty($afbeelding)){ ?><input type="file" class="form-control" id="foto" name="foto" /> <?php } ?>
					<?php if(!empty($afbeelding)){ ?> <img src="images/bedrijf_images/<?php echo $bedrijfs_id .'/'. $afbeelding; ?>" width="70px" role="picture" />
					<button class="btn btn-danger" type="submit" name="Del_Image" value="afbeelding" />Verwijder</button> <?php } ?>
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
					<label for="Instagram">Youtube:</label>
					<input type="text" class="form-control" id="Instagram" name="youtube" value="<?php echo $youtube; ?>"  />
			</div>
			
			<div class="form-group">
					<label for="Pinterest">Pinterest:</label>
					<input type="text" class="form-control" id="Pinterest" name="pinterest" value="<?php echo $pinterest; ?>"  />
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
					if(!isset($naam[0])){
						$naam[0] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[0]);
					
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[1])){
						$naam[1] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[1]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[2])){
						$naam[2] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[2]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[3])){
						$naam[3] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[3]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[4])){
						$naam[4] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[4]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[5])){
						$naam[5] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[5]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[6])){
						$naam[6] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[6]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[7])){
						$naam[7] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[7]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[8])){
						$naam[8] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[8]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[9])){
						$naam[9] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[9]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[10])){
						$naam[10] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[10]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[11])){
						$naam[11] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[11]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[12])){
						$naam[12] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[12]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[13])){
						$naam[13] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[13]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[14])){
						$naam[14] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[14]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[15])){
						$naam[15] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[15]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[16])){
						$naam[16] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[16]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[17])){
						$naam[17] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[17]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[18])){
						$naam[18] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[18]);
					?>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="form-group">
					<?php 
					if(!isset($naam[19])){
						$naam[19] = null;}
					echo specialiteitkeuze($pdo, $subbranche_id, true, 'specialiteit[]', 1, $specialiteiten[19]);
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
			
				
					
					
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label for="beschrijving">Beschrijving:</label>
					<textarea id="beschrijving" class="form-control" name="beschrijving" rows="5" ><?php echo $beschrijving; ?></textarea>
					<script>
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