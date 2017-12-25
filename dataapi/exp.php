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

if (isset($_REQUEST['get']) && $_REQUEST['get'] == 1) {
	echo serialize($o_c->getWorkExpByClient($client_id));
	exit;
}elseif (isset($_REQUEST['del']) && $_REQUEST['del'] == 1) {	
	echo serialize($o_c->delWorkExp($work_id));
	exit;
}


# get work experience
$set_arr = array();

$set_arr['fdate']  = isset($_POST['t_fdate'])? (string)trim($_POST['t_fdate']) : "0000-00-00";
$set_arr['fdate']  = $set_arr['fdate'] == ""? "0000-00-00" : $set_arr['fdate'] ; 

$set_arr['tdate']  = isset($_POST['t_tdate'])? (string)trim($_POST['t_tdate']) : "0000-00-00";
$set_arr['tdate']  = $set_arr['tdate'] == ""? "0000-00-00" : $set_arr['tdate'];

$set_arr['com']    = isset($_POST['t_com'])? (string)trim($_POST['t_com']) : "";
$set_arr['country'] = isset($_POST['t_country'])? (string)trim($_POST['t_country']) : "";

$set_arr['pos']    = isset($_POST['t_pos'])? (string)trim($_POST['t_pos']) : "";

$set_arr['note']   = isset($_POST['t_note'])? (string)trim($_POST['t_note']) : "";
$set_arr['note']   = $set_arr['note'] != ""? $set_arr['note'] : " ";

$set_arr['fulltime']   = isset($_POST['t_fulltime'])? trim($_POST['t_fulltime']) : 0;

	if($set_arr['com'] == ""){
		$msg = 'ERROR:Invalid Company Name';	
	}else{
		if($isNew == 1){
			$set_arr['order'] = $o_c->getWorkExpOrder($work_id, $client_id);
			$o_c->resetWorkExpOrder($client_id, $set_arr['order']);
			$set_arr['order'] = $set_arr['order'] + 1; 
			$o_c->addWorkExp($client_id, $set_arr);
			$msg = $o_c->getLastInsertID();				
		}
		else{
			$o_c->setWorkExp($work_id, $set_arr);
			$msg = "success";			
		}
		
	}	
echo serialize($msg);
exit;
?>
