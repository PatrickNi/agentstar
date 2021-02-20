<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
ini_set("display_errors", 1);
error_reporting(2047);
set_time_limit(0);

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

$user_pos = $o_g->getUserPosition($user_id);


$from_day = isset($_POST['t_fdate'])? trim($_POST['t_fdate']) : "";
$to_day   = isset($_POST['t_tdate'])? trim($_POST['t_tdate']) : "";
$staff_id = isset($_POST['t_staff'])? trim($_POST['t_staff']) : $user_id;
$is_all   = isset($_POST['rp_type'])? trim($_POST['rp_type']) : "d";

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
$coaches  = array();

$from_archive = false;

if ($from_day != "" && $to_day != "" && $is_all != "") {

    //Check archive
    $archive = $o_r->getStaffArchive($staff_id, $is_all);
    if (count($archive) > 0) {
        $from_archive = true;
        $is_all   = $archive['is_all'];
        $from_day = $archive['from_day'];
        $to_day   = $archive['to_day'];
    }
    
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
        
        if (count($archive) > 0) {
            if ($staff_id == $user_id || $user_pos == 'PE' || $user_pos == 'C') {
                $courses    = $archive['courses'];
                $courseprocs= $archive['courseprocs'];
                $coursesems = $archive['coursesems'];
                $coursepots = $archive['coursepots'];
            }

            if ($staff_id == $user_id || $user_pos == 'C') {
                $visaagrees = $archive['visaagrees'];
                $visaprocs  = $archive['visaprocs'];
                //$visapaids  = $o_r->getAmountofVisaByUser($from_day, $to_day, $staff_id);
                $visavisits = $archive['visavisits'];
                $homeloan   = $archive['homeloan'];
                $homeloan_fee   = $archive['homeloan_fee']; 
            }

            if ($staff_id == $user_id || $user_pos == 'PC' || $user_pos == 'C')
                $coaches =  $archive['coaches'];

        }
        else {

            if ($staff_id == $user_id || $user_pos == 'PE' || $user_pos == 'C') {
                $courses    = $o_r->getNumOfCourseClientByUser($from_day, $to_day, $staff_id);
                $courseprocs= $o_r->getNumOfCourseProcessByUser($from_day, $to_day, $staff_id);
                $coursesems = $o_r->getAmountOfCourseCommByUser($from_day, $to_day, $staff_id);
                $coursepots = $o_r->getAmountOfCoursePotCommByUser($from_day, $to_day, $staff_id);
            }
            
            if ($staff_id == $user_id || $user_pos == 'C') {
                $visaagrees = $o_r->getNumOfAgreementByUser($from_day, $to_day, $staff_id); 
                $visaprocs  = $o_r->getNumOfVisaProcByUser($from_day, $to_day, $staff_id);
                //$visapaids  = $o_r->getAmountofVisaByUser($from_day, $to_day, $staff_id);
                $visavisits = $o_r->getNumOfVisitByUser($from_day, $to_day, $staff_id);
                $homeloan   = $o_r->getNumOfHomeLoan($from_day, $to_day, $staff_id);
                $homeloan_fee   = $o_r->getNumOfHomeLoanFee($from_day, $to_day, $staff_id);
            }

            if ($staff_id == $user_id || $user_pos == 'PC' || $user_pos == 'C')
                $coaches = $o_r->getNumOfCoach($from_day, $to_day, $staff_id);
        }
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

        if (count($archive) > 0) {
            if ($staff_id == $user_id || $user_pos == 'PE' || $user_pos == 'C') {
                $courses    = $archive['courses'];
                $courseprocs= $archive['courseprocs'];
                $coursesems = $archive['coursesems'];
                $coursepots = $archive['coursepots'];
            }

            if ($staff_id == $user_id || $user_pos == 'C') {
                $visaagrees = $archive['visaagrees'];
                $visaprocs  = $archive['visaprocs'];
                //$visapaids  = $o_r->getAmountofVisaByUser($from_day, $to_day, $staff_id);
                $visavisits = $archive['visavisits'];
                $homeloan   = $archive['homeloan'];
                $homeloan_fee   = $archive['homeloan_fee']; 
            }

            if ($staff_id == $user_id || $user_pos == 'PC' || $user_pos == 'C')
                $coaches =  $archive['coaches']; 
        }
        else {
            if ($staff_id == $user_id || $user_pos == 'PE' || $user_pos == 'C') {
                $courses    = $o_r->getAllOfCourseClientByUser($from_day, $to_day, $staff_id);
                $courseprocs= $o_r->getAllOfCourseProcessByUser($from_day, $to_day, $staff_id);
                $coursesems = $o_r->getAllOfCourseCommByUser($from_day, $to_day, $staff_id);
                $coursepots = $o_r->getAllOfCoursePotCommByUser($from_day, $to_day, $staff_id);
            }
            
            if ($staff_id == $user_id || $user_pos == 'C') {
                $visaagrees = $o_r->getAllOfAgreementByUser($from_day, $to_day, $staff_id); 
                $visaprocs  = $o_r->getAllOfVisaProcByUser($from_day, $to_day, $staff_id);
                //$visapaids  = $o_r->getTotalAmountofVisaByUser($from_day, $to_day, $staff_id);
                $visavisits = $o_r->getAllOfVisitByUser($from_day, $to_day, $staff_id);
                $homeloan   = $o_r->getAllOfHomeLoan($from_day, $to_day, $staff_id);        
                $homeloan_fee   = $o_r->getAllOfHomeLoanFee($from_day, $to_day, $staff_id); 
            }

            if ($staff_id == $user_id || $user_pos == 'PC' || $user_pos == 'C')
                $coaches = $o_r->getAllOfCoach($from_day, $to_day, $staff_id);
        }
    }

    if (isset($_POST['bt_archive']) && $_POST['bt_archive'] == 'archive report' && !$from_archive) {
        $filter = array('is_all'=>$is_all, 'from_day'=>$from_day, 'to_day'=>$to_day);
        $o_r->doStaffArchive($staff_id, $is_all, $filter, $courses, $courseprocs, $coursesems, $coursepots, $visaagrees, $visaprocs, $visavisits, $homeloan, $homeloan_fee, $coaches);
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
$o_tpl->assign('coaches', $coaches);
$o_tpl->assign('fromDay', $from_day);
$o_tpl->assign('toDay', $to_day);
$o_tpl->assign('staffid', $staff_id);
$o_tpl->assign('isAll', $is_all);
$o_tpl->assign('from_archive', $from_archive);



if ($user_pos == 'C'){
    $o_tpl->assign('slUsers', $o_g->getUserNameArr(0,true));
}
elseif($user_pos == 'PC' || $user_pos == 'PE'){
    //var_dump($o_g->getMemberByStaffId($user_id));
    $o_tpl->assign('slUsers', $o_g->getUserNameArr($user_id) + $o_g->getMemberByStaffId($user_id));
}
else {
    $o_tpl->assign('slUsers', $o_g->getUserNameArr($user_id));
}

$o_tpl->assign('ugs', $ugs);

$o_tpl->display('report_staff.2.tpl');



?>
