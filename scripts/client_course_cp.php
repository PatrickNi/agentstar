<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

# get course id
$course_id = isset($_REQUEST['courseid'])? trim($_REQUEST['courseid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;

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




# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}


$client_arr = $o_c->getOneClientInfo($client_id);
$course_arr = array();
$course_sem = array();
$course_process = array();


# get cource
$course_arr = $o_c->getCourseByUser(0, $client_id);

# get course sem
$course_sem = $o_c->getSemByCourse($client_id);

# get course process
$course_process = $o_c->getProcessDateOfCourse($client_id, 0);

	


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('course_arr', $course_arr);
$o_tpl->assign('course_sem', $course_sem);
$o_tpl->assign('course_process', $course_process);
$o_tpl->assign('col_arr', $o_c->getProcessOfCourse(1));
$o_tpl->assign('qual_arr', $o_c->getQualOfCourse());
$o_tpl->assign('major_arr', $o_c->getMajorOfCourse());
$o_tpl->assign('user_arr', $o_g->getUserNameArr());
$o_tpl->assign('cate_arr', $o_s->getCategory());

$o_tpl->assign('cid', $client_id);
$o_tpl->assign('course_id', $course_id);
$o_tpl->assign('client', $client_arr);
$o_tpl->assign('client_type', $o_c->getClientType($client_id));
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('coursecount', count($course_arr));
$o_tpl->display('client_course_cp.tpl');
?>
