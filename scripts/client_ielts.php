<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

# get course id
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
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


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$sets['testday']    = isset($_POST['t_testday'])? (string)trim($_POST['t_testday']) : "0000-00-00";
	$sets['testday']    = $sets['testday'] == ""? "0000-00-00" : $sets['testday'];
	
	$sets['planday']     = isset($_POST['t_planday'])? (string)trim($_POST['t_planday']) : "0000-00-00";
	$sets['planday']    = $sets['planday'] == ""? "0000-00-00" : $sets['planday'];
	
	$sets['mod']  = isset($_POST['t_mod'])? (string)trim($_POST['t_mod']) : "";
	$sets['overall']     = isset($_POST['t_result'])? (string)trim($_POST['t_result']) : "";
	$sets['listen'] = isset($_POST['t_listen'])? (string)trim($_POST['t_listen']) : "";
	$sets['read'] = isset($_POST['t_read'])? (string)trim($_POST['t_read']) : "";	
	$sets['write'] = isset($_POST['t_write'])? (string)trim($_POST['t_write']) : "";
	$sets['speak'] = isset($_POST['t_speak'])? (string)trim($_POST['t_speak']) : "";
		
		
	if($o_c->checkIetls($client_id)){
		$o_c->setIetls($client_id, $sets);
	
	}else{
		$o_c->addIetls($client_id, $sets);
	}

}elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	$o_c->delIetls($client_id);
}


# format array
$show_arr = $o_c->getIetls($client_id);

# set smarty tpl
$o_tpl = new Template;

$o_tpl->assign('dt_arr', $show_arr);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('client_type', $o_c->getClientType($client_id));
$o_tpl->display('client_ielts.tpl');
?>
