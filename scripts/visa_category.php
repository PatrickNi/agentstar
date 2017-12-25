<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$isNone = "none";
$cat_id = isset($_REQUEST['catid'])? trim($_REQUEST['catid']) : 0;


# get action
$action = isset($_POST["at_{$cat_id}"])? trim($_POST["at_{$cat_id}"]) : "";
switch (strtoupper($action)){
	case __ACT_SUBCLASS:
		header("Location: visa_subclass.php?catid={$cat_id}");
		exit;
		break;
	case __ACT_DEL:
		$o_v->delVisaCategory($cat_id);	
		break;
	case __ACT_EDIT:
		$isNone = "block";
		break;		
	default:
		break;					
}

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$cat_name = isset($_POST['t_name'])? trim($_POST['t_name']) : "";

	if($cat_id > 0){
		$o_v->setVisaCategory($cat_id, $cat_name);
	}else{
		$o_v->addVisaCategory($cat_name);
	}
	$cat_id = 0;
	$isNone = "none";
}elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "NEW"){
	$isNone = "block";
}


# get action
$action_arr = array(__ACT_EDIT => "Edit",  __ACT_SUBCLASS => "SubClass", __ACT_DEL => "Delete" );//__ACT_DEL => "Delete",

# format array
$cat_arr = $o_v->getVisaNameArr();



# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('category_arr', $cat_arr);

if($cat_id > 0 && array_key_exists($cat_id, $cat_arr)){
	$o_tpl->assign('dt_name', $cat_arr[$cat_id]);
}

$o_tpl->assign('catid', $cat_id);
$o_tpl->assign('isNone', $isNone);
$o_tpl->display('visa_category.tpl');
?>
