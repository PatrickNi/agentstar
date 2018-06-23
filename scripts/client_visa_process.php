<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');

$PROCESS_VISA_STATUS = array('withdraw'=>'withdraw', 'refused'=>'refused', 'cancel agreement'=>'cancel agreement', 'agent stop'=>'agent stop', 'declined' => 'declined' );


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
$error = "";
# get course id
$visa_id    = isset($_REQUEST['vid'])? trim($_REQUEST['vid']) : 0;
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$process_id = isset($_REQUEST['pid'])? trim($_REQUEST['pid']) : 0;
$isNew = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;
$isOther = isset($_REQUEST['isOther'])? trim($_REQUEST['isOther']) : 0;
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$error = "";
$visa_rs_arr = $o_c->getVisaRsID($visa_id);
# get item array
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$process_item_arr = $o_v->getVisaItemArr($visa_rs_arr['visa'], $visa_rs_arr['class']); 


if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$sets['date'] = isset($_REQUEST['t_date'])? trim($_REQUEST['t_date']) : "0000-00-00";
	$sets['date'] = $sets['date'] == ""? "0000-00-00" : $sets['date'];
	$sets['due']  = isset($_REQUEST['t_due'])? trim($_REQUEST['t_due']) : "0000-00-00";
	$sets['epd']  = isset($_REQUEST['t_epdate'])? trim($_REQUEST['t_epdate']) : "0000-00-00";
	$sets['due']  = $sets['due'] == ""? "0000-00-00" : $sets['due'];
	
	$sets['detail']  = isset($_REQUEST['t_detail'])? trim($_REQUEST['t_detail']) : "";
	$sets['subject'] = isset($_REQUEST['t_subject'])? trim($_REQUEST['t_subject']) : 0;
	$sets['add']     = isset($_REQUEST['t_add'])? trim($_REQUEST['t_add']) : "";
	$sets['done']    = isset($_REQUEST['t_done'])? trim($_REQUEST['t_done']) : 0;
	
	$post_back = $sets;
	//check special steps
	$change_visa_status = false;
	if (isset($PROCESS_VISA_STATUS[$sets['subject']])) {
     	$sets['add'] = $sets['subject'];
     	$change_visa_status = $PROCESS_VISA_STATUS[$sets['subject']];
        $sets['subject'] = 0;
	}
	elseif (isset($process_item_arr[$sets['subject']]) && stripos($process_item_arr[$sets['subject']], 'grant') !== false) {
		$change_visa_status = 'grant';
	}
	
	
    if ($sets['date'] == '0000-00-00' && $sets['done'] == 1) {
    	$error = "<script language='javascript'>alert('Please input the DATE when you done this process!');</script>";
    }
	elseif($isNew == 1  && $sets['subject'] > 0 && $o_c->checkVisaProcess($visa_id, $sets['subject'])){
		$error = "<script language='javascript'>alert('The Process existed in current visa applying');</script>";
	}
	elseif($isNew == 1 && $change_visa_status) {
		//Fetch grant itemid
		$grant_item_id = 0;
		foreach ($process_item_arr as $_id => $item) {
			if (stripos($item, 'grant') !== false)
				$grant_item_id = $_id;
		}

		if ($o_c->checkVisaStatusInProcess($visa_id, $PROCESS_VISA_STATUS, $grant_item_id))
			$error = "<script language='javascript'>alert('The Process of Visa Status is existed!');</script>";		
	}
	elseif ($change_visa_status == 'grant' && $sets['done'] == 1) {
		if(!$o_c->checkVisaAmont($visa_id)){
			$error = "<script language='javascript'>alert('Unfinished Agreement! Plesas check payments');</script>";     		
		}

		if ($sets['epd'] == '0000-00-00') {
			$error = "<script language='javascript'>alert('Current Visa Expire Date not set');</script>";
		}
		else {
			//sync visa expire date
			$o_v->setVisaExpire($visa_id, $sets['epd']);
		
			if ($sets['epd'] > date('Y-m-d')) {
				//sync client main
				$visa_rs_arr['epd'] = $sets['epd'];
				$o_c->setClientMainVisa($visa_rs_arr, $client_id);
			}
		}
	}

	if ($error == '') {
		if($isNew == 1){
			#current process order id
			$sets['order'] = $o_c->getVisaProcessOrder($process_id, $visa_id);
			$o_c->resetVisaProcessOrder($visa_id, $sets['order']);
			$sets['order'] = $sets['order'] + 1; 
			$process_id = $o_c->addVisaProcess($visa_id, $sets);			
		}
		else{
			/*
			//check visa payments
			if ($sets['done'] == 1 && isset($process_item_arr[$sets['subject']]) && preg_match('/^apply/i', $process_item_arr[$sets['subject']])) {

				if (!$o_v->checkVisaPayment($visa_id))
					$error = "Cannot apply due to client didn't pay off!";
			}
			*/			
		}		
		
		if ($error == '') {
			$o_c->setVisaProcess($process_id, $sets);	
			if($o_v->is_auto_step($visa_id) && $sets['done'] == 1 && $process_id > 0 && $visa_rs_arr['adate'] > '0000-00-00'){		
				$o_c->autoVisaProcess($visa_id, $process_id, $process_item_arr);
				reset($process_item_arr);
			}	


			if ($change_visa_status && $sets['done'] == 1) {
				$o_c->setApplyVisaStatus($visa_id, $change_visa_status);
			}
			echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;
		}	
	}
}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if($process_id > 0){
		$o_v->close_auto_step($process_id);
		$o_c->delVisaProcess($process_id);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}


# format array
$process_arr = $o_c->getVisaProcess($visa_id);



# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('process_arr', $process_arr);
$o_tpl->assign('subject_arr', $process_item_arr);

if ($error != '') {
	$post_back['itemid'] = $post_back['subject'];
	$o_tpl->assign('dt_arr', $post_back);
}
elseif($isOther == 0 && $process_id > 0 && array_key_exists($process_id, $process_arr)){
	if (isset($PROCESS_VISA_STATUS[$process_arr[$process_id]['add']])) {
		$process_arr[$process_id]['itemid'] = $process_arr[$process_id]['add'];
		$process_arr[$process_id]['add'] = '';
	}
	$o_tpl->assign('dt_arr', $process_arr[$process_id]);
}

$o_tpl->assign('cid', $client_id);
$o_tpl->assign('vid', $visa_id);
$o_tpl->assign('pid', $process_id);
$o_tpl->assign('isOther', $isOther);
$o_tpl->assign('isNew', $isNew);
$o_tpl->assign('errormsg', $error);
$o_tpl->assign('visa_rs', $visa_rs_arr);
$o_tpl->display('client_visa_process.tpl');
?>

