<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');

# get course id
$status = isset($_REQUEST['t_status'])? trim($_REQUEST['t_status']) : "";
$stid   = isset($_REQUEST['t_stid'])? trim($_REQUEST['t_stid']) : "";
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_c = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$group_arr = array();

switch($button){
	case "SAVE":
		$o_c->addAgentStatus($status);
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if ($stid > 0){
			$o_c->delAgentStatus($stid);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	default:
		break;
}

$status_arr = array();
$status_arr = $o_c->getAgentStatus();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return form_audit('form1')">
<input type="hidden" name="hCancel" value="0">
			<table border="0" width="100%" cellpadding="3">
				<tr class="greybg">
					<td colspan="3"align="center" class="whitetext">
							Agent Status&nbsp;
					</td>
				</tr>	
				<tr>	  
				  <td align="left" width="83%">
					   <select name="t_stid" >
					   <?php
					   	 foreach($status_arr as $id => $status){
					   	 	echo "<option value={$id}>{$status}</option>";
					   	 }
					   ?>
				      </select>
				  </td>    
				  <td width="17%" align="left">
						<input type="submit" value="Delete" name="bt_name" style="font-weight:bold" onClick="this.form.hCancel.value=1">				  
				  </td>
				</tr>
				<tr>
					<td align="left" width="83%"><input type="text" name="t_status" size="30" value=""></td>
					<td width="17%" align="left"><input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>																		
				<tr align="center"  class="greybg" >
				  <td colspan="2">&nbsp;</td>
				</tr>									
			</table>	
</form>			
</body>
</html>