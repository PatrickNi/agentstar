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

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}

$visa_expire = array();
$visa_expire = $o_r->getVisaService($view_all);

$other_expire = array();
$other_expire = $o_r->getOtherService($view_all);


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('visa_expire', $visa_expire);
$o_tpl->assign('other_expire', $other_expire);
$o_tpl->display('report_expir.tpl');
?>
