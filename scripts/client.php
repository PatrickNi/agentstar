<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');
require_once(__LIB_PATH.'ExportAPI.class.php');

ini_set("display_errors", 1);
error_reporting(2047);
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

#define serach filed
$columns = array('l'=>'LName', 'f'=>'FName', 'e'=>'EName', 't'=>'ClientType', 'm'=>'Email', 'c'=>'TOKEN', 'dob'=>'Dob');
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
$only_course = 0;
/*
if ($ugs['seeall']['v'] == 0){
    if ($ugs['i_rev']['v'] == 1 || (isset($ugs['c_track']['v']) && $ugs['c_track']['v'] == 1)){
        $view_all = 0;
    }
    else{
       $view_all = $user_id;    
    }
    
    if(isset($ugs['c_track']['v']) && $ugs['c_track']['v'] == 1){
        $only_course = 1;        
    }
}
 */
if ($ugs['seeall']['v'] == 0 && $ugs['c_track']['v'] == 0 && $ugs['v_track']['v'] == 0){
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
$status = isset($_REQUEST['is_geic'])?  $_REQUEST['is_geic'] : '';


$page_link = '';
$client_arr = array();
if (isset($_REQUEST['bt_name']) && $_REQUEST['bt_name'] == 'QUERY' && array_key_exists($srch_type, $columns)){
	$client_arr = $o_c->getClientInfo($page, $page_size, 0, $view_all, $columns[$srch_type], $srch_qtext, $from_date, $to_date, $only_course, $status);
	$rows_num = $o_c->getClientTotalRows();
    $rows_arr   = $o_c->getClientNumRows(0, $view_all, $columns[$srch_type], $srch_qtext, $from_date, $to_date, $only_course, $status);
    //$rows_num   = isset($rows_arr['all'])? array_sum($rows_arr['all']) : 0;
	$page_link  = "&bt_name={$_REQUEST['bt_name']}&srchType={$srch_type}&srchTxt={$srch_qtext}&t_fdate={$from_date}&t_tdate={$to_date}";
}else{
	$client_arr = $o_c->getClientInfo($page, $page_size, 0, $view_all, "", "", $from_date, $to_date, $only_course, $status);
	$rows_num = $o_c->getClientTotalRows();
    $rows_arr   = $o_c->getClientNumRows(0, $view_all, "", "", $from_date, $to_date, $only_course, $status);
	//$rows_num   = array_sum($rows_arr['all']);

}

if (isset($_REQUEST['bt_export']) && strtoupper($_REQUEST['bt_export']) == 'EXPORT CLIENT EMAILS'){
	$o_ept = new ExportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);
	$o_ept->exportClientEmail($srch_qtext, $from_date, $to_date);
}

$o_page =  new PageDistribute($self_url, $rows_num, $page_size, $page_offset, $page, $page_link);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('from', $from_date);
$o_tpl->assign('to', $to_date);
$o_tpl->assign('srchtype', $srch_type);
$o_tpl->assign('srchtxt', $srch_qtext);
$o_tpl->assign('is_geic', $status);
$o_tpl->assign("ugs", $ugs);
$o_tpl->assign('client_arr', $client_arr);
$o_tpl->assign('abouts', $rows_arr);
$o_tpl->assign('totalabouts', $rows_num);
$o_tpl->assign('page_url', $o_page->ShowPageLink());
$o_tpl->assign('redir_url', $redir_url . "?cid=");
$o_tpl->display('client.tpl');

?>
