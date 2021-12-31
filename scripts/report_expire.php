<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');



# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_r = new ReportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$viewWhat = isset($_POST['t_view'])? trim($_POST['t_view']) : "v";
$staff_id = isset($_POST['staff_id'])? trim($_POST['staff_id']) : 0;

//user grants
$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
include_once dirname(__FILE__).'/init_grants.php';
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}

//var_dump($ugs['seeall']['v'], $user_id, $staff_id);
# get user position
if ($staff_id == 0 && $ugs['visa_expire']['v'] == 0){
	$staff_id = $user_id;
}
//var_dump($staff_id);

$visa_expire = array();
$visa_expire = $o_r->getVisaService($staff_id);

$other_expire = array();
//$other_expire = $o_r->getOtherService($staff_id);

$main_expire = array();
$main_expire = $o_r->getMainVisa($staff_id);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('visa_expire', $visa_expire);
$o_tpl->assign('other_expire', $other_expire);
$o_tpl->assign('main_expire', $main_expire);
$o_tpl->assign('staffid', $staff_id);
if ($ugs['visa_expire']['v'] == 1) {
	$o_tpl->assign('slUsers', $o_g->getUserNameArr(0,true));
}
else {
	$o_tpl->assign('slUsers', $o_g->getUserNameArr($staff_id));
}
$o_tpl->display('report_expir.tpl');
?>
