<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
ini_set("display_errors", 1);
error_reporting(2047);


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_r = new ReportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

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

$viewWhat = isset($_POST['t_view'])? trim($_POST['t_view']) : "";
# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}

$reports = array();
switch ($viewWhat){
	case "v":
		$view_all = $user_id;
		if ($ugs['v_track']['v'] == 1){
			$view_all = 0;
		}
		$reports = $o_r->getTodoVisa($view_all);		
		break;
	case "c":
		$reports = $o_r->getTodoCourse($view_all);
		break;
	case "i":
		$reports = $o_r->getTodoInstitute();
		break;
	case "s":
		$reports = $o_r->getTodoService($view_all);
		break;		
	case "a":
		$reports = $o_r->getTodoAgent();
		break;				
}

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('urgent_arr', $reports);
$o_tpl->assign('viewWhat', $viewWhat);
$o_tpl->assign('ugs', $ugs);
$o_tpl->display('todo_review.tpl');
?>
