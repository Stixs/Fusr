<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               		// Enable verbose debug output

$mail->isSMTP();                                      		// Set mailer to use SMTP
$mail->Host = 'www.thuisserver.org';  				  		// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               		// Enable SMTP authentication
$mail->Username = 'Jeroentest@thuisserver.org';       		// SMTP username
$mail->Password = 'Admintest01';                   			// SMTP password
$mail->SMTPSecure = 'tls';                            		// Enable TLS encryption, `ssl` also accepted
//$mail->Port = 587;                                    	// TCP port to connect to

$mail->setFrom('jeroentest@thuisserver.org', 'Jeroen');
$mail->addAddress('jeroenbiggie@gmail.com', 'Jeroen');     	// Add a recipient
//$mail->addAddress('');               					  	// Name is optional
$mail->addReplyTo('jeroentest@thuisserver.org', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         	// Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    	// Optional name
$mail->isHTML(true);                                  		// Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    =  $pw.'</br>'. $username ;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}