<?php
//require_once('../etc/const.php');
require_once('class.phpmailer.php');
require_once('class.smtp.php');

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "email-smtp.us-east-1.amazonaws.com";
$mail->Port = 587;


$mail->Username = "AKIA4HGOHSH43QIUHZXC";
$mail->Password = "BIRYyFDm1YNqq6LP7PUjxrFCkAPXd9bBeJ9tkoAZs7Ki";

$mail->setFrom("email@publisherrest.com", 'Publisher Rest');
$mail->Subject = "Test PANI";
$mail->msgHTML('TEST');

$mail->addAddress('r_alfa@hotmail.com');

//var_dump($mail->Send());
if (!$mail->Send())
    echo "Mail Error:". $mail->ErrorInfo;
    else
        echo "Success";

?>
