<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'CoachAPI.class.php');

ini_set("display_errors", 1);
error_reporting(2047);

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

# get course id
$coach_id   = isset($_REQUEST['coachid'])? trim($_REQUEST['coachid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$lesson_id = isset($_REQUEST['lessonid'])? trim($_REQUEST['lessonid']) : 0;

$sets['startdate']  = isset($_REQUEST['startdate'])? trim($_REQUEST['startdate']) : "0000-00-00";
$sets['fee']  = isset($_REQUEST['fee'])? trim($_REQUEST['fee']) : 0;
$sets['staff']  = isset($_REQUEST['staff'])? trim($_REQUEST['staff']) : 0;
$sets['status']  = isset($_REQUEST['t_status'])? trim($_REQUEST['t_status']) : 'Active';
$sets['starttime']  = isset($_REQUEST['starttime'])? trim($_REQUEST['starttime']) : '0:00';

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 
$o_h = new CoachAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1); 


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


$coach_arr = $o_h->getCoach($client_id, $coach_id);
$lesson_arr = $o_h->getLessons($client_id, $coach_id, $lesson_id);

if (isset($_POST['bt_name']) && stripos($_POST['bt_name'], "SAVE") !== false){
    
    //check primary information
    try {
        if ($sets['staff'] == '0') {
            throw new Exception ("Staff id be empty");
        }

        if ($sets['startdate'] == '0000-00-00' || $sets['startdate'] == '0000-00-00') {
            throw new Exception ("Start Date or End Date cannot be empty");
        }
    }
    catch (Exception $e){
        echo "<script language='javascript'>alert('".$e->getMessage()."');</script>"; 
        exit;
    }

    if($coach_id > 0 && $lesson_id > 0){   
        $sets['adjust'] = 0;
        if ($lesson_arr[$coach_id][$lesson_id]['staff'] != $sets['staff']) {
            $sets['adjust'] = 1;
        }

        if ($lesson_arr[$coach_id][$lesson_id]['fee'] != $sets['fee']) {
            $sets['adjust'] = 1;
        }

        if ($lesson_arr[$coach_id][$lesson_id]['startdate'] != $sets['startdate']) {
            $sets['adjust'] = 1;
        }

        $o_h->setLesson($lesson_id, $sets);
        echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
        exit; 
    }
}
elseif (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
    $o_h->delCoach($coach_id);
    echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
    exit;   
}

# get user position
$view_all = 0;
if ($ugs['seeall']['v'] == 0){
    $view_all = $user_id;
}




# set smarty tpl
$o_tpl = new Template;
$lesson_arr = $o_h->getLessons($client_id, $coach_id, $lesson_id);

$o_tpl->assign("items_arr", $o_h->getItems());
$o_tpl->assign('dt_arr', $lesson_arr[$coach_id][$lesson_id]);
$o_tpl->assign('student_in_lesson', $o_h->countStudentInLesson($lesson_arr[$coach_id][$lesson_id]));
$o_tpl->assign('coach', $coach_arr[$coach_id]);
$o_tpl->assign('user_arr', $o_g->getUserNameArr());

$min_hour = 9;
$max_hour = 19;
$init_hours = array();
$minute = 0;
for($i=0; $i<=($max_hour - $min_hour) * 2; $i++){
    array_push($init_hours, date("H:i", mktime($min_hour, $minute, 0,0,0,0)));
    $minute += 30;   
}

$o_tpl->assign('init_hour', $init_hours);

$o_tpl->assign('cid', $client_id);
$o_tpl->assign('lessonid', $lesson_id);
$o_tpl->assign('coachid', $coach_id);
$o_tpl->assign('client', $o_c->getOneClientInfo($client_id));
$o_tpl->assign('ugs', $ugs);

$o_tpl->display('client_lesson_detail.tpl'); 

?>
