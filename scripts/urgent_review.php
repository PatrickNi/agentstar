<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'Report.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
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


if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'check_dob') {
    $o_r->checkYearDob($_REQUEST['cid'], $_REQUEST['dob'], $user_id);
    echo json_encode(array('succ'=>1));
    exit;
}


$viewWhat = isset($_REQUEST['t_view'])? trim($_REQUEST['t_view']) : "";
$sort_list = isset($_REQUEST['sort_list'])? trim($_REQUEST['sort_list']) : "";

$vdu = isset($_REQUEST['vdu'])? 1 : 0;
$cdu = isset($_REQUEST['cdu'])? 1 : 0;
$idu = isset($_REQUEST['idu'])? 1 : 0;
$sdu = isset($_REQUEST['sdu'])? 1 : 0;
$atopdu = isset($_REQUEST['atopdu'])? 1 : 0;
$asubdu = isset($_REQUEST['asubdu'])? 1 : 0;
//echo "============{$sort_list}=============<p/>";
# get user position
$view_all = 0;
$only_course = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}
$staff_id = $user_id;

$reports = array();
$sort_ord_arr = array(0=>'ASC', 1=>'DESC');
switch ($viewWhat){
	case "v":
//		$staff_id = $user_id;
		if (isset($ugs['todo_visa']) && $ugs['todo_visa']['v'] == 1){
			if(isset($_REQUEST['vUid'])) {
				$staff_id = $_REQUEST['vUid'];
			}
			else {
				$staff_id = 0;
			}
		}
		$sort_col_arr = array(1=>'ClientName',2=>'VisaName',3=>'ClassName',4=>'Item',5=>'SortDue');
		$reports = $o_r->getUrgentVisa($staff_id,getSortList($sort_list, $sort_col_arr, $sort_ord_arr), $vdu);
//        $reports = array_merge($o_r->getUrgentVisa($view_all, $sort_col, $sort_ord),$o_r->getTodoVisa($view_all, $sort_col, $sort_ord));		
		break;
	case "c":
		
        if (isset($ugs['todo_course']) && $ugs['todo_course']['v'] == 1){
			if(isset($_REQUEST['cUid'])) {
				$staff_id = $_REQUEST['cUid'];
			}
			else {
				$staff_id = 0;
			}
		}
        $sort_col_arr = array(1=>'ClientName',2=>'Name',3=>'Qual',4=>'Major',5=>'ProcessName', 6=>'SortDue');
        
        $reports = $o_r->getUrgentCourse($staff_id,getSortList($sort_list, $sort_col_arr, $sort_ord_arr), $only_course, $cdu);
        break;
    case "vm":
        if (isset($ugs['todo_visa']) && $ugs['todo_visa']['v'] == 1){
            if(isset($_REQUEST['vmUid'])) {
                $staff_id = $_REQUEST['vmUid'];
            }
            else {
                $staff_id = 0;
            }
        }
        $sort_col_arr = array(1=>'ClientName',2=>'Name',3=>'Qual',4=>'Major',5=>'ProcessName', 6=>'SortDue');
        $reports = $o_r->getUrgentVerifyMigration($staff_id,getSortList($sort_list, $sort_col_arr, $sort_ord_arr));
        break;
	case "i":
        $sort_col_arr = array(1=>'Name',2=>'Subject',3=>'SortDue');
        $reports = $o_r->getUrgentInstitute(getSortList($sort_list, $sort_col_arr, $sort_ord_arr), $idu);
//		$reports = array_merge($o_r->getUrgentInstitute($sort_col, $sort_ord), $o_r->getTodoInstitute($sort_col, $sort_ord));
		break;			
	case "s":
        if (isset($ugs['todo_course']) && $ugs['todo_course']['v'] == 1){
            if(isset($_REQUEST['cUid'])) {
                $staff_id = $_REQUEST['cUid'];
            }
            else {
                $staff_id = 0;
            }
        }
        $sort_col_arr = array(1=>'ClientName',2=>'Subject',3=>'SortDue');
        $reports = $o_r->getUrgentService($staff_id,getSortList($sort_list, $sort_col_arr, $sort_ord_arr), $sdu);
//		$reports = array_merge($o_r->getUrgentService($view_all, $sort_col, $sort_ord), $o_r->getTodoService($view_all, $sort_col, $sort_ord));
		break;		
	case "asub":
        $sort_col_arr = array(1=>'Name',2=>'Subject',3=>'SortDue');
        $reports = $o_r->getUrgentAgent(getSortList($sort_list, $sort_col_arr, $sort_ord_arr), 'sub');
//		$reports = array_merge($o_r->getUrgentAgent($sort_col, $sort_ord), $o_r->getTodoAgent($sort_col, $sort_ord));
		break;
	case "atop":
        $sort_col_arr = array(1=>'Name',2=>'Subject',3=>'SortDue');
        $reports = $o_r->getUrgentAgent(getSortList($sort_list, $sort_col_arr, $sort_ord_arr), 'top');
//		$reports = array_merge($o_r->getUrgentAgent($sort_col, $sort_ord), $o_r->getTodoAgent($sort_col, $sort_ord));
		break;			
}

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('urgent_arr', $reports);
$o_tpl->assign('viewWhat', $viewWhat);
$o_tpl->assign('view_show', $viewWhat == ""? 0 : $viewWhat);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('sort_list', $sort_list);
$o_tpl->assign('staffid', $staff_id);
$o_tpl->assign('userid', $user_id);
$o_tpl->assign('vdu', $vdu);
$o_tpl->assign('idu', $idu);
$o_tpl->assign('cdu', $cdu);
$o_tpl->assign('sdu', $sdu);
$o_tpl->assign('atopdu', $atopdu);
$o_tpl->assign('asubdu', $asubdu);
if ((isset($ugs['todo_visa']) && $ugs['todo_visa']['v'] == 1 && $viewWhat == 'v') || (isset($ugs['todo_course']) && $ugs['todo_course']['v'] == 1 && ($viewWhat == 'c' || $viewWhat == 's'))){
	$o_tpl->assign('slUsers', $o_g->getUserNameArr());
}else {
	$o_tpl->assign('slUsers', $o_g->getUserNameArr($staff_id));
}
//var_dump($o_g->getUserNameArr(),$o_g->get_course_viewer($user_id) );
$o_tpl->assign('slCourseViewer', $slCourseViewer);
$o_tpl->assign('ugs', $ugs);
$o_tpl->display('urgent_review.tpl');
?>
