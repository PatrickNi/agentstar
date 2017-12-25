<?php
//print_r($_POST);

if(isset($_POST['j_commit']) && strtoupper($_POST['j_commit']) == 'COMMIT'){
	$dns = mysql_connect("localhost", 'root', 'root');
	$sql = "INSERT INTO jobcollect (JobName, Owner, Agent, Server, ServerPath, How2Run, Description) ";
	foreach ($_POST as $k => $v){
		$_POST[$k] = addslashes($v);
	}
	$sql .= " Values ('{$_POST['j_name']}', '{$_POST['j_owner']}', '{$_POST['j_agent']}', '{$_POST['j_server']}', '{$_POST['j_path']}', '{$_POST['j_h2r']}', '{$_POST['j_desc']}')";
	mysql_db_query('test', $sql, $dns) or die(mysql_error());
	mysql_close($dns);
	
	echo "<script language='javascript'>alert('Sucessfully !')</script>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
</head>
<link rel="stylesheet" href="css/sam.css">
<body>
<form method="post" action="" name="form1" target="_self" onSubmit="return form_audit('form1')">
<table width="100%"  class="graybordertable">
	<tr  class="title" >
		<td align="center" colspan="2"><strong>Job Collection</strong></td>
	</tr>
	<tr>
		<td align="left"><strong>JobName: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input name="j_name" type="text" size="50" value=""></td>
	</tr>
	<tr>
		<td align="left"><strong>Owner: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input name="j_owner" type="text" size="50" value=""></td>
	</tr>	
	<tr>
		<td align="left"><strong>Agent(代理人): </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input name="j_agent" type="text" size="50" value=""></td>
	</tr>	
	<tr>
		<td align="left"><strong>Server: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input name="j_server" type="text" size="50" value=""></td>
	</tr>	
	<tr>
		<td align="left"><strong>Server Path: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><input name="j_path" type="text" size="50" value=""></td>
	</tr>	
	<tr>
		<td align="left"><strong>How To Run: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><textarea name="j_h2r" rows="5" style="width:300px"></textarea></td>
	</tr>
	<tr>
		<td align="left"><strong>Description: </strong>&nbsp;&nbsp;</td>
		<td align="left" width="90%"><textarea name="j_desc" rows="5" style="width:300px"></textarea></td>
	</tr>	
	<tr>
		<td class="title" colspan="2" align="center">			
			<input type="submit" style="font-weight:bold;" value="Commit" name="j_commit">&nbsp;&nbsp;
			<input type="reset" style="font-weight:bold; " value="Reset">

		</td>
	</tr>
</table>
</form>
</body>
</html>