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
$sets['itemid'] = isset($_REQUEST['itemid'])? trim($_REQUEST['itemid']) : 0;
$sets['startdate']  = isset($_REQUEST['startdate'])? trim($_REQUEST['startdate']) : "0000-00-00";
$sets['enddate']   = isset($_REQUEST['enddate'])? (string)trim($_REQUEST['enddate']) : "0000-00-00";
$sets['starttime']   = isset($_REQUEST['starttime'])? (string)trim($_REQUEST['starttime']) : "00:00";
$sets['duehour']   = isset($_REQUEST['duehour'])? (string)trim($_REQUEST['duehour']) : 0;

$sets['freqw_l'] = isset($_REQUEST['freqw'])? $_REQUEST['freqw'] : array();
$sets['freqw']   = implode(',', $sets['freqw_l']);

$sets['fee']  = isset($_REQUEST['fee'])? trim($_REQUEST['fee']) : 0;
$sets['staff']  = isset($_REQUEST['staff'])? trim($_REQUEST['staff']) : 0;
$sets['sales']  = isset($_REQUEST['sales'])? trim($_REQUEST['sales']) : 0;
$sets['note']    = isset($_REQUEST['t_note'])? iconv('utf-8', 'GBK', (string)trim($_REQUEST['t_note'])) : "";


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

if (isset($_POST['bt_name']) && stripos($_POST['bt_name'], "SAVE") !== false){
    
    //check primary information
    try {
        if ($sets['staff'] == '0') {
            throw new Exception ("Staff id be empty");
        }

        if ($sets['itemid'] == '0') {
            throw new Exception ("Course cannot be empty");
        }

        if ($sets['startdate'] == '0000-00-00' || $sets['enddate'] == '0000-00-00') {
            throw new Exception ("Start Date or End Date cannot be empty");
        }

        if ($sets['duehour'] == '0' || count($sets['freqw_l']) == 0) {
            throw new Exception ("Due Hour or Weeks cannot be empty");
        }

        if ($sets['starttime'] == '00:00') {
            throw new Exception ("Start time cannot be empty");
        }
    }
    catch (Exception $e){
        echo json_encode(array('msg'=>$e->getMessage(), 'id'=>0));
        exit;
    }

    if($coach_id > 0){   
        if($msg == ''){
            $o_h->setCoach($user_id,$coach_id, $sets);
        }       

    }else{
        $coach_id =  $o_h->addCoach($user_id, $client_id, $sets);
    }
    

    #set client user related
    if($sets['staff'] > 0){
        $o_c->addClientUserRs($client_id, $sets['staff'], 'COACH');
    }
        
    echo json_encode(array('msg'=>$msg == ""? "Save OK" : $msg, 'id'=>$coach_id));
    exit;
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

if($coach_id > 0){
    $visa_arr = $o_h->getCoach($client_id, $coach_id);
    $sets = $visa_arr[$coach_id];
}


$min_hour = 9;
$max_hour = 19;
$init_hours = array();
$minute = 0;
for($i=0; $i<=($max_hour - $min_hour) * 2; $i++){
    array_push($init_hours, date("H:i", mktime($min_hour, $minute, 0,0,0,0)));
    $minute += 30;   
}

$o_tpl->assign('init_hour', $init_hours);


$o_tpl->assign("init_courses", "var items=".json_encode($o_h->getAssocItems()));
$o_tpl->assign("items_arr", $o_h->getItems());

$o_tpl->assign('dt_arr', $sets);

$o_tpl->assign('user_arr', $o_g->getUserNameArr());


//show balance
if ($coach_id > 0){
    $o_tpl->assign('account_arr', $o_c->getAccount($coach_id,0,'coach'));
}


$o_tpl->assign('cid', $client_id);
$o_tpl->assign('uid', $user_id);
$o_tpl->assign('coachid', $coach_id);
$o_tpl->assign('client', $o_c->getOneClientInfo($client_id));
$o_tpl->assign('msg', $msg);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('due_arr', array('30' => "0.5hr", '60' => "1hr", '90' => "1.5hrs", '120' => "2hrs", '150' => "2.5hrs", '180' => "3hrs", '210' => "3.5hrs", '240' => "4hrs", '480' => "1day"));


$o_tpl->display('client_coach_detail.tpl'); 

?>
