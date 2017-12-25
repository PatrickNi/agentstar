<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');


ini_set('display_errors', 1);
error_reporting(2047);

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_r = new ReportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


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



#get page id
$page = isset($_GET['p'])? $_GET['p'] : 1;
$page_size = 100;
$page_offset = 10;
$page_url = "report_cocomm.php";

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}

$semprocs = array();
$semprocs = $o_r->getCoCommissionByUser($view_all, 0, 0);
$rows_num = $o_r->getNumOfCoCommissionsByUser($view_all);
//$o_page =  new PageDistribute($page_url, $rows_num, $page_size, $page_offset, $page, '');
//var_dump($semprocs);
//echo $rows_num."<p/>";


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('semprocs', $semprocs);
$o_tpl->assign('agents', $o_a->getAgent());
$o_tpl->assign('total_num', $rows_num);
$o_tpl->display('report_cocomm.tpl');
?>
