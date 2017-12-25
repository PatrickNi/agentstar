<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
	echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_f = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

# get function id
$func_id   = isset($_REQUEST['funcid'])? trim($_REQUEST['funcid']) : 0;
$group_id  = isset($_POST['f_group'])? trim($_POST['f_group']) : 0;
$func_name = isset($_POST['f_name'])? trim($_POST['f_name']) : "";
$func_mark = isset($_POST['f_mark'])? trim($_POST['f_mark']) : "";
$func_scrp = isset($_POST['f_script'])? trim($_POST['f_script']) : "";


if(isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "NEW"){	
	$o_f->addFunc($func_name, $func_mark, $func_scrp, $group_id);
	echo "<script language='javascript'>self.location.href='sys_func.php';</script>";
	exit;
}


if($func_id > 0 && isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "EDIT"){
	$o_f->setFunc($func_id, $func_name, $func_mark, $group_id, $func_scrp);
	echo "<script language='javascript'>self.location.href='sys_func.php';</script>";
	exit;
}


if($func_id > 0){
	$func_arr = $o_f->getFuncList($func_id);
	if(is_array($func_arr) && count($func_arr) > 0){
		$func_name  = $func_arr[$func_id]['name'];
		$func_mark  = $func_arr[$func_id]['mark'];
		$group_id   = $func_arr[$func_id]['group'];
		$func_scrp= $func_arr[$func_id]['script'];
	}
	$_tag = "edit";
}else{
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
<form method="post" name="form1"  action="sys_func_add.php" target="_self" onSubmit="return form_audit('form1')">
<table width="100%"  class="graybordertable">
	<input type="hidden" name="funcid" value="<?php echo $func_id;?>">
	<input type="hidden" name="qflag" value="<?php echo $_tag;?>">
	<input type="hidden" name="hCancel" value="0">
	<tr  class="title" >
		<td colspan="2" align="center"><strong>Add New Function</strong></td>
	</tr>
	<tr>
		<td align="left"><strong>Function: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input name="f_name" type="text" size="30" value="<?php echo $func_name;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Mark: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input type="text" size="30" name="f_mark" value="<?php echo $func_mark;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Script: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input type="text" size="30" name="f_script" value="<?php echo $func_scrp;?>"></td>
	</tr>	
	<tr>
		<td align="left"><strong>Func Group:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%">
		 	<select name="f_group" >
		 	<?php
		 		$group_arr = $o_f->getFuncGroupList();
		 		foreach($group_arr as $id => $v){
		 			if($id == $group_id){
		 				echo "<option value={$id} selected>{$v['name']}</option>";
		 			}else{
		 				echo "<option value={$id}>{$v['name']}</option>";	
		 			}
		 		}
		 	?>
		 	</select>
		</td>
	</tr>
	
	<tr>
		<td class="title" colspan="2" align="center">

		   <input type="submit" style="font-weight:bold;" value="<?php echo $_tag;?>">&nbsp;&nbsp;
	       <input type="button" style="font-weight:bold;" value="Cancel" onClick="javascript:this.form.action='sys_func.php';this.form.submit();">	  </td>
	</tr>
</table>
</form>
</body>
</html>