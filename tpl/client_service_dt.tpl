<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="sid" value="{$sid}">
<input type="hidden" name="isNew" value="{$isNew}">
<table border="0" width="100%" cellpadding="3" cellspacing="1">
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" value="">
			<td align="left" width="10%">
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
			</td>		
			<td align="center" class="whitetext">Detail Information</td>
			 <td align="right"  width="10%">
				<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
			</td>
		</tr>	
	</table></td></tr>	
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven"><input type="text" name="t_date" id="t_date" value="{$dt_arr.date}"  size="30">
  
        
        </td>
	</tr>
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>Subject:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven"><textarea style="width:300px; height:100px;" name="t_subject">{$dt_arr.subject}</textarea>
		</td>
	</tr>
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven"><textarea style="width:300px; height:100px;" name="t_detail">{$dt_arr.detail}</textarea></td>
	</tr>			
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven"><input type="text" name="t_due" id="t_due" value="{$dt_arr.due}" size="30">

        </td>
	</tr>
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven"><input type="checkbox" name="t_done" value="1" {if $dt_arr.done eq 1} checked {/if}></td>
	</tr>												
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>									
</table>
</form>	

{literal}
<script type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_due').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}	
</body>
</html>