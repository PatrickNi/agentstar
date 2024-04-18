<?php
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

$abodyid = isset($_GET['abodyid'])? $_GET['abodyid'] : 0;
$ascoid  = isset($_GET['ascoid'])? $_GET['ascoid'] : 0;

#get page id
$page = isset($_GET['p'])? $_GET['p'] : 1;
$page_size = 100;
$page_offset = 10;
$page_url = "report_asco_client.php";

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}

$asco_arr = array();
$asco_arr = $o_v->getApplyVisa($view_all, $abodyid, $ascoid, $page, $page_size);
$rows_num = $o_v->getNumOfApplyVisa($view_all, $abodyid, $ascoid);
$o_page =  new PageDistribute($page_url, $rows_num, $page_size, $page_offset, $page, '');



# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('ascoarr', $asco_arr);


$_arr =$o_v->getVisaBody($abodyid);
$o_tpl->assign('assename', $_arr[$abodyid]);

$_arr =$o_v->getVisaAsco($abodyid, $ascoid);
$o_tpl->assign('asconame', $_arr[$ascoid]);

// get client name
$client_arr = array();
foreach ($asco_arr as $cid => $v){
    foreach ($v as $vv){
        $client_arr[$cid] = $vv['client'];
    }
}
$o_tpl->assign('clientarr', $client_arr);

$o_tpl->assign('page_url', $o_page->ShowPageLink());
$o_tpl->display('report_asco_client.tpl');
?>
