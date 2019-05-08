<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$db = new MysqlDB(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$sql = "select distinct c.CVID from client_visa_process as c, visa_rs_item i, (select VisaID, Sum(DueAmount) as totalpay, Sum(b.paid) as paid from client_account a left join  (select AccountID, SUM(PaidAmount) as paid from client_payment Group by AccountID) b on (a.ID = b.AccountID) where ACC_TYPE = 'visa' Group by VisaID having totalpay > paid) d where c.cvid = d.visaid and c.itemid = i.itemid and i.item like 'apply%' ";
$db->query($sql);
$visas = array();
while ($db->fetch()) {
    $visas[$db->CVID] = array();
}

$sql = "SELECT v.id, cateid, subclassid, lname, fname, v.cid, VUserID from client_visa v, client_info c where v.cid = c.cid and v.id in (".implode(',', array_keys($visas)).")";
$db->query($sql);
while ($db->fetch()) {
    $results[$db->VUserID][$db->id]['name'] = $db->fname." ".$db->lname;
    $results[$db->VUserID][$db->id]['visa'] = $db->cateid."\t".$db->subclassid;
    $results[$db->VUserID][$db->id]['cid' ] = $db->cid;
}

$sql = "SELECT a.cateid, a.visaname, b.subclassid, b.classname FROM visa_category a, visa_subclass b where a.cateid = b.cateid ";
$db->query($sql);
$visa_names = array();
while ($db->fetch()) {
    $visa_names[$db->cateid."\t".$db->subclassid] = $db->visaname." ".$db->classname;
}


# get user
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 
$user_arr = $o_g->getUserNameArr();

echo "<dl>";
foreach ($results as $paperwork => $vv) {
    echo "<dt>Paperwork: {$user_arr[$paperwork]}</dt>";
    foreach ($vv as $id => $v) {
        echo '<dd><a href="http://60.229.252.229:8080/scripts/client_visa_detail.php'."?cid={$v['cid']}&vid={$id}".'" target="_blank">'."{$v['name']} ({$visa_names[$v['visa']]})".'</a></dd>';
    }
}
echo "</dl>";
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
