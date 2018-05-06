<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
ini_set("display_errors", 1);
error_reporting(2047);

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
	echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_f = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$u_id = isset($_POST['uid'])? trim($_POST['uid']) : 0;
# set user function relation
if($u_id > 0 && isset($_POST['qflag']) && strtoupper($_POST['qflag']) == 'APPROVE'){
	$o_f->setUserPermission($u_id, $_POST['funcId']);
	
	//grants set
	$_grants = array();
	foreach ($g_user_grants as $item){
		$tag = 'g_'.$item;
		$_grants[$item] = 0;
		if (array_key_exists($tag, $_POST)) {
			foreach ($_POST[$tag] as $v){
				$_grants[$item] = $_grants[$item] | $v;
			}
		}
	}
	$o_f->set_user_adv($u_id,  $_grants);

	//sys user views
	$tmp = array();
	if (isset($_POST['sys_views'])) {
		foreach ($_POST['sys_views'] as $v) {
			$v = explode('_', $v);
			$tmp[$v[0]][]=$v[1];
		}

		foreach ($tmp as $type => $u) {
			$o_f->set_sys_views($u_id, $type, $u);
		}
	}
}


# get user function relation
$func_arr = array();
//$advs = array();
if($u_id > 0){
	$func_arr = $o_f->getUserFuncList($u_id);
//	$advs = $o_f->get_user_adv($u_id);
}

# get user
$user_arr = $o_f->getUserNameArr();


$ugs = array();
$user_grants = $o_f->get_user_grants($u_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_f->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}


$sys_grants = array();
foreach ($g_user_grants as $item){
	foreach ($g_user_ops as $key=>$op){
		$sys_grants[$item][$key] = $op; 
	}
}


# output
$o_tpl = new Template;
$o_tpl->assign("func_arr", $func_arr);
$o_tpl->assign("user_arr", $user_arr);

$o_tpl->assign("grant", $sys_grants);
$o_tpl->assign("ugs", $ugs);
$o_tpl->assign("sys_views", $o_f->get_sys_views($u_id));

$o_tpl->assign("uid", $u_id);
$o_tpl->display("sys_assign.tpl");
?>

