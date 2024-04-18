<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# get course id
$ct_id     = isset($_REQUEST['ctid'])? trim($_REQUEST['ctid']) : 0;
$group_id  = isset($_REQUEST['gid'])? trim($_REQUEST['gid']) : 0;
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";


$o_c = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$group_arr = array();

switch($button){
	case "SAVE":
		$sets['org']    = isset($_POST['t_org'])? trim($_POST['t_org']) : "";
		$sets['phone']  = isset($_POST['t_phone'])? trim($_POST['t_phone']) : "";
		$sets['person'] = isset($_POST['t_person'])? trim($_POST['t_person']) : "";
		$sets['mobile'] = isset($_POST['t_mobile'])? trim($_POST['t_mobile']) : "";
		$sets['email']  = isset($_POST['t_email'])? trim($_POST['t_email']) : "";
		$sets['add']    = isset($_POST['t_add'])? trim($_POST['t_add']) : "";
		$sets['fax']    = isset($_POST['t_fax'])? trim($_POST['t_fax']) : "";
		$sets['web']    = isset($_POST['t_web'])? trim($_POST['t_web']) : "";
		$sets['note']   = isset($_POST['t_note'])? trim($_POST['t_note']) : "";
		if($ct_id > 0){
			$o_c->setContact($ct_id, $sets);
		}else{
			$o_c->addContact($group_id, $sets);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if($ct_id > 0){
			$o_c->delContact($ct_id);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";		
		break;
	default:
		break;
}

if ($ct_id > 0){
	$contact_arr = $o_c->getContact($ct_id);
}
# set smarty tpl
$o_tpl = new Template;
if ($ct_id > 0 && $group_id > 0){
	$o_tpl->assign('dt_arr', $contact_arr[$group_id][$ct_id]);
}

$o_tpl->assign('gid', $group_id);
$o_tpl->assign('ctid', $ct_id);
$o_tpl->display('contact.tpl');
?>
