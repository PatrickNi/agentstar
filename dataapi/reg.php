<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');

function getIpAddress()
{
	if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	} elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$onlineip = getenv('REMOTE_ADDR');
	} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}
	$clientip = false;
	foreach (explode(',', $onlineip) as $remote_ip) {
		$remote_ip = preg_replace('/^([\d\.]+).*/', '\1', trim($remote_ip));
		if (filter_var($remote_ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
			$clientip = $remote_ip;
			break;
		}
	}
	return $clientip;
}
$ACCESS_TOKES = array('a74613df87c11d04519fb0ee4225c800' => 'v1', '92ec7cb202aa392b94bc88c575096f29'=>'v2');

//Token required
if (getIpAddress() != '47.52.119.83' || !isset($_REQUEST['token']) || !isset($ACCESS_TOKES[$_REQUEST['token']])) {
	die('Acess denied');
}

$API_VERSION = $ACCESS_TOKES[$_REQUEST['token']];



$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get client id 
if ($API_VERSION == 'v1') {
	$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
}
elseif ($API_VERSION == 'v2') {
	$data = $o_c->_loginSig(isset($_REQUEST['sig'])? (string)trim($_REQUEST['sig']) : "");
	if (isset($data['cid']) && $data['cid'] > 0) {
		$client_id = $data['cid'];
	}
	else {
		echo json_encode(array('err'=>1, 'msg'=>'no client found'));
		exit;
	}
}


$sets = array();
$sets['email']  = isset($_REQUEST['t_email'])? (string)trim($_REQUEST['t_email']) : $data['email'];
$sets['pass']  = isset($_REQUEST['t_pass'])? (string)trim($_REQUEST['t_pass']) : "";

