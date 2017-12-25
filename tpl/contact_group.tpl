<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="gid" value="{$gid}">
			<table border="0" width="100%" cellpadding="3">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
							<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
						</td>		
						<td align="center" class="whitetext">Contact Group</td>
						<td align="right" width="10%">
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
						</td>
					</tr>
				</table></td></tr>
				<tr>
					<td width="17%" align="left" class="rowodd"><strong>Group:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%" class="roweven"><input type="text" name="t_group" size="50" value="{$dt_arr.name}"></td>
				</tr>
				<tr>
					<td width="17%" align="left" class="rowodd"><strong>Tel:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%" class="roweven"><input type="text" name="t_tel" size="50" value="{$dt_arr.tel}"></td>
				</tr>
				<tr>
					<td width="17%" align="left" class="rowodd"><strong>Person:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%" class="roweven"><input type="text" name="t_person" size="50" value="{$dt_arr.person}"></td>
				</tr>																		
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>							
			</table>	
</form>			
</body>
</html>