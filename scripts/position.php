<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

# get course id
$pos = isset($_REQUEST['t_pos'])? trim($_REQUEST['t_pos']) : "";
$pid   = isset($_REQUEST['t_pid'])? trim($_REQUEST['t_pid']) : 0;
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

switch($button){
	case "SAVE":
		$o_c->addPosition($pos);
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if ($pid > 0){
			$o_c->delPosition($pid);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	default:
		break;
}

$positions = array();
$positions = $o_c->getPosition();
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
			<table border="0" width="100%" cellpadding="3">
				<tr class="greybg">
					<td colspan="3"align="center" class="whitetext">
							New Position&nbsp;
					</td>
				</tr>	
				<tr>	  
				  <td align="left" width="83%">
					   <select name="t_pid" style="font-weight:bolder;">
					   <?php
					   	 foreach($positions as $id => $_pos){
					   	 		echo "<option value={$id}>{$_pos}</option>";
					   	 }
					   ?>
				      </select>
				  </td>    
				  <td width="17%" align="left">
						<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">				  
				  </td>
				</tr>
				<tr>
					<td align="left" colspan="2"><strong>Position:</strong>&nbsp;&nbsp;<input type="text" name="t_pos" size="30" value=""></td>
				</tr>																						
				<tr align="center"  class="greybg" >
				  <td colspan="2">
					<input type="hidden" name="bt_name" value="">
					<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">
				  </td>
				</tr>									
			</table>	
</form>			
</body>
</html>