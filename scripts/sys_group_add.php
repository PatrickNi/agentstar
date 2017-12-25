<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
	echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_f = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get function id
$group_id   = isset($_REQUEST['groupid'])? trim($_REQUEST['groupid']) : 0;
$group_name = isset($_POST['g_name'])? trim($_POST['g_name']) : "";
$group_mark = isset($_POST['g_mark'])? trim($_POST['g_mark']) : "";



if(isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "NEW"){	
	$o_f->addFuncGroup($group_name, $group_mark);
	echo "<script language='javascript'>self.location.href='sys_group.php';</script>";
	exit;
}

if($group_id > 0 && isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "EDIT"){
	$o_f->setFuncGroup($group_id, $group_name, $group_mark);
	echo "<script language='javascript'>self.location.href='sys_group.php';</script>";
	exit;
}


if($group_id > 0){
	$gorup_arr = $o_f->getFuncGroupList($group_id);
	if(is_array($gorup_arr) && count($gorup_arr) > 0){
		$group_name  = $gorup_arr[$group_id]['name'];
		$group_mark  = $gorup_arr[$group_id]['mark'];
	}
	$_tag = "EDIT";
}else {
	$_tag = "NEW";
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="sys_group_add.php" target="_self" onSubmit="return form_audit('form1')">
<table width="100%"  class="graybordertable">
	<input type="hidden" name="groupid" value="<?php echo $group_id;?>">
	<input type="hidden" name="qflag" value="<?php echo $_tag;?>">
	<input type="hidden" name="hCancel" value="0">
	<tr  class="title" >
		<td align="center" colspan="2"><strong>Add New Function Group</strong></td>
	</tr>
	<tr>
		<td align="left"><strong>Group: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input name="g_name" type="text" size="30" value="<?php echo $group_name;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Mark: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input type="text" size="30" name="g_mark" value="<?php echo $group_mark;?>"></td>
	</tr>
	<tr>
		<td class="title" colspan="2" align="center">
			<input type="submit" style="font-weight:bold;" value="<?php echo $_tag;?>">&nbsp;&nbsp;
			<input type="button" style="font-weight:bold;" value="Cancel" onClick="javascript:this.form.action='sys_group.php';this.form.submit();">
		</td>
	</tr>
</table>
</form>
</body>
</html>