<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$position_arr['PE'] = 'Edu Partner';
$position_arr['PC'] = 'Coach Partner';


$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
	echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_f = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get function id
$user_id     = isset($_REQUEST['uid'])? trim($_REQUEST['uid']) : 0;
$user_name   = isset($_POST['u_name'])? trim($_POST['u_name']) : "";
$user_pswd   = isset($_POST['u_pswd'])? trim($_POST['u_pswd']) : "";
$user_email  = isset($_POST['u_email'])? trim($_POST['u_email']) : "";
$user_pos    = isset($_POST['u_pos'])? trim($_POST['u_pos']) : "";
$user_mark   = isset($_POST['u_mark'])? trim($_POST['u_mark']) : "";
$user_mobile = isset($_POST['u_mobile'])? trim($_POST['u_mobile']) : "";
$user_phone  = isset($_POST['u_phone'])? trim($_POST['u_phone']) : "";
$user_add    = isset($_POST['u_add'])? trim($_POST['u_add']) : "";
$user_adv    = isset($_POST['u_adv'])? trim($_POST['u_adv']) : 0;
$user_startdate  = isset($_POST['u_startdate'])? trim($_POST['u_startdate']) : "";
$user_leavedate  = isset($_POST['u_leavedate'])? trim($_POST['u_leavedate']) : "0000-00-00";

if(isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "NEW"){	
	$o_f->addUser($user_name, $user_pswd, $user_email, $user_mobile, $user_phone, $user_add, $user_pos, $user_mark, $user_adv, $user_startdate,$user_leavedate);
	echo "<script language='javascript'>self.location.href='sys_user.php';</script>";
	exit;
}


if($user_id > 0 && isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "EDIT"){
	$o_f->setUser($user_id, $user_name, $user_pswd, $user_email, $user_mobile, $user_phone, $user_add, $user_pos, $user_mark, $user_adv, $user_startdate, $user_leavedate);
	echo "<script language='javascript'>self.location.href='sys_user.php';</script>";
	exit;
}




if($user_id > 0){
	$user_arr = $o_f->getUserList($user_id);
	if(is_array($user_arr) && count($user_arr) > 0){
		$user_name   = $user_arr[$user_id]['name'];
		$user_pswd   = $user_arr[$user_id]['pswd'];
		$user_email	 = $user_arr[$user_id]['email'];
		$user_mobile = $user_arr[$user_id]['mobile'];
		$user_mark   = $user_arr[$user_id]['mark'];
		$user_phone	 = $user_arr[$user_id]['phone'];
		$user_add    = $user_arr[$user_id]['add'];
		$user_pos    = $user_arr[$user_id]['pos'];
		$u_adv       = $user_arr[$user_id]['adv'];
		$user_startdate = $user_arr[$user_id]['startdate'];
		$user_leavedate = $user_arr[$user_id]['leavedate'];
	}
	$_tag = "Edit";
}else{
	$_tag = "New";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<script language="javascript" src="../js/calendar.js"></script>
<body>
<form method="post" action="sys_user_add.php" name="form1" target="_self" onSubmit="return form_audit('form1')">
<table width="100%"  class="graybordertable">
	<input type="hidden" name="uid" value="<?php echo $user_id;?>">
	<input type="hidden" name="qflag" value="<?php echo $_tag;?>">
	<input type="hidden" name="hCancel" value="0">
	<tr  class="title" >
		<td align="center" colspan="2"><strong>Add New User</strong></td>
	</tr>
	<tr>
		<td width="14%" align="left"><strong>Name: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%"><input name="u_name" type="text" size="30" value="<?php echo $user_name;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Password: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%"><input type="password" size="30" name="u_pswd" value="<?php echo $user_pswd;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Email: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%"><input type="text" size="30" name="u_email" value="<?php echo $user_email;?>" onChange="aduit_email(this.value)"></td>
	</tr>	
	<tr>
		<td align="left"><strong>Position: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%">
			<select name="u_pos">
			<?php
				foreach($position_arr as $key => $pos){
					if ($key == $user_pos){
						echo "<option value={$key} selected>{$pos}</option>";
					}else{
						echo "<option value={$key}>{$pos}</option>";
					}
				}
			?>
			</select>
	</tr>
	<tr>
		<td align="left"><strong>Mark: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%">
			<select name="u_mark">
			<?php
				foreach($mark_arr as $key => $mark){
					if ($key == $user_mark){
						echo "<option value={$key} selected>{$mark}</option>";
					}else{
						echo "<option value={$key}>{$mark}</option>";
					}
				}
			?>
			</select>
	</tr>			
	<tr>
		<td align="left"><strong>Mobile: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%"><input type="text" size="30" name="u_mobile" value="<?php echo $user_mobile;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Telephone: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%"><input type="text" size="30" name="u_phone" value="<?php echo $user_phone;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Address: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%"><input type="text" size="30" name="u_add" value="<?php echo $user_add;?>"></td>
	</tr>
	<tr>
		<td align="left"><strong>Advance for Course Commission: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="86%"><input type="checkbox" size="30" name="u_adv" value="1" <?php echo $u_adv == 1? "checked" : ""; ?>></td>
	</tr>
    <tr>
        <td align="left"><strong>Official Start Date: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="86%"><input type="text" size="30" name="u_startdate" value="<?php echo $user_startdate;?>" onDblClick="calendar()" onChange="audit_date(this)" ></td>
    </tr>	
    <tr>
        <td align="left"><strong>Official Leave Date: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="86%"><input type="text" size="30" name="u_leavedate" value="<?php echo $user_leavedate;?>" onDblClick="calendar()" onChange="audit_date(this)" >
        	&nbsp;&nbsp;
        	<a href="/scripts/sys_user_merge.php?uid=<?php echo $user_id;?>" target="_self">Course Consultant Merge</a>
        </td>

    </tr>							
	<tr>
		<td class="title" colspan="2" align="center">			
			<input type="submit" style="font-weight:bold;" value="<?php echo $_tag;?>">&nbsp;&nbsp;
			<input type="button" style="font-weight:bold;" value="Cancel" onClick="javascript:this.form.action='sys_user.php';this.form.submit();">
		</td>
	</tr>
</table>
</form>
</body>
</html>