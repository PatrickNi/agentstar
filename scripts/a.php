<?php

require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'Report.class.php');
$o_a = new ReportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$staff_id = 81;
$path = __DOWNLOAD_PATH.'reportstaff/';
if (file_exists($path.'s'.$staff_id.'.dat')) {
    unlink($path.'s'.$staff_id.'.dat');
}

if (file_exists($path.'d'.$staff_id.'.dat')) {
    unlink($path.'d'.$staff_id.'.dat');
}
exit;




set_time_limit(0);
/*
$sql = "select userid, ID FROM client_course";
$db->query($sql);
while($db->fetch()) {
    echo $db->userid."\t".$db->ID."\n";
}
    SELECT d.username, RedDate as wk, concat(LName, ' ', FName) as Name, c.CID, a.ID, a.CCID, c.DOB, ConsultantDate, c.AgentID, 
    IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount,RedComm-Discount) as bonus, 
    IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount, 0) as bonus_r1,
    IF(CoComm > 0 OR Discount > 0, 0, RedComm-Discount)as bonus_r2,
    t1.BeginDate as GET_CODE_BEGINDATE, 
    d.StartDate as USER_START_DATE,
    Discount as bonus_discount,
    RedComm as bonus_redcomm,
    RComm as bonus_rcomm,
    CoComm as bonus_cocomm,
    0 as nobonus 
FROM client_course_sem a left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5) , client_course b,client_info c, sys_user d WHERE a.CCID = b.ID AND b.CID = c.CID AND b.ConsultantID = d.ID AND RedDate >= '2010-01-01' AND RedDate <= '2020-05-18' and b.ConsultantID = {$_REQUEST['uid']} Order by wk, Name, a.SEM


select count(*) from client_course a where exists (select 'x' from client_course_process b where a.ID = b.CCID and b.Done = 1 and b.ProcessID = 5) and ConsultantID = 80
*/

$sql = <<<EOF
    SELECT if(d.id is not null, d.username, b.ConsultantID) as username, RedDate as wk, concat(LName, ' ', FName) as Name, c.CID, a.ID, a.CCID, c.DOB, ConsultantDate, c.AgentID, 
    IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount,RedComm-Discount) as bonus, 
    IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount, 0) as bonus_r1,
    IF(CoComm > 0 OR Discount > 0, 0, RedComm-Discount)as bonus_r2,
    t1.BeginDate as GET_CODE_BEGINDATE, 
   if(d.id is not null, d.StartDate, 'n/a') as USER_START_DATE,
    Discount as bonus_discount,
    RedComm as bonus_redcomm,
    RComm as bonus_rcomm,
    CoComm as bonus_cocomm,
    0 as nobonus 
FROM client_course_sem a left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5) , client_course b left join sys_user d on (b.ConsultantID = d.id), client_info c WHERE a.CCID = b.ID AND b.CID = c.CID AND RedDate >= '2010-01-01' AND RedDate <= '2020-05-18' Order by wk, Name, a.SEM

EOF;

$db->query($sql);
$bonus = 0;
while($db->fetch()) {
    //echo $db->bonus."\n";
    echo $db->username."\t".$db->wk."\t".$db->Name."\t".$db->CID."\t".$db->ID."\t".$db->CCID."\t".$db->DOB."\t".$db->ConsultantDate."\t".$db->AgentID."\t".$db->bonus."\t".$db->bonus_r1."\t".$db->bonus_r2."\t".$db->GET_CODE_BEGINDATE."\t".$db->USER_START_DATE."\t".$db->bonus_discount."\t".$db->bonus_redcomm."\t".$db->bonus_rcomm."\t".$db->bonus_cocomm."\t".$db->nobonus."\n";
}
//var_dump($bonus);



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
