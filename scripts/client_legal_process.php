<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'LegalAPI.class.php');


ini_set("display_errors", 1);
error_reporting(2047);

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
$error = "";
# get course id
$visa_id    = isset($_REQUEST['vid'])? trim($_REQUEST['vid']) : 0;
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$process_id = isset($_REQUEST['pid'])? trim($_REQUEST['pid']) : 0;
$isNew = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;
$isOther = isset($_REQUEST['isOther'])? trim($_REQUEST['isOther']) : 0;
$error = "";


$o_v = new LegalAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$legal_arr = $o_v->getLegal($client_id, $visa_id);

# get item array

$process_item_arr = $o_v->getStep($legal_arr[$visa_id]['cateid'], $legal_arr[$visa_id]['subid']); 


if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$sets['date'] = isset($_REQUEST['t_date'])? trim($_REQUEST['t_date']) : "0000-00-00";
	$sets['date'] = $sets['date'] == ""? "0000-00-00" : $sets['date'];
	$sets['due']  = isset($_REQUEST['t_due'])? trim($_REQUEST['t_due']) : "0000-00-00";
	$sets['due']  = $sets['due'] == ""? "0000-00-00" : $sets['due'];
	
	$sets['detail']  = isset($_REQUEST['t_detail'])? trim($_REQUEST['t_detail']) : "";
	$sets['subject'] = isset($_REQUEST['t_subject'])? trim($_REQUEST['t_subject']) : 0;
	$sets['add']     = isset($_REQUEST['t_add'])? trim($_REQUEST['t_add']) : "";
	$sets['done']    = isset($_REQUEST['t_done'])? trim($_REQUEST['t_done']) : 0;
	
	
	if ($process_id > 0)
		$o_v->setProcess($process_id, $sets);
	else 
		$o_v->addProcess($visa_id, $sets);

	if ($visa_id > 0 && $sets['done'] == 1) 
		$o_v->autoProcess($visa_id, $legal_arr[$visa_id]['cateid'], $legal_arr[$visa_id]['subid']);	
	
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	

}
elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if($process_id > 0){
		$o_v->delProcess($process_id);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}




# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('subject_arr', $process_item_arr);
$o_tpl->assign('dt_arr', $o_v->getProcess($process_id, $visa_id, $legal_arr[$visa_id]['cateid'], $legal_arr[$visa_id]['subid']));
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('vid', $visa_id);
$o_tpl->assign('pid', $process_id);
$o_tpl->assign('isOther', $isOther);
$o_tpl->assign('isNew', $isNew);
$o_tpl->assign('errormsg', $error);
$o_tpl->display('client_legal_process.tpl');
?>

