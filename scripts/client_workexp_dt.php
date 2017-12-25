<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');


$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

# get client id 
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$work_id   = isset($_REQUEST['wid'])? trim($_REQUEST['wid']) : 0;
$isNew     = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;



# get work experience
$set_arr = array();

$set_arr['fdate']  = isset($_REQUEST['t_fdate'])? (string)trim($_REQUEST['t_fdate']) : "0000-00-00";
$set_arr['fdate']  = $set_arr['fdate'] == ""? "0000-00-00" : $set_arr['fdate'] ; 

$set_arr['tdate']  = isset($_REQUEST['t_tdate'])? (string)trim($_REQUEST['t_tdate']) : "0000-00-00";
$set_arr['tdate']  = $set_arr['tdate'] == ""? "0000-00-00" : $set_arr['tdate'];

$set_arr['com']    = isset($_REQUEST['t_com'])? (string)trim($_REQUEST['t_com']) : "";
$set_arr['country'] = isset($_REQUEST['t_country'])? (string)trim($_REQUEST['t_country']) : "";

$set_arr['pos']    = isset($_REQUEST['t_pos'])? (string)trim($_REQUEST['t_pos']) : "";
$set_arr['fulltime']= isset($_REQUEST['t_fulltime'])? trim($_REQUEST['t_fulltime']) : 0;

$set_arr['note']   = isset($_REQUEST['t_note'])? (string)trim($_REQUEST['t_note']) : "";
$set_arr['note']   = $set_arr['note'] != ""? $set_arr['note'] : " ";


if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE") {
	if($set_arr['com'] == ""){
		echo "<script language='javascript'>alert('Error empty company');</script>";	
	}else{
		if($isNew == 1 || $work_id == 0){
			$set_arr['order'] = $o_c->getWorkExpOrder($work_id, $client_id);
			$o_c->resetWorkExpOrder($client_id, $set_arr['order']);
			$set_arr['order'] = $set_arr['order'] + 1; 
			$o_c->addWorkExp($client_id, $set_arr);
		}else{
			$o_c->setWorkExp($work_id, $set_arr);
		}
		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;		
	}	
}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	$o_c->delWorkExp($work_id); 
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}


# get work experience
$work_arr = array();
$work_arr = $o_c->getWorkExpByClient($client_id);

# set smarty tpl
$o_tpl = new Template;
if($isNew == 0 && $work_id > 0 && array_key_exists($work_id, $work_arr)){
	$o_tpl->assign('dt_arr', $work_arr[$work_id]);
}


$o_tpl->assign('country_arr', $o_c->getCountry());
$o_tpl->assign('positions', $o_c->getPosition());
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('wid', $work_id);
$o_tpl->assign('isNew', $isNew);
$o_tpl->display('client_workexp_dt.tpl');
?>
