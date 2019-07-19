<?php
require_once('../etc/const.php');

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

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


# inital variable
$page = isset($_GET['p'])? trim($_GET['p']) : 1;
$page_size 	 = 100;
$page_offset = 10;
$self_url 	 = "agent_student.php";

$from_date = isset($_REQUEST['t_fdate'])? trim($_REQUEST['t_fdate']) : "";
$to_date  = isset($_REQUEST['t_tdate'])? trim($_REQUEST['t_tdate']) : "";
$agent_id = isset($_REQUEST['aid'])? trim($_REQUEST['aid']) : 0;

$is_global_ambassador = isset($_REQUEST['is_amb'])? trim($_REQUEST['is_amb']) : 0;

$staff_id = $user_id;
if (isset($_REQUEST['t_staff']) && $_REQUEST['t_staff'] > 0) {
    $staff_id = $_REQUEST['t_staff'];
}



$student_arr = array();
$student_arr = $o_a->countStudent($from_date, $to_date, $agent_id, $staff_id);
$totals  = $o_a->countStudentNumRows($from_date, $to_date, $agent_id, $staff_id);
$o_page =  new PageDistribute($self_url, $totals['total'], $page_size, $page_offset, $page, "&aid={$agent_id}&t_fdate={$from_date}&t_tdate={$to_date}&is_amb={$is_global_ambassador}");

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('courses', $o_s->getCourseQual());
$o_tpl->assign('majors', $o_s->getCourseMajor());
$o_tpl->assign('users', $o_g->getUserNameArr());
$o_tpl->assign('schools', $o_s->getSchool());

$o_tpl->assign('aid', $agent_id);
$o_tpl->assign('from', $from_date);
$o_tpl->assign('to', $to_date);
$o_tpl->assign('page_url', $o_page->ShowPageLink());
$o_tpl->assign('student_arr', $student_arr);
$o_tpl->assign('totals', $totals);
$o_tpl->assign('ugs', $ugs);

$o_tpl->assign('is_global_ambassador', $is_global_ambassador);
$o_tpl->assign('staffid', $staff_id);
# get user position
if (isset($ugs['seeall']) && $ugs['seeall']['v'] == 1){
    $o_tpl->assign('slUsers', $o_g->getUserNameArr());
}else {
    $o_tpl->assign('slUsers', $o_g->getUserNameArr($staff_id));
}
if ($agent_id > 0) {
    $o_tpl->assign("agent_arr", $o_a->getAgentList($agent_id));
}

$o_tpl->display('agent_student.tpl');

?>

