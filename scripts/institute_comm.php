<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

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

# get course id
$school_id  = isset($_REQUEST['sid'])? trim($_REQUEST['sid']) : 0;
$comm_id    = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$isNew = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : "none";

$o_f = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$error = "";
# get action
$action = isset($_POST["at_{$comm_id}"])? trim($_POST["at_{$comm_id}"]) : "";
switch (strtoupper($action)){
	case __ACT_DEL:
		if($ugs['i_comm']['d'] == 1){
			$o_f->delComm($comm_id);	
		}else{
			$error = "alert('Permission Denied!')";
		}
		break;
	case __ACT_EDIT:
		$isNew = "block";	
		break;		
	default:
		break;					
}


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$course = isset($_POST['t_course'])? trim($_POST['t_course']) : "";
	$rate   = isset($_POST['t_rate'])? trim($_POST['t_rate']) : 0;
	$agent  = isset($_POST['t_agent'])? trim($_POST['t_agent']) : 0;
	$boun   = isset($_POST['t_boun'])? trim($_POST['t_boun']) : 0;
	
	if($course == "" || $rate == "" || $boun == ""){
		$error = "alert('Error empty data submitted!');";
			
	}else{
		if($comm_id > 0){
			if($ugs['i_comm']['m'] == 1){
				$o_f->setComm($comm_id, $course, $rate, $agent, $boun);
			}else{
				$error = "alert('Permission Denied!')";
			}
		}else{
			if($ugs['i_comm']['i'] == 1){
				$o_f->addComm($school_id, $course, $rate, $agent, $boun);
			}else{
				$error = "alert('Permission Denied!')";
			}
		}
		$comm_id = 0;
		$isNew = "none";	
	}
}


# get action
$action_arr = array(__ACT_EDIT => "Edit", __ACT_DEL => "Delete");

# format array
$comm_arr = $o_f->getComm($school_id);

$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$agent_arr = $o_a->getAgent('top');

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('comm_arr', $comm_arr);
$o_tpl->assign('agent_arr', $agent_arr);


if($comm_id > 0 && array_key_exists($comm_id, $comm_arr)){
	$o_tpl->assign('dt_arr', $comm_arr[$comm_id]);
}

$o_tpl->assign('iname', $o_f->getNameByIID($school_id));
$o_tpl->assign('sid', $school_id);
$o_tpl->assign('cid', $comm_id);
$o_tpl->assign('isNew', $isNew);
$o_tpl->assign('error_js', $error);
$o_tpl->assign('ugs', $ugs);
$o_tpl->display('institute_comm.tpl');
?>

