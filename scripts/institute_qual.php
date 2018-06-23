<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');

$id = isset($_REQUEST['id'])? $_REQUEST['id'] : 0;
$iid = isset($_REQUEST['iid'])? $_REQUEST['iid'] : 0;
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$qualName = isset($_REQUEST['t_name'])? $_REQUEST['t_name'] : "";
	if ($id > 0){
		$o_s->setCourseQual($id, $qualName);
	}elseif($iid > 0){
		$o_s->addCourseQual($iid, $qualName);
	}
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;
}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if ($id > 0){
		$o_s->delCourseQual($id);
	}
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;		
}

$quals = array();
if($iid > 0 && $id > 0){
	$quals = $o_s->getCourseQual($iid,$id);
}

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
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="iid" value="<?php echo $iid; ?>">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="3"align="center" class="whitetext">Qualification Edit</td>
		</tr>	
		<tr>
			<td width="25%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="75%" class="roweven"><input type="text" name="t_name" size="30" value="<?php echo (array_key_exists($iid, $quals) && array_key_exists($id, $quals[$iid]))? $quals[$iid][$id] : "";?>"></td>
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