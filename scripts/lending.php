<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'LendingAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_s = new LendingAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
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

$fromDay  = isset($_REQUEST['t_fdate'])? trim($_REQUEST['t_fdate']) : "";
$toDay    = isset($_REQUEST['t_tdate'])? trim($_REQUEST['t_tdate']) : "";


# get user position
$view_all = 0;
$isCeo = 1;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
	$isCeo = 0;
}


$stats = $o_s->getLendingStats($fromDay, $toDay);

$totals = array('referre'=>0, 'settled'=>0, 'comm_ref'=>0, 'comm_rec'=>0);
foreach ($stats as $v) {
    $totals['referre' ] += $v['referre'];
    $totals['settled' ] += $v['settled'];
    $totals['comm_ref'] += $v['comm_ref'];
    $totals['comm_rec'] += $v['comm_rec'];
}

# set smarty tpl
$o_tpl = new Template;

// category line color set
$line_color = array(1=>"#80FF80", 2=>"#FFFF99", 3=>"#CA95FF", 4=>"#6C6CFF", 5=>"#C78D8D", 6=>"#7ABCBC");

$o_tpl->assign('lending_arr', $o_s->getLending(0,null, null));
$o_tpl->assign('stats', $stats);
$o_tpl->assign('total', $totals);
$o_tpl->assign('ugs', $ugs);
$o_tpl->display('lending.tpl');

?>
