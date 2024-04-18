<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');


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


$qual_id   = isset($_REQUEST['qid'])? trim($_REQUEST['qid']) : 0;
$isNew     = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;
$isChange  = isset($_REQUEST['isChange'])? trim($_REQUEST['isChange']) : 0;


if (isset($_REQUEST['get']) && $_REQUEST['get'] == 1) {	
	$rtn = $o_c->getQualificationByClient($client_id);
	if ($API_VERSION == 'v2') {
		echo json_encode(array('err'=>0, 'msg'=>$rtn));
	}
	else {
		echo serialize($rtn);
	}
	exit;
}
elseif (isset($_REQUEST['del']) && $_REQUEST['del'] == 1) {	
	$rtn = $o_c->delQual($qual_id);
	if ($API_VERSION == 'v2') {
		echo json_encode(array('err'=>$rtn? 1 : 0, 'msg'=>$rtn? 'success' : 'failed'));
	}
	else {
		echo serialize($rtn);
	}
	exit;
}



# get qualification
$sets = array();
$sets['country']= isset($_POST['t_country'])? (string)trim($_POST['t_country']) : 0;
$sets['fdate']  = isset($_POST['t_fdate'])? (string)trim($_POST['t_fdate']) : "0000-00-00";
$sets['fdate']   = $sets['fdate'] != ""? $sets['fdate'] : "0000-00-00";

$sets['tdate']  = isset($_POST['t_tdate'])? (string)trim($_POST['t_tdate']) : "0000-00-00";
$sets['tdate']   = $sets['tdate'] != ""? $sets['tdate'] : "0000-00-00";

$sets['school'] = isset($_POST['t_school'])? (string)trim($_POST['t_school']) : '';	
$sets['qual']   = isset($_POST['t_qual'])? (string)trim($_POST['t_qual']) : '';
$sets['major']  = isset($_POST['t_major'])? (string)trim($_POST['t_major']) : '';

$sets['note']   = isset($_POST['t_note'])? (string)trim($_POST['t_note']) : "";
$sets['status']   = isset($_POST['t_status'])? (string)trim($_POST['t_status']) : "YES";

$sets['fulltime']   = isset($_POST['t_fulltime'])? trim($_POST['t_fulltime']) : 0;


if($sets['country'] == 0 || $sets['school'] == '' || $sets['fdate'] == "0000-00-00" || $sets['tdate'] == "0000-00-00"){
	$msg = 'ERROR: Invalid Input Data';
}
else{
	if(isset($_POST['isNew']) && $_POST['isNew'] == 1){
		$sets['order'] = $o_c->getQualOrder($qual_id, $client_id);
		$o_c->resetQualOrder($client_id, $sets['order']);
		$sets['order'] = $sets['order'] + 1; 
		$o_c->addQualification($client_id, $sets);
		$msg = $o_c->getLastInsertID();			
	}
	else{
		$o_c->setQualification($qual_id, $sets);
		$msg = $qual_id;					
	}
}

if ($API_VERSION == 'v2') {
	if (stripos($msg, 'ERROR') !== false && $msg > 0) {
		echo json_encode(array('err'=>0, 'msg'=>$msg));
	}
	else {
		echo json_encode(array('err'=>1, 'msg'=>$msg));
	}
}
else {
	echo serialize($msg);
}

exit;
?>
