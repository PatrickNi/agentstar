<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'TodoAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

//user grants
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_t = new TodoAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


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
$course_id  = isset($_REQUEST['courseid'])? trim($_REQUEST['courseid']) : 0;
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$process_id = isset($_REQUEST['pid'])? trim($_REQUEST['pid']) : 0;
$isOther    = isset($_REQUEST['isOther'])? trim($_REQUEST['isOther']) : 0;
$item_id    = isset($_REQUEST['itemid'])? trim($_REQUEST['itemid']) : 0;

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

# get process
$process_arr = array();
$process_arr = $o_c->getProcessOfCourse();
$msg = '';
if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$sets['date']    = isset($_REQUEST['t_date'])? (string)trim($_REQUEST['t_date']) : "0000-00-00";
	$sets['date']    = $sets['date'] == ""? "0000-00-00" : $sets['date'];
	
	$sets['due']     = isset($_REQUEST['t_due'])? (string)trim($_REQUEST['t_due']) : "0000-00-00";
	$sets['due']    = $sets['due'] == ""? "0000-00-00" : $sets['due'];
	
	$sets['detail']  = isset($_REQUEST['t_detail'])? (string)trim($_REQUEST['t_detail']) : "";
	$sets['add']     = isset($_REQUEST['t_add'])? (string)trim($_REQUEST['t_add']) : "";
	
	$sets['subject'] = isset($_REQUEST['t_subject'])? (string)trim($_REQUEST['t_subject']) : 0;
	$sets['done']    = isset($_REQUEST['t_done'])? trim($_REQUEST['t_done']) : 0;
	$sets['ex']      = isset($_REQUEST['t_ex'])? trim($_REQUEST['t_ex']) : 0;

	if(($sets['date'] == '0000-00-00' && $sets['done'] == 1)) {
		$msg = "alert(':need date');";
	}
	elseif(($sets['due'] == '0000-00-00' && $sets['done'] == 0)) {
		$msg = "alert(':need due date');";
	}
	else {

		if($isOther == 1){
			$sets['order'] = $o_c->getCourseProcessOrder($process_id, $course_id);
			$o_c->resetCourseProcessOrder($course_id, $sets['order']);
			$sets['order'] = $sets['order'] + 1; 
			$sets['isAuto'] = 0;
			$o_c->addCourseProcess($course_id, $sets);

		}else{
			$o_c->setCourseProcess($process_id, $sets, $course_id);

			if($sets['done'] == 1 && $process_id > 0){		
				$o_t->doneBySourceId('course', $process_id);
				
				$sets['order'] = $o_c->getCourseProcessOrder($process_id, $course_id);
				$sets['subject'] = $item_id > 0? $item_id : $o_c->getNextCourseProcessID($sets['subject']);
				$sets['order'] = $sets['order'] + 1;
				$sets['date']    = "0000-00-00";
				$sets['due']     = "0000-00-00";
				$sets['detail']  = "";
				$sets['done']    = 0;
				$o_c->autoCourseProcess($course_id, $sets);
				$o_c->alarmAddSemester($course_id, $process_id);			
			}

			if ($sets['due'] > '0000-00-00')
				$o_t->setDueDate('course', $process_id, $sets['due']);			
		}
		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;
	}

}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if($process_id > 0){
		$o_c->delCourseProcessByID($process_id);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}


# format array
$show_arr = $o_c->getCourseProcess($course_id);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('process_arr', $process_arr);

if($isOther == 0 && $process_id > 0 && array_key_exists($process_id, $show_arr)){
	$o_tpl->assign('dt_arr', $show_arr[$process_id]);
	$o_tpl->assign('forward_btn', $o_c->getForwardProcess($show_arr[$process_id]['subject']));
}
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('course_id', $course_id);
$o_tpl->assign('pid', $process_id);
$o_tpl->assign('isOther', $isOther);
$o_tpl->assign('isapprove', $o_c->getCourseConsult($course_id) == $user_id || (isset($ugs['c_track']['v']) && $ugs['c_track']['v'] == 1)? 1 :  0);
$o_tpl->assign('msg', $msg);
$o_tpl->display('client_course_process.tpl');
?>
