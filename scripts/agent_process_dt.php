<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');



# get course id
$agent_id = isset($_REQUEST['aid'])? trim($_REQUEST['aid']) : 0;
$process_id = isset($_REQUEST['pid'])? trim($_REQUEST['pid']) : 0;
$isNew      = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;

$o_s = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$sets['date'] = isset($_POST['t_date'])? trim($_POST['t_date']) : "0000-00-00";
	$sets['date'] = $sets['date'] != ""? $sets['date'] : "0000-00-00";
	
	$sets['detail']  = isset($_POST['t_detail'])? trim($_POST['t_detail']) : "";
	$sets['subject'] = isset($_POST['t_subject'])? trim($_POST['t_subject']) : "";
	$sets['due']     = isset($_POST['t_due'])? trim($_POST['t_due']) : "0000-00-00";
	$sets['due']     = $sets['due'] != ""? $sets['due'] : "0000-00-00";
	
	$sets['done']    = isset($_POST['done'])? trim($_POST['done']) : 0;
	
	if($sets['subject'] == ""){
		echo "<script language='javascript'>alert('Error Empty Subject');</script>";	
	}else{
		if($isNew == 1){
			$sets['order'] = $o_s->getProcessOrder($process_id, $agent_id);
			$o_s->resetProcessOrder($agent_id, $sets['order']);
			$sets['order'] = $sets['order'] + 1; 
	
			$o_s->addProcess($agent_id, $sets);
		}else{
			$o_s->setProcess($process_id, $sets);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		exit;		
	}
}elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	$o_s->delProcess($process_id);	
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;
}



# format array
$process_arr = $o_s->getProcess($agent_id);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('process_arr', $process_arr);

if($isNew == 0 && $process_id > 0 && array_key_exists($process_id, $process_arr)){
	$o_tpl->assign('dt_arr', $process_arr[$process_id]);
}

$o_tpl->assign('aid', $agent_id);
$o_tpl->assign('pid', $process_id);
$o_tpl->assign('isNew', $isNew);
$o_tpl->display('agent_proc_dt.tpl');
?>

