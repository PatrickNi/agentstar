<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<body>
<form name="form1" target="_self" method="post">
<input type="hidden" name="vid" value="{$vid}">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="depid" value="0">
<table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
	 <tr >
	  	<td colspan="7" align="center"  class="bordered_2">
			<table width="100%" cellpadding="1" cellspacing="1">
				<tr>
					<td colspan="4"  align="left" >
						<input type="submit" name="bt_name" value="Set Dependant" style="font-weight:bold;">&nbsp;&nbsp;
						<!--<input type="submit" value="Delete" name="qSubmit" style="font-weight:bold;">	-->  
					</td>
					<td colspan="4" align="right">
						<strong>From: &nbsp;</strong><input type="text"	 name="t_fdate" id="t_fdate" value="{$from}">&nbsp;&nbsp;

						<strong>To: &nbsp;</strong><input type="text"	 name="t_tdate" id="t_tdate" value="{$to}">&nbsp;&nbsp;
                       
						<select name="srchType">
							<option value="l" {if $srchtype eq 'l'} selected {/if}>Last Name</option>
							<option value="f" {if $srchtype eq 'f'} selected {/if}>First Name</option>
							<option value="e" {if $srchtype eq 'e'} selected {/if}>English Name</option>
							<option value="t" {if $srchtype eq 't'} selected {/if}> Client Type</option>					
						</select>&nbsp;&nbsp;
						<input type="text" name="srchTxt" size="20" value="{$srchtxt}">&nbsp;&nbsp;
						<input type="submit" value="QUERY" name="bt_name" style="font-weight:bold;" >
					</td>
				</tr>				
	   		</table>	
	   </td>
	</tr>
	</tr>
	<tr>
		<td align="left" colspan="9" class="greybg"><span class="highyellow">{$page_url}</span></td>
	</tr>					
	<tr align="center" class="totalrowodd">
		<td width="2%"><input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>
		<td width="15%">Last Name</td>	
		<td width="15%">First Name</td>
		<td width="10%">Gender</td>
		<td width="15%">DoB</td>
		<td>Email</td>
		<td width="10%">Action</td>
    </tr>
	 {foreach key=id item=arr from=$client_arr}
	 <tr id="tr_{$id}" onMouseOut="roff({$id});" onMouseOver="ron({$id});">
	 	<td align="center" onClick="rowToggle({$id})" class="border_1"><input type="checkbox" id="box_{$id}" onClick="toggleRow(this);" name="idArr[]" value="{$id}" {if $arr.depid gt 0} checked {/if}></td>
		<td align="center" class="border_1">{$arr.lname}</td>
		<td align="center" class="border_1">{$arr.fname}</td>
		<td align="center" class="border_1">{$arr.gender}</td>
		<td align="center" class="border_1">{$arr.dob}</td>
		<td align="center" class="border_1">{$arr.email}</td>
		<td align="center" class="border_1"><input type="submit" name="bt_name" value="Delete" onClick="this.form.depid.value={$id};"{if $arr.depid eq 0} disabled {/if}></td>
	 </tr>	
	 {/foreach}
</table>
</form>
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
</script>
{/literal}	
</body>
</html>
