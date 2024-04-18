<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');

$db = new MysqlDB(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$sql = " select c.StartDate, count(*) as c1, if(c.StartDate < NOW(), 1, 0) as c2 
from client_info a left join client_course b on(a.CID = b.CID) left join client_course_sem c on(b.ID = c.CCID) left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
where d.ID is not null and (a.ClientType = 'Study' or ClientType = 'all') 
Group by c.StartDate
order by c.StartDate";
$db->query($sql);
while ($db->fetch()){
	 echo $db->StartDate .",". $db->c1 .",". $db->c2."<br>";
}
exit;

$sql = "alter table `geic`.`sys_user` add column `StartDate` date   NULL  after `UserGrants`";
//$sql = "alter table `geic`.`agent` add column `isVerify` tinyint (4)  DEFAULT '0' NULL";
$db->query($sql);
//$sql = "alter table `geic`.`institute_status` add column `Rank` tinyint (4)  DEFAULT '0' NULL  after `AgentStatus`";
//$db->query($sql);

//$sql = "update `institute_status` SET `Rank`='1' where `ID`='3'";
//$db->query($sql);
//
//$sql = "update `institute_status` set `Rank`='2' where `ID`='2' ";
//$db->query($sql);
//
//$sql = "update `institute_status` set `Rank`='3' where `ID`='4'";
//$db->query($sql);
//
//$sql = "select * from `geic`.`institute_status`";
//$db->query($sql);
//while ($db->fetch()){
//	echo $db->ID."|".$db->AgentStatus."|".$db->Rank."<p>";
//}
//
//
//$sql = "CREATE TABLE `institute_category_sub` (
//            `ID` int(11) NOT NULL auto_increment,
//            `CateName` varchar(255) default NULL,  
//            `ParentID` int(11) NOT NULL default 0,
//             PRIMARY KEY  (`ID`) 
//         ) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";
//$db->query($sql);
$db->close();


?>
