	<div id="register">
	<h1>Registreren</h1>
	<form name="RegistratieFormulier" action="" method="post">
	<table>
		<tr>
		<td><label for="FirstName">Bedrijfsnaam:</label></td><td><input type="text" id="bedrijf_naam" name="Bedrijfsnaam" value="<?php echo $bedrijf_naam; ?>" size="30"/></td>
		</tr>
		<tr>
		<td><label for="Adres">Adres:</label></td><td><input type="text" id="Adres" name="adres" value="<?php echo $adres; ?>"  size="30"/></td>
		</tr>
		<tr>
		<td><label for="Postcode">Postcode:</label></td><td><input type="text" id="Postcode" name="postcode" value="<?php echo $postcode; ?>"  size="30"/></td>
		</tr>
		<tr>		
		<td><label for="Plaats">Plaats:</label></td><td><input type="text" id="Plaats" name="plaats" value="<?php echo $plaats; ?>"  size="30"/></td>
		</tr>
		<tr>		
		<td><label for="Land">Land:</label></td><td><input type="text" id="Land" name="land" value="<?php echo $land; ?>"  size="30"/></td>
		</tr>
		<tr>		
		<td><label for="Telefoon">Telefoon:</label></td><td><input type="text" id="Telefoon" name="telefoon" value="<?php echo $telefoon; ?>"  size="30"/></td>
		</tr>
		<tr>		
		<td><label for="Fax">Fax:</label></td><td><input type="text" id="Fax" name="fax" value="<?php echo $fax; ?>"  size="30"/></td>
		</tr>
		<tr>		
		<td><label for="Type">Type:</label></td><td><input type="text" id="Type" name="type" value="<?php echo $type; ?>"  size="30"/></td>
		</tr>
		<tr>		
		<td><label for="Naar">Naar:</label></td><td><input type="text" id="Naar" name="naar" value="<?php echo $naar; ?>"  size="30"/></td>
		</tr>
		<tr>		
		<td><label for="Specialiteit">Specialiteit:</label></td><td><input type="text" id="Specialiteit" name="specialiteit" value="<?php echo $specialiteit; ?>"  size="30"/></td>
		</tr>
		<tr>
		<td><label for="Email">Bedrijfs E-mail:</label></td><td><input type="text" id="Email" name="bedrijf_email" value="<?php echo $bedrijf_email; ?>"  size="30"/></td><td>
		</tr>
		<tr>
		<td><label for="Gebruikersnaam">Gebruikersnaam:</label></td><td><input type="text" id="Gebruikersnaam" name="Username" value="<?php echo $Username; ?>"  size="30"/></td>
		</tr>
		<tr>
		<td><label for="Wachtwoord">Wachtwoord:</label></td><td><input type="text" id="Wachtwoord" name="Password" value="<?php echo $Password; ?>"  size="30"/></td>
		</tr>
		<tr>
		<td><label for="Email">E-mail:</label></td><td><input type="text" id="Email" name="email" value="<?php echo $email; ?>" size="30"/></td><td>
		</tr>
		<tr>		
		<td><input type="submit" name="Registreerbedrijf" value="Registreer!" /></td>
		</tr>
	</table>
	</form>
	</div>
