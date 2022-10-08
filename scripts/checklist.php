<?php
require_once('../etc/const.php');

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ChecklistAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$o_c = new ChecklistAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$alert_msg = "";
if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$tpl_id = $o_c->addTpl(isset($_POST['t_name'])? trim($_POST['t_name']) : "");
	if ($tpl_id > 0) {
		$alert_msg = "<script>alert('Create success');</script>";
	}
	else {
		$alert_msg = "<script>alert('Create failed');</script>";
	}
}
elseif (isset($_POST['bt_name']) && (strtoupper($_POST['bt_name']) == "ACTIVE" || strtoupper($_POST['bt_name']) == "INACTIVE")){
	if ($o_c->setTpl(isset($_POST['tpl_id'])? trim($_POST['tpl_id']) : 0, "", $_POST['bt_name'])) {
		$alert_msg = "<script>alert('Set success');</script>";
	}
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "CLONE"){
	$tpl_id = $o_c->addTpl(isset($_POST['clone_tpl_name'])? trim($_POST['clone_tpl_name']) : "");
	$clone_tpl_id = isset($_POST['clone_tpl_id'])? trim($_POST['clone_tpl_id']) : 0;
	if ($o_c->cloneTpl($tpl_id, $clone_tpl_id)) {
		$alert_msg = "<script>alert('Clone success');</script>";
	}
	else {
		$alert_msg = "<script>alert('Clone failed');</script>";
	}
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	if ($o_c->delTpl(isset($_POST['tpl_id'])? trim($_POST['tpl_id']) : 0)) {
		$alert_msg = "<script>alert('Delete success');</script>";
	}
} 

$about_arr = array();
$about_arr = $o_c->getTpls();

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('about_arr', $about_arr);
$o_tpl->assign('alert_msg', $alert_msg);
$o_tpl->assign('visa_arr', $o_v->getVisaNameArr());
$o_tpl->assign('visaclass_arr', $o_v->getVisaClassArr(0, 'Active'));
$o_tpl->display('checklist.tpl');

?>
