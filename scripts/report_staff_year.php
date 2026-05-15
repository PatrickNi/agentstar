<?php
require_once('../etc/const.php');
//ini_set("display_errors", 1);
//error_reporting(E_ALL);


require_once(__LIB_PATH . 'Template.class.php');
require_once(__LIB_PATH . 'Report.class.php');
require_once(__LIB_PATH . 'GeicAPI.class.php');
require_once(__LIB_PATH . 'CoachAPI.class.php');
require_once(__LIB_PATH . 'ClientAPI.class.php');

set_time_limit(0);

function getAnnualWeekStats($startDateStr, $endDateStr)
{
    $start = new DateTime($startDateStr);
    $end = new DateTime($endDateStr);

    // 如果开始日期大于结束日期，直接返回空
    if ($start > $end)
        return [];

    $results = [];
    $startYear = (int) $start->format('Y');
    $endYear = (int) $end->format('Y');

    for ($year = $startYear; $year <= $endYear; $year++) {
        // 1. 确定该年的自然边界
        $yearFirstDay = new DateTime("$year-01-01 00:00:00");
        $yearLastDay = new DateTime("$year-12-31 23:59:59");

        // 2. 根据输入限制调整开始和结束日期
        // 如果是第一年，开始日期不能早于输入日期
        $currentStart = ($yearFirstDay < $start) ? clone $start : clone $yearFirstDay;
        // 如果是最后一年，结束日期不能晚于输入日期
        $currentEnd = ($yearLastDay > $end) ? clone $end : clone $yearLastDay;

        // 3. 计算该年的总周数
        // 注意：ISO-8601 标准中，有些年份有 53 周。这里计算该自然年内的周数。
        $weeksInYear = calculateWeeksInPeriod($currentStart, $currentEnd);

        $results[] = [
            'year' => $year,
            'weeks' => $weeksInYear,
            'start_date' => $currentStart->format('Y-m-d'),
            'end_date' => $currentEnd->format('Y-m-d'),
            'courses' => 0,
            'courseprocs_apo' => 0,
            'courseprocs_reo' => 0,
            'courseprocs_rec' => 0,
            'coursepots' => 0,
            'coursesems' => 0,
            'visaagrees' => 0,
            'visagrants' => 0,
            'visavisits_vc' => 0,
            'visavisits_cf' => 0,
            'net_profit' => 0,
            'apply_visa' => 0,
            'finalized_free' => 0,
            'finalized_paid' => 0,
            'reviewer' => 0,
            'coach_hour' => 0,
            'coach_student' => 0,
            'coach_lessons' => 0,
            'coach_paid' => 0,
            'coach_sale' => 0,
        ];
    }

    return $results;
}

/**
 * 计算两个日期之间包含的周数（向上取整）
 */
function calculateWeeksInPeriod($start, $end)
{
    $interval = $start->diff($end);
    $days = $interval->days + 1; // 包含结束当天
    return ceil($days / 7);
}

# check valid user
$user_id = isset($_COOKIE['userid']) ? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_r = new ReportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

//user grants
$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item) {
    if (array_key_exists($item, $user_grants)) {
        foreach ($g_user_ops as $key => $op) {
            $ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op);
        }
    }
}

$user_pos = $o_g->getUserPosition($user_id);


$staff_id = isset($_REQUEST['t_staff']) ? trim($_REQUEST['t_staff']) : 0;
$is_all = isset($_POST['rp_type']) ? trim($_POST['rp_type']) : "d";
$query_about = isset($_POST['t_about']) ? trim($_POST['t_about']) : "";

$weeks = array();
$tmp_weeks = array();
$courses = array();
$courseprocs = array();
$coursesems = array();
$visaprocs = array();
$visaagrees = array();
$visavisits = array();
$visareviews = array();
$coursepots = array();
$visapaids = array();
$homeloan = array();
$homeloan_fee = array();
$coaches = array();
$coaches_fee = array();
$visaapplies = array();

$from_archive = false;

if ($staff_id != "") {

    if ($staff_id > 0) {
        $staff_info = $o_g->getUserList($staff_id);
        if (isset($staff_info[$staff_id]) && $staff_info[$staff_id]['leavedate'] > '0000-00-00') {
            $offduty = true;
        } else {
            $staff_info[$staff_id]['leavedate'] = date('Y-m-d');
        }
    } else {
        die('Staff not exist');
    }


    //Check archive
    $archive = $o_r->getStaffArchive($staff_id, $is_all);
    if (count($archive) > 0) {
        $from_archive = true;
        $is_all = $archive['is_all'];
        $from_day = $archive['from_day'];
        $to_day = $archive['to_day'];
        die('Staff was offduty');
    }

    //Calcul From ~ To
    $report_from_to = getAnnualWeekStats($staff_info[$staff_id]['startdate'], $staff_info[$staff_id]['leavedate']);


    foreach ($report_from_to as $k => $fromto) {
        if ($staff_id == $user_id || $user_pos == 'PE' || $user_pos == 'C') {
            $offduty = false;

            $courses = $o_r->getAllOfCourseClientByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $offduty, $query_about);
            $courseprocs = $o_r->getAllOfCourseProcessByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $offduty, $query_about);
            $coursesems = $o_r->getAllOfCourseCommByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $offduty, $query_about);
            $coursepots = $o_r->getAllOfCoursePotCommByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $offduty, $query_about);

            $report_from_to[$k]['courses'] = $courses['all']['cnt'];//Course clients
            $report_from_to[$k]['courseprocs_apo'] = $courseprocs['all']['apocnt'];//Apply Offer
            $report_from_to[$k]['courseprocs_reo'] = $courseprocs['all']['reocnt'];//Received Offer
            $report_from_to[$k]['courseprocs_rec'] = $courseprocs['all']['reccnt'];//Received CEO
            $report_from_to[$k]['coursepots'] = $coursepots['all']['rcomm'];//Potential Comm
            $report_from_to[$k]['coursesems'] = $coursesems['all']['bonus'];//Received Comm
        }

        if ($staff_id == $user_id || $user_pos == 'C' || $user_pos == 'PE') {
            $visaagrees = $o_r->getAllOfAgreementByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $visagrants = $o_r->getAllOfVisaGranted($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);

            $report_from_to[$k]['visaagrees'] = $visaagrees['all']['fee'];//Agreement Signed
            $report_from_to[$k]['visagrants'] = $visagrants['all']['gfee'];//Agreement staff visa grant
        }

        if ($staff_id == $user_id || $user_pos == 'C') {
            $visapaids = $o_r->getAllOfVisaPaidByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $visaprocs = $o_r->getAllOfVisaProcByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $visavisits = $o_r->getAllOfVisitByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $visareviews = $o_r->getAllOfVisaReviewByUser($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $homeloan = $o_r->getAllOfHomeLoan($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $homeloan_fee = $o_r->getAllOfHomeLoanFee($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $visaapplies = $o_r->getAllOfVisaApply($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);

            $report_from_to[$k]['visavisits_vc'] = $visavisits['all']['pcnt'];//Visa Consultant
            $report_from_to[$k]['visavisits_cf'] = $visavisits['all']['totalcfee'];//Consultant Fee
            $report_from_to[$k]['net_profit'] = $visapaids['all']['paid'] - $visapaids['all']['spand'];//Net Profit
            $report_from_to[$k]['apply_visa'] = $visaapplies['all']['total']['paid'];//Apply Visa
            @$report_from_to[$k]['finalized_free'] = $visaprocs['all']['gfee_free'] + $visaprocs['all']['wfee_free'] + $visaprocs['all']['rfee_free'] + $visaprocs['all']['cfee_free'] + $visaprocs['all']['sfee_free']; // Finalized Cases (Free)
            @$report_from_to[$k]['finalized_paid'] = $visaprocs['all']['gfee_paid'] + $visaprocs['all']['wfee_paid'] + $visaprocs['all']['rfee_paid'] + $visaprocs['all']['cfee_paid'] + $visaprocs['all']['sfee_paid']; // Finalized Cases (Paid)
            $report_from_to[$k]['reviewer'] = $visareviews ? $visareviews['all']['cnt'] : 0;//Reviewer
        }

        if ($staff_id == $user_id || $user_pos == 'PC' || $user_pos == 'C' || $user_pos == 'M') {
            $coaches = $o_r->getAllOfCoach($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);
            $coaches_fee = $o_r->getAllOfCoachFee($fromto['start_date'], $fromto['end_date'], $staff_id, $query_about);

            foreach ($coaches_fee as $week => $v) {
                foreach ($v as $itemid => $vv) {
                    if (!isset($coaches[$week]) || !isset($coaches[$week][$itemid])) {
                        $coaches[$week][$itemid] = array('title' => $vv['title'], 'list' => array(), 'extrahour' => 0, 'lessons' => array(), 'hour' => 0, 'client' => 0);
                    }
                }
            }

            foreach ($coaches as $week => $v) {
                foreach ($v as $itemid => $vv) {
                    @$report_from_to[$k]['coach_hour'] += $vv['hour'];
                    @$report_from_to[$k]['coach_student'] += count($vv['list']);
                    @$report_from_to[$k]['coach_lessons'] += count($vv['lessons']);
                    @$report_from_to[$k]['coach_paid'] += $coaches[$week][$itemid]['paid'];
                    @$report_from_to[$k]['coach_sale'] += $coaches[$week][$itemid]['sale'];
                }
            }
        }
    }
}
/*
echo "<pre>";
var_dump($report_from_to);
echo "</pre>";
exit;
*/
# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('reports', $report_from_to);
$o_tpl->assign('staffid', $staff_id);
$o_tpl->assign('isAll', $is_all);
$o_tpl->assign('uid', $user_id);
$o_tpl->assign('user_pos', $user_pos);

if ($user_pos == 'C' || $user_pos == 'M') {
    $o_tpl->assign('slUsers', $o_g->getUserNameArr(0, true));
} elseif ($user_pos == 'PC' || $user_pos == 'PE') {
    //var_dump($o_g->getMemberByStaffId($user_id));
    $o_tpl->assign('slUsers', $o_g->getUserNameArr($user_id) + $o_g->getMemberByStaffId($user_id));
} else {
    $o_tpl->assign('slUsers', $o_g->getUserNameArr($user_id));
}

$leave_staffs = array();
if ($user_id == 3) {
    foreach ($o_g->getUserList(0, true) as $id => $v) {
        $leave_staffs[$id] = $v['startdate'];
    }
}
$o_tpl->assign('leave_staffs', " var leave_staffs=" . json_encode($leave_staffs) . ";");

$o_tpl->assign('ugs', $ugs);
$o_tpl->display('report_staff_year.tpl');


?>