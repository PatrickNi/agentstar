<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'LegalAPI.class.php');

ini_set('display_errors', 1);
error_reporting(2047);

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$isNone = "none";
$o_v = new LegalAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$cat_id = isset($_REQUEST['catid'])? trim($_REQUEST['catid']) : 0;
$sub_id = isset($_REQUEST['subid'])? trim($_REQUEST['subid']) : 0;
$rid    = isset($_REQUEST['rid'])? trim($_REQUEST['rid']) : 0;

# get action
$action = isset($_POST["at_{$rid}"])? trim($_POST["at_{$rid}"]) : "";
switch (strtoupper($action)){
	case __ACT_DEL:
		$o_v->delStep($rid);	
		break;
	case __ACT_EDIT:
		$isNone = "block";	
		break;
	default:
		break;					
}

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$process_name = isset($_POST['t_name'])? trim($_POST['t_name']) : "";
    $process_order = isset($_POST['t_pri'])? trim($_POST['t_pri']) : 0;

	if($rid > 0){
		$o_v->setStep($rid, $process_name, $process_order);
	}else{
		$o_v->addStep($cat_id, $sub_id, $process_name, $process_order);
	}
	$rid = 0;
	$isNone = "none";	
}elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "NEW"){
	$isNone = "block";	
}


# get action
$action_arr = array(__ACT_EDIT => "Edit", __ACT_DEL => "Delete");

# format array
$relate_arr = $o_v->getStep($cat_id, $sub_id);


# get category name
$cat_name = $o_v->getCategory($cat_id);

# get sublcass name
$sub_name = $o_v->getSubClass($cat_id, $sub_id);


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('relate_arr', $relate_arr);


if($rid > 0 && array_key_exists($rid, $relate_arr)){
	$o_tpl->assign('dt_name', $relate_arr[$rid]['name']);
    $o_tpl->assign('dt_pri', $relate_arr[$rid]['pri']);
}

$o_tpl->assign('catid', $cat_id);
$o_tpl->assign('subid', $sub_id);
$o_tpl->assign('rid', $rid);
$o_tpl->assign('category', $cat_name);
$o_tpl->assign('subclass', $sub_name);
$o_tpl->assign('isNone', $isNone);
$o_tpl->display('legal_steps.tpl');
?>
