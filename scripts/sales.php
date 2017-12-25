<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$iid = isset($_REQUEST['sid'])? $_REQUEST['sid'] : 0;


# format array
$categories = $o_g->getSalesCatgory($iid);

# get category info
$points = $o_g->getSalesPoint();



# set smarty tpl
$o_tpl = new Template;

if($iid > 0 && array_key_exists($iid, $categories)){
	$o_tpl->assign('category_arr', $categories[$iid]);
	$o_tpl->assign('points', $points);
}
$o_tpl->assign('iname', $o_s->getNameByIID($iid));
$o_tpl->assign('iid', $iid);
$o_tpl->assign('sid', $iid);
$o_tpl->display('sales.tpl');
?>

