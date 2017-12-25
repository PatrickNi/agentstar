<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="ctid" value="{$ctid}">
<input type="hidden" name="gid" value="{$gid}">
<input type="hidden" name="hCancel" value="0">
			<table border="0" width="100%" cellpadding="1" cellspacing="1">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
							<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
						</td>		
						<td align="center" class="whitetext">Origanization</td>
						<td align="right" width="10%">
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
						</td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Organization:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_org" size="50" value="{$dt_arr.org}"></td>
			    </tr>
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Phone:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_phone" size="50" value="{$dt_arr.phone}"></td>
				</tr>
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Fax:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_fax" size="50" value="{$dt_arr.fax}"></td>
				</tr>
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>WeSite:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_web" size="50" value="{$dt_arr.web}"></td>
				</tr>
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Email:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_email" size="50" value="{$dt_arr.email}" onChange="audit_email(this.value)"></td>
				</tr>		
				<!--<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Mobile:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_mobile"  size="30" value="{$dt_arr.mobile}"></td>
				</tr>-->
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Person:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_person" size="50" value="{$dt_arr.person}"></td>
				</tr>
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Address:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><input type="text" name="t_add" size="50" value="{$dt_arr.add}"></td>
				</tr>
				<tr>
					<td width="17%" align="left"  class="rowodd" ><strong>Notes:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="83%"  class="roweven" ><textarea name="t_note" style="width:400px; height:200px ">{$dt_arr.note}</textarea></td>
				</tr>																																	
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>					
  </table>		
</form>	
