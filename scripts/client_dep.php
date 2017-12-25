<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');


$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$client_id = isset($_REQUEST['cid'])? $_REQUEST['cid'] : 0;
$visa_id = isset($_REQUEST['vid'])? $_REQUEST['vid'] : 0;
$dep_id = isset($_REQUEST['depid'])? $_REQUEST['depid'] : 0;
$deps = isset($_POST['idArr'])? $_POST['idArr'] : array();

#define serach filed
$columns = array('l'=>'LName', 'f'=>'FName', 'e'=>'EName', 't'=>'ClientType');
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);

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

# inital variable
$page = isset($_GET['p'])? trim($_GET['p']) : 1;
$page_size 	 = 50;
$page_offset = 10;
$self_url 	 = "client.php";
$redir_url   = "client_detail.php";

$srch_type  = isset($_REQUEST['srchType'])? trim($_REQUEST['srchType']) : "";
$srch_qtext  = isset($_REQUEST['srchTxt'])? trim($_REQUEST['srchTxt']) : "";
$from_date = isset($_REQUEST['t_fdate'])? trim($_REQUEST['t_fdate']) : "";
$to_date   = isset($_REQUEST['t_tdate'])? trim($_REQUEST['t_tdate']) : "";

if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == 'SET DEPENDANT' &&  $visa_id > 0){
	$o_c->setDependant($visa_id, $deps);
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;	
} elseif (isset($_REQUEST['bt_name']) && isset($_REQUEST['bt_name'])== 'DELETE' &&  $visa_id > 0 && $dep_id > 0){
	$o_c->delDependant($visa_id, $dep_id);
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;	
}

$client_arr = array();
if (isset($_REQUEST['bt_name']) && isset($_REQUEST['bt_name']) == 'QUERY' && array_key_exists($srch_type, $columns)){
	$client_arr = $o_c->getDependantClientInfo($page, $page_size, $visa_id, $view_all, $columns[$srch_type], $srch_qtext, $from_date, $to_date, $client_id);			
	$rows_num   = $o_c->getClientNumRows($visa_id, $view_all, $columns[$srch_type], $srch_qtext, $from_date, $to_date);
}else{
	$client_arr = $o_c->getDependantClientInfo($page, $page_size, $visa_id, $view_all, "", "", $from_date, $to_date, $client_id);
	$rows_num   = $o_c->getClientNumRows($visa_id, $view_all, "", "", $from_date, $to_date);
}
$o_page =  new PageDistribute($self_url, $rows_num, $page_size, $page_offset, $page, '');

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('from', $from_date);
$o_tpl->assign('to', $to_date);
$o_tpl->assign('srchtype', $srch_type);
$o_tpl->assign('srchtxt', $srch_qtext);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('vid', $visa_id);


$o_tpl->assign('client_arr', $client_arr);
$o_tpl->assign('page_url', $o_page->ShowPageLink());
$o_tpl->assign('redir_url', $redir_url . "?cid=");
$o_tpl->display('client_dep.tpl');
?>
