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
$view_all = $staff_id;
if ($ugs['v_track']['v'] == 1 && $staff_id == 'all'){
	$view_all = 0;
}

$reviews = $catarr = $subarr = array();
$catarr = $o_v->getVisaNameArr();
$subarr = $o_v->getVisaClassNameArr();
$reviews = $o_r->getVisaReviewByUser($from_day, $to_day, $view_all);
$all['open'] = $all['close'] = $all['amount'] = $all['paid'] = 0;
if ($reviews){
	foreach ($reviews as $_cat => $vs){
		foreach ($vs as $_sub => $v){
			if (isset($subarr[$_cat]) && isset($subarr[$_cat][$_sub])){
				if (isset($v['open']))
					$all['open']   += $v['open'];
				if (isset($v['close']))
					$all['close']  += $v['close'];
				if (isset($v['subamt']))
					$all['amount'] += $v['subamt'];
			}
		}
	}
}
# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('fromDay', $from_day);
$o_tpl->assign('toDay', $to_day);
$o_tpl->assign('review', $reviews);
$o_tpl->assign('all', $all);
$o_tpl->assign('catarr', $catarr);
$o_tpl->assign('subarr', $subarr);
$o_tpl->assign('staffid', $staff_id);
# get user position
if ($ugs['v_track']['v'] == 1){
	$o_tpl->assign('slUsers', $o_g->getUserNameArr());
	$o_tpl->assign('isView', 1);
}else {
	$o_tpl->assign('slUsers', $o_g->getUserNameArr($staff_id));
	$o_tpl->assign('isView', 0);
}
$o_tpl->assign('sf', $staff_id);

$o_tpl->display('report_visa.tpl');
?>