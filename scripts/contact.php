<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

# get course id
$cate_type  = isset($_REQUEST['type'])? trim($_REQUEST['type']) : "D";
$contact_id = isset($_REQUEST['ctid'])? trim($_REQUEST['ctid']) : 0;

$o_c = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get action
$action = isset($_POST["at_{$contact_id}"])? trim($_POST["at_{$contact_id}"]) : "";
switch (strtoupper($action)){
	case __ACT_DEL:
		$o_c->delContact($contact_id);	
		break;
	default:
		break;					
}


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "APPROVE"){
	$f_org    = isset($_POST['t_org'])? trim($_POST['t_org']) : "";
	$f_phone  = isset($_POST['t_phone'])? trim($_POST['t_phone']) : "";
	$f_person = isset($_POST['t_person'])? trim($_POST['t_person']) : "";
	$f_moblie = isset($_POST['t_mobile'])? trim($_POST['t_mobile']) : "";
	$f_email  = isset($_POST['t_phone'])? trim($_POST['t_phone']) : "";
	$f_add    = isset($_POST['t_add'])? trim($_POST['t_add']) : "";
	$f_fax    = isset($_POST['t_fax'])? trim($_POST['t_fax']) : "";
	$f_web    = isset($_POST['t_web'])? trim($_POST['t_web']) : "";

	if($contact_id > 0){
		$o_c->setContact($contact_id, $f_org, $f_person, $f_moblie, $f_phone, $f_email, $f_add, $f_fax, $f_web);
	}else{
		$o_c->addContact($f_org, $f_person, $f_moblie, $f_phone, $f_email, $f_add, $f_fax, $f_web);
	}
	$contact_id = 0;
}


# get action
$action_arr = array(__ACT_EDIT => "Edit", __ACT_DEL => "Delete");

# format array
$contact_arr = $o_c->getContact();

# get category info
$group_arr = $o_c->getContactGroup();



# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('contact_arr', $contact_arr);
$o_tpl->assign('contact_group_arr', $group_arr);
//if($contact_id > 0 && array_key_exists($contact_id, $contact_arr)){
//	$o_tpl->assign('dt_arr', $contact_arr[$contact_id]);
//}


$o_tpl->assign('typeid', $cate_type);
$o_tpl->display('contact_new.tpl');
?>

