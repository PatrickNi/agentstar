<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');

$db = new MysqlDB(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$sql = "SELECT cateid, subclassid FROM visa_rs_item where item like 'issue biz %' or item like 'issue business%' ";
$db->query($sql);
$items = array();
while ($db->fetch()) {
    $items[$db->cateid."-".$db->subclassid] = 1;
}

$sql = "SELECT a.cateid, a.visaname, b.subclassid, b.classname FROM visa_category a, visa_subclass b where a.cateid = b.cateid ";
$db->query($sql);
echo "<pre>";
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
while ($db->fetch()) {
    $k =$db->cateid."-".$db->subclassid;
    if (!isset($items[$k])) {
        echo $db->visaname."\t".$db->classname."........";
        if ($o_v->addVisaRelate($db->cateid, $db->subclassid, 'issue biz invoice', 0))
            echo "ok\n";
        else 
            echo "fail\n";
    }
}
echo "</pre>";

exit;
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
