<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');


$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='login.php';</script>";
}
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_f = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$agent_id = isset($_REQUEST['aid'])? trim($_REQUEST['aid']) : 0;

$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}

# get function id

$sets = array();
if(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){ 
	$sets['name']    = isset($_REQUEST['t_name'])? trim($_REQUEST['t_name']) : 0;
	$sets['web']     = isset($_REQUEST['t_web'])? trim($_REQUEST['t_web']) : 0;
	$sets['tel']     = isset($_POST['t_tel'])? trim($_POST['t_tel']) : "";
	$sets['fax']     = isset($_POST['t_fax'])? trim($_POST['t_fax']) : "";
	$sets['email']   = isset($_POST['t_email'])? trim($_POST['t_email']) : "";
	$sets['add']     = isset($_POST['t_add'])? trim($_POST['t_add']) : "";
	$sets['country'] = isset($_POST['t_country'])? trim($_POST['t_country']) : 0;
	$sets['contact'] = isset($_POST['t_contact'])? trim($_POST['t_contact']) : "";
	$sets['type']    = isset($_POST['t_type'])? trim($_POST['t_type']) : "sub";
	$sets['note']    = isset($_POST['t_note'])? trim($_POST['t_note']) : "";
	$sets['status']  = isset($_POST['t_status'])? trim($_POST['t_status']) : 0;
    $sets['city']    = isset($_POST['t_city'])? trim($_POST['t_city']) : "";
	$sets['verify']  = isset($_POST['t_verify'])? trim($_POST['t_verify']) : 0;
    $sets['cate']    = isset($_POST['t_cate'])? trim($_POST['t_cate']) : '';	

    if ($agent_id > 0){
    	$o_f->setAgent($agent_id, $sets);	
    }else{
    	$agent_id = $o_f->addAgent($sets);
    }
}
elseif(isset($_POST['bt_code']) && strtoupper($_POST['bt_code']) == "GENERATE CODE" && $agent_id > 0){ 
	$o_f->generateCode($agent_id);
}

# get group


# output
$o_tpl = new Template;
if ($agent_id > 0){
	$agent_arr = array();
	$agent_arr = $o_f->getAgentList($agent_id);
	$o_tpl->assign("dt_arr", $agent_arr[$agent_id]);
}
else {
    if (isset($_POST['t_cate'])) {
        $o_tpl->assign("dt_arr", array('cate'=>$_POST['t_cate']));
    }
}

$o_tpl->assign('country_arr', $o_c->getCountry());

$exType = isset($_REQUEST['status'])? $_REQUEST['status'] : "";
$o_tpl->assign('status_arr', $o_s->getAgentStatus());
$o_tpl->assign("exType", $exType);
$o_tpl->assign("aid", $agent_id);
$o_tpl->assign("ugs", $ugs);
$o_tpl->assign("itemtype", __FILE_AGENT);
$o_tpl->display("agent_detail.tpl");

?>
