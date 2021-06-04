<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');




$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


if(!isset($_REQUEST['token']) || $_REQUEST['token'] != 'a74613df87c11d04519fb0ee4225c800')
	die("token expired");



# get client id 
$sets = array();
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$sets['email']  = isset($_REQUEST['t_email'])? (string)trim($_REQUEST['t_email']) : "";
$sets['pass']  = isset($_REQUEST['t_pass'])? (string)trim($_REQUEST['t_pass']) : "";

//user login
if (isset($_REQUEST['login']) && $_REQUEST['login'] == 1) {
	echo serialize($o_c->_login($sets['email'], $sets['pass']));
	exit;
}
elseif (isset($_REQUEST['get']) && $_REQUEST['get'] == 1) {	
	echo serialize($o_c->getOneClientInfo($client_id));
	exit;
}
elseif (isset($_REQUEST['reg']) && $_REQUEST['reg'] == 1) {	
	echo serialize($o_c->_register($_REQUEST['email']));
	exit;
}
elseif (isset($_REQUEST['reg']) && $_REQUEST['reg'] == 2) {	
	echo serialize($o_c->_register($_REQUEST['t_email'],$_REQUEST['t_lname'],$_REQUEST['t_fname'],$_REQUEST['t_phone'],$_REQUEST['t_wechatid'],$_REQUEST['t_ctype'],2,$_REQUEST['t_about']));
	exit;
}
elseif (isset($_REQUEST['cfm']) && $_REQUEST['cfm'] == 1) {	
	echo serialize($o_c->_confirm($client_id));
	exit;
}
elseif (isset($_REQUEST['reg']) && $_REQUEST['reg'] == 'partner') {	
	echo serialize($o_a->_register());
	exit;
}


$sets['visa']  = isset($_REQUEST['t_visa'])? (string)trim($_REQUEST['t_visa']) : 0;
$sets['class'] = isset($_REQUEST['t_class'])? (string)trim($_REQUEST['t_class']) : 0; 
$sets['classtxt']  = isset($_REQUEST['t_classtxt'])? (string)trim($_REQUEST['t_classtxt']) : "";

	# get client info
	$sets['lname']  = isset($_REQUEST['t_lname'])? (string)trim($_REQUEST['t_lname']) : "";
	$sets['fname']  = isset($_REQUEST['t_fname'])? (string)trim($_REQUEST['t_fname']) : "";
	//$sets['status']  = isset($_REQUEST['status'])? (string)trim($_REQUEST['status']) : "approved";	
	$sets['dob']    = isset($_REQUEST['t_dob']) && $_REQUEST['t_dob'] != ''? (string)trim($_REQUEST['t_dob']) : "0000-00-00";

	
	$sets['gender'] = isset($_REQUEST['t_gender'])? (string)trim($_REQUEST['t_gender']) : "";
	$sets['ename']  = isset($_REQUEST['t_ename'])? (string)trim($_REQUEST['t_ename']) : "";
	$sets['tel']    = isset($_REQUEST['t_tel'])? (string)trim($_REQUEST['t_tel']) : "";
	$sets['mobile'] = isset($_REQUEST['t_mobile'])? (string)trim($_REQUEST['t_mobile']) : "";
	$sets['add']    = isset($_REQUEST['t_add'])? (string)trim($_REQUEST['t_add']) : "";
	$sets['country']= isset($_REQUEST['t_country'])? (string)trim($_REQUEST['t_country']) : "";
	//$sets['type']   = isset($_REQUEST['t_type'])? (string)trim($_REQUEST['t_type']) : "";
	$sets['type']   = isset($_REQUEST['t_type'])? explode(',', $_REQUEST['t_type']) : array();

	$sets['agent']  = isset($_REQUEST['t_agent'])? (string)trim($_REQUEST['t_agent']) : 0;
	$sets['note']   = isset($_REQUEST['t_note'])? (string)trim($_REQUEST['t_note']) : "";
//	$sets['cuser']    = isset($_REQUEST['t_cuser'])? (string)trim($_REQUEST['t_cuser']) : 0;
	$sets['sign']  = isset($_REQUEST['t_sign'])  && $_REQUEST['t_sign'] != '' ? (string)trim($_REQUEST['t_sign']) : date('Y-m-d');
//	$sets['sign']  = $sets['sign'] == ""? date("Y-m-d"): $sets['sign'];
	
	$sets['about']  = isset($_REQUEST['t_about'])? (string)trim($_REQUEST['t_about']) : "";
	@$sets['about']  = $sets['about'] == "" ? (string)$_REQUEST['t_aboutTxt'] : $sets['about'];

	$sets['married']  = isset($_REQUEST['t_m'])? (string)trim($_REQUEST['t_m']) : "never_married";

	if (isset($_REQUEST['t_c']) && $_REQUEST['t_c'] == 1){
		$sets['c_name']  = isset($_REQUEST['t_c_name'])? (string)trim($_REQUEST['t_c_name']) : "";
		$sets['c_tel']   = isset($_REQUEST['t_c_tel'])? (string)trim($_REQUEST['t_c_tel']) : "";
		$sets['c_mobile']= isset($_REQUEST['t_c_mobile'])? (string)trim($_REQUEST['t_c_mobile']) : "";
		$sets['c_email'] = isset($_REQUEST['t_c_email'])? (string)trim($_REQUEST['t_c_email']) : "";
		$sets['c_add']   = isset($_REQUEST['t_c_add'])? (string)trim($_REQUEST['t_c_add']) : "";	
		$sets['c_rtu']   = isset($_REQUEST['t_c_rtu'])? (string)trim($_REQUEST['t_c_rtu']) : "";			
	}

	$sets['epdate']  = isset($_REQUEST['t_epdate']) && $_REQUEST['t_epdate'] != ''? (string)trim($_REQUEST['t_epdate']) : "0000-00-00";
//	$sets['epdate']  = $sets['epdate'] == ""? "0000-00-00" : $sets['epdate']; //date("Y-m-d")
	$sets['actm']  = isset($_REQUEST['t_actm'])? (string)trim($_REQUEST['t_actm']) : "";
	$sets['d_actm']  = isset($_REQUEST['t_d_actm']) && $_REQUEST['t_d_actm'] != ''? (string)trim($_REQUEST['t_d_actm']) : "0000-00-00";
	$sets['bank']  = isset($_REQUEST['t_bank'])? (string)trim($_REQUEST['t_bank']) : "";

	#set or add client info
	$msg = 'success';
    if ($client_id > 0){
        if($sets['about'] == ""){
			$msg = "ERROR:Where do you know about us: can not be empty!";
        }
        else{
			if ($_REQUEST['code'] != '') 
				$sets['agent'] = $o_a->getAgentIDByCode($_REQUEST['code']);
				        	
			$o_c->setClientInfo($client_id, $sets);			
        }
    } else {
		if ($o_c->checkSimilarClient($sets) > 0) {
			$msg = "ERROR:Has similar NAME or same EMAIL !!!";			
        }
        elseif($sets['about'] == ""){
			$msg = "ERROR:Where do you know about us: can not be empty!";
			exit;			
        }
        else{
			if ($_REQUEST['code'] != '') 
				$sets['agent'] = $o_a->getAgentIDByCode($_REQUEST['code']);

			$o_c->addClientInfo(0, $sets);
			$msg = $o_c->getLastInsertID();

		}
	}

	echo serialize($msg);
	exit;
?>
