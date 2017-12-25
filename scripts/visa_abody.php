<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'Template.class.php');
ini_set("display_errors", 1);
error_reporting(2047);

# get course id
$bname = isset($_REQUEST['bname'])? trim($_REQUEST['bname']) : "";
$bid   = isset($_REQUEST['bid'])? trim($_REQUEST['bid']) : 0;
$button    = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$body_arr = array();
$body_arr = $o_v->getVisaBody();
$asco_arr = $o_v->getVisaAscoByABody();
switch($button){
	case "SAVE":
		if ($bid > 0) {
			$o_v->setVisaABody($bid, $bname);
		}else{
			$o_v->addVisaABody($bname);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "DELETE":
		if ($bid > 0){
			$o_v->delVisaBody($bid);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	case "EDIT";
		break;	
	default:
		# set smarty tpl
		$o_tpl = new Template;
		$o_tpl->assign("abodys", $body_arr);
		$o_tpl->assign("ascos", $asco_arr);
		$o_tpl->display('visa_abody.tpl');
		exit;
		break;
}
$edit_name = array_key_exists($bid, $body_arr)? $body_arr[$bid] : "";

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
<input type="hidden" name="bid" value="<?php echo $bid;?>">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr class="bordered_2">
		<td colspan="3"align="center" class="whitetext">
				Setting&nbsp;
		</td>
	</tr>	
	<tr>
		<td align="left" colspan="2"><input type="text" name="bname" size="50" value="<?php echo $edit_name;?>"></td>
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