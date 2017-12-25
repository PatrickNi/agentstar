<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

# get course id
$major = isset($_REQUEST['t_major'])? trim($_REQUEST['t_major']) : "";
$pid   = isset($_REQUEST['t_pid'])? trim($_REQUEST['t_pid']) : "";
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$group_arr = array();

switch($button){
	case "SAVE":
		$o_c->addMajorOfCourse($major);
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if ($pid > 0){
			$o_c->delMajorOfCourse($pid);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	default:
		break;
}

$major_arr = array();
$major_arr = $o_c->getMajorOfCourse();
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
							Course Major&nbsp;
					</td>
				</tr>	
				<tr>	  
				  <td align="left" width="83%">
					   <select name="t_pid" >
					   <?php
					   	 foreach($major_arr as $id => $major){
					   	 	echo "<option value={$id}>{$major}</option>";
					   	 }
					   ?>
				      </select>
				  </td>    
				  <td width="17%" align="left">
						<input type="submit" value="Delete" name="bt_name" style="font-weight:bold" onClick="this.form.hCancel.value=1">				  
				  </td>
				</tr>
				<tr>
					<td align="left" width="83%"><input type="text" name="t_major" size="30" value=""></td>
					<td width="17%" align="left"><input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>																		
				<tr align="center"  class="greybg" >
				  <td colspan="2">&nbsp;</td>
				</tr>									
			</table>	
</form>			
</body>
</html>