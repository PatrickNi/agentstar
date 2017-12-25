<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'LendingAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

//user grants
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}

# get course id
$hid       = isset($_REQUEST['hid'])? trim($_REQUEST['hid']) : 0;
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$process_id = isset($_REQUEST['pid'])? trim($_REQUEST['pid']) : 0;
$add_step      = isset($_REQUEST['isOther'])? trim($_REQUEST['isOther']) : 0;
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new LendingAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

# get process
$process_arr = array();
$process_arr = $o_c->getProcessOfCourse();
$msg = '';
if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$sets['date']    = isset($_REQUEST['t_date'])? (string)trim($_REQUEST['t_date']) : "0000-00-00";
	$sets['date']    = $sets['date'] == ""? "0000-00-00" : $sets['date'];
	
	$sets['due']     = isset($_REQUEST['t_due'])? (string)trim($_REQUEST['t_due']) : "0000-00-00";
	$sets['due']    = $sets['due'] == ""? "0000-00-00" : $sets['due'];
	
	$sets['detail']  = isset($_REQUEST['t_detail'])? (string)trim($_REQUEST['t_detail']) : "";
	$sets['add']     = isset($_REQUEST['t_add'])? (string)trim($_REQUEST['t_add']) : "";
	$sets['subject'] = isset($_REQUEST['t_subject'])? (string)trim($_REQUEST['t_subject']) : "";

	if ($sets['subject'] == "")
		$sets['subject'] = $sets['add'];

	$sets['done']    = isset($_REQUEST['t_done'])? trim($_REQUEST['t_done']) : 0;

	if(($sets['date'] == '0000-00-00' && $sets['done'] == 1)) {
		$msg = "alert(':need date');";
	}
	elseif(($sets['due'] == '0000-00-00' && $sets['done'] == 0)) {
		$msg = "alert(':need due date');";
	}
	else {
		if ($process_id > 0) {
			$o_s->setProcess($process_id, $sets, $hid);
		}
		else {
			$o_s->addProcess($hid, $sets);
		}

		$o_s->autoProcess($hid);

		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;
	}

}
elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if($process_id > 0){
		$o_s->delProcess($process_id);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}
elseif ($add_step != 1) {
	$sets['subject'] = 'Refer home loan';
}



# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('step_arr', $o_s->getStep());
$o_tpl->assign('dt_arr', $process_id > 0? $o_s->getProcess($process_id): $sets);

$o_tpl->assign('cid', $client_id);
$o_tpl->assign('hid', $hid);
$o_tpl->assign('pid', $process_id);
$o_tpl->assign('msg', $msg);
$o_tpl->assign('isOther', $add_step);
$o_tpl->display('client_homeloan_process.tpl');
?>
