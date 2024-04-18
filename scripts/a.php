<?php

require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'Report.class.php');

/*
$d = dir(__DOWNLOAD_PATH.'reportstaff/');
echo "Handle: " . $d->handle . "\n";
echo "Path: " . $d->path . "\n";
while (false !== ($entry = $d->read())) {
   echo $entry."\n";
}
$d->close();
*/
//var_dump(mkdir(dirname(__LIB_PATH).'/scripts/font/unifont'));
//exit;

$o_a = new ReportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$staff_id = 112;
$rpt_type = 's'; 
$file = __DOWNLOAD_PATH.'reportstaff/'.$rpt_type.$staff_id.'.dat';
if (file_exists($file)) {
    var_dump($file);
    unlink($file);
}

$rpt_type = 'd';    
$file = __DOWNLOAD_PATH.'reportstaff/'.$rpt_type.$staff_id.'.dat';
if (file_exists($file)) {
    var_dump($file);
    unlink($file);
}
    
exit;
$archive = $o_a->getStaffArchive($staff_id, 's');
var_dump(count($archive['courses']['all']['name']));
var_dump(count($archive['courseprocs']['all']['apocid'])+count($archive['courseprocs']['all']['reocid'])+count($archive['courseprocs']['all']['reccid'])+count($archive['courseprocs']['all']['reo_st'])+count(array_unique($archive['coursesems']['all']['course']))+count(array_unique($archive['coursesems']['all']['coursepots'])));
var_dump(count(array_unique(array_merge($archive['courseprocs']['all']['apocid'],$archive['courseprocs']['all']['reocid'],$archive['courseprocs']['all']['reccid'],$archive['courseprocs']['all']['reo_st']))));
echo implode(',', array_keys($archive['courseprocs']['all']['reocid']));
echo "<p/>";
echo implode(',', array_keys($archive['courseprocs']['all']['reccid']));
echo "<p/>";
echo implode(',', array_keys($archive['courseprocs']['all']['apocid']));
echo "<p/>";
echo implode(',', array_keys($archive['courseprocs']['all']['reo_st']));
echo "<p/>";
echo implode(',', $archive['coursesems']['all']['course']);
echo "<p/>";
echo implode(',', $archive['coursepots']['all']['course']);
exit;



/*
set_time_limit(0);

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
*/


error_reporting(E_ALL);
ini_set('display_errors', true);
require_once('../etc/const.php');
require_once('class.phpmailer.php');
require_once('class.smtp.php');

$mail = new PHPMailer();
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
//$mail->SMTPAutoTLS = false;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->CharSet = "UTF-8";


$mail->Username = 'grace@geic.com.au';//'patrick.nxf@gmail.com';//"r_alfa@hotmail.com";
$mail->Password = 'Iloveangus2069!';//'whiteSKY13jing';// "dowhatyouthink";

$mail->setFrom("grace@geic.com.au", 'Grace Shen');
$mail->Subject = "哥伦布献上的生日礼券 ｜ Global Birthday Coupon";


$body=<<<EOF
<p>
<img src="https://as.geic.com.au/images/bod_banner.jpeg" width="455" height="808"/>
</p>
<p>尊贵的哥伦布客户 [first name 从系统获取]，<p/>
<p>您好！<p/>
<p>哥伦布祝您生日快乐、心想事成！<p/>
<p>我们诚挚地为您献上$55澳元的生日礼券，表达我们对您的敬意。<p/>
<p>您或者您的朋友可以享用。<p/>
<p>顺安！<p/>
<p><p/>
<p><p/>
<p>Dear Global Client,<p/>
<p>Happy Birthday to you!<p/>
<p>And thank you for supporting Global, we hope you enjoy the Global $55 birthday coupon on this very special day.<p/>
<p>We wish you have a wonderful day today.<p/>
<p>Best regards,<p/>

EOF;

$mail->msgHTML($body);

$mail->addAddress('rhys@geic.com.au');//

//var_dump($mail->Send());
if (!$mail->Send())
	echo "Mail Error:". $mail->ErrorInfo;
else
	echo "Success";

?>
