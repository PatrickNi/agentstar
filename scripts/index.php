<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($user_id > 0)) {
	echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_func = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);


$ugs = array();
array_push($g_user_grants, 'todo_alert');
$user_grants = $o_func->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_func->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}


$taskArr = $o_func->getReceiveTask(0, $user_id);


# get function
$arr_func = array();
$arr_func = $o_func->getFuncByUser($user_id);

# get url func & grop name
$func_name  = "";
$group_name = "";
$func_id  = isset($_GET['f'])? trim($_GET['f']) : 0;
$group_id = isset($_GET['g'])? trim($_GET['g']) : 0;
if ($func_id == 0 || $group_id == 0) {
	$url = "welcome.htm";
}else{
	$url = $o_func->getFuncUrl($group_id, $func_id);
	$func_name  = $o_func->getFuncName($func_id);
	$group_name = $o_func->getGroupName($group_id);
}


# set smarty tpl
$oTpl = new Template;
$oTpl->assign('func_name', $func_name);
$oTpl->assign('group_name', $group_name);
$oTpl->assign('gid', $group_id);
$oTpl->assign('uid', $user_id);
$oTpl->assign('url', $url);
$oTpl->assign('grouArr', $arr_func);
$oTpl->assign('task_num', $o_func->getNumberOfUndoTask($user_id));
$oTpl->assign('user_name', $o_func->getUserName($user_id));
$oTpl->assign('ugs', $ugs);

//var_dump($arr_func);exit;
$oTpl->display('frame_test.tpl');

echo '<script language="javascript">
function openMenu(id)
{
	obj = document.getElementById(id);
	if(obj.style.display == "none")
	{
		obj.style.display = "block";
	}
	else
	{
		obj.style.display = "none";
	}
}
</script>';
?>
