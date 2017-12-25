<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'CalendarAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}


# get date and uid
$date    = isset($_REQUEST['t_date'])? trim($_REQUEST['t_date']) : date("Y-m-d", mktime());
$uid     = isset($_REQUEST['t_user'])? trim($_REQUEST['t_user']) : 0;
$hour    = isset($_REQUEST['t_hour'])? trim($_REQUEST['t_hour']) : 0;
$cal_id  = isset($_REQUEST['id'])? trim($_REQUEST['id']) : 0;

$min_hour = 9;
$max_hour = 18;

$o_c = new CalendarAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get user calendar
$calendar_arr = $o_c->getUserCalendar($date, $uid);
$is_date = 0;
if (count($calendar_arr) > 0){
	$is_date = 1;
}


$show_arr = array();
$minute = 30;
for($i=0; $i<=($max_hour - $min_hour) * 2; $i++){
	$ht = date("H:i", mktime($min_hour, $minute, 0,0,0,0));
	$show_arr[$ht]['id']    = "";
	$show_arr[$ht]['title'] = "";
	$show_arr[$ht]['desc']  = "";
	$show_arr[$ht]['due']   = "";
	$show_arr[$ht]['done']  = "";
	$show_arr[$ht]['over']  = 0;
	$minute += 30;   
}

foreach($calendar_arr as $id => $v){
	if(array_key_exists($v['hour'], $show_arr)){
		$show_arr[$v['hour']]['id']    = $id ;
		$show_arr[$v['hour']]['title'] = $v['title'];
		$show_arr[$v['hour']]['desc']  = $v['desc'];
		$show_arr[$v['hour']]['due']   = $v['due'];
		$show_arr[$v['hour']]['done']  = $v['done'];
		if ($v['due'] >= 60){
			$tmp_arr = explode(":", $v['hour']);
			$mode = round($v['due'] / 30) - 1;
			for ($i=1;$i <= $mode; $i++){
				$ht = date("H:i", mktime($tmp_arr[0], $tmp_arr[1]+ ($i*30), 0,0,0,0));
				if (array_key_exists($ht, $show_arr)){
					$show_arr[$ht]['over']  = 1;
					$show_arr[$ht]['done']  = $v['done'];
				}
			}
		}		
	}		
}



# get user array
$o_u = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$user_arr = array();
$user_arr = $o_u->getUserNameArr();

# get action
$action_arr = array(__ACT_EDIT => "Edit", __ACT_DEL => "Cancel", __ACT_DONE => "Done");
$action2_arr = array(__ACT_NEW => "Add New");


# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('act2_arr', $action2_arr);
$o_tpl->assign('calendar_arr', $show_arr);
$o_tpl->assign('user_arr', $user_arr);
$o_tpl->assign('user', $uid);
$o_tpl->assign('username', $o_u->getUserName($user_id));

$o_tpl->assign('t_date', $date);
$o_tpl->assign('content', $is_date);
$o_tpl->display('calendar.tpl');
?>
