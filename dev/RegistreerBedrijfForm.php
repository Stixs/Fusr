	<div id="register">
	<h1>Registreren</h1>
	<form name="RegistratieFormulier" action="" method="post">
	<table>
		<tr>
		<td><label for="Gebruikersnaam">Gebruikersnaam:</label></td><td><input type="text" id="Gebruikersnaam" name="Username" value="<?php echo $Username; ?>"  size="30"/></td>
		</tr>
		<tr>
		<td><label for="Wachtwoord">Wachtwoord:</label></td><td><input type="text" id="Wachtwoord" name="Password" value="<?php echo $Password; ?>"  size="30"/></td>
		</tr>
		<tr>
		<td><label for="Email">E-mail:</label></td><td><input type="text" id="email" name="email" value="<?php echo $email; ?>" size="30"/></td><td>
		</tr>
		<tr>		
		<td><input type="submit" name="Registreerbedrijf" value="Registreer!" /></td>
		</tr>
	</table>
	</form>
	</div>
