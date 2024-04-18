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

# get course id
$visa_id   = isset($_REQUEST['vid'])? trim($_REQUEST['vid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$catid     = isset($_REQUEST['t_visa'])? trim($_REQUEST['t_visa']) : 0;
$subid     = isset($_REQUEST['t_class'])? trim($_REQUEST['t_class']) : 0;

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
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


# get user
$user_arr = $o_g->getUserNameArr(0,true);

# client information
$client_arr = $o_c->getOneClientInfo($client_id);


# get visa
$visa_arr = array();
$visa_arr = $o_c->getApplyVisa($client_id, 0, 0);

// get lodge and grant process
$lgprocs = array();
$lgprocs = $o_c->getVisaLodgeGrandProc($client_id, 0);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('visa_arr', $visa_arr);



# get visa category
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$cate_arr  = $o_v->getVisaNameArr();
$class_arr = $o_v->getVisaClassArr($catid);

//$o_tpl->assign('client_arr', $dep_arr);
$o_tpl->assign('cate_arr', $cate_arr);
$o_tpl->assign('class_arr', $class_arr);
$o_tpl->assign('user_arr', $user_arr);
$o_tpl->assign('uid', $user_id);
$o_tpl->assign('procs', $lgprocs);
$o_tpl->assign('catid', $catid);
$o_tpl->assign('subid', $subid);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('vid', $visa_id);
$o_tpl->assign('client', $client_arr);
$o_tpl->assign('client_type', $o_c->getClientType($client_id));
$o_tpl->assign('user_pos', $o_g->getUserPosition($user_id));
$o_tpl->assign('ugs', $ugs);

# get user position
if ($ugs['v_track']['v'] == 1){
    $o_tpl->assign('isMaster', 1); 
}else{
    $o_tpl->assign('isMaster', 0);
}

$o_tpl->assign('userid', $user_id);

$o_tpl->display('client_visa.tpl'); 
?>
