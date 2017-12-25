<?php
//require_once('../etc/const.php');
require_once('class.phpmailer.php');
require_once('class.smtp.php');

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp-mail.outlook.com";
$mail->Port = 587;


$mail->Username = "r_alfa@hotmail.com";
$mail->Password = "dowhatyouthink";

$mail->setFrom("r_alfa@hotmail.com", 'Patrick NI');
$mail->Subject = "Test PANI";
$mail->msgHTML('TEST');

$mail->addAddress('patrickni@megainformationtech.com');

//var_dump($mail->Send());
if (!$mail->Send())
	echo "Mail Error:". $mail->ErrorInfo;
else
	echo "Success";

?>
