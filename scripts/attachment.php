<?php
ini_set("display_errors", 1);
error_reporting(2047);
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

$filetmp  = isset($_FILES['uploadFile'])? $_FILES['uploadFile']['tmp_name'] : "";
$filesize = isset($_FILES['uploadFile'])? $_FILES['uploadFile']['size'] : 0;
$itemid   = isset($_REQUEST['item'])?  $_REQUEST['item'] : 0;
$itemtype = isset($_REQUEST['type'])?  $_REQUEST['type'] : 0;
$msg = "";
$pass = 1;


$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

// get user dictionary
$user_dir = "";
$dl_path = __DOWNLOAD_PATH;
if ($itemtype != "") {
	$user_dir = str_replace(' ', '_', $itemtype);
	$dl_path = __DOWNLOAD_PATH . $user_dir ."/";
	if (!is_dir($dl_path)) {
		mkdir($dl_path) or die("Cannot create user dir!");
	}	
	
	if ($itemid != "") {
		$user_dir .= "/".str_replace(' ', '_', $itemid);
		$dl_path = __DOWNLOAD_PATH . $user_dir ."/";
		if (!is_dir($dl_path)) {
			mkdir($dl_path) or die("Cannot create user dir!");
		}	
	}
}


if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "UPLOAD"){
	if($filetmp == ""){
		$msg = "Upload File failed!";
		$pass = 0;
	}
	
	if($filesize == 0){
		$msg = "Error file size";
		$pass = 0;
	}
	
	if (file_exists($dl_path . $_FILES['uploadFile']['name'])) {
		$msg = "File {$_FILES['uploadFile']['name']} has existed !";
		$pass = 0;		
	}
	if($pass == 1 && $itemid > 0 && $itemtype != ""){
		if(copy($filetmp, $dl_path . $_FILES['uploadFile']['name'])){
			$o_g->addAttachment($itemid, $itemtype, $user_dir ."/". $_FILES['uploadFile']['name'], $user_id);			
		}else{
			$msg = "copy failed";
		}
	}	
}elseif (isset($_POST['Change']) && strtoupper($_POST['Change']) == "CHANGE"){
	$fid = isset($_POST['id'])? $_POST['id'] : 0;
	$new_name = isset($_POST['new_'.$fid])? $_POST['new_'.$fid] : "";
	if ($fid > 0 && $new_name != "") {
		# get source name
		$old_name = $o_g->getAttachmentFileName($fid);
		preg_match('/.*(\.[^.]+)$/', $old_name, $match);
		$expa = isset($match[1])? $match[1] : "";
		if (file_exists($dl_path . $new_name . $expa)) {
			$msg = "File ".$new_name.$expa." has existed !";
			$pass = 0;			
		}

		if ($pass == 1) {
			rename(__DOWNLOAD_PATH.$old_name, $dl_path.$new_name.$expa);	
			$o_g->changeAttachment($fid, $user_dir ."/". $new_name.$expa);	
		}	
	}
}elseif (isset($_POST['Delete']) && strtoupper($_POST['Delete']) == "DELETE"){
	$fid = isset($_POST['id'])? $_POST['id'] : 0;
	if ($fid > 0) {
		# get source name
		$old_name = $o_g->getAttachmentFileName($fid);
		if (file_exists(__DOWNLOAD_PATH.$old_name)) {
			$o_g->delAttachment	($fid);
			unlink(__DOWNLOAD_PATH.$old_name);	
		}		
	}
}

$files = $o_g->getAttachment($itemid, $itemtype);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('files', $files);
$o_tpl->assign('itemid', $itemid);
$o_tpl->assign('itemtype', $itemtype);
$o_tpl->assign('msg', $msg);
$o_tpl->display('attachment.tpl'); 



?>
