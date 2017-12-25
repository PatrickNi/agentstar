<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');



# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;


# get course id
$course_id = isset($_REQUEST['courseid'])? trim($_REQUEST['courseid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$sem_id = isset($_REQUEST['semid'])? trim($_REQUEST['semid']) : 0;
$isChange = isset($_REQUEST['isChange'])? trim($_REQUEST['isChange']) : 0;

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


$set_course['iid'] = isset($_POST['t_school'])? (string)trim($_POST['t_school']) : 0;
$set_course['catid']   = isset($_POST['t_cate'])? (string)trim($_POST['t_cate']) : 0;
$set_course['qual']   = isset($_POST['t_qual'])? (string)trim($_POST['t_qual']) : 0;
$set_course['major']  = isset($_POST['t_major'])? (string)trim($_POST['t_major']) : 0;
$set_course['agent']   = isset($_POST['t_agent'])? (string)trim($_POST['t_agent']) : 0;


$set_course['key']     = isset($_POST['t_key'])? (string)trim($_POST['t_key']) : "";

$set_course['tusdate'] = isset($_POST['t_tusdate'])? (string)trim($_POST['t_tusdate']) : "0000-00-00";
$set_course['tusdate'] = $set_course['tusdate'] == ""? "0000-00-00" : $set_course['tusdate'];
 
$set_course['tsdate']  = isset($_POST['t_tsdate'])? (string)trim($_POST['t_tsdate']) : "0000-00-00";
$set_course['tsdate']  = $set_course['tsdate'] == ""? "0000-00-00" : $set_course['tsdate'];

$set_course['method']  = isset($_POST['t_method'])? (string)trim($_POST['t_method']) : 0;
$set_course['fee']     = isset($_POST['t_fee'])? (string)trim($_POST['t_fee']) : 0;
$set_course['appfee']  = isset($_POST['t_appfee'])? (string)trim($_POST['t_appfee']) : 0;

$set_course['start']   = isset($_POST['t_fdate'])? (string)trim($_POST['t_fdate']) : "0000-00-00";
$set_course['start']   = $set_course['start'] == ""? "0000-00-00" : $set_course['start'];

$set_course['end']     = isset($_POST['t_tdate'])? (string)trim($_POST['t_tdate']) : "0000-00-00";
$set_course['end']     = $set_course['end'] == ""? "0000-00-00" : $set_course['end'];

$set_course['due']     = isset($_POST['t_due'])? (string)trim($_POST['t_due']) : "";
$set_course['done']    = isset($_POST['done'])? (string)trim($_POST['done']) : 0;
$set_course['active']  = $set_course['done'];

$set_course['refuse']  = isset($_POST['t_rf'])? (string)trim($_POST['t_rf']) : "";
$set_course['refuse']  = $set_course['refuse'] != ""? $set_course['refuse'] : "";	

$set_course['unit']  = isset($_POST['t_unit'])? (string)trim($_POST['t_unit']) : "year";

# get cource
$course_arr = array();
$course_arr = $o_c->getCourseByUser($course_id);
$cateid = $o_c->getCateIDbyCourse($course_id);
if ($isChange == 0 && $course_id > 0 && array_key_exists($cateid, $course_arr) && array_key_exists($course_id, $course_arr[$cateid])){
	$set_course = $course_arr[$cateid][$course_id];
	$set_course['catid'] = $cateid;
}
$msg = "";
if ($o_c->isGetCOEByCourse($course_id) != 0 && $o_c->getSemNumByCourse($course_id) == 0){
	$set_course['active'] = $set_course['active'] !=2? 1 : $set_course['active'] ;
	$msg = "alert('You may need to add semesters!');";
}

# get process sem
$process_arr = array();
if ($course_id > 0){
	$process_arr = $o_c->getCourseProcess($course_id);
}


# get agent name
$agent_arr = array();
$agent_arr = $o_a->getAgent('top');

# set smarty tpl
$o_tpl = new Template;

$o_tpl->assign('process_arr', $process_arr);
$o_tpl->assign('agent_arr', $agent_arr);
$o_tpl->assign('msg_alert', $msg);
#set category
$o_tpl->assign('cate_arr', $o_s->getCategory());

#set school name
$sc_arr = array();
if ($set_course['catid'] > 0){	
	$sc_arr = $o_s->getSchool($set_course['catid']);
	$o_tpl->assign('sc_arr', $sc_arr);
}

#set qualification & major
if (array_key_exists($set_course['iid'], $sc_arr)){
	$arr = $o_s->getCourseQual($set_course['iid']);
	if(array_key_exists($set_course['iid'], $arr)){
		$o_tpl->assign('qual_arr', $arr[$set_course['iid']]);
	}
}

#set qualification & major
if (count($arr) > 0 && array_key_exists($set_course['qual'], $arr[$set_course['iid']])){
	$arr = $o_s->getCourseMajor($set_course['qual']);
	if(array_key_exists($set_course['qual'], $arr)){
		$o_tpl->assign('major_arr', $arr[$set_course['qual']]);
	}
}
$o_tpl->assign('dt_arr', $set_course);


$o_tpl->assign('item_arr', $o_c->getProcessOfCourse());
$o_tpl->assign('courseid', $course_id);
$o_tpl->assign('cid', $client_id);


$o_tpl->assign('loginid', $user_id);
$o_tpl->assign('method_arr', $o_c->getMethodOfCourse());
$o_tpl->assign("itemtype", __FILE_APPLY_COURSE);
$o_tpl->display('client_course_detail_cp.tpl');
?>
