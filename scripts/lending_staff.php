<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'LendingAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

# get course id
$lid  = isset($_REQUEST['lid'])? trim($_REQUEST['lid']) : 0;
$staff_id = isset($_REQUEST['fid'])? trim($_REQUEST['fid']) : 0;
$isNew = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : "none";


$o_f = new LendingAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


if ($lid > 0 && isset($_REQUEST['act']) && trim($_REQUEST['act']) == 'dl'){
	echo json_encode($o_f->getStaff($lid));
	exit;
}

# get action
$action = isset($_POST["at_{$staff_id}"])? trim($_POST["at_{$staff_id}"]) : "";
switch (strtoupper($action)){
	case __ACT_DEL:
		$o_f->delStaff($staff_id);	
		break;
	case __ACT_EDIT:
		$isNew = "block";	
		break;		
	default:
		break;					
}

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$sets['name']   = isset($_POST['t_name'])? trim($_POST['t_name']) : "N/A";
	$sets['name']   = $sets['name'] != ""? $sets['name'] : "N/A";
	
	$sets['mobile'] = isset($_POST['t_mobile'])? trim($_POST['t_mobile']) : "";
	$sets['fax']    = isset($_POST['t_fax'])? trim($_POST['t_fax']) : "";
	$sets['phone']  = isset($_POST['t_phone'])? trim($_POST['t_phone']) : "";
	$sets['email']  = isset($_POST['t_email'])? trim($_POST['t_email']) : "";
	$sets['addr']   = isset($_POST['t_addr'])? trim($_POST['t_addr']) : "";
	$sets['code']   = isset($_POST['t_code'])? trim($_POST['t_code']) : "";
	
	if($staff_id > 0){
		$o_f->setStaff($staff_id, $sets);
	}else{
		$o_f->addStaff($lid, $sets);
	}
	$staff_id = 0;
	$isNew = "none";
}


# get action
$action_arr = array(__ACT_EDIT => "Edit", __ACT_DEL => "Delete");

# format array
$staff_arr = $o_f->getStaff($lid);


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('staff_arr', $staff_arr);

if($staff_id > 0 && array_key_exists($staff_id, $staff_arr)){
	$o_tpl->assign('dt_arr', $staff_arr[$staff_id]);
}

$lend_arr = $o_f->getLending($lid, 0, 0);

$o_tpl->assign('iname', $lend_arr[$lid]['name']);
$o_tpl->assign('lid', $lid);
$o_tpl->assign('fid', $staff_id);
$o_tpl->assign('isNew', $isNew);
$o_tpl->display('lending_staff.tpl');
?>

