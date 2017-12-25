<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');
require_once(__LIB_PATH.'ExportAPI.class.php');

ini_set("display_errors", 1);
error_reporting(2047);
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

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
$self_url 	 = "institute_student.php";

$from_date = isset($_REQUEST['t_fdate'])? trim($_REQUEST['t_fdate']) : "";
$to_date  = isset($_REQUEST['t_tdate'])? trim($_REQUEST['t_tdate']) : "";
$iid = isset($_REQUEST['sid'])? trim($_REQUEST['sid']) : 0;

# get user position
$view_all = 0;
if ($ugs['seeall'] == 0){
	$view_all = $user_id;
}

$student_arr = array();
$student_arr = $o_s->countStudent($from_date, $to_date, $iid, $view_all);

if (isset($_REQUEST['bt_export']) && strtoupper($_REQUEST['bt_export']) == "EXPORT STUDENT EMAILS"){
	$clientArr = array();
	foreach ($student_arr as $v){
		array_push($clientArr, $v['cid']);
	}
	$o_ept = new ExportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);
	$o_ept->exportClientEmail('','','','',$clientArr, 'institute_student');
}

$totals  = $o_s->countStudentNumRows($from_date, $to_date, $iid, $view_all);
$o_page =  new PageDistribute($self_url, $totals['total'], $page_size, $page_offset, $page, "&sid={$iid}&t_fdate={$from_date}&t_tdate={$to_date}");

# set smarty tpl
$o_tpl = new Template;
$quals = $o_s->getCourseQual($iid);
$o_tpl->assign('courses', isset($quals[$iid])?$quals[$iid]:0);
$majors = $o_s->getCourseMajor();
$o_tpl->assign('majors', $majors);
$o_tpl->assign('users', $o_g->getUserNameArr());
$o_tpl->assign('iname', $o_s->getNameByIID($iid));

$o_tpl->assign('sid', $iid);
$o_tpl->assign('from', $from_date);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('to', $to_date);
$o_tpl->assign('page_url', $o_page->ShowPageLink());
$o_tpl->assign('student_arr', $student_arr);
$o_tpl->assign('totals', $totals);
$o_tpl->display('institute_student.tpl');

?>
