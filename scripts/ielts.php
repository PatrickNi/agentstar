<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');


$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$action = isset($_REQUEST['act'])? trim($_REQUEST['act']) : '';

# get client id 
$sets = array();
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;

if (isset($_REQUEST['get']) && $_REQUEST['get'] == 1) {	
	echo serialize($o_c->getIetls($client_id););
	exit;
}

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



	echo serialize('SUCC');
	exit;

?>