//user login
if (isset($_REQUEST['login']) && $_REQUEST['login'] == 1) {
	echo serialize($o_c->_login($sets['email'], $sets['pass']));
	exit;
}
if (isset($_REQUEST['login']) && $_REQUEST['login'] == 2) {
	echo serialize($o_c->_loginSig(isset($_REQUEST['sig'])? (string)trim($_REQUEST['sig']) : ""));
	exit;
}
elseif (isset($_REQUEST['get']) && $_REQUEST['get'] == 1) {	
	$rtn = $o_c->getOneClientInfo($client_id);
	if ($API_VERSION == 'v2') {
		echo json_encode(array('err'=>0, 'msg'=>$rtn));
	}
	else {
		echo serialize($rtn);
	}
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
elseif (isset($_REQUEST['reg']) && $_REQUEST['reg'] == 'uploadall') {
	$data = json_decode(base64_decode($_POST['data']), true);

	if (isset($data['profile'])) {
		$sets['visa']  = isset($data['profile']['t_visa'])? (string)trim($data['profile']['t_visa']) : 0;
		$sets['class'] = isset($_REQUEST['t_class'])? (string)trim($data['profile']['t_class']) : 0; 
		$sets['classtxt']  = isset($data['profile']['t_classtxt'])? (string)trim($data['profile']['t_classtxt']) : "";
		
		# get client info
		$sets['lname']  = isset($data['profile']['t_lname'])? (string)trim($data['profile']['t_lname']) : "";
		$sets['fname']  = isset($data['profile']['t_fname'])? (string)trim($data['profile']['t_fname']) : "";
		//$sets['status']  = isset($data['profile']['status'])? (string)trim($data['profile']['status']) : "approved";	
		$sets['dob']    = isset($data['profile']['t_dob']) && $data['profile']['t_dob'] != ''? (string)trim($data['profile']['t_dob']) : "0000-00-00";
		
		
		$sets['gender'] = isset($data['profile']['t_gender'])? (string)trim($data['profile']['t_gender']) : "";
		$sets['ename']  = isset($data['profile']['t_ename'])? (string)trim($data['profile']['t_ename']) : "";
		$sets['tel']    = isset($data['profile']['t_tel'])? (string)trim($data['profile']['t_tel']) : "";
		$sets['mobile'] = isset($data['profile']['t_mobile'])? (string)trim($data['profile']['t_mobile']) : "";
		$sets['add']    = isset($data['profile']['t_add'])? (string)trim($data['profile']['t_add']) : "";
		$sets['country']= isset($data['profile']['t_country'])? (string)trim($data['profile']['t_country']) : "";
		//$sets['type']   = isset($data['profile']['t_type'])? (string)trim($data['profile']['t_type']) : "";
		$sets['type']   = isset($data['profile']['t_type'])? $data['profile']['t_type'] : array();
		
		$sets['agent']  = isset($data['profile']['t_agent'])? (string)trim($data['profile']['t_agent']) : 0;
		$sets['cus_note']   = isset($data['profile']['t_cus_note'])? (string)trim($data['profile']['t_cus_note']) : "";
		//	$sets['cuser']    = isset($data['profile']['t_cuser'])? (string)trim($data['profile']['t_cuser']) : 0;
		$sets['sign']  = isset($data['profile']['t_sign'])  && $data['profile']['t_sign'] != '' ? (string)trim($data['profile']['t_sign']) : date('Y-m-d');
		//	$sets['sign']  = $sets['sign'] == ""? date("Y-m-d"): $sets['sign'];
		
		$sets['about']  = isset($data['profile']['t_about'])? (string)trim($data['profile']['t_about']) : "";
		@$sets['about']  = $sets['about'] == "" ? (string)$data['profile']['t_aboutTxt'] : $sets['about'];
		
		$sets['married']  = isset($data['profile']['t_m'])? (string)trim($data['profile']['t_m']) : "never_married";
		
		//if (isset($data['profile']['t_c']) && $data['profile']['t_c'] == 1){
			$sets['t_c'] = 1;
			$sets['c_name']  = isset($data['profile']['t_c_name'])? (string)trim($data['profile']['t_c_name']) : "";
			$sets['c_tel']   = isset($data['profile']['t_c_tel'])? (string)trim($data['profile']['t_c_tel']) : "";
			$sets['c_mobile']= isset($data['profile']['t_c_mobile'])? (string)trim($data['profile']['t_c_mobile']) : "";
			$sets['c_email'] = isset($data['profile']['t_c_email'])? (string)trim($data['profile']['t_c_email']) : "";
			$sets['c_add']   = isset($data['profile']['t_c_add'])? (string)trim($data['profile']['t_c_add']) : "";	
			$sets['c_rtu']   = isset($data['profile']['t_c_rtu'])? (string)trim($data['profile']['t_c_rtu']) : "";			
		//}
		
		$sets['epdate']  = isset($data['profile']['t_epdate']) && $data['profile']['t_epdate'] != ''? (string)trim($data['profile']['t_epdate']) : "0000-00-00";
		//	$sets['epdate']  = $sets['epdate'] == ""? "0000-00-00" : $sets['epdate']; //date("Y-m-d")
		$sets['actm']  = isset($data['profile']['t_actm'])? (string)trim($data['profile']['t_actm']) : "";
		$sets['d_actm']  = isset($data['profile']['t_d_actm']) && $data['profile']['t_d_actm'] != ''? (string)trim($data['profile']['t_d_actm']) : "0000-00-00";
		$sets['bank']  = isset($data['profile']['t_bank'])? (string)trim($data['profile']['t_bank']) : "";
		$sets['staff_name']  = isset($data['profile']['t_staffname'])? (string)trim($data['profile']['t_staffname']) : "";
		
		#set or add client info
		$msg = 'success';
		if ($client_id > 0){
			if($sets['about'] == ""){
				$msg = "ERROR: Where do you know about us: can not be empty!";
			}
			else{
				if ($data['profile']['code'] != '') 
					$sets['agent'] = $o_a->getAgentIDByCode($data['profile']['code']);
					//echo serialize($sets);exit;	        	
				$o_c->setClientInfo($client_id, $sets);			
			}
		}
	}

	if (isset($data['edu'])) {
		foreach ($data['edu'] as $edu) {
			$sets = array();
			$sets['country']= isset($edu['t_country'])? (string)trim($edu['t_country']) : 0;
			$sets['fdate']  = isset($edu['t_fdate'])? (string)trim($edu['t_fdate']) : "0000-00-00";
			$sets['fdate']   = $sets['fdate'] != ""? $sets['fdate'] : "0000-00-00";
			
			$sets['tdate']  = isset($edu['t_tdate'])? (string)trim($edu['t_tdate']) : "0000-00-00";
			$sets['tdate']   = $sets['tdate'] != ""? $sets['tdate'] : "0000-00-00";
			
			$sets['school'] = isset($edu['t_school'])? (string)trim($edu['t_school']) : '';	
			$sets['qual']   = isset($edu['t_qual'])? (string)trim($edu['t_qual']) : '';
			$sets['major']  = isset($edu['t_major'])? (string)trim($edu['t_major']) : '';
			
			$sets['note']   = isset($edu['t_note'])? (string)trim($edu['t_note']) : "";
			$sets['status']   = isset($edu['t_status'])? (string)trim($edu['t_status']) : "YES";
			
			$sets['fulltime']   = isset($edu['t_fulltime'])? trim($edu['t_fulltime']) : 0;
			
			
			$msg = 'success';
			if($sets['country'] == 0 || $sets['school'] == '' || $sets['fdate'] == "0000-00-00" || $sets['tdate'] == "0000-00-00"){
				$msg = 'ERROR: Invalid Input Data';
			}
			else{
				$sets['order'] = 0;//$sets['order'] + 1; 
				$o_c->addQualification($client_id, $sets);
				//$msg = $o_c->getLastInsertID();			
			}
		}
	}
	
	if (isset($data['exp'])) {
		foreach ($data['exp'] as $exp) {
			# get work experience
			$set_arr = array();

			$set_arr['fdate']  = isset($exp['t_fdate'])? (string)trim($exp['t_fdate']) : "0000-00-00";
			$set_arr['fdate']  = $set_arr['fdate'] == ""? "0000-00-00" : $set_arr['fdate'] ; 

			$set_arr['tdate']  = isset($exp['t_tdate'])? (string)trim($exp['t_tdate']) : "0000-00-00";
			$set_arr['tdate']  = $set_arr['tdate'] == ""? "0000-00-00" : $set_arr['tdate'];

			$set_arr['com']    = isset($exp['t_com'])? (string)trim($exp['t_com']) : "";
			$set_arr['country'] = isset($exp['t_country'])? (string)trim($exp['t_country']) : "";

			$set_arr['pos']    = isset($exp['t_pos'])? (string)trim($exp['t_pos']) : "";

			$set_arr['note']   = isset($exp['t_note'])? (string)trim($exp['t_note']) : "";
			$set_arr['note']   = $set_arr['note'] != ""? $set_arr['note'] : " ";

			$set_arr['fulltime']   = isset($exp['t_fulltime'])? trim($exp['t_fulltime']) : 0;

			$msg = 'success';
			if($set_arr['com'] == ""){
				$msg = 'ERROR:Invalid Company Name';	
			}
			else{
				$set_arr['order'] = 0;//$sets['order'] + 1; 
				$o_c->addWorkExp($client_id, $set_arr);
				//$msg = $o_c->getLastInsertID();				
			}	
		}
	}
	if (isset($msg) && $msg) {
		if ($API_VERSION == 'v2') {
			if (stripos($msg, 'ERROR') !== false) {
				echo json_encode(array('err'=>1, 'msg'=>$msg));
			}
			else {
				echo json_encode(array('err'=>0, 'msg'=>$msg));
			}
		}
		else {
			echo serialize($msg);
		}
	}

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
$sets['cus_note']   = isset($_REQUEST['t_cus_note'])? (string)trim($_REQUEST['t_cus_note']) : "";
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
			//echo serialize($sets);exit;	        	
		$o_c->setClientInfo($client_id, $sets);			
	}
} 

if ($API_VERSION == 'v2') {
	echo json_encode(array('err'=>$msg=='success'? 0 : 1, 'msg'=>$msg));
}
else {
	echo serialize($msg);
}
exit;
/*
else {
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
*/
?>
