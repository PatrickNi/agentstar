<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;


$account_id = isset($_REQUEST['aid'])? trim($_REQUEST['aid']) : 0;
$pid = isset($_POST['pid'])? trim($_POST['pid']) : 0;
$isNew = isset($_POST['t_new'])? trim($_POST['t_new']) : 0;
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
		if($ugs['p_h']['m'] == 1){
			$o_c->setPayment($pid, $sets);
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;
		}else{
			echo "<script language='javascript'>alert('permission denied');</script>";
		}    
	}
	elseif($isNew == 1){
		if($ugs['p_h']['m'] == 1){
			$o_c->addPayment($account_id, $sets);
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;    
		}else{
			echo "<script language='javascript'>alert('permission denied');</script>";
		}    		
	}
}elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	if($ugs['p_h']['d'] == 1){
		$o_c->delPayment($pid);
		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;   	
	}else{
			echo "<script language='javascript'>alert('permission denied');</script>";
	}   		
}

$payments = $o_c->getPayment($account_id);
if($account_id > 0){
	$accounts = $o_c->getAccount(0,$account_id);
}

# set smarty tpl
$o_tpl = new Template;
if($account_id > 0){
	$o_tpl->assign('account', $accounts[$account_id]);
}

$o_tpl->assign('aid', $account_id);
$o_tpl->assign('payments', $payments);
$o_tpl->display('client_payment.tpl'); 

?>
