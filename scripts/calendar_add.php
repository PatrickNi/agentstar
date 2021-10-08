<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'CalendarAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'TodoAPI.class.php');

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
    echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

# get date and uid
$cal_id  = isset($_REQUEST['id'])? trim($_REQUEST['id']) : 0;

$sets = array();
$sets['date'] = isset($_REQUEST['t_date'])? (string)trim($_REQUEST['t_date']) : "";
$sets['user'] = isset($_REQUEST['t_user'])? (string)trim($_REQUEST['t_user']) : 0;
$sets['desc'] = isset($_POST['t_desc'])? (string)trim($_POST['t_desc']) : "";
$sets['hour'] = isset($_REQUEST['t_hour'])? (string)trim($_REQUEST['t_hour']) : "";
$sets['title']= isset($_POST['t_title'])? (string)trim($_POST['t_title']) : "";
$sets['due']  = isset($_POST['t_due'])? (string)trim($_POST['t_due']) : "";
$sets['done'] = isset($_POST['t_done'])? (int)trim($_POST['t_done']) : 0;

$o_c = new CalendarAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$todo = new TodoAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){  
	#check empty title
	if ($sets['title'] == ""){
    	echo "<script language='javascript'>alert('Empty Title');</script>";
	}else{
		
		#check due date
		$hours  = explode(":", $sets['hour']);
        $nextht =  date("H:i", mktime($hours[0], $hours[1] + $sets['due'], 0,0,0,0));
		if($o_c->checkDueTime($sets['user'], $sets['date'], $nextht, $sets['hour'], $sets['due'], $cal_id)){
	    	echo "<script language='javascript'>alert('Error Due Time');</script>";		
		}
		else{
			  
			$date  = isset($_POST['hdate']) && $_POST['hdate'] != ""? trim($_POST['hdate']) : $sets['date'];
			$user  = isset($_POST['huser'])&& $_POST['huser'] != ""? trim($_POST['huser']) : $sets['user'];	
		    if($cal_id > 0){
		        $o_c->setCalendar($cal_id, $sets);
		    }
			else{
		        $cal_id = $o_c->addCalendar($sets, $_userid);
		    }

			$data[0] = array('user_id'=>$_userid, 
							'source'=>'appointment', 
							'source_id'=>$cal_id, 
							'begin_date'=>$sets['date'], 
							'due_date'=>$sets['date'], 
							'remind_time' => $sets['date'].' '.$sets['hour'].':00',
							'raw_data'=>array('title'=>$sets['title'], 
												'desc'=>$sets['desc'], 
												'due'=>$sets['due']
						 				 )
		  				);
		  	$todo->upload($data,true);
	   		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
			exit;
		}
	}

}elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
    $o_c->cancelCalendar($cal_id);
	$todo->delBySource('appointment', $cal_id);
    echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}



# get user array
$o_u = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$user_arr = array();
$user_arr = $o_u->getUserNameArr();



# build duration time
$due_arr = array();
$due_arr = array('30' => "0.5hr" , '60' => "1hr", '90' => "1.5hrs", '120' => "2hrs", '150' => "2.5hrs", '180' => "3hrs", '210' => "3.5hrs", '240' => "4hrs", '480' => "1day");

# get hour array
$hour_arr = array();
$min_hour = 9;
$max_hour = 18;
$minute   = 30;
for($i=0; $i<=($max_hour - $min_hour) * 2; $i++){
	$ht = date("H:i", mktime($min_hour, $minute, 0,0,0,0));
	$hour_arr[$ht] = $ht;
	$minute += 30;   
}

$username = "";
$date = "";
$user = "";
$is_edit  = 0;
if($cal_id > 0){
    $sets = array();
    $sets = $o_c->getOneUserCalendar($cal_id);
    $date = $sets['date'];
    $user = $sets['user'];
    $is_edit  = 1;
}

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('dt_arr', $sets);
$o_tpl->assign('hour_arr', $hour_arr);
$o_tpl->assign('user_arr', $user_arr);
$o_tpl->assign('due_arr', $due_arr);

$o_tpl->assign('calid', $cal_id);
$o_tpl->assign('hdate', $date);
$o_tpl->assign('huser', $user);
$o_tpl->assign('is_edit', $is_edit);
$o_tpl->assign('username', $o_u->getUserName(isset($sets['from'])&&$sets['from']>0?$sets['from']:$_userid));
$o_tpl->display('calendar_add.tpl');

?>
