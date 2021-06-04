<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Institute Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<script language="javascript" >{$error_js}</script>

<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="{$sid}">
<input type="hidden" name="bankid" value="{$bankid}">
<input type="hidden" name="isNew" value="{$isNew}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="7">
		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>	
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="7"> <span class="highyellow">Insititute: {$iname}</span></td>
	</tr>			
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="7" style="padding:3 ">Institute Bank 
			<input type="submit" value="Add New" style="font-weight:bold;" onClick="this.form.isNew.value='block'">
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td>Account Name</td>
		<td>BSB</td>
		<td>Account No</td>
		<td>Action</td>
	</tr>
	{foreach key=id item=arr from=$bank_arr}
	<tr align="center" class="roweven">
	    <td>{$arr.aname}</td>
		<td>{$arr.bsb}</td>
        <td >{$arr.ano}</td>
		<td>
			<select name="at_{$id}" style="font-size:9px; font-weight:bolder;">
				{foreach key=act_id item=act_name from=$act_arr}
					<option value="{$act_id}">{$act_name}</option>
				{/foreach}							
			</select>&nbsp;					
            <input style="font-weight:bolder;" type="button" value="OK" onClick="this.form.bankid.value={$id};this.form.submit();"> 
		</td>
	</tr>
	{/foreach}
</table>
<p />
<div id="editDiv" style="display:{$isNew};">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="2"align="center" class="whitetext">Detail Information</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Account Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input type="text" name="t_aname" value="{$dt_arr.aname}" size="50"/>
			</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>BSB:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input type="text" name="t_bsb" value="{$dt_arr.bsb}" size="50"/>
			</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Account No:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input type="text" name="t_ano" value="{$dt_arr.ano}" size="50"/>
			</td>
		</tr>
		<tr align="center"  class="greybg" >
			<td colspan="2"><input type="submit" value="Save" name="bt_name" style="font-weight:bold "></td>
		</tr>									
	</table>
</div>			
</form>	
</body>
</html>