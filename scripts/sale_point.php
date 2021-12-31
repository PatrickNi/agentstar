<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$cateid  = isset($_REQUEST['cateid'])? $_REQUEST['cateid'] : 0;
$pointid = isset($_REQUEST['pid'])? $_REQUEST['pid'] : 0;

$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$pointName = isset($_REQUEST['t_name'])? $_REQUEST['t_name'] : "";
	$pointNote = isset($_REQUEST['t_note'])? $_REQUEST['t_note'] : "";
	if ($pointid > 0){
		$o_g->setSalesPoint($pointid, $pointName, $pointNote);
	}else{
		$o_g->addSalesPoint($cateid, $pointName, $pointNote);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;
}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if ($cateid > 0){
		$o_g->delSalesPoint($pointid);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;
}


$points = $o_g->getSalesPoint($pointid);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="cateid" value="<?php echo $cateid; ?>">
<input type="hidden" name="pid" value="<?php echo $pointid; ?>">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="3"align="center" class="whitetext">
					Sales Point&nbsp;
			</td>
		</tr>	
		<tr>
			<td width="25%" align="left" class="rowodd"><strong>Point Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="75%" class="roweven">
				<textarea name="t_name" style="width: -webkit-fill-available; height:500px;"><?php echo ($pointid > 0 && $cateid > 0)? $points[$cateid][$pointid]['name'] : "";?></textarea>
		
		</td>
		</tr>																				
		<tr align="center"  class="greybg" >
		  <td colspan="2">
				<input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Delete" name="bt_name" style="font-weight:bold">
			</td>
		</tr>									
	</table>	
</form>			
</body>
</html>