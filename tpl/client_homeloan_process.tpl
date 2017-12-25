<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star - Home Loan - Process</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>

<script language="javascript" src="../js/audit.js"></script>
<script language="javascript">{$msg}</script>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="hid" value="{$hid}">
<input type="hidden" name="pid" value="{$pid}">
<input type="hidden" name="isOther" value="{$isOther}">
		<table border="0" width="100%" cellpadding="3" cellspacing="1">
			<tr class="greybg">
				
			</tr>	
			<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
				<tr align="center"  class="greybg">
					<input type="hidden" name="bt_name" value="">
					<td align="left" width="10%">
						<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" >
					</td>	
					<td align="center" class="whitetext">Detail Information</td>
					<td align="right" width="10%">
						<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">
					</td>
				</tr>				
			</table></td></tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven">
                	<input type="text" name="t_date" id="t_date" value="{$dt_arr.date}">
                </td>
			</tr>
			<tr>
			{if $isOther eq 1 || (not in_array($dt_arr.subject, $step_arr) && $isNew neq 1)}
					<tr>
						<td width="19%" align="left" class="rowodd"><strong>Additional Step:</strong>&nbsp;&nbsp;</td>
						<td align="left" width="81%" class="roweven">
							<input type="text" name="t_subject" value="{$dt_arr.subject}" style="width:600px;">
						</td>
					</tr>
			{else}
					<tr>
						<td width="19%" align="left" class="rowodd"><strong>Subject:</strong>&nbsp;&nbsp;</td>
						<td align="left" width="81%" class="roweven">
							<select name="t_subject" onChange="this.form.t_detail.focus();">
							{foreach key=pid item=step from=$step_arr}
								<option value="{$step}" {if $step eq $dt_arr.subject} selected {/if}>{$step}</option>
							{/foreach}
							</select>
						</td>
					</tr>
			{/if}						
			</tr>				
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><textarea name="t_detail" style="width:100%; height:100px ">{$dt_arr.detail}</textarea></td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_due" id="t_due" value="{$dt_arr.due}" >
 
                </td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="checkbox" value="1"  name="t_done" {if $dt_arr.done eq 1} checked {/if}></td>
			</tr>																				
			<tr class="greybg"><td colspan="2">&nbsp;</td></tr>								
		</table>
</form>	
{literal}
<script type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_due').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	function show_add(obj){
		if($(obj).val() == "")
			$('#add_step').css("display", "");	
		else
			$('#add_step').css("display", "none");
	}
</script>
{/literal}	