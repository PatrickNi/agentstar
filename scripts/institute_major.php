<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');

$id = isset($_REQUEST['id'])? $_REQUEST['id'] : 0;
$qualid = isset($_REQUEST['qual'])? $_REQUEST['qual'] : 0;
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	$majorName = isset($_POST['t_name'])? $_POST['t_name'] : "";
	if ($id > 0){
		$o_s->setCourseMajor($id, $majorName);
	}elseif($qualid > 0){
		$o_s->addCourseMajor($qualid, $majorName);
	}
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;
}elseif(isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	if ($id > 0){
		$o_s->delCourseMajor($id);
	}
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;		
}

$majors = array();
if($qualid > 0 && $id > 0){
	$majors = $o_s->getCourseMajor($qualid,$id);
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
<input type="hidden" name="qual" value="<?php echo $qualid; ?>">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="3"align="center" class="whitetext">Major Edit</td>
		</tr>	
		<tr>
			<td width="25%" align="left" class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="75%" class="roweven"><input type="text" name="t_name" size="30" value="<?php echo (array_key_exists($qualid, $majors) && array_key_exists($id, $majors[$qualid]))? $majors[$qualid][$id] : "";?>"></td>
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