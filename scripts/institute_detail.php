<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
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

$school_id = isset($_REQUEST['sid'])? trim($_REQUEST['sid']) : 0;
$isChange = isset($_REQUEST['isChange'])? trim($_REQUEST['isChange']) : 0;

$set_arr = array();
$set_arr['school'] = isset($_REQUEST['t_school'])? trim($_REQUEST['t_school']) : "";
$set_arr['web']    = isset($_REQUEST['t_web'])? trim($_REQUEST['t_web']) : "";
$set_arr['agent']  = isset($_REQUEST['t_agent'])? trim($_REQUEST['t_agent']) : 0;
$set_arr['note']   = isset($_REQUEST['t_note'])? trim($_REQUEST['t_note']) : "";
$set_arr['cate']   = isset($_REQUEST['t_cate'])? trim($_REQUEST['t_cate']) : 0;
$set_arr['subcate']= isset($_REQUEST['t_subcate'])? trim($_REQUEST['t_subcate']) : 0;
$set_arr['topagent'] = isset($_REQUEST['t_agent_top'])? trim($_REQUEST['t_agent_top']) : 0;

if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE") {
	if ($school_id > 0){
		$o_s->setSchoolInfo($school_id, $set_arr);
	} else{
		$o_s->addSchoolInfo($set_arr);
		$school_id = $o_s->getLastInsertID();
	}
}elseif (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
    $o_s->delSchoold($school_id);
    header("Location: institute.php");
    exit;
}

$school_arr = $o_s->getSchoolList($school_id, "", "");

# set smarty tpl
$o_tpl = new Template;
if ($school_id > 0 && $isChange == 0){
	$set_arr = $school_arr[$school_id];
}

$o_tpl->assign('dt_arr', $set_arr);


$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('status_arr', $o_s->getAgentStatus());
$o_tpl->assign('country_arr', $o_v->getCountry());
$o_tpl->assign('sid', $school_id);
$o_tpl->assign('itemtype', __FILE_INSTITUTE);

//category combain
$cate_arr = $o_s->getCategory();
$subcate_arr = array();
if ($set_arr['cate'] > 0){
	$sub_arr = $o_s->getSubCategory($set_arr['cate']);
	if (isset($sub_arr[$set_arr['cate']])){	
	   $subcate_arr = $sub_arr[$set_arr['cate']];
	} 				
}
if($ugs['i_nocp']['v'] == 1) {
    $o_tpl->assign('forbid_sl', FORBID_SELECT);
    $o_tpl->assign('forbid_rc', FORBID_RIGHTCLK);
    $o_tpl->assign('forbid_cp', FORBID_COPY);
}

$o_tpl->assign('subcate_arr', $subcate_arr);
$o_tpl->assign('category_arr', $cate_arr);
$o_tpl->assign('top_agents', $o_a->getAgentList(0, 'top'));
$o_tpl->assign('forbid_sl', FORBID_SELECT);
$o_tpl->assign('forbid_rc', FORBID_RIGHTCLK);
$o_tpl->assign('forbid_cp', FORBID_COPY);

$o_tpl->display('institute_detail.tpl');
?>
