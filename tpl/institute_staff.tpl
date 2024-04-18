<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="{$sid}">
<input type="hidden" name="fid" value="{$fid}">
<input type="hidden" name="isNew" value="{$isNew}">
<table align="center" class="graybordertable" width="100%"   border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="7"><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="7"> <span class="highyellow">Insititute: {$iname}</span></td>
	</tr>		
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="7" style="padding:3 ">Institute Staff Information 
			<input type="submit" value="Add New" style="font-weight:bold;" onClick="this.form.isNew.value='block'">
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td>Name</td>
		<td>Position</td>
		<td>Phone</td>
		<td>Fax</td>
		<td>Mobile</td>
		<td>Email</td>
		<td>Action</td>
	</tr>
	{foreach key=id item=arr from=$staff_arr}
	<tr align="center" class="roweven">
		<td>{$arr.name}</td>
		<td>{$positions[$arr.pos]}</td>
		<td>{$arr.phone}</td>
		<td>{$arr.fax}</td>
		<td>{$arr.mobile}</td>
		<td>{$arr.email}</td>
		<td>
			<select name="at_{$id}" style="font-size:9px; font-weight:bolder;" {if $arr.done eq 1} disabled {/if}>
				{foreach key=act_id item=act_name from=$act_arr}
					<option value="{$act_id}">{$act_name}</option>
				{/foreach}							
			</select>&nbsp;
			<input style="font-weight:bolder;" type="button" {if $arr.done eq 1} disabled {/if} value="OK" onClick="this.form.fid.value={$id};this.form.submit();"> 					
		</td>
	</tr>
	{/foreach}
</table>
<p />
<div id="editDiv" style="display:{$isNew} ">
	<table border="0" width="100%" cellpadding="3">
		<tr class="greybg">
			<td colspan="2"align="center" class="whitetext">Detail Information</td>
		</tr>	
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_name" value="{$dt_arr.name}" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Position:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven">
				<select name="t_pos">
				{foreach key=id item=pos from=$positions}
					<option value="{$id}" {if $id eq $dt_arr.pos} selected {/if}>{$pos}</option>
				{/foreach}
				{if $dt_arr.pos lt 1}<option value="0" selected>select a position</option>{/if}
				</select>
				<span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="openModel('position.php',300,300,'NO', 'form1')">Add new position</span>
			</td>		
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Phone:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_phone" value="{$dt_arr.phone}" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Fax:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_fax" value="{$dt_arr.fax}" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_mobile" value="{$dt_arr.mobile}" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Email:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_email" value="{$dt_arr.email}" size="50" onChange="audit_email(this.value)"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Address:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_add" value="{$dt_arr.add}" size="50"></td>
		</tr>																																	
		<tr align="center"  class="greybg" >
			<td colspan="2"><input type="submit" value="Save" name="bt_name" style="font-weight:bold "></td>
		</tr>									
	</table>
</div>			
</form>	
</body>
</html>
