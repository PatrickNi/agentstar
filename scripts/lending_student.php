<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'LendingAPI.class.php');

ini_set("display_errors", 1);
error_reporting(2047);
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new LendingAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}


$lend_id = isset($_REQUEST['lid'])? trim($_REQUEST['lid']) : 0;

# get user position
$view_all = 0;
if ($ugs['seeall'] == 0){
	$view_all = $user_id;
}

$lend_arr = $o_s->getLending($lend_id, 0, 0);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('user_arr', $o_g->getUserNameArr());

$o_tpl->assign('lid', $lend_id);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('iname', $lend_arr[$lend_id]['name']);
$o_tpl->assign('student_arr', $o_s->getHomeloan(0,0,0,$lend_id));
$o_tpl->assign('process', $o_s->getProcessbyLend($lend_id));
$o_tpl->assign('staffs', $o_s->getStaff($lend_id));

$o_tpl->display('lending_student.tpl');

?>
