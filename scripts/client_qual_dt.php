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


# get qualification
$sets = array();
$sets['country']= isset($_REQUEST['t_country'])? (string)trim($_REQUEST['t_country']) : 0;
$sets['fdate']  = isset($_REQUEST['t_fdate'])? (string)trim($_REQUEST['t_fdate']) : "0000-00-00";
$sets['fdate']   = $sets['fdate'] != ""? $sets['fdate'] : "0000-00-00";

$sets['tdate']  = isset($_REQUEST['t_tdate'])? (string)trim($_REQUEST['t_tdate']) : "0000-00-00";
$sets['tdate']   = $sets['tdate'] != ""? $sets['tdate'] : "0000-00-00";

$sets['school'] = isset($_REQUEST['t_school'])? (string)trim($_REQUEST['t_school']) : '';	
$sets['qual']   = isset($_REQUEST['t_qual'])? (string)trim($_REQUEST['t_qual']) : '';
$sets['major']  = isset($_REQUEST['t_major'])? (string)trim($_REQUEST['t_major']) : '';

$sets['note']   = isset($_REQUEST['t_note'])? (string)trim($_REQUEST['t_note']) : "";
$sets['status']   = isset($_REQUEST['t_status'])? (string)trim($_REQUEST['t_status']) : "YES";
$sets['fulltime']   = isset($_REQUEST['t_fulltime'])? trim($_REQUEST['t_fulltime']) : 0;

if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE") {
	if($sets['country'] == 0 || $sets['school'] == '' || $sets['fdate'] == "0000-00-00" || $sets['tdate'] == "0000-00-00"){
		echo "<script language='javascript'>alert('Error Choose Date');</script>";	
	}else{
		if($isNew == 1){
			$sets['order'] = $o_c->getQualOrder($qual_id, $client_id);
			$o_c->resetQualOrder($client_id, $sets['order']);
			$sets['order'] = $sets['order'] + 1; 
//			print_r($sets);
//			exit;
			$o_c->addQualification($client_id, $sets);
		}else{
			$o_c->setQualification($qual_id, $sets);
		}
		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;		
	}
}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	$o_c->delQual($qual_id);
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;
}


# get work experience
$qual_arr = array();
$qual_arr = $o_c->getQualificationByClient(0, $qual_id);


# set smarty tpl
$o_tpl = new Template;


if($isChange == 1){
	$o_tpl->assign('dt_arr', $sets);
}elseif($isNew == 0 && $qual_id > 0 && array_key_exists($qual_id, $qual_arr)){
	$o_tpl->assign('dt_arr', $qual_arr[$qual_id]);
}


$o_tpl->assign('qual_arr', $o_c->getQualOfCourse());
$o_tpl->assign('major_arr', $o_c->getMajorOfCourse());
$o_tpl->assign('country_arr', $o_c->getCountry());

if($sets['country'] > 0){
	$o_tpl->assign('school_arr', $o_c->getSchool($sets['country']));
}

$o_tpl->assign('cid', $client_id);
$o_tpl->assign('qid', $qual_id);
$o_tpl->assign('isNew', $isNew);
$o_tpl->assign('isChange', $isChange);
$o_tpl->display('client_qual_dt.tpl');
?>
