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

$o_v = new LegalAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$isNone = "none";

$cat_id = isset($_REQUEST['catid'])? trim($_REQUEST['catid']) : 0;
$sub_id = isset($_REQUEST['subid'])? trim($_REQUEST['subid']) : 0;


# get action
$action = isset($_POST["at_{$sub_id}"])? trim($_POST["at_{$sub_id}"]) : "";
switch (strtoupper($action)){
	case __ACT_RElATION:
		header("Location: legal_steps.php?catid={$cat_id}&subid={$sub_id}");
		exit;
		break;
	case __ACT_DEL:
		$o_v->delSubclass($cat_id, $sub_id);	
		break;
	case __ACT_EDIT:
		$isNone = "block";
		break;		
	default:
		break;					
}

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$class_name = isset($_POST['t_name'])? trim($_POST['t_name']) : "";

	if($sub_id > 0){
		$o_v->setSubclass($cat_id, $sub_id, $class_name);
	}else{
		$o_v->addSubclass($cat_id, $class_name);
	}
	$sub_id = 0;
	$isNone = "none";
}elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "NEW"){
	$isNone = "block";
}


# get action
$action_arr = array(__ACT_EDIT => "Edit",  __ACT_RElATION => "Steps", __ACT_DEL => "Delete" );//__ACT_DEL => "Delete",

# format array
$sub_arr = $o_v->getSubClass($cat_id);

# get category name
$cat_name = $o_v->getCategory($cat_id);


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('subclass_arr', $sub_arr);


if($sub_id > 0 && array_key_exists($sub_id, $sub_arr)){
	$o_tpl->assign('dt_name', $sub_arr[$sub_id]);
}

$o_tpl->assign('catid', $cat_id);
$o_tpl->assign('subid', $sub_id);
$o_tpl->assign('isNone', $isNone);
$o_tpl->assign('category', $cat_name);
$o_tpl->display('legal_subclass.tpl');
?>
