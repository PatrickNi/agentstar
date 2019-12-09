<?php
require_once('../etc/const.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'ExportAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
 

$cates['education'] = array('n'=>'Education agent', 's'=>0, 'o'=>0, 'c'=>0, 'rc'=>0, 'pc'=>0, 'aid'=>array());
$cates['company'  ] = array('n'=>'Company agent', 's'=>0, 'o'=>0, 'c'=>0, 'rc'=>0, 'pc'=>0, 'aid'=>array());
$cates['student'  ] = array('n'=>'Student ambassador', 's'=>0, 'o'=>0, 'c'=>0, 'rc'=>0, 'pc'=>0, 'aid'=>array());
$cates['inactive' ] = array('n'=>'Inactive agent', 's'=>0, 'o'=>0, 'c'=>0, 'rc'=>0, 'pc'=>0, 'aid'=>array());
//$cates['other'    ] = array('n'=>'Other', 's'=>0, 'o'=>0, 'c'=>0, 'rc'=>0, 'pc'=>0, 'aid'=>array());

if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

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

$fromDay  = isset($_REQUEST['t_fdate'])? trim($_REQUEST['t_fdate']) : "";
$toDay    = isset($_REQUEST['t_tdate'])? trim($_REQUEST['t_tdate']) : "";


$form = isset($_REQUEST['t_form'])? trim($_REQUEST['t_form']) : "";
if(isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "REMOVE" && isset($_POST['agentId'])){
    $o_a->delAgentByArr($_POST['agentId']);
}

$t_cate = isset($_REQUEST['t_cate'])? trim($_REQUEST['t_cate']) : "";

//fix category manuall
if ($form == 'top') {
	unset($cates['company']);
	unset($cates['student']);
}
elseif ($form == 'sub') {
	unset($cates['company']);
	unset($cates['student']);
	$cates['education']['n'] = 'Global Partner';
	//$cates['student'  ]['n'] = 'Global Ambassador';
}

# get user position
$view_all = 0;
$isCeo = 1;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
	$isCeo = 0;
}

# get group
$agent_arr = array();
$country = $o_c->getCountry();
$status  = $o_s->getAgentStatus();
if($form != ""){
	$agent_arr = $o_a->getAgentList(0, $form, $t_cate);
	$stats = $o_a->countAgent($form, $view_all, $fromDay, $toDay);

	foreach ($agent_arr as $aid => $v) {
		$k = isset($cates[$v['cate']])? $v['cate'] : 'other';

		array_push($cates[$k]['aid'], $aid);	
		if (!isset($stats[$aid]))
			continue;
	

		$cates[$k]['s' ] += $stats[$aid]['stdcnt'];			
		$cates[$k]['o' ] += $stats[$aid]['offer'];
		$cates[$k]['c' ] += $stats[$aid]['coe'];
		$cates[$k]['rc'] += $stats[$aid]['rcomm'];
		$cates[$k]['pc'] += $stats[$aid]['pcomm'];		

		$agent_arr[$aid]['cn'] = isset($country[$v['country']])? $country[$v['country']] : '';
		$agent_arr[$aid]['sn'] = isset($status[$v['stid']])? $status[$v['stid']] : '';		
	}
	
	if (isset($_REQUEST['bt_export']) && strtoupper($_REQUEST['bt_export']) == strtoupper("Export Emails")){
		$o_ept = new ExportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);
		$mailArr = array();
		foreach ($agent_arr as $id => $v){
			if ($v['cate'] != $t_cate)
				continue;
			
			array_push($mailArr, $v['email']);
		}
		$o_ept->exportAgentEmail($mailArr, $form);
	}
	//print_r($cates);
}



# output
$o_tpl = new Template;
$o_tpl->assign('from', $fromDay);
$o_tpl->assign('to', $toDay);
$o_tpl->assign('isCeo', $isCeo);
//$o_tpl->assign('country_arr', $o_c->getCountry());
//$o_tpl->assign('status_arr', $o_s->getAgentStatus());
$o_tpl->assign("agent_arr", $agent_arr);
if(isset($stats)){
	$o_tpl->assign("stats", $stats);
}
$o_tpl->assign("totals", $cates);
$o_tpl->assign("form", $form);
$o_tpl->assign('cate', $t_cate);
$o_tpl->assign("ugs", $ugs);
$o_tpl->display("agent.tpl");

?>

