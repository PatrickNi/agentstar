<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');

error_reporting(2047);
ini_set('display_errors', 1);


function getSortList($sort_list, &$sort_col, &$sort_ord){
	if ($sort_list == ''){
		return $sort_list;
	}
	   
	$_sort = array();
	$groups = explode('|', $sort_list);
	foreach ($groups as $v){
		$cell = explode(':', $v);
		if (isset($sort_col[$cell[0]]) && isset($sort_ord[$cell[1]])){
             if ($sort_col[$cell[0]] == 'ProcessName') {
                 if ($cell[1] == 0) {
                    $sort_col[$cell[0]] = "if(p.ID > 0, p.ID, CONCAT(999999, ExItem))" ;   
                 }
                 else {
                    $sort_col[$cell[0]] = "if(p.ID > 0, p.ID, CONCAT(0, ExItem))";    
                 }             
             }                     
           array_push($_sort, $sort_col[$cell[0]]." ".$sort_ord[$cell[1]]);
		}
	}
	return implode(",", $_sort);
}


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


$viewWhat  = isset($_REQUEST['t_view'])? trim($_REQUEST['t_view']) : "";
$sort_list = isset($_REQUEST['sort_list'])? trim($_REQUEST['sort_list']) : "";
$staff_id  = isset($_REQUEST['vUid'])? $_REQUEST['vUid'] : $user_id;


$reports = array();
$sort_ord_arr = array(0=>'ASC', 1=>'DESC');

$page        = isset($_REQUEST['p'])? trim($_REQUEST['p']) : 1;
$page_size   = 50;
$page_offset = 10;
$self_url    = basename(__FILE__);

$vdu = isset($_POST['vdu'])? 1 : 0;

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('viewWhat', $viewWhat);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('sort_list', $sort_list);
$o_tpl->assign('staffid', $staff_id);
$o_tpl->assign('vdu', $vdu);
$o_tpl->assign('slUsers', $o_g->getUserNameArr());
$o_tpl->assign('ugs', $ugs);

switch ($viewWhat){
	case "legal":
		$sort_col_arr = array(1=>'ClientName',2=>'VisaName',3=>'ClassName',4=>'Item',5=>'SortDue');
		$reports = $o_r->getUrgentLegal($staff_id,getSortList($sort_list, $sort_col_arr, $sort_ord_arr), $vdu, $page, $page_size);
        $o_r->query("select found_rows() AS TOTAL ");
        $o_r->fetch();
        $o_page = new PageDistribute(basename(__FILE__),$o_r->TOTAL, $page_size, $page_offset, $page, "&t_view＝{$viewWhat}&sort_list={$sort_list}&vUid＝{$staff_id}");

        $o_tpl->assign('urgent_arr', $reports);
        $o_tpl->assign('page_url', $o_page->ShowPageLink());
        $o_tpl->display('urgent_legal.tpl');		
		break;
}


?>
