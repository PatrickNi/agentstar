<?php
require_once('../etc/const.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'CoachAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_h = new CoachAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

//user grants
$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
include_once dirname(__FILE__).'/init_grants.php';
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}


# inital variable
$agent_id = isset($_REQUEST['aid'])? trim($_REQUEST['aid']) : 0;

$is_global_ambassador = isset($_REQUEST['is_amb'])? trim($_REQUEST['is_amb']) : 0;
$staff_id = $user_id;
if (isset($_REQUEST['t_staff']) && $_REQUEST['t_staff'] > 0) {
    $staff_id = $_REQUEST['t_staff'];
}


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('user_arr', $o_g->getUserNameArr(0,true));
$o_tpl->assign('aid', $agent_id);
$o_tpl->assign('ugs', $ugs);

$o_tpl->assign('coach_arr', $o_a->countCoach($agent_id));
$o_tpl->assign('items_arr', $o_h->getItems());
$o_tpl->assign('uid', $user_id);
$o_tpl->assign('user_arr', $o_g->getUserNameArr());
$o_tpl->assign('grade_arr', $o_h->GRADE_LIST);

if ($agent_id > 0) {
    $tmp = $o_a->getAgentList($agent_id);
    $o_tpl->assign("agent_arr", $tmp);
}

$o_tpl->display('agent_coach.tpl');

?>

