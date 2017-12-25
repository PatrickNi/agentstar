<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

# get course id
$group_id  = isset($_REQUEST['gid'])? trim($_REQUEST['gid']) : 0;
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";


$o_c = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$group_arr = array();

switch($button){
	case "SAVE":
		if($group_id > 0){
			$o_c->setContactGroup($group_id, $_POST['t_group'], $_POST['t_tel'], $_POST['t_person']);
		}else{
			$o_c->addContactGroup($_POST['t_group'], $_POST['t_tel'], $_POST['t_person']);
//			$group_id = $o_c->getLastInsertID();			
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if ($group_id > 0){
			$o_c->delContactGroup($group_id);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	default:
		break;
}

if ($group_id > 0){
	$group_arr = $o_c->getContactGroup($group_id);
}
# set smarty tpl
$o_tpl = new Template;
if ($group_id > 0){
	$o_tpl->assign('dt_arr', $group_arr[$group_id]);
}

$o_tpl->assign('gid', $group_id);
$o_tpl->display('contact_group.tpl');


?>
