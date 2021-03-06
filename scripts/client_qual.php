<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get client id 
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;


# get user active
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



# get work experience
$qual_arr = array();
$qual_arr = $o_c->getQualificationByClient($client_id);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('show_arr', $qual_arr);


$o_tpl->assign('qual_arr', $o_c->getQualOfCourse());
$o_tpl->assign('major_arr', $o_c->getMajorOfCourse());
$o_tpl->assign('country_arr', $o_c->getCountry());
$o_tpl->assign('school_arr', $o_c->getSchool());

$o_tpl->assign('client', $o_c->getOneClientInfo($client_id));
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('itemtype', __FILE_QUAL);
$o_tpl->assign('client_type', $o_c->getClientType($client_id));
$o_tpl->display('client_qual.tpl');
?>
