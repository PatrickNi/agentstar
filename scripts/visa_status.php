<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'Template.class.php');
ini_set("display_errors", 1);
error_reporting(2047);

# get course id
$name = isset($_REQUEST['status'])? trim($_REQUEST['status']) : "";
$id   = isset($_REQUEST['statusid'])? trim($_REQUEST['statusid']) : 0;
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$status_arr = array();
$status_arr = $o_v->getVisaStatus();
switch($button){
	case "SAVE":
		if ($id > 0) {
			$o_v->setVisaStatus($id, $name);
		}else{
			$o_v->addVisaStatus($name);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if ($id > 0){
			$o_v->delVisaStatus($id);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "EDIT";
		break;	
	default:
		# set smarty tpl
		$o_tpl = new Template;
		$o_tpl->assign("status", $status_arr);
		$o_tpl->display('visa_status.tpl');
		exit;
		break;
}
$edit_name = array_key_exists($id, $status_arr)? $status_arr[$id] : "";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="spid" value="<?php echo $id;?>">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr class="bordered_2">
		<td colspan="3"align="center" class="whitetext">
				Setting&nbsp;
		</td>
	</tr>	
	<tr>
		<td align="left" colspan="2"><input type="text" name="spname" size="50" value="<?php echo $edit_name;?>"></td>
	</tr>																		
	<tr align="center"  class="bordered_2">
	  <td colspan="2">
			<input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" value="Delete" name="bt_name" style="font-weight:bold">
		</td>
	</tr>									
</table>	
</form>			
</body>
</html>