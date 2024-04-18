<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_r = new ReportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

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

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}

$reviews = array();
$reviews = $o_r->getVisaReviewByUser($from_day, $to_day, $staff_id);
$all['open'] = $all['close'] = $all['amount'] = $all['paid'] = 0;
foreach ($reviews as $vs){
	foreach ($vs as $v){
		$all['open']   += $v['open'];
		$all['close']  += $v['close'];
		$all['amount'] += $v['subamt'];
		echo "{$all['open']} : {$v['open']} <br>";
	}
}
print_r($reviews);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('fromDay', $from_day);
$o_tpl->assign('toDay', $to_day);
$o_tpl->assign('review', $reviews);
$o_tpl->assign('all', $all);
$o_tpl->assign('catarr', $o_v->getVisaNameArr());
$o_tpl->assign('subarr', $o_v->getVisaClassNameArr());
$o_tpl->assign('staffid', $staff_id);
print_r($o_v->getVisaNameArr());
print_r($o_v->getVisaClassNameArr());
# get user position
if ($ugs['seeall']['v'] == 1){
	$o_tpl->assign('slUsers', $o_g->getUserNameArr());
	$o_tpl->assign('isView', 1);
}else {
	$o_tpl->assign('slUsers', $o_g->getUserNameArr($staff_id));
	$o_tpl->assign('isView', 0);
}
$o_tpl->assign('sf', $staff_id);

$o_tpl->display('report_visa.tpl');
?>