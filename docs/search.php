<?php

	mysql_connect("localhost:3306","zoeken","zoeken") or die("could not connect");
	mysql_select_db("jvbeek_zoek") or die("could not find db");
	$output ='';
	//collect
	if (isset($_POST['searchVal']))
	{
		$searchq= $_POST['searchVal'];
		
//		$output .= "s:".$searchq.'************';  
		//filter non 0-9 a-z
		//$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
		$query = mysql_query("SELECT * FROM Namen WHERE voornaam LIKE '%$searchq%' OR achternaam LIKE '%$searchq%' ") or die("could not search ");

		$count = mysql_num_rows($query);
		if ($count==0)
		{
			$output = 'There was no such results!';
		}else
		{
			$output .="Aantal =".$count."=";
			while($row = mysql_fetch_array($query))
			{
				$vnaam = $row['voornaam'];
				$tnaam = $row['tussenvoegsel'];
				$anaam = $row['achternaam'];
				$id = $row['id'];
				
				$output .= '<div>'.$vnaam.' '.$tnaam.' '.$anaam.'</div>';  
			}
		}
	}
	echo ($output);
?>