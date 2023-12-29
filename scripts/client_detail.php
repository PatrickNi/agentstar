<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}


$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


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

unset($client_type_arr['all']);
foreach ($client_type_arr as $id => $v){
	$client_type_arr[$id] = strtolower($v);
}
//new client type
$client_type_arr['Home Loan'] = 'homeloan';
$client_type_arr['Legal'] = 'legal';
$client_type_arr['Coach'] = 'coach';


# get client id 
$sets = array();
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$isChange = isset($_REQUEST['visaChange'])? (string)trim($_REQUEST['visaChange']) : 0;
$sets['visa']  = isset($_REQUEST['t_visa'])? (string)trim($_REQUEST['t_visa']) : 0;
$sets['visa']  = $sets['visa'] == ""? 0 : $sets['visa'];

$sets['class'] = isset($_REQUEST['t_class'])? (string)trim($_REQUEST['t_class']) : 0; 
$sets['class']  = $sets['class'] == ""? 0 : $sets['class'];


	# get client info
	$sets['pass']  = isset($_REQUEST['t_pass'])? (string)trim($_REQUEST['t_pass']) : "";
	$sets['classtxt']  = isset($_REQUEST['t_classtxt'])? (string)trim($_REQUEST['t_classtxt']) : "";

	$sets['lname']  = isset($_REQUEST['t_lname'])? (string)trim($_REQUEST['t_lname']) : "";
	$sets['fname']  = isset($_REQUEST['t_fname'])? (string)trim($_REQUEST['t_fname']) : "";
	
	$sets['dob']    = isset($_REQUEST['t_dob']) && $_REQUEST['t_dob'] != ''? (string)trim($_REQUEST['t_dob']) : "0000-00-00";
	
	
	$sets['gender'] = isset($_REQUEST['t_gender'])? (string)trim($_REQUEST['t_gender']) : "";
	$sets['ename']  = isset($_REQUEST['t_ename'])? (string)trim($_REQUEST['t_ename']) : "";
	$sets['email']  = isset($_REQUEST['t_email'])? (string)trim($_REQUEST['t_email']) : "";
	$sets['tel']    = isset($_REQUEST['t_tel'])? (string)trim($_REQUEST['t_tel']) : "";
	$sets['mobile'] = isset($_REQUEST['t_mobile'])? (string)trim($_REQUEST['t_mobile']) : "";
	$sets['add']    = isset($_REQUEST['t_add'])? (string)trim($_REQUEST['t_add']) : "";
	$sets['country']= isset($_REQUEST['t_country'])? (string)trim($_REQUEST['t_country']) : "";
	$sets['type']   = isset($_REQUEST['t_type'])? $_REQUEST['t_type'] : array();
	
	if (isset($_REQUEST['t_agent_p']) && (string)trim($_REQUEST['t_agent_p']) > "0") {
		$sets['agent']  = (string)trim($_REQUEST['t_agent_p']);
	}
	elseif (isset($_REQUEST['t_agent_a']) && (string)trim($_REQUEST['t_agent_a']) > "0") {
		$sets['agent']  = (string)trim($_REQUEST['t_agent_a']) ;
	}
	else {
		$sets['agent']  = 0;
	}


	$sets['note']   = isset($_REQUEST['t_note'])? (string)trim($_REQUEST['t_note']) : "";
	$sets['cus_note']   = isset($_REQUEST['t_cus_note'])? (string)trim($_REQUEST['t_cus_note']) : "";
//	$sets['cuser']    = isset($_REQUEST['t_cuser'])? (string)trim($_REQUEST['t_cuser']) : 0;
	$sets['sign']  = isset($_REQUEST['t_sign'])  && $_REQUEST['t_sign'] != '' ? (string)trim($_REQUEST['t_sign']) : "0000-00-00";
//	$sets['sign']  = $sets['sign'] == ""? date("Y-m-d"): $sets['sign'];
	
	$sets['about']  = isset($_REQUEST['t_about'])? (string)trim($_REQUEST['t_about']) : "";
	$sets['about']  = $sets['about'] == ""? (string)$_REQUEST['t_aboutTxt'] : $sets['about'];

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
	$sets['actm']  = isset($_REQUEST['t_actm'])? (string)trim($_REQUEST['t_actm']) : "";
	$sets['d_actm']  = isset($_REQUEST['t_d_actm']) && $_REQUEST['t_d_actm'] != ''? (string)trim($_REQUEST['t_d_actm']) : "0000-00-00";
	$sets['bank']  = isset($_REQUEST['t_bank'])? (string)trim($_REQUEST['t_bank']) : "";
