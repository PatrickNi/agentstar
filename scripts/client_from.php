<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

# get course id
$add_about = isset($_REQUEST['t_about'])? trim($_REQUEST['t_about']) : "";
$del_about = isset($_REQUEST['d_about'])? trim($_REQUEST['d_about']) : "";
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$group_arr = array();

switch($button){
	case "SAVE":
		$o_c->addClientFrom($add_about);
		//echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		$o_c->delClientFrom($del_about);
		//echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	default:
		break;
}

$status_arr = array();
$status_arr = $o_c->getClientFrom();
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
							Where do you know about us&nbsp;
					</td>
				</tr>	
				<tr>	  
				  <td align="left" width="83%">
					   <select name="d_about" >
					   <?php
					   	 foreach($status_arr as $name){
					   	 	echo "<option value=$name>{$name}</option>";
					   	 }
					   ?>
				      </select>
				  </td>    
				  <td width="17%" align="left">
						<input type="submit" value="Delete" name="bt_name" style="font-weight:bold" onClick="this.form.hCancel.value=1">				  
				  </td>
				</tr>
				<tr>
					<td align="left" width="83%"><input type="text" name="t_about" size="50" value=""></td>
					<td width="17%" align="left"><input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>																		
				<tr align="center"  class="greybg" >
				  <td colspan="2">&nbsp;</td>
				</tr>									
			</table>	
</form>			
</body>
</html>
