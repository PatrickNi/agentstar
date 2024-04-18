<?php
require_once('../etc/const.php');
require_once(__SMARTY_LIB_PATH.'Smarty.class.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'MysqlDB.class.php');


setcookie("userid", 0, time()+60*60*24,"/");
$user_name	= isset($_POST['tUser'])? trim($_POST['tUser']) : 0;
$user_pswd	= isset($_POST['tPswd'])? trim($_POST['tPswd']) : 0; 
$login_tag	= isset($_POST['login'])? trim($_POST['login']) : 0;	
$redirect_uri = isset($_REQUEST['redirect'])? trim($_REQUEST['redirect']) : '';	
$user_id	= 0;
$remote     = 0;
$error_msg	= "";

ini_set('display_errors', true);
error_reporting(E_ALL);
if (strtoupper($login_tag) == "ON" && $user_name != "" && $user_pswd != ""){

	$oDB = new MysqlDB(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

	$user_name = addslashes($user_name);
	$user_pswd = addslashes($user_pswd);
	
	$sql = "select ID, REMOTEACCESS from sys_user where UserName = '{$user_name}' and UserPassword = '{$user_pswd}' ";
	$oDB->query($sql);
	if ($oDB->fetch()){
		$user_id = $oDB->ID;
		$remote  = $oDB->REMOTEACCESS;			
	}

	if ($user_id > 0 && ($remote || (!$remote && (stripos($_SERVER['REMOTE_ADDR'], '192.168') ===0 || $_SERVER['REMOTE_ADDR'] == '110.143.32.230')))){
		setcookie("userid", $user_id, time()+60*60*24,"/");
		//var_dump($redirect_uri);exit;
	        header("Location: ".($redirect_uri? $redirect_uri : ' index.php'));
		//header("Location: index.php");
	}
	else {
		$error_msg = "Invalid user name, password or remote access denied!";
	}
}


# set smarty tpl
$oTpl = new Template;
$oTpl->assign('error_msg', $error_msg);
$oTpl->display('login.tpl');

# output javascript
echo '<script language="javascript">
	function GOTO(){
		if(form1.username.value==""){
			alert("Please enter your valid username.");
			form1.username.focus();
			return false;
		}
		if(form1.password.value==""){
			alert("Please enter your valid password.");
			form1.password.focus();
			return false;
		}
		//form1.submit();
		return true;
	}
</script>';



?>
