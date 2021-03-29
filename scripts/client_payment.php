<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'CouponAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;


$account_id = isset($_REQUEST['aid'])? trim($_REQUEST['aid']) : 0;
$pid = isset($_POST['pid'])? trim($_POST['pid']) : 0;
$isNew = isset($_POST['t_new'])? trim($_POST['t_new']) : 0;
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_p = new CouponAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

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
$accounts = $o_c->getAccount(0, $account_id);


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$sets['date'] = isset($_POST['t_date'])? (string)$_POST['t_date'] : "0000-00-00";
	$sets['date'] = $sets['date'] == ""? "0000-00-00" : $sets['date'];
	
	$sets['paid'] = isset($_POST['t_paid'])? $_POST['t_paid'] : 0;
    $sets['remark'] = isset($_POST['t_remark'])? $_POST['t_remark'] : '';	

    if ($sets['paid'] < 0 ){
    	echo "<script language='javascript'>alert('Negative paid amount');</script>";
    }
	elseif ($pid > 0 && $isNew == 0){
		# check valid user
		$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
		if(($accounts[$account_id]['type'] == 'visa' && $ugs['v_pay']['m'] == 1) || $accounts[$account_id]['type'] != 'visa'){
			$o_c->setPayment($pid, $sets);
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;
		}
		else{
			echo "<script language='javascript'>alert('Permission denied');</script>";
		}    
	}
	elseif($isNew == 1){
		if(($accounts[$account_id]['type'] == 'visa' && $ugs['v_pay']['i'] == 1) || $accounts[$account_id]['type'] != 'visa'){
			$o_c->addPayment($account_id, $sets);
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;    
		}
		else{
			echo "<script language='javascript'>alert('Permission denied');</script>";
		}    		
	}
}
elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "REDEEM") {
	if (isset($_POST['t_coupon']) && $_POST['t_coupon'] > 0) {
		$sets['date'] = date('Y-m-d');
		$coupon = $o_p->redeem($_POST['t_coupon'], $accounts[$account_id]['type'].'.'.$accounts[$account_id]['step'], $sets['date']);
		if ($coupon) {
			$sets['paid'] = $coupon[$_POST['t_coupon']];
			$sets['remark'] = 'Redeem a coupon';
			//var_dump($sets);exit;
			$paymentid = $o_c->addPayment($account_id, $sets);
			$o_p->postRedeem($_POST['t_coupon'], $account_id, $accounts[$account_id]['type'], $paymentid);
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;    
		}
		echo "<script language='javascript'>alert('Redeem failed');</script>";
		
	}
	else {
		echo "<script language='javascript'>alert('Redeem failed');</script>";
	}

}
elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	if(($accounts[$account_id]['type'] == 'visa' && $ugs['v_pay']['d'] == 1) || $accounts[$account_id]['type'] != 'visa'){
		$o_c->delPayment($pid);
		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;   	
	}else{
			echo "<script language='javascript'>alert('Permission denied');</script>";
	}   		
}

if ($accounts[$account_id]['type'] == 'visa' && $ugs['v_pay']['v'] == 0) {
	echo "<script language='javascript'>alert('Permission denied');</script>";
	exit;
}

$payments = $o_c->getPayment($account_id);
if($account_id > 0){
	$accounts = $o_c->getAccount(0,$account_id);
}

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('ugs', $ugs);

if($account_id > 0){
	$o_tpl->assign('account', $accounts[$account_id]);
	$o_tpl->assign('coupons', $o_p->getCouponsByClient($o_c->getClientIDbyAccount($accounts[$account_id]), $accounts[$account_id]['type'].'.'.$accounts[$account_id]['step'], 'NEW'));
}

$o_tpl->assign('aid', $account_id);
$o_tpl->assign('payments', $payments);
$o_tpl->display('client_payment.tpl'); 

?>
