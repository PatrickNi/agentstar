<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'LendingAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
ini_set('display_errors', 1);
error_reporting(4096);

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_s = new LendingAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
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

$lend_id = isset($_REQUEST['lid'])? trim($_REQUEST['lid']) : 0;
$isChange = isset($_REQUEST['isChange'])? trim($_REQUEST['isChange']) : 0;

$set_arr = array();
$set_arr['name']    = isset($_POST['t_name'])? trim($_POST['t_name']) : "";
$set_arr['cr']      = isset($_POST['t_cr'])? trim($_POST['t_cr']) : 0.00;
$set_arr['contact'] = isset($_POST['t_contact'])? trim($_POST['t_contact']) : "";
$set_arr['cate']    = isset($_POST['t_cate'])? trim($_POST['t_cate']) : '';


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE") {

	$set_arr['cr'] = $set_arr['cr'] / 100;
    if ($lend_id > 0){
		$o_s->setLending($lend_id, $set_arr);
	} else{
		$o_s->addLending($set_arr);
		$lend_id = $o_s->getLastInsertID();
	}
}elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
    $o_s->delLending($lend_id);
    header("Location: lending_detail.php");
    exit;
}



# set smarty tpl
$o_tpl = new Template;
if ($lend_id > 0 ){
    $lend_arr = $o_s->getLending($lend_id, "", "");
	$set_arr = $lend_arr[$lend_id];
}


$o_tpl->assign('dt_arr', $set_arr);
$o_tpl->assign('category_arr', $o_s->getCategory());

$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('lid', $lend_id);
$o_tpl->assign('itemtype', __FILE_INSTITUTE);


if($ugs['i_nocp']['v'] == 1) {
    $o_tpl->assign('forbid_sl', FORBID_SELECT);
    $o_tpl->assign('forbid_rc', FORBID_RIGHTCLK);
    $o_tpl->assign('forbid_cp', FORBID_COPY);
}

$o_tpl->assign('forbid_sl', FORBID_SELECT);
$o_tpl->assign('forbid_rc', FORBID_RIGHTCLK);
$o_tpl->assign('forbid_cp', FORBID_COPY);

$o_tpl->display('lending_detail.tpl');
?>
