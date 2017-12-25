<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');


$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);

# get client id 
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$service_id = isset($_REQUEST['sid'])? trim($_REQUEST['sid']) : 0;
$isNew = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;

# get service
$set_arr = array();
$set_arr['date']  = isset($_POST['t_date'])? (string)trim($_POST['t_date']) : "0000-00-00";
$set_arr['date']  = $set_arr['date'] == ""? "0000-00-00" : $set_arr['date'] ; 

$set_arr['due']  = isset($_POST['t_due'])? (string)trim($_POST['t_due']) : "0000-00-00";
$set_arr['due']  = $set_arr['due'] == ""? "0000-00-00" : $set_arr['due'];

$set_arr['detail']    = isset($_POST['t_detail'])? (string)trim($_POST['t_detail']) : "";
$set_arr['subject'] = isset($_POST['t_subject'])? (string)trim($_POST['t_subject']) : "";

$set_arr['done']    = isset($_POST['t_done'])? (string)trim($_POST['t_done']) : 0;

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE") {
	if ($set_arr['subject'] == ""){
		echo "<script language='javascript'>alert('Error empty subject');</script>";	
	}else{
		if ($isNew == 1){
			$o_c->addService($client_id, $set_arr);
		} else {
			$o_c->setService($service_id, $set_arr);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		exit;		
	}
}elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	$o_c->delService($service_id);
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;		
}



# get work experience
$services = array();
$services = $o_c->getServiceByClient($client_id);

# set smarty tpl
$o_tpl = new Template;
if($isNew == 0 && $service_id > 0 && array_key_exists($service_id, $services)){
	$o_tpl->assign('dt_arr', $services[$service_id]);
}


$o_tpl->assign('cid', $client_id);
$o_tpl->assign('sid', $service_id);
$o_tpl->assign('isNew', $isNew);
$o_tpl->display('client_service_dt.tpl');
?>
