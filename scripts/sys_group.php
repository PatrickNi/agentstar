<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
	echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_f = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


if(isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "REMOVE"){
	$o_f->delFuncGroupByArr($_POST['groupId']);
	$o_f->delFuncByGroupArr($_POST['groupId']);
}

# get group
$group_arr = array();
$group_arr = $o_f->getFuncGroupList();


# output
$o_tpl = new Template;
$o_tpl->assign("group_arr", $group_arr);
$o_tpl->display("sys_group.tpl");
?>