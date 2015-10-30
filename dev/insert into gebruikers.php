<?php
require('./connection.php');
$pdo = ConnectDB();
$sth = $pdo->prepare("Select * from mail 
			inner join gebruikers on gebruiker_id = gebruikermail_id 
			inner join bedrijfgegevens on id = gebruikermail_id 
			where Mail_verstuurd = null");
	$sth->execute();
	
	

while($row = $sth->fetch())
{
	$bedrijfs_id = $row['id'];
	$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
	
	require('./Usernamegenerate.php');
	require('./Passwordgenerate.php');
	
	
	$Username= $username; 
	$Password= $pw;
	
	
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
	    
		$parameters = array(':bedrijfs_id'=>$bedrijfs_id);
		$sth3 = $pdo->prepare("Select email from bedrijfgegevens where id=:bedrijfs_id");
		$sth3->execute($parameters);
		$row2= $sth3->fetch();
		$email =$row2['email'];
		
		$datum = date("d/m/Y");

//De mailfunctie		
require_once 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               		// Enable verbose debug output

$mail->isSMTP();                                      		// Set mailer to use SMTP
$mail->Host = 'www.thuisserver.org';  				  		// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               		// Enable SMTP authentication
$mail->Username = 'Jeroentest@thuisserv.org';       		// SMTP username
$mail->Password = 'K00kb03k';                   			// SMTP password
$mail->SMTPSecure = 'tls';                            		// Enable TLS encryption, `ssl` also accepted
//$mail->Port = 587;                                    		// TCP port to connect to

$mail->setFrom('jeroentest@thuisserver.org', 'Jeroen');
$mail->addAddress($email);     								// Add a recipient
//$mail->addAddress('');               					  	// Name is optional
$mail->addReplyTo('jeroentest@thuisserver.org', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         	// Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    	// Optional name
$mail->isHTML(true);                                  		// Set email format to HTML

$mail->Subject = 'Uw account voor fusr';
$mail->Body    = 'Hierbij verstuur ik uw persoonlijk account voor fusr, Dit account is verbonden aan uw bedrijf</br>
				  Uw wachtwoord is:'.$pw.'</br>
				  Uw gebruikersnaam is:'. $username ;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 	
	else {
    echo 'Message has been sent';
	}
	$mail->ClearAllRecipients();
		
		
		
		$parameters = array(':gebruikermail_id'=>$bedrijfs_id,
							':Mail_verstuurd'=>$datum
							);
		$sth4 = $pdo->prepare("INSERT INTO mail (gebruikermail_id, Mail_verstuurd) VALUES (:gebruikermail_id, :Mail_verstuurd)");
		$sth4-> execute($parameters);
		echo $row['id'] . ' - ' . $pw . ' - ' . $username . ' - ' . $email . ' - ' . $datum . ' - asd' . $row['Mail_verstuurd'] . '<br>';
	
		
}

?> 