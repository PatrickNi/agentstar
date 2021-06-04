<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'CouponAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

$o_p = new CouponAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);

# get client id 
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$couponid = isset($_REQUEST['t_conf_id'])? trim($_REQUEST['t_conf_id']) : 0;
$isNew = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;

# get service
$set_arr = array();
$set_arr['conf']  = isset($_POST['t_conf'])? (string)trim($_POST['t_conf']) : 0;

$set_arr['sdate']  = isset($_POST['t_sdate'])? (string)trim($_POST['t_sdate']) : "0000-00-00";
$set_arr['sdate']  = $set_arr['sdate'] == ""? "0000-00-00" : $set_arr['sdate'] ; 

$set_arr['edate']  = isset($_POST['t_edate'])? (string)trim($_POST['t_edate']) : "0000-00-00";
$set_arr['edate']  = $set_arr['edate'] == ""? "0000-00-00" : $set_arr['edate'];


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SEND") {
	if ($set_arr['sdate'] == "0000-00-00" || $set_arr['edate'] == "0000-00-00" ){
		echo "<script language='javascript'>alert('No Start date or End date');</script>";	
	}
    else{
		if ($isNew == 1){
			$o_p->send($client_id, $set_arr['conf'], $set_arr['sdate'], $set_arr['edate'], $user_id);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		exit;		
	}
}elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	//$o_c->delService($service_id);
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;		
}



# get work experience
$coupons = array();
$coupons = $o_p->getCouponsByClient($client_id,'','',false);

# set smarty tpl
$o_tpl = new Template;
if($isNew == 0 && $couponid > 0 && array_key_exists($couponid, $coupons)){
	$o_tpl->assign('dt_arr', $coupons[$couponid]);
}


$o_tpl->assign('cid', $client_id);
$o_tpl->assign('couponid', $couponid);
$o_tpl->assign('isNew', $isNew);
$o_tpl->assign('coupon_confs', $o_p->listConfs());
$o_tpl->display('client_coupon_detail.tpl');
?>
