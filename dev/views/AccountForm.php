<?php $aan = 1; ?>
<div class="row">
	<div class="ContentPadding">
		<div class="col-xs-12">
			<h1>Wijzigen</h1>
			<form name="WijzigenFormulier" class="wijzigen" action="" method="post" enctype="multipart/form-data">
				<div class="col-xs-12 col-md-6">
				
					<div class="form-group">
						<label for="Bedrijfsnaam">Wijzig inlognaam:</label>
						<input type="text" class="form-control" id="bedrijf_naam" name="inlognaam" value="<?php echo $inlognaam; ?>" />
						<?php echo '<h5 style="color:red;margin:0px;font-size:15px">'. $InlogErr. '</h5>'; ?>
					</div>
					<hr>
					<div class="form-group">
						<label for="Adres">Wijzig emailadres:</label>
						<input type="text" class="form-control" id="Adres" name="emailadres" value="<?php echo $emailadres; ?>"  />
					</div>
					<hr>
					<div class="form-group">
						<label for="Postcode">Nieuw wachtwoord:</label>
						<input type="text" class="form-control" id="Postcode" name="N_wachtwoord" value="" />
						<?php echo '<h5 style="color:red;margin:0px;font-size:15px">'. $nieuwErr. '</h5>'; ?>
					</div>
					<div class="form-group">
						<label for="Postcode">Herhaal wachtwoord:</label>
						<input type="text" class="form-control" id="Postcode" name="H_wachtwoord" value="" />
						<?php echo '<h5 style="color:red;margin:0px;font-size:15px">'. $herhaalErr. '</h5>'; ?>
					</div>
					
					
					<hr>
					
					<div class="form-group">
						<label for="Postcode">Huidig wachtwoord:</label>
						<input type="text" class="form-control" id="Postcode" name="O_wachtwoord" value="" />
						<?php echo '<h5 style="color:red;margin:0px;font-size:15px">'. $oudErr. '</h5>'; ?>
					</div>
					
					
					<div class="col-xs-12" style="padding-bottom:40px;">
						<button class="btn btn-default" type="submit" name="Wijzigen" value="Wijzigen" />Wijzigen</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>