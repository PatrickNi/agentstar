<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
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
$sem_id     = isset($_REQUEST['semid'])? trim($_REQUEST['semid']) : 0;
$process_id = isset($_REQUEST['pid'])? trim($_REQUEST['pid']) : 0;
$isNew      = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	if($ugs['c_rev']['m'] == 0){
		echo "<script language='javascript'>alert('permission denied');</script>";
		exit;
	}   

	$sets['date']    = isset($_REQUEST['t_date'])? (string)trim($_REQUEST['t_date']) : "0000-00-00";
	$sets['date']    = $sets['date'] == ""? "0000-00-00" : $sets['date'];
	
	$sets['due']     = isset($_REQUEST['t_due'])? (string)trim($_REQUEST['t_due']) : "0000-00-00";
	$sets['due']    = $sets['due'] == ""? "0000-00-00" : $sets['due'];
	
	$sets['detail']  = isset($_REQUEST['t_detail'])? (string)trim($_REQUEST['t_detail']) : "";
	
	$sets['subject'] = isset($_REQUEST['t_subject'])? (string)trim($_REQUEST['t_subject']) : "";
	$sets['done']    = isset($_REQUEST['t_done'])? trim($_REQUEST['t_done']) : 0;

	
	if($isNew == 1){				
		$sets['order'] = $o_c->getSemProcessOrder($process_id, $sem_id);
		$o_c->resetSemProcessOrder($sem_id, $sets['order']);
		$sets['order'] = $sets['order'] + 1; 

		$o_c->addSemProcess($sem_id, $sets);

	}else{
		$o_c->setSemProcess($process_id, $sets);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;

}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if($process_id > 0){
		$o_c->delSemProcess($process_id);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}


# format array
$show_arr = $o_c->getSemProcess($sem_id);

# set smarty tpl
$o_tpl = new Template;
if($isNew == 0 && $process_id > 0 && array_key_exists($process_id, $show_arr)){
	$o_tpl->assign('dt_arr', $show_arr[$process_id]);
}

$o_tpl->assign('semid', $sem_id);
$o_tpl->assign('pid', $process_id);
$o_tpl->assign('isNew', $isNew);
$o_tpl->assign('isapprove', $o_c->getCourseConsultBySem($sem_id) == $user_id || (isset($ugs['c_track']['v']) && $ugs['c_track']['v'] == 1)? 1 :  0);
$o_tpl->display('client_course_sem_process.tpl');
?>
