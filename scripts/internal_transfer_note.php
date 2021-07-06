<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'FinanceAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

ini_set("display_errors", 1);
error_reporting(2047);

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

# get course id
$sem_id   = isset($_REQUEST['semid'])? trim($_REQUEST['semid']) : 0;
$course_id = isset($_REQUEST['courseid'])? trim($_REQUEST['courseid']) : 0;
$transfer_id = isset($_REQUEST['tid'])? trim($_REQUEST['tid']) : 0;



$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_f = new FinanceAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 


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
    $sets['cr'] = isset($_REQUEST['t_cr']) && $_REQUEST['t_cr'] > 0? $_REQUEST['t_cr'] : 0;
    $sets['commgst'] = isset($_REQUEST['t_commgst']) && $_REQUEST['t_commgst'] > 0? $_REQUEST['t_commgst'] : 0;
    $sets['bonus'] = isset($_REQUEST['t_bonus']) && $_REQUEST['t_bonus'] > 0? $_REQUEST['t_bonus'] : 0;
    $sets['comm2biz'] = isset($_REQUEST['t_comm2biz']) && $_REQUEST['t_comm2biz'] > 0? $_REQUEST['t_comm2biz'] : 0;
    $sets['recipt'] = isset($_REQUEST['t_recpit']) && $_REQUEST['t_recpit'] > 0? $_REQUEST['t_recpit'] : '';

    if($o_f->updateTransferNotes($transfer_id,$sets['cr'],$sets['commgst'],$sets['comm2biz'],$sets['recipt'],$sets['bonus'])){
        echo "<script language='javascript'>alert('update succ'); if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
    }
    else {
        echo "<script language='javascript'>alert('update failed'); if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
    }
    
    exit; 
}
elseif (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "ADDNEW"){
    $rtn = $o_f->addTransferNotes($sem_id, $course_id);
    if ($rtn['succ']) {
        echo "<script language='javascript'>alert('Generate success!');if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
    }
    else {
        echo "<script language='javascript'>alert('".($rtn['msg']? $rtn['msg'] : 'Generate Failed!!!')."');if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
    }
    exit;   
}

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
    $view_all = $user_id;
}




# set smarty tpl
$o_tpl = new Template;


$o_tpl->assign('dt_arr', $o_f->getTransferNotes($transfer_id));

# get cource
$course_arr = array();
$cateid = $o_c->getCateIDbyCourse($course_id);
$course_arr = $o_c->getCourseByUser($course_id);
$o_tpl->assign('qual_name', @$course_arr[$cateid][$course_id]['qualname']);
$o_tpl->assign('major_name', @$course_arr[$cateid][$course_id]['majorname']);
$o_tpl->assign('school_name', @$course_arr[$cateid][$course_id]['school']);
$o_tpl->assign('client', $o_c->getOneClientInfo(@$course_arr[$cateid][$course_id]['cid']));

#get sem
$sem_arr = array();
$sem_arr = $o_c->getCourseSem($course_id);
$o_tpl->assign('sem_arr', $sem_arr[$sem_id]);

$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('semid', $sem_id);
$o_tpl->assign('courseid', $course_id);
$o_tpl->assign('tid', $transfer_id);

$o_tpl->display('internal_transfer_note.tpl'); 

?>
