<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'Template.class.php');
ini_set("display_errors", 1);
error_reporting(2047);

# get course id
$asconame = isset($_REQUEST['asconame'])? trim($_REQUEST['asconame']) : "";
$abodyid   = isset($_REQUEST['abodyid'])? trim($_REQUEST['abodyid']) : 0;
$ascoid   = isset($_REQUEST['ascoid'])? trim($_REQUEST['ascoid']) : 0;
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$asco_arr = array();
$asco_arr = $o_v->getVisaAsco();
switch($button){
	case "SAVE":
		if ($ascoid > 0) {
			$o_v->setVisaAsco($ascoid, $asconame);
		}else{
			$o_v->addVisaAsco($asconame, $abodyid);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if ($ascoid > 0){
			$o_v->delVisaAsco($ascoid);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "EDIT";
		break;	
	default:
		break;
}
$edit_name = array_key_exists($ascoid, $asco_arr)? $asco_arr[$ascoid] : "";

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
<input type="hidden" name="ascoid" value="<?php echo $ascoid;?>">
<input type="hidden" name="abodyid" value="<?php echo $abodyid;?>">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr class="bordered_2">
		<td colspan="3"align="center" class="whitetext">
				Setting Asco&nbsp;
		</td>
	</tr>	
	<tr>
		<td align="left" colspan="2"><input type="text" name="asconame" size="50" value="<?php echo $edit_name;?>"></td>
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