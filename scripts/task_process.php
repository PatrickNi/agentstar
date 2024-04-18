<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
ini_set("display_errors", 1);
error_reporting(2047);
# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$task_id = isset($_REQUEST['tid'])? trim($_REQUEST['tid']) : 0;
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$sets['date'] = isset($_POST['t_date'])? trim($_POST['t_date']) : "0000-00-00";
$sets['date'] = $sets['date'] == ""? "0000-00-00" : $sets['date'];

$sets['detail']  = isset($_POST['t_detail'])? trim($_POST['t_detail']) : "";
$sets['task']    = isset($_POST['t_task'])? trim($_POST['t_task']) : "";

$sets['due'] = isset($_POST['t_due'])? trim($_POST['t_due']) : "0000-00-00";
$sets['due'] = $sets['due'] == ""? "0000-00-00" : $sets['due'];
$sets['duehour'] = isset($_POST['t_duehour'])? trim($_POST['t_duehour']) : 0;

$sets['to']     = isset($_POST['t_to'])? trim($_POST['t_to']) : "";
$sets['done']     = isset($_POST['t_done'])? trim($_POST['t_done']) : 0;

$error = "";
if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	if($sets['task'] == ""){
		$error = "alert('Error empy title submitted');";
	}else{
		$sets['duehour'] = ($sets['duehour'] == 0 || $sets['duehour'] == '')? 8 : $sets['duehour'];		
		if($task_id > 0){
			$o_g->setTask($task_id, $sets);
		}else {
			$o_g->addTask($user_id, $sets);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		exit;	
	}
}elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	if($task_id > 0){
		$o_g->delTask($task_id);
	}
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;	
}


$users = $o_g->getUserNameArr();
$tasks = $o_g->getTask($task_id);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('users', $users);

if($error != ""){
	$o_tpl->assign('dt_arr', $sets);

}elseif($task_id > 0){
	$o_tpl->assign('dt_arr', $tasks[$task_id]);
}

$duehour = array();
for ($i=8;$i<=18; $i++){
	$duehour[] = $i;
}
$o_tpl->assign('tid', $task_id);
$o_tpl->assign('userid', $user_id);
$o_tpl->assign('duehour', $duehour);
$o_tpl->assign('error_js', $error);
$o_tpl->display('task_process.tpl');
?>
