<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$emailuser = "ianmenaamagua@gmail.com";
$emailpass = "Nikiui17";
$emailhost = "Smtp.gmail.com";
var_dump($emailhost);
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = $emailhost;
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->Username = $emailuser;
$mail->Password = $emailpass;
$mail->Subject = "Test Email";
$mail->setFrom($emailuser);
$mail->Body = "this is a test";
$mail->addAddress("niklas0617@gmail.com");
if ($mail->Send()) {
	echo "mail sent";
} else{
	echo "error";
}