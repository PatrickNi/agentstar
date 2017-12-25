<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'LendingAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

//user grants
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}

# get course id
$hid = isset($_REQUEST['hid'])? trim($_REQUEST['hid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$isChange = isset($_REQUEST['isChange'])? trim($_REQUEST['isChange']) : 0;

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new LendingAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


$set_loan['lid'] = isset($_REQUEST['t_lend'])? (string)trim($_REQUEST['t_lend']) : 0;
$set_loan['cr']   = isset($_REQUEST['t_cr'])? (string)trim($_REQUEST['t_cr']) : 0.00;
$set_loan['amount']   = isset($_REQUEST['t_amount'])? str_replace(',', "", (string)trim($_REQUEST['t_amount'])) : 0;
$set_loan['price']   = isset($_REQUEST['t_price'])? str_replace(',', "", (string)trim($_REQUEST['t_price'])) : 0;
$set_loan['status']   = isset($_REQUEST['t_status'])? (string)trim($_REQUEST['t_status']) : 'pending';

$set_loan['start']   = isset($_REQUEST['t_fdate'])? (string)trim($_REQUEST['t_fdate']) : "0000-00-00";
$set_loan['start']   = $set_loan['start'] == ""? "0000-00-00" : $set_loan['start'];

$set_loan['end']     = isset($_REQUEST['t_tdate'])? (string)trim($_REQUEST['t_tdate']) : "0000-00-00";
$set_loan['end']     = $set_loan['end'] == ""? "0000-00-00" : $set_loan['end'];
$set_loan['staff']   = isset($_REQUEST['staff'])? (string)trim($_REQUEST['staff']) : 0;
$set_loan['user']    = isset($_REQUEST['t_user'])? (string)trim($_REQUEST['t_user']) : $user_id;

$set_loan['cocomm'] = isset($_REQUEST['t_cocomm'])? trim($_REQUEST['t_cocomm']) : "";
$set_loan['cocomm'] = $set_loan['cocomm'] == ""? "0" : $set_loan['cocomm'];
$set_loan['codate'] = isset($_REQUEST['t_codate'])? trim($_REQUEST['t_codate']) : "";
$set_loan['codate'] = $set_loan['codate'] == ""? "0000-00-00" : $set_loan['codate'];
$set_loan['discount'] = isset($_REQUEST['t_discount'])? trim($_REQUEST['t_discount']) : "";
$set_loan['discount'] = $set_loan['discount'] == ""? "0" : $set_loan['discount'];		    
$set_loan['discountdate'] = isset($_REQUEST['t_discountdate'])? trim($_REQUEST['t_discountdate']) : "";
$set_loan['discountdate'] = $set_loan['discountdate'] == ""? "0000-00-00" : $set_loan['discountdate'];	


$msg = '';
if (isset($_REQUEST['bt_name']) && (strtoupper($_REQUEST['bt_name']) == "SAVE" || strtoupper($_REQUEST['bt_name']) == "COURSEPROCESS")){
	if ($ugs['c_service']['i'] !=1 ) {
		echo "<script language='javascript'>alert('Permission denied!');if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;
	}


	//check necessary column
	if($set_loan['cr'] == 0 || $set_loan['lid'] == 0 || $set_loan['amount'] == 0) {
		if($msg == '') {
			$msg = 'alert("[INCOMPLETED INFO] \nCheck follwoings: \n1.Lending Insitute\n2.Commission Rate\n3.Loan Amount\n")';
		}
	}
	else {
		$set_loan['cr'] = $set_loan['cr']/100;

		if($hid > 0){
			$o_s->setHomeloan($hid, $set_loan);
		}else{
			$hid = $o_s->addHomeloan($user_id, $client_id, $set_loan);
			$o_s->autoProcess($hid);
		}
		
		if(strtoupper($_REQUEST['bt_name']) == "SAVE") {
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;
		}
	}

}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	$o_s->delHomeloan($hid);
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;
}

$o_s->autoProcess($hid);

# set smarty tpl
$o_tpl = new Template;

if ($hid > 0)
	$set_loan = $o_s->getHomeLoan($hid,0,0);


$o_tpl->assign('user_arr', $o_g->getUserNameArr());
$o_tpl->assign('msg_alert', $msg);
$o_tpl->assign('lend_arr', $o_s->getLending(0,null,null));
$o_tpl->assign('process_arr', $hid> 0? $o_s->getProcess(0, $hid) : array());
$o_tpl->assign('dt_arr', $set_loan);
$o_tpl->assign('lend_staff', $set_loan['lid'] > 0? $o_s->getStaff($set_loan['lid']): array());
$o_tpl->assign('client', $o_c->getOneClientInfo($client_id));


$o_tpl->assign('hid', $hid);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('loginid', $user_id);
$o_tpl->assign("ugs", $ugs);

$o_tpl->display('client_homeloan_detail.tpl');
?>
