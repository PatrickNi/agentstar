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
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="semid" value="{$semid}">
<input type="hidden" name="pid" value="{$pid}">
<input type="hidden" name="isNew" value="{$isNew}">
			<table border="0" width="100%" class="graybordertable" cellpadding="3" cellspacing="1">
				<tr><td colspan="2"><table cellspacing="0" cellpadding="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
							<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" {if $isapprove eq 0} disabled {/if}>
						</td>		
						<td align="center" class="whitetext">Semester Process Detail</td>
						 <td align="right" width="10%">
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" {if $isapprove eq 0} disabled {/if}>
						</td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_date" id="t_date" value="{$dt_arr.date}" onChange="audit_date(this)">
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
					<td width="19%" align="left" class="rowodd"><strong>Subject:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<input type="text" name="t_subject" value="{$dt_arr.subject}" size="50">
					</td>
				</tr>									
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_detail" style="width:300px; height:100px;">{$dt_arr.detail}</textarea></td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_due" id="t_due" value="{$dt_arr.due}" onChange="audit_date(this)">
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
					<td width="19%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="checkbox" value="1"  name="t_done" {if $dt_arr.done eq 1} checked {/if}></td>
				</tr>																							
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>					
			</table>		
</form>	
{$errormsg}
</body>
</html>