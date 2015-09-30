<?php

/** De functie RedirectNaarPagina
  * optionele parameter paginanr. Hiermee kun je de gebruiker naar
  * iedere gewenste pagina doorsturen
  */
/*function RedirectNaarPagina($paginanr = NULL)
{
	if(!isset($paginanr))
	{
		echo "<br />U word binnen 5 seconden doorgestuurd naar de hoofdpagina.";
		header("Refresh: 4;URL=index.php");
	} 
	else
		header("Location: index.php");
}
*/
/** De functie LoginCheck
  * controleert of de gebruiker is ingelogd
  */
function LoginCheck($pdo) 
{
    // Controleren of Sessie variabelen bestaan
    if (isset($_SESSION['user_id'], $_SESSION['username'],                    $_SESSION['login_string'])) 
	{
        $gebruiker_id = $_SESSION['user_id'];
        $Login_String = $_SESSION['login_string'];
        $Username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
		$parameters = array(':gebruiker_id'=>$gebruiker_id);
		$sth = $pdo->prepare('SELECT wachtwoord FROM gebruikers WHERE gebruiker_id = :gebruiker_id LIMIT 1');
 
       	$sth->execute($parameters);

		// controleren of de klant voorkomt in de DB
		if ($sth->rowCount() == 1) 
		{
			// Variabelen inlezen uit query
			$row = $sth->fetch();

			//check maken
		    $Login_Check = hash('sha512', $row['wachtwoord'] . $user_browser);
 
				//controleren of check overeenkomt met sessie
                if ($Login_Check == $Login_String)
					return true;
                else 
                   return false;
         } else 
              return false;         
     } else 
          return false;
}

/* Functies voor validatie van Form Fields */

/** Controleert een email adres op geldigheid
  * @return  boolean
  */
  function is_email($Invoer)
  {
	 return (bool)(preg_match("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^",$Invoer));
   }


  /** Controleert of een string aan de minimum lengte voldoet
  * @return  boolean
  */
  function is_minlength($Invoer, $MinLengte)
  {
	return (strlen($Invoer) >= (int)$MinLengte);
  }

  /** Controleert of invoer een NL postcode is
  * @return  boolean
  */
  function is_NL_PostalCode($Invoer)
  {
	return (bool)(preg_match('#^[1-9][0-9]{3}\h*[A-Z]{2}$#i', $Invoer));
  }

  /** Controleert of invoer een NL telefoonnr is
  * @return  boolean
  */
  function is_NL_Telnr($Invoer)
  {
	return (bool)(preg_match('#^0[1-9][0-9]{0,2}-?[1-9][0-9]{5,7}$#', $Invoer) 
               && (strlen(str_replace(array('-', ' '), '', $Invoer)) == 10));
  }


/** Controleert of invoer alleen uit letters bestaat
  * @return  boolean
  */
  function is_Char_Only($Invoer)
  {
	return (bool)(preg_match("/^[a-zA-Z ]*$/", $Invoer)) ;
  }

/** functie die controleert of een gebruikersnaam wel of niet in de database		  * voorkomt.
  */
  function is_Username_Unique($Invoer,$pdo)
  {
	$parameters = array(':Username'=>$Invoer);
	$sth = $pdo->prepare('SELECT gebruiker_id FROM klanten WHERE Inlognaam = :Username LIMIT 1');

	$sth->execute($parameters);

	// controleren of de username voorkomt in de DB
	if ($sth->rowCount() == 1) 
		return false;//username komt voor
	else
		return true;//username komt niet voor
  }

function Pre_Select($name, $options, $optionToSelect, $id) {
	$html = '<label for="sel'.$id.'">Specialiteiten:</label>';
    $html .= '<select class="form-control" id="sel'.$id.'" name="'.$name.'">';
    foreach ($options as $option => $value) {
        if($value == $optionToSelect)
            $html .= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
        else
            $html .= '<option value="'.$value.'">'.$value.'</option>';
    }
    $html .= '</select>';
    return $html;
}

function Dropdown($name, $options, $id) {
	$html = '<label for="sel'.$id.'">Specialiteiten:</label>';
    $html .= '<select class="form-control" id="sel'.$id.'" name="'.$name.'">';
    foreach ($options as $option => $value) {
            $html .= '<option value="'.$value.'">'.$value.'</option>';
    }
    $html .= '</select>';
    return $html;
}
function branchelijst($pdo) {
	$branches = array("");
	$sth = $pdo->prepare('select branche_name from branche');
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
		
	$branches = array_merge($branches, $result);
	return $branches;
} 

function specialiteitenlijst($pdo) {
	$specialiteiten = array("");
	$sth = $pdo->prepare('select specialiteit from specialiteiten');
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
		
	$specialiteiten = array_merge($specialiteiten, $result);
	return $specialiteiten;
}  

function branchekeuze($pdo, $name, $id, $keuze = NULL) {
	$html = '<label for="sel'.$id.'">Branche</label>';
    $html .= '<script type="text/javascript">
								function lastselected(value)
								{
									window.location.href = "http://www.thuisserver.org/style/index.php?paginanr=5&branche=" + value ;
								}
								</script>
								
								<select class="form-control" id="sel'.$id.'" name="'.$name.'" value="'.$name.'" onchange="lastselected(this.value)">';	
	$sth = $pdo->prepare('select * from branche');
		$sth->execute();
			$branche_id = $_GET["branche"];
			if ($branche_id==""){$branche_id=1;}
			while($row = $sth->fetch())
				{
					
					if($row['branche_id'] == $branche_id)
					{
						$html .= '<option value="'.$row['branche_id'].'" selected="selected">'.$row['branche_name'].'</option>';
					}
					else
					{
						$html .= '<option value="'.$row['branche_id'].'">'.$row['branche_name'].'</option>';
					}
				}
	$html .= '</select>';
    return $html;
}

function getBranche()
{
	$tmp = $_GET["branche"];
	if ($tmp==""){$tmp=1;}
	return $tmp;
}

function specialiteitkeuze($pdo, $name, $id, $keuze = NULL) {
	$active_branche = getBranche();
	$html = '<label for="sel'.$id.'">Specialiteiten:</label>';
    $html .= '<select class="form-control" id="sel'.$id.'" name="'.$name.'">';	
	$sth = $pdo->prepare('select * from specialiteiten where branche_id = '.$active_branche);
		$sth->execute();
			
			while($row = $sth->fetch())
				{
					
					if($row['specialiteit_id'] == $keuze)
					{
						$html .= '<option value="'.$row['specialiteit_id'].'" selected="selected">'.$row['specialiteit'].'</option>';
					}
					else
					{
						$html .= '<option value="'.$row['specialiteit_id'].'">'.$row['specialiteit'].'</option>';
					}
				}
	$html .= '</select>';
    return $html;
}

function friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '', $string);
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '', $string);
    return strtolower(trim($string, '-'));
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}



function getCoordinates($address){
 
$address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
 
$url = "https://maps.google.com/maps/api/geocode/json?sensor=false&address=$address&key=AIzaSyDR4VX5begZLhQfll5UrHZrklwVBMR8fd4";
 
$response = file_get_contents($url);
 
$json = json_decode($response,TRUE); //generate array object from the response from the web
 
return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
 
}



?>
