<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'ExportAPI.class.php');


ini_set("display_errors", 1);
error_reporting(2047);

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


$from_day = isset($_GET['fd'])? trim($_GET['fd']) : "";
$to_day   = isset($_GET['td'])? trim($_GET['td']) : "";
$catid    = isset($_GET['catid'])? trim($_GET['catid']) : 0;
$subid    = isset($_GET['subid'])? trim($_GET['subid']) : 0;
$staff_id    = isset($_GET['sf'])? trim($_GET['sf']) : 0;
$isOpencase = isset($_GET['op'])? trim($_GET['op']) : 0;

$exp_name = $isOpencase == 1? 'Open': 'Close';

$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}

# get review
$review_arr = array();
$proc_arr = array();
if ($catid > 0 && $subid > 0){
	$review_arr = $o_c->getVisaReview($from_day, $to_day, $catid, $subid, $staff_id, $isOpencase);

	# add process
	$proc_arr = $o_c->getProcessDateByVisa($review_arr);	

	//get amount
	$amount_arr = $o_c->getAccountByVisa($review_arr);
	
	if (isset($_REQUEST['bt_export']) && strtoupper($_REQUEST['bt_export']) == strtoupper("EXPORT {$exp_name} VISA EMAILS")){
		$clientArr = array();
		foreach ($review_arr as $v){
			array_push($clientArr, $v['client']);
		}
		$o_ept = new ExportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);
		$o_ept->exportClientEmail('','','','',$clientArr, strtolower($exp_name).'_visa');
		
	}
}

# get title
$title_arr = array();
$title_arr = $o_v->getVisaItemArr($catid, $subid);


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('review_arr', $review_arr);
$o_tpl->assign('procs', $proc_arr);
$o_tpl->assign('amounts', $amount_arr);
$o_tpl->assign('title_arr', $title_arr);
$o_tpl->assign('catname', $o_v->getVisaName($catid));
$o_tpl->assign('subname', $o_v->getSubclassName($catid, $subid));
$o_tpl->assign('fd', $from_day);
$o_tpl->assign('td', $to_day);
$o_tpl->assign('catid', $catid);
$o_tpl->assign('subid', $subid);
$o_tpl->assign('sf', $staff_id);
$o_tpl->assign('op', $isOpencase);
$o_tpl->assign('exp_name', $exp_name);
$o_tpl->assign('ugs', $ugs);


$o_tpl->display('report_visa_opencase.tpl');
?>