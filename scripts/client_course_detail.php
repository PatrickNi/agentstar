<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');



# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

//user grants
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}

# get course id
$course_id = isset($_REQUEST['courseid'])? trim($_REQUEST['courseid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$sem_id = isset($_REQUEST['semid'])? trim($_REQUEST['semid']) : 0;
$isChange = isset($_REQUEST['isChange'])? trim($_REQUEST['isChange']) : 0;

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


$set_course['iid'] = isset($_REQUEST['t_school'])? (string)trim($_REQUEST['t_school']) : 0;
$set_course['catid']   = isset($_REQUEST['t_cate'])? (string)trim($_REQUEST['t_cate']) : 0;
$set_course['qual']   = isset($_REQUEST['t_qual'])? (string)trim($_REQUEST['t_qual']) : 0;
$set_course['major']  = isset($_REQUEST['t_major'])? (string)trim($_REQUEST['t_major']) : 0;
$set_course['agent']   = isset($_REQUEST['t_agent'])? (string)trim($_REQUEST['t_agent']) : '';


$set_course['key']     = isset($_REQUEST['t_key'])? (string)trim($_REQUEST['t_key']) : "";

$set_course['tusdate'] = isset($_REQUEST['t_tusdate'])? (string)trim($_REQUEST['t_tusdate']) : "0000-00-00";
$set_course['tusdate'] = $set_course['tusdate'] == ""? "0000-00-00" : $set_course['tusdate'];
 
$set_course['tsdate']  = isset($_REQUEST['t_tsdate'])? (string)trim($_REQUEST['t_tsdate']) : "0000-00-00";
$set_course['tsdate']  = $set_course['tsdate'] == ""? "0000-00-00" : $set_course['tsdate'];

$set_course['method']  = isset($_REQUEST['t_method'])? (string)trim($_REQUEST['t_method']) : 0;
$set_course['fee']     = isset($_REQUEST['t_fee'])? (string)trim($_REQUEST['t_fee']) : 0;
$set_course['appfee']  = isset($_REQUEST['t_appfee'])? (string)trim($_REQUEST['t_appfee']) : 0;

$set_course['start']   = isset($_REQUEST['t_fdate'])? (string)trim($_REQUEST['t_fdate']) : "0000-00-00";
$set_course['start']   = $set_course['start'] == ""? "0000-00-00" : $set_course['start'];

$set_course['end']     = isset($_REQUEST['t_tdate'])? (string)trim($_REQUEST['t_tdate']) : "0000-00-00";
$set_course['end']     = $set_course['end'] == ""? "0000-00-00" : $set_course['end'];

$set_course['due']     = isset($_REQUEST['t_due'])? (string)trim($_REQUEST['t_due']) : "";
$set_course['done']    = isset($_REQUEST['done'])? (string)trim($_REQUEST['done']) : 0;
$set_course['active']  = $set_course['done'];

$set_course['refuse']  = isset($_REQUEST['t_rf'])? (string)trim($_REQUEST['t_rf']) : "";
$set_course['refuse']  = $set_course['refuse'] != ""? $set_course['refuse'] : "";	

$set_course['unit']  = isset($_REQUEST['t_unit'])? (string)trim($_REQUEST['t_unit']) : "year";

$apodue = isset($_REQUEST['t_apodue'])? (string)trim($_REQUEST['t_apodue']) : "0000-00-00";
$apodue = $apodue != ''? $apodue : "0000-00-00";

$set_course['consultant_date']   = isset($_REQUEST['t_consultant_date'])? (string)trim($_REQUEST['t_consultant_date']) : "0000-00-00";
$set_course['consultant_date']   = $set_course['consultant_date'] == ""? "0000-00-00" : $set_course['consultant_date'];
$set_course['consultant'] = isset($_REQUEST['t_consultant'])? (string)trim($_REQUEST['t_consultant']) : 0;


$msg = '';
if (isset($_REQUEST['bt_name']) && (strtoupper($_REQUEST['bt_name']) == "SAVE" || strtoupper($_REQUEST['bt_name']) == "COURSEPROCESS")){
	if ($ugs['c_service']['i'] !=1 ) {
		echo "<script language='javascript'>alert('Permission denied!');if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;
	}

	
	$process = false;
	if($course_id > 0) {
		$process_arr = $o_c->getCourseProcess($course_id);
		foreach ($process_arr as $v){
			if($v['subject'] <= __C_GET_COE && $v['done'] == 1 && ($v['date'] == '' || $v['date'] == '0000-00-00')) {
				$msg = 'alert("[INCOMPLETED INFO] => '. $course_process_arr[$v['subject']] .' need date")';
				$process = true;
				break;
			}
			else if($v['subject'] <= __C_GET_COE && $v['done'] == 0 && ($v['due'] == '' || $v['due'] == '0000-00-00')) {
				$msg = 'alert("[INCOMPLETED INFO] => '. $course_process_arr[$v['subject']] .' need due date")';
				$process = true;
				break;				
			}
		}
	}

	//check necessary column
	if($set_course['catid'] == 0 ||	$set_course['iid'] == 0 || $set_course['qual'] == 0 || $set_course['major'] == 0 || $set_course['agent'] == '' || $set_course['start'] == '0000-00-00' || $set_course['end'] == '0000-00-00' || $set_course['fee'] == 0 || $set_course['due'] == "" || $process || $apodue == "0000-00-00" || ($set_course['refuse'] == "" && $set_course['active'] == 2)) {
		if($msg == '') {
			if ($set_course['refuse'] == "" && $set_course['active'] == 2) {
				$msg = 'alert("Refuse reason should not be empty")';
			}
			elseif($apodue == "0000-00-00")  {
				$msg = 'alert("Apply offer => need due date")';
			}
			else {
				$msg = 'alert("[INCOMPLETED INFO] \nCheck follwoings: \n1.Category\n2.Institute\n3.Qualification\n4.Major\n5.Top-Agent\n6.Start Date\n7.Compere Date\n8.Tution Fee\n9.Duration\n")';
			}
		}
	}
	else {

		if($course_id > 0){
			$o_c->setCourse($course_id, $set_course);
		}else{
			$course_id = $o_c->addCourse($user_id, $client_id, $set_course);
		}

		if($set_course['done'] == 2){
			$o_c->finishProcessofCourse($course_id);

		}else{
			#add new process
			$maxid = $o_c->getMaxCourseProcess($course_id);
			if ($maxid == 0 && ($set_course['start'] != "" || $set_course['start'] != "0000-00-00")){
				$sets['order'] = $o_c->getCourseProcessOrder(0, $course_id);
				$o_c->resetCourseProcessOrder($course_id, $sets['order']);
				$sets['order'] = $sets['order'] + 1;             

				$sets['subject'] = $o_c->getNextCourseProcessID($maxid);
				$sets['done']    = 0;
				$sets['detail']  = "";
				$sets['add']     = "";
				$sets['date']    = '0000-00-00';
				$sets['due']     = $apodue;
				$o_c->autoCourseProcess($course_id, $sets, 1);        
				/*
				#step 2 receive offer
				$o_c->resetCourseProcessOrder($course_id, $sets['order']);
				$sets['order'] = $sets['order'] + 1;                
				$sets['subject'] = $o_c->getNextCourseProcessID($sets['subject']);
				$sets['date']    = "0000-00-00";
				$sets['add']     = "";
	            $sets['due']     = "0000-00-00";
    	        $sets['done']    = 0;
        	    $o_c->autoCourseProcess($course_id, $sets, 1);
				 */
        	}        
	    }
		
		if(strtoupper($_REQUEST['bt_name']) == "SAVE") {
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;
		}		
	}

}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	$o_c->delCourseByID($course_id);
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;
}


# get cource
$course_arr = array();
$course_arr = $o_c->getCourseByUser($course_id);
$cateid = $o_c->getCateIDbyCourse($course_id);
if ($isChange == 0 && $course_id > 0 && array_key_exists($cateid, $course_arr) && array_key_exists($course_id, $course_arr[$cateid])){
	$set_course = $course_arr[$cateid][$course_id];
	$set_course['catid'] = $cateid;
}

if ($course_id > 0 && $ugs['c_track']['v'] == 0 && $course_arr[$cateid][$course_id]['consultant'] != $user_id) {
	echo "<script language='javascript'>alert('Access denied!');window.close();</script>";
	exit;
}

//$msg = "";
if ($o_c->isGetCOEByCourse($course_id) != 0 && $o_c->getSemNumByCourse($course_id) == 0){
	$set_course['active'] = $set_course['active'] !=2? 1 : $set_course['active'] ;
	$msg = "alert('You may need to add semesters!');";
}

# get process sem
$process_arr = array();
if ($course_id > 0){
	$process_arr = $o_c->getCourseProcess($course_id);
	foreach ($process_arr as $v){
		if($v['subject'] == __C_APPLY_OFFER) {
			$apodue = $v['due'];
		}
	}
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
$arr = array();
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

$o_tpl->assign('user_arr',$o_g->getUserNameArr());
$o_tpl->assign('item_arr', $o_c->getProcessOfCourse());
$o_tpl->assign('courseid', $course_id);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('isapprove', $o_c->getCourseConsult($client_id) == $user_id || (isset($ugs['c_track']['v']) && $ugs['c_track']['v'] == 1)? 1 :  0);
$o_tpl->assign('user_id', $user_id);
$o_tpl->assign('method_arr', $o_c->getMethodOfCourse());
$o_tpl->assign("itemtype", __FILE_APPLY_COURSE);
$o_tpl->assign("ugs", $ugs);
$o_tpl->assign('client', $o_c->getOneClientInfo($client_id));
$o_tpl->assign('apodue', $apodue);
$o_tpl->display('client_course_detail.tpl');
?>
