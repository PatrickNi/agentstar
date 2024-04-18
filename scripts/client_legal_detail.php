<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'LegalAPI.class.php');

ini_set("display_errors", 1);
error_reporting(2047);

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

# get course id
$visa_id   = isset($_REQUEST['vid'])? trim($_REQUEST['vid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$sets['cateid'] = isset($_REQUEST['t_cate'])? trim($_REQUEST['t_cate']) : 0;
$sets['subid']  = isset($_REQUEST['t_type'])? trim($_REQUEST['t_type']) : 0;
$sets['vdate']   = isset($_REQUEST['t_first'])? (string)trim($_REQUEST['t_first']) : "0000-00-00";
$sets['vdate']   = $sets['vdate'] == ""? "0000-00-00" : $sets['vdate'];
$sets['adate']   = isset($_REQUEST['t_adate'])? (string)trim($_REQUEST['t_adate']) : "0000-00-00";
$sets['adate']   = $sets['adate'] == ""? "0000-00-00" : $sets['adate'];
$sets['status']  = isset($_REQUEST['t_status'])? trim($_REQUEST['t_status']) : "";
$sets['auser']   = isset($_REQUEST['t_auser'])? (string)trim($_REQUEST['t_auser']) : 0;
$sets['vuser']   = isset($_REQUEST['t_vuser'])? (string)trim($_REQUEST['t_vuser']) : 0;
$sets['note']    = isset($_REQUEST['t_note'])? (string)trim($_REQUEST['t_note']) : "";

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 
$o_v = new LegalAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 


//ajax action
if (isset($_REQUEST['act'])) {
    switch ($_REQUEST['act']) {
        case 'subclass':
            echo json_encode($o_v->getSubClass($_REQUEST['cateid']));
            break;
        default:
            
            break;
    }
    exit;
}



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

$msg = "";
if(isset($_REQUEST['bt_name']) && stripos($_REQUEST['bt_name'], "CLOSE") !== false){
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}

if (isset($_POST['bt_name']) && stripos($_POST['bt_name'], "SAVE") !== false){
    
    //check primary information
    try {
        if ($sets['cateid'] == '0') {
            throw new Exception ("Category cannot be empty");
        }

        if ($sets['subid'] == '0') {
            throw new Exception ("Type cannot be empty");
        }

        if ($sets['auser'] == '0') {
            throw new Exception ("Agreement staff cannot be empty");
        }

        if ($sets['vuser'] == '0') {
            throw new Exception ("Paperwork cannot be empty");
        }
    }
    catch (Exception $e){
        echo json_encode(array('msg'=>$e->getMessage(), 'id'=>0));
        exit;
    }

    if($visa_id > 0){	
		if($msg == ''){
			$o_v->setLegal($visa_id, $sets);
		}		

    }else{
        $visa_id =  $o_v->addLegal($user_id, $client_id, $sets);
	}
	
    if ($visa_id > 0)
        $o_v->autoProcess($visa_id, $sets['cateid'], $sets['subid']);
	
	#set client user related
	if($sets['auser'] > 0){
		$o_c->addClientUserRs($client_id, $sets['auser'], 'L');
	}
	
	if ($sets['vuser'] > 0 && $sets['vuser'] != $sets['auser']) {
		$o_c->addClientUserRs($client_id, $sets['vuser'], 'L');
	}

	
    echo json_encode(array('msg'=>$msg == ""? "Save OK" : $msg, 'id'=>$visa_id));
    exit;
}elseif (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	$o_v->delLegal($visa_id);
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
	$view_all = $user_id;
}

# get user
$user_arr = $o_g->getUserNameArr();



# set smarty tpl
$o_tpl = new Template;

if($visa_id > 0){
	$visa_arr = $o_v->getLegal($client_id, $visa_id, $user_id);
    $sets = $visa_arr[$visa_id];
}


$o_tpl->assign('dt_arr', $sets);


$o_tpl->assign('cate_arr', $o_v->getCategory());
$o_tpl->assign('type_arr', $o_v->getSubClass());
$o_tpl->assign('user_arr', $user_arr);


//show balance
if ($visa_id > 0){
	$o_tpl->assign('account_arr', $o_c->getAccount($visa_id,0,'legal'));
}


$o_tpl->assign('cid', $client_id);
$o_tpl->assign('uid', $user_id);
$o_tpl->assign('vid', $visa_id);
$o_tpl->assign('client', $o_c->getOneClientInfo($client_id));
$o_tpl->assign('msg', $msg);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('status', $o_v->getStatus());
$o_tpl->assign('process_arr', $o_v->getProcess(0, $visa_id, $sets['cateid'], $sets['subid']));

$o_tpl->display('client_legal_detail.tpl'); 

?>
