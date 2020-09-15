<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');
require_once(__LIB_PATH.'ExportAPI.class.php');


$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
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

# inital variable
$page = isset($_GET['p'])? trim($_GET['p']) : 1;
$page_size 	 = 50;
$page_offset = 10;
$self_url    = "institute.php";
$redir_url   = "institute_detail.php";

$t_button = isset($_REQUEST['qSubmit'])? trim($_REQUEST['qSubmit']) : "";
$t_qtype  = isset($_REQUEST['srchType'])? trim($_REQUEST['srchType']) : "";
$t_qtext  = isset($_REQUEST['srchTxt'])? trim($_REQUEST['srchTxt']) : "";
$cateid	  = isset($_REQUEST['t_cate'])? trim($_REQUEST['t_cate']) : 1;

$fromDay  = isset($_REQUEST['t_fdate'])? trim($_REQUEST['t_fdate']) : "";
$toDay    = isset($_REQUEST['t_tdate'])? trim($_REQUEST['t_tdate']) : "";
$show_static = isset($_REQUEST['show_static'])? trim($_REQUEST['show_static']) : 0;

//if (strtoupper($t_button) == "DELETE"){
//	$o_s->delSchoold($_POST['school']);
//}

$msg = '';
if (strtoupper($t_button) == "EXPORT ALL STAFF EMAIL") {
	if ($ugs['i_export']['v'] == 1) {	
		$o_ept = new ExportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);
		$o_ept->exportInstituteEmail();
	}
	else {
		$msg = "alert('You have no permission to export staff emails');";
	}
}

# get user position
$view_all = 0;
$isCeo = 1;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
	$isCeo = 0;
}

$stats = array();
if ($show_static)
    $stats = $o_s->countSchool($view_all, $fromDay, $toDay);

$all['total'] = $all['offer'] = $all['coe'] = $all['potrev']  = $all['redrev'] =0;
$suball = array();
foreach ($stats as $v){
		$all['total'] += $v['num'];
		$all['offer'] += $v['s2'];
		$all['coe'] += $v['s3'];
		$all['potrev'] += $v['a1'];
		$all['redrev'] += $v['a2'];
}


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('from', $fromDay);
$o_tpl->assign('to', $toDay);

$o_tpl->assign('isCeo', $isCeo);

$schools = $o_s->getSchoolRsh();
$o_tpl->assign('school_arr', $schools);

$o_tpl->assign('status_arr', $o_s->getAgentStatus());

//category combain
$sub_arr     = $o_s->getSubCategory();
$cate_arr    = $o_s->getCategory();
$cate_arr[0] = 'Unassigned Category';

$catelvl_arr = array();
foreach ($cate_arr as $cateid => $name){
	if (isset($sub_arr[$cateid])){
        foreach ($sub_arr[$cateid] as $subid => $subname){
            $catelvl_arr[$cateid.$subid]['name'   ] = $name ." >> ". $subname;			 	
            $catelvl_arr[$cateid.$subid]['student'] = 0;
            $catelvl_arr[$cateid.$subid]['offer'  ] = 0;
			$catelvl_arr[$cateid.$subid]['coe'    ] = 0;
			$catelvl_arr[$cateid.$subid]['potrev' ] = 0;
			$catelvl_arr[$cateid.$subid]['redrev' ] = 0;


            if (isset($schools[$cateid.$subid])) {
				foreach ($schools[$cateid.$subid] as $id => $scname){
					if(!isset($stats[$id])) continue;
                    $catelvl_arr[$cateid.$subid]['student'] += @$stats[$id]['num'];
                    $catelvl_arr[$cateid.$subid]['offer'  ] += @$stats[$id]['s2'];
					$catelvl_arr[$cateid.$subid]['coe'    ] += @$stats[$id]['s3'];
					$catelvl_arr[$cateid.$subid]['potrev' ] += @$stats[$id]['a1'];
					$catelvl_arr[$cateid.$subid]['redrev' ] += @$stats[$id]['a2'];
                }                
            }

		}
	}
    $catelvl_arr[$cateid.'0']['name'] = $name ." >> other";
    $catelvl_arr[$cateid.'0']['student'] = 0;
    $catelvl_arr[$cateid.'0']['offer'  ] = 0;
    $catelvl_arr[$cateid.'0']['coe'    ] = 0;
	$catelvl_arr[$cateid.'0']['potrev' ] = 0;
	$catelvl_arr[$cateid.'0']['redrev' ] = 0;

    if (isset($schools[$cateid.'0'])) {
		foreach ($schools[$cateid.'0'] as $id => $scname){
			if(!isset($stats[$id])) continue;
           $catelvl_arr[$cateid.'0']['student'] += @$stats[$id]['num'];
           $catelvl_arr[$cateid.'0']['offer'  ] += @$stats[$id]['s2'];
		   $catelvl_arr[$cateid.'0']['coe'    ] += @$stats[$id]['s3'];
		   $catelvl_arr[$cateid.'0']['potrev' ] += @$stats[$id]['a1'];
   		   $catelvl_arr[$cateid.'0']['redrev' ] += @$stats[$id]['a2'];		   
        }                
    }
}

// category line color set
$line_color = array(1=>"#80FF80", 2=>"#FFFF99", 3=>"#CA95FF", 4=>"#6C6CFF", 5=>"#C78D8D", 6=>"#7ABCBC");

$o_tpl->assign('category_arr', $catelvl_arr);
$o_tpl->assign('stats', $stats);
$o_tpl->assign('totals', $all);
$o_tpl->assign('cateid', $cateid);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('redir_url', $redir_url . "?sid=");
$o_tpl->assign('msg', $msg );
$o_tpl->assign('show_static', $show_static);
$o_tpl->display('institute.tpl');

?>
