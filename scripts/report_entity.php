<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');



# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$v_company = isset($_REQUEST['v_company'])? trim($_REQUEST['v_company']) : "";


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

#get page id
$page = isset($_GET['p'])? $_GET['p'] : 1;
$page_size = 100;
$page_offset = 10;
$page_url = "report_entity.php";

$visa_arr = array();
$rows_num = 0;
if ($v_company != '') {
    $visa_arr = $o_v->getApplyVisa(0, 0, 0, $page, $page_size, $v_company);
    $rows_num = $o_v->getNumOfApplyVisa(0, 0, 0, $v_company);
}
$o_page =  new PageDistribute($page_url, $rows_num, $page_size, $page_offset, $page, '');

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('visa_arr', $visa_arr);
$o_tpl->assign('page_url', $o_page->ShowPageLink());
$o_tpl->assign('v_company', $v_company);

$o_tpl->display('report_entity.tpl');
?>
