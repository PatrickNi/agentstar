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


$from_day = isset($_POST['t_fdate'])? trim($_POST['t_fdate']) : "";
$to_day   = isset($_POST['t_tdate'])? trim($_POST['t_tdate']) : "";
$staff_id = isset($_POST['t_staff'])? trim($_POST['t_staff']) : $user_id;
$is_all	  = isset($_POST['rp_type'])? trim($_POST['rp_type']) : "d";

$weeks = array();
$tmp_weeks  = array();
$courses    = array();
$courseprocs= array();
$coursesems = array();
$visaprocs  = array();
$visaagrees = array();
$visavisits = array();
$coursepots = array();
$visapaids = array();
$homeloan  = array();
$homeloan_fee  = array();
if ($from_day != "" && $to_day != "" && $is_all != "") {
	#format date range
	if ($is_all == "d") {
			
		$weeks   = array();
		$_day    = $from_day;
		$_begin  = $from_day;
		$_end    = $from_day;
		$last_wk = date("YW", strtotime($from_day));
		while ($_day <= $to_day){
			$wk = date("YW", strtotime($_day));
			if ($last_wk != $wk){
				$weeks[$last_wk] = $_begin .'~'. $_end;
				$_begin  = $_day;
				$last_wk = $wk; 
			}
			$_end = $_day;
			$_day = date("Y-m-d", strtotime('+1 Day', strtotime($_day)));
		}
		if (!isset($weeks[$wk])){
			$weeks[$wk] = $_begin .'~'. $_end;
		}
		
	
		$courses    = $o_r->getNumOfCourseClientByUser($from_day, $to_day, $staff_id);
		$courseprocs= $o_r->getNumOfCourseProcessByUser($from_day, $to_day, $staff_id);
		$coursesems = $o_r->getAmountOfCourseCommByUser($from_day, $to_day, $staff_id);
   		$coursepots = $o_r->getAmountOfCoursePotCommByUser($from_day, $to_day, $staff_id);
		$visaagrees = $o_r->getNumOfAgreementByUser($from_day, $to_day, $staff_id);	
		$visaprocs  = $o_r->getNumOfVisaProcByUser($from_day, $to_day, $staff_id);
		//$visapaids  = $o_r->getAmountofVisaByUser($from_day, $to_day, $staff_id);
		$visavisits = $o_r->getNumOfVisitByUser($from_day, $to_day, $staff_id);
		$homeloan   = $o_r->getNumOfHomeLoan($from_day, $to_day, $staff_id);
		$homeloan_fee   = $o_r->getNumOfHomeLoanFee($from_day, $to_day, $staff_id);
	
	}
	elseif($is_all == "s"){
		//cal weeks
		$w = 1;
		$_day    = $from_day;
		$last_wk = date("YW", strtotime($from_day));
		while ($_day <= $to_day){
			$wk = date("YW", strtotime($_day));
			if ($last_wk != $wk){
				$w++;
				$last_wk = $wk;
			}
			$_day = date("Y-m-d", strtotime('+1 Day', strtotime($_day)));
		}

		$weeks['all'] = $from_day ."~". $to_day ." ({$w} weeks)";
		$courses    = $o_r->getAllOfCourseClientByUser($from_day, $to_day, $staff_id);
		$courseprocs= $o_r->getAllOfCourseProcessByUser($from_day, $to_day, $staff_id);
        $coursesems = $o_r->getAllOfCourseCommByUser($from_day, $to_day, $staff_id);
        $coursepots = $o_r->getAllOfCoursePotCommByUser($from_day, $to_day, $staff_id);
		$visaagrees = $o_r->getAllOfAgreementByUser($from_day, $to_day, $staff_id);	
		$visaprocs  = $o_r->getAllOfVisaProcByUser($from_day, $to_day, $staff_id);
		//$visapaids  = $o_r->getTotalAmountofVisaByUser($from_day, $to_day, $staff_id);
		$visavisits = $o_r->getAllOfVisitByUser($from_day, $to_day, $staff_id);
		$homeloan   = $o_r->getAllOfHomeLoan($from_day, $to_day, $staff_id);		
		$homeloan_fee   = $o_r->getAllOfHomeLoanFee($from_day, $to_day, $staff_id);	
	}
}

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('weeks', $weeks);
$o_tpl->assign('courses', $courses);
$o_tpl->assign('courseprocs', $courseprocs);
$o_tpl->assign('coursesems', $coursesems);
$o_tpl->assign('visaprocs', $visaprocs);
$o_tpl->assign('visaagrees', $visaagrees);
//$o_tpl->assign('visapaids', $visapaids);
$o_tpl->assign('visavisits', $visavisits);
$o_tpl->assign('coursepots', $coursepots);
$o_tpl->assign('homeloan', $homeloan);
$o_tpl->assign('homeloan_fee', $homeloan_fee);
$o_tpl->assign('fromDay', $from_day);
$o_tpl->assign('toDay', $to_day);
$o_tpl->assign('staffid', $staff_id);
$o_tpl->assign('isAll', $is_all);

# get user position
if (isset($ugs['rpt_staff']) && $ugs['rpt_staff']['v'] == 1){
	$o_tpl->assign('slUsers', $o_g->getUserNameArr());
}else {
	$o_tpl->assign('slUsers', $o_g->getUserNameArr($staff_id));
}
$o_tpl->assign('ugs', $ugs);

$o_tpl->display('report_staff.2.tpl');
?>
