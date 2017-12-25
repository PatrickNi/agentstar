<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" media="all" href="../js/calendar/calendar.css" title="win2k-cold-1">
<script type="text/javascript" src="../js/calendar/calendar.js"></script>
<script type="text/javascript" src="../js/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="../js/calendar/calendar-setup.js"></script>

<script language="javascript" src="../js/audit.js"></script>
<script language="javascript">{$error_js}</script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="tid" value="{$tid}">
			<table border="0" width="100%" class="graybordertable" cellpadding="3" cellspacing="1">
				<tr class="greybg">
					<td colspan="2"align="center" class="whitetext">
						Task Process Detail&nbsp;&nbsp;
					</td>
				</tr>	
				<tr>
					<td width="19%" align="left"  class="rowodd"><strong>From:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">{if $dt_arr.from gt 0}{$users[$dt_arr.from]}{else}{$users[$userid]}{/if}</td>
				</tr>				
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>To:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_to" onChange="this.form.t_date.focus();">
						{foreach key=id item=name from=$users}
							<option value="{$id}" {if $id eq $dt_arr.to} selected {/if}>{$name}</option>
						{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Sign Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_date" id="t_date" value="{$dt_arr.date}" onDblClick="calendar()" onChange="audit_date(this)">
{literal}
<script type="text/javascript">
		Calendar.setup({
		inputField : "t_date",
		ifFormat   : "%Y-%m-%d",
		eventName  : "dblclick",
		step       :  1
	});
</script> 
{/literal}   
                    
                    </td>
				</tr>				
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Task:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_task" style="width:500px;" value="{$dt_arr.task}" ></td>
				</tr>				
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_detail" style="width:500px; height:450px;">{$dt_arr.detail}</textarea></td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<input type="text" name="t_due" id="t_due" value="{$dt_arr.due}" onChange="audit_date(this)">
{literal}
<script type="text/javascript">
		Calendar.setup({
		inputField : "t_due",
		ifFormat   : "%Y-%m-%d",
		eventName  : "dblclick",
		step       :  1
	});
</script> 
{/literal}   
                        
                        </td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Due Hour:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_duehour">
						{foreach item=hour from=$duehour} 
						 <option value="{$hour}" {if $dt_arr.duehour eq $hour} selected {/if}>{$hour}</option>
						{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="checkbox" value="1"  name="t_done" {if $dt_arr.done eq 1} checked {/if}></td>
				</tr>																							
				<tr align="center"  class="greybg">
					<input type="hidden" name="bt_name" value="">
					<td align="left">
						<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
					</td>		
					 <td align="right">
						<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
					</td>
				</tr>								
			</table>		
</form>	