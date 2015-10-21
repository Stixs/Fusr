<?php
require('/connection.php');
$pdo = ConnectDB();
$sth = $pdo->prepare("SELECT * FROM bedrijfgegevens");
$sth->execute();
$count = 0;
while($row = $sth->fetch() and $count < 20)
{
	$count++;
	require('/Usernamegenerate.php');
	require('/Passwordgenerate.php');
	
	
	$Username= $username;
	$Password= $pw;
	
	$bedrijfs_id = $row['bedrijfs_id'];
	//maak unieke salt
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		//hash het paswoord met de Salt
		$Password = hash('sha512', $Password . $salt);

	

		$parameters = array(':bedrijfs_id'=>$bedrijfs_id,
							':Inlognaam'=>$Username,
							':Password'=>$Password,
							':salt'=>$salt,
							':level'=>5
							);
		$sth2 = $pdo->prepare('INSERT INTO gebruikers (gebruiker_id, bedrijfs_id, inlognaam, wachtwoord, salt, level) VALUES (:bedrijfs_id, :bedrijfs_id, :Inlognaam, :Password, :salt, :level)');
		$sth2->execute($parameters);
	    echo $pw;
	    echo $row['bedrijfs_id'].'</br>';
	
		
}

?> 