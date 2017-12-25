<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}



$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$visa_id = isset($_REQUEST['vid'])? trim($_REQUEST['vid']) : 0;

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


# get user
$user_arr = $o_g->getUserNameArr();

# get visa
$visa_arr = array();
$visa_arr = $o_c->getApplyVisaByDep($client_id);



//# get dependant arr
//$dep_arr = $o_c->getDependantArr($client_id);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('visa_arr', $visa_arr);


$o_tpl->assign('user_arr', $user_arr);


//$o_tpl->assign('catid', $catid);
//$o_tpl->assign('subid', $subid);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('vid', $visa_id);
$o_tpl->assign('client', $o_c->getOneClientInfo($client_id));
$o_tpl->assign('client_type', $o_c->getClientType($client_id));
$o_tpl->display('client_visa_dp.tpl'); 

?>
