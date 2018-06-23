<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

# get course id
$school_id  = isset($_REQUEST['sid'])? trim($_REQUEST['sid']) : 0;
$process_id = isset($_REQUEST['pid'])? trim($_REQUEST['pid']) : 0;
$isNone    = isset($_REQUEST['isNone'])? trim($_REQUEST['isNone']) : "none";

$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

//user grants
$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}


# get action
$action = isset($_REQUEST["at_{$process_id}"])? trim($_REQUEST["at_{$process_id}"]) : "";
switch (strtoupper($action)){
	case __ACT_DONE:
		$o_s->endProcess($process_id);
		$process_id = 0;	
		break;
	case __ACT_DEL:
		$o_s->delProcess($process_id);	
		break;
	default:
		break;					
}

if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$sets['date'] = isset($_REQUEST['t_date'])? trim($_REQUEST['t_date']) : "0000-00-00";
	$sets['date'] = $sets['date'] != ""? $sets['date'] : "0000-00-00";
	
	$sets['detail']  = isset($_REQUEST['t_detail'])? trim($_REQUEST['t_detail']) : "";
	$sets['subject'] = isset($_REQUEST['t_subject'])? trim($_REQUEST['t_subject']) : "";
	$sets['due']     = isset($_REQUEST['t_due'])? trim($_REQUEST['t_due']) : "0000-00-00";
	$sets['due']     = $sets['due'] != ""? $sets['due'] : "0000-00-00";
	
	if($process_id > 0){
		$o_s->setProcess($process_id, $sets);
	}else{
		$o_s->addProcess($school_id, $sets);
	}
	$process_id = 0;
	$isNone = "none";
}


# get action
$action_arr = array(__ACT_EDIT => "Edit", __ACT_DEL => "Delete", __ACT_DONE=>"Done");

# format array
$process_arr = $o_s->getProcess($school_id);


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('process_arr', $process_arr);

if($process_id > 0 && array_key_exists($process_id, $process_arr)){
	$o_tpl->assign('dt_arr', $process_arr[$process_id]);
}

$o_tpl->assign('iname', $o_s->getNameByIID($school_id));
$o_tpl->assign('isNone', $isNone);
$o_tpl->assign('sid', $school_id);
$o_tpl->assign('pid', $process_id);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('itemtype', __FILE_INSTITUTE_PROCESS);
$o_tpl->display('institute_process.tpl');
?>