//	$sets['epdate']  = $sets['epdate'] == ""? "0000-00-00" : $sets['epdate']; //date("Y-m-d")

	$sets['wechatid']  = isset($_REQUEST['t_wechat_id'])? (string)trim($_REQUEST['t_wechat_id']) : "";
	$sets['wechatphone']  = isset($_REQUEST['t_wechat_phone'])? (string)trim($_REQUEST['t_wechat_phone']) : "";
	$sets['wechatemail']  = isset($_REQUEST['t_wechat_email'])? (string)trim($_REQUEST['t_wechat_email']) : "";
	$sets['staff_name']= isset($_REQUEST['t_staffname'])? (string)trim($_REQUEST['t_staffname']) : "";

if (isset($_REQUEST['bt_name']) && (strtoupper($_REQUEST['bt_name']) == "SAVE" || strtoupper($_REQUEST['bt_name']) == "APPROVED")) {
/*
	if ($sets['country'] == '0') {
		echo "<script language='javascript'>alert('\"Country: \" can not be empty!')</script>";
	}
	elseif ($sets['visa']  == '0') {
		echo "<script language='javascript'>alert('\"Current Visa Type: \" can not be empty!')</script>";
	}
	elseif ($sets['epdate'] == '') {
		echo "<script language='javascript'>alert('\"Current Visa ExpireDate: \" can not be empty!')</script>";
	}
	elseif ($sets['gender'] == '') {
		echo "<script language='javascript'>alert('\"Gender: \" can not be empty!')</script>";
	}
	elseif (isset($_REQUEST) && $_REQUEST['t_dob'] == '') {
		echo "<script language='javascript'>alert('\"DOB: \" can not be empty!')</script>";
	}
	elseif (isset($_REQUEST) && !preg_match('/^[\d]{4}-[\d]{2}-[\d]{2}/', $_REQUEST['t_dob'])) {
		echo "<script language='javascript'>alert('\"DOB: \" should be YYYY-MM-DD!')</script>";
	}
	elseif ($sets['mobile'] == '') {
		echo "<script language='javascript'>alert('\"Mobile: \" can not be empty!')</script>";
	}
	elseif($sets['about'] == "" && $sets['agent'] == 0){
        echo "<script language='javascript'>alert('\"Where do you know about us: \" can not be empty!')</script>";
	}
*/
	if ($sets['lname'] == '') {
		echo "<script language='javascript'>alert('\"Last Name: \" can not be empty!')</script>";
	}
	elseif ($sets['fname'] == '') {
		echo "<script language='javascript'>alert('\"First Name: \" can not be empty!')</script>";
	}
	elseif ($sets['email'] == '' || !preg_match('/^[^@]+@[^@]+$/', $sets['email'])) {
		echo "<script language='javascript'>alert('\Email: \" can not be empty! or incorrect!')</script>";
	}
	else {

		#set or add client info
   		if ($client_id > 0){	
			if (strtoupper($_REQUEST['bt_name']) == "APPROVED") {
				$save = false;
				$sets['status'] = 'new';
				
				if ($sets['country'] == '0') {
					echo "<script language='javascript'>alert('\"Country: \" can not be empty!')</script>";
				}
				elseif ($sets['visa']  == '0') {
					echo "<script language='javascript'>alert('\"Current Visa Type: \" can not be empty!')</script>";
				}
				elseif ($sets['epdate'] == '') {
					echo "<script language='javascript'>alert('\"Current Visa ExpireDate: \" can not be empty!')</script>";
				}
				elseif ($sets['gender'] == '') {
					echo "<script language='javascript'>alert('\"Gender: \" can not be empty!')</script>";
				}
				elseif (isset($_REQUEST) && $_REQUEST['t_dob'] == '') {
					echo "<script language='javascript'>alert('\"DOB: \" can not be empty!')</script>";
				}
				elseif (isset($_REQUEST) && !preg_match('/^[\d]{4}-[\d]{2}-[\d]{2}/', $_REQUEST['t_dob'])) {
					echo "<script language='javascript'>alert('\"DOB: \" should be YYYY-MM-DD!')</script>";
				}
				elseif ($sets['mobile'] == '') {
					echo "<script language='javascript'>alert('\"Mobile: \" can not be empty!')</script>";
				}
				elseif($sets['about'] == "" && $sets['agent'] == 0){
					echo "<script language='javascript'>alert('\"Where do you know about us: \" can not be empty!')</script>";
				}
				else {
					$sets['status'] = 'approved';
					$save = true;
				}
			}
			else {
				$save = true;
			}

			if ($save)
				$o_c->setClientInfo($client_id, $sets);
	    } 
		else {
			if ($o_c->checkSimilarClient($sets) > 0) {
				echo "<script language='javascript'>alert('Has similar names in DB!')</script>";	
			}
			else {			
				$o_c->addClientInfo($user_id, $sets);
				$client_id = $o_c->getLastInsertID();
			
				#add user client relate
				$o_c->addClientUserRs($client_id, $user_id);
			}
		}
	
		#auto metion visa expire data
		if($sets['epdate'] != "" && $sets['epdate'] != '0000-00-00'){// && strtoupper($sets['type']) == "STUDY"
			$tag = "Visa expiry date at {$sets['epdate']}";
			$o_c->autoService($sets['epdate'], $tag, $client_id, $sets['visa'],$sets['class']);
		}
	}
}elseif (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == 'DELETE'){
	$o_c->delClient($client_id);
	header("Location: client.php");
	exit;
}
elseif(isset($_REQUEST['crypt_link']) && $_REQUEST['crypt_link'] != "") {
	if ($_REQUEST['crypt_link'] == 'gen') {
		$link = $o_c->genCryptionLink($client_id);
		echo json_encode(array('succ'=>$link? 1: 0, 'link'=>$link));
	}
	elseif ($_REQUEST['crypt_link'] == 'expire') {
		$link = $o_c->expireCryptionLink($client_id);
		echo json_encode(array('succ'=>$link? 1: 0, 'link'=>''));
	}
	exit;
}

