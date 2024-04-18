<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$position_arr['PE'] = 'Edu Partner';
$position_arr['PC'] = 'Coach Partner';

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($_userid > 0)) {
	echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_f = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if(isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "REMOVE"){
	$o_f->delReceiveTaskByUser($_POST['userId']);
	$o_f->delUserByArr($_POST['userId']);
}


# get group
$user_arr = array();
$user_arr = $o_f->getUserList();

# output
$o_tpl = new Template;
$o_tpl->assign("user_arr", $user_arr);
$o_tpl->assign("markarr", $mark_arr);
$o_tpl->assign("posarr", $position_arr);
$o_tpl->display("sys_user.tpl");
?>
