<?php
require_once('../etc/const.php');

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$isNone = "none";
$item_id = isset($_REQUEST['item_id'])? trim($_REQUEST['item_id']) : "";

# get action
$action = isset($_POST["at_{$item_id}"])? trim($_POST["at_{$item_id}"]) : "";
switch (strtoupper($action)){
	case __ACT_DEL:
		$o_c->delClientFrom($item_id);	
		break;
	case __ACT_EDIT:
		$isNone = "block";
		break;		
	default:
		break;					
}

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$item_name = isset($_POST['t_name'])? trim($_POST['t_name']) : "";
	$item_zh   = isset($_POST['t_zh'])? trim($_POST['t_zh']) : "";
	$item_rank = isset($_POST['t_rank'])? trim($_POST['t_rank']) : 0;

	if($item_id != ""){
		$o_c->setClientFrom($item_id, $item_zh, $item_rank);
	}
	else{
		$o_c->addClientFrom($item_name, $item_zh, $item_rank);
	}
	$isNone = "none";
}elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "NEW"){
	$isNone = "block";
}




$about_arr = array();
$about_arr = $o_c->getClientAboutus();

# get action
$action_arr = array(__ACT_EDIT => "Edit", __ACT_DEL => "Delete" );//__ACT_DEL => "Delete",


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('about_arr', $about_arr);

if($item_id != "" && array_key_exists($item_id, $about_arr)){
	$o_tpl->assign('dt', $about_arr[$item_id]);
}

$o_tpl->assign('item_id', $item_id);
$o_tpl->assign('isNone', $isNone);
$o_tpl->display('client_from.tpl');

?>