#get client type
$client_type = $o_c->getClientType($client_id);

//check dependant
$is_dependant = $o_c->checkDependant($client_id);




# get client info
$client_arr = array();
$client_arr = $o_c->getOneClientInfo($client_id);
if ($client_id > 0) {
	$sets['visa']  = $sets['visa'] == 0? $client_arr['visa'] : $sets['visa'];
}


if ($client_id > 0) {
	$sets['class'] =  $sets['class'] == 0? $client_arr['class'] : $sets['class'];
}

	

# get country
$country_arr = array();
$country_arr = $o_c->getCountry();

# get agent name
//get global partner
$agent_partner = $o_a->getAgentList(0,'sub','education');

//get global ambassador
$agent_ambassador = $o_a->getAgentList(0,'sub','student');


//# get user
//$user_arr = array();
//$user_arr = $o_g->getUserNameArr();

# get visa arr
$visa_arr = array();
$visa_arr = $o_v->getVisaNameArr();
$class_arr = array();
$class_arr = $o_v->getVisaClassArr($sets['visa'], $client_id == 0? 'Active' : '');

# set smarty tpl
$o_tpl = new Template;
if (isset($_REQUEST['bt_name']) && (strtoupper($_REQUEST['bt_name']) == "SAVE" || strtoupper($_REQUEST['bt_name']) == "APPROVED")) {
	if ($save) {
		$o_tpl->assign('arr', $client_arr);
	}
	else {
		$o_tpl->assign('arr', $sets);
	}
}
else {
	if (isset($_REQUEST['bt_name'])) {
		$o_tpl->assign('arr', $sets);
	}
	else {
		$o_tpl->assign('arr', $client_arr);
	}
	//
}

$o_tpl->assign('visa_arr', $visa_arr);
$o_tpl->assign('visaclass_arr', $class_arr);

$o_tpl->assign('cid', $client_id);
$o_tpl->assign('catid', $sets['visa']);
$o_tpl->assign('classid', $sets['class']);
$o_tpl->assign('all_types', $client_type_arr);
//$o_tpl->assign('agent_arr', $agent_arr);
$o_tpl->assign('agent_partner', $agent_partner);
$o_tpl->assign('agent_ambassador', $agent_ambassador);
$o_tpl->assign('country_arr', $country_arr);
//$o_tpl->assign('user_arr', $user_arr);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('client_type', $client_type);
$o_tpl->assign('isDependant', $is_dependant);
$o_tpl->assign('clientfroms', $o_c->getClientFrom());
$o_tpl->assign('aboutinput', in_array($client_arr['about'], $o_c->getClientFrom())? 1:0);
$o_tpl->assign("ugs", $ugs);
if($ugs['b_nocp']['v'] == 1) {
    $o_tpl->assign('forbid_sl', FORBID_SELECT);
    $o_tpl->assign('forbid_rc', FORBID_RIGHTCLK);
    $o_tpl->assign('forbid_cp', FORBID_COPY);
}

$o_tpl->assign('cryption_link', $o_c->getCryptionLink($client_id));
$o_tpl->display('client_detail.tpl');
?>
