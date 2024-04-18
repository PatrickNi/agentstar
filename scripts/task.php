<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$isFrom = isset($_POST['t_type'])? $_POST['t_type'] : 1;
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if (isset($_POST['del_task']) && is_array($_POST['del_task']) && count($_POST['del_task']) > 0){
	$o_g->delTask($_POST['del_task']);
}


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

$users = $o_g->getUserNameArr();

switch($isFrom){
	case 0:
		if($ugs['seeall']['v'] == 1){
			$user_id = 0;
		}
		$tasks = $o_g->getAssignTask(0, $user_id);
		break;
	case 1:
		$tasks = $o_g->getReceiveTask(0, $user_id);
		break;	
}


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('users', $users);
$o_tpl->assign('tasks', $tasks);
$o_tpl->assign('isFrom', $isFrom);
$o_tpl->assign('today', date("Y-m-d"));
$o_tpl->display('task.tpl');
?>
