<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'ianmenaamagua@gmail.com'; // Gmail address which you want to use as SMTP server
$mail->Password = 'Nikiui17'; // Gmail address Password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = '587';

$mail->setFrom('ianmenaamagua@gmail.com'); // Gmail address which you used as SMTP server
$mail->addAddress('niklas0617@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

$mail->isHTML(true);
$mail->Subject = 'Message Received (Contact Page)';
$mail->Body = "<h3>Name : ian <br>Email: l <br>Message : message</h3>";

if ($mail->send()) {
    echo "yey";
}else{
    echo "ney";
}
