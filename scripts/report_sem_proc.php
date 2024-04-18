<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');



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



#get page id
$page = isset($_GET['p'])? $_GET['p'] : 1;
$page_size = 100;
$page_offset = 10;
$page_url = "report_sem_proc.php";

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}

$semprocs = array();
if (isset($_REQUEST['btn']) && $_REQUEST['btn'] == 'Sort by Top-agents') {
    $semprocs = $o_r->getCommissionByTopAgent($view_all, $page, $page_size);
    $rows_num = $o_r->getNumOfCommissionsByTopAgent($view_all);    
    $o_page =  new PageDistribute($page_url, $rows_num, $page_size, $page_offset, $page, '&btn='.urlencode($_REQUEST['btn']));
    $is_agent = 1;
}
elseif (isset($_REQUEST['btn']) && $_REQUEST['btn'] == 'Sort by Institutes')  {
    $is_agent = 1;
    $semprocs = $o_r->getCommissionBySchool($view_all, $page, $page_size);
    $rows_num = $o_r->getNumOfCommissionsBySchool($view_all);
    $o_page =  new PageDistribute($page_url, $rows_num, $page_size, $page_offset, $page, '&btn='.urlencode($_REQUEST['btn']));
}
elseif (isset($_REQUEST['btn']) && $_REQUEST['btn'] == 'Account todo')  {
    $is_agent = 1;
    $semprocs = $o_r->getCommissionByAccount($view_all, $page, $page_size);
    $rows_num = $o_r->getNumOfCommissionsByAccount($view_all);
    $o_page =  new PageDistribute($page_url, $rows_num, $page_size, $page_offset, $page, '&btn='.urlencode($_REQUEST['btn']));
}
else {
    $is_agent = 0;
    $semprocs = $o_r->getCommissionByUser($view_all, $page, $page_size);
    $rows_num = $o_r->getNumOfCommissionsByUser($view_all);
    $o_page =  new PageDistribute($page_url, $rows_num, $page_size, $page_offset, $page, '');
}

//print_r($semprocs);
//echo $rows_num."<p/>";


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('is_agent', $is_agent);
$o_tpl->assign('semprocs', $semprocs);
$o_tpl->assign('step2', __SEM_START.__SEM_INVOICE);
$o_tpl->assign('page_url', $o_page->ShowPageLink());
$o_tpl->display('report_sem_proc.tpl');
?>
