<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

# get client id 
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$qual_id   = isset($_REQUEST['qid'])? trim($_REQUEST['qid']) : 0;
$isNew     = isset($_REQUEST['isNew'])? trim($_REQUEST['isNew']) : 0;
$isChange  = isset($_REQUEST['isChange'])? trim($_REQUEST['isChange']) : 0;


if (isset($_REQUEST['get']) && $_REQUEST['get'] == 1) {	
	//$o_c->query('set names gb2312');
	echo serialize($o_c->getQualificationByClient($client_id));
	exit;
}
elseif (isset($_REQUEST['del']) && $_REQUEST['del'] == 1) {	
	echo serialize($o_c->delQual($qual_id));
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
	}else{
		if($isNew == 1){
			$sets['order'] = $o_c->getQualOrder($qual_id, $client_id);
			$o_c->resetQualOrder($client_id, $sets['order']);
			$sets['order'] = $sets['order'] + 1; 
			$o_c->addQualification($client_id, $sets);
			$msg = $o_c->getLastInsertID();			
		}
		else{
			$o_c->setQualification($qual_id, $sets);
			$msg = "Success";					
		}
	}
echo serialize($msg);
exit;
?>
