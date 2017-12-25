<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

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

$iid = isset($_REQUEST['sid'])? $_REQUEST['sid'] : 0;

#get qualification
$quals = $o_s->getCourseQual($iid);

#get major
$majors = $o_s->getCourseMajor();

# set smarty tpl
$o_tpl = new Template;

if(array_key_exists($iid, $quals)){
	$o_tpl->assign('quals', $quals[$iid]);
	$o_tpl->assign('majors', $majors);
}

$o_tpl->assign('iid', $iid);
$o_tpl->assign('sid', $iid);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('iname', $o_s->getNameByIID($iid));
$o_tpl->display('institute_course.tpl');
?>