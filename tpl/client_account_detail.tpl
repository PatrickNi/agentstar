<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>


<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="aid" value="{$aid}">
<input type="hidden" name="vid" value="{$vid}">
<input type="hidden" name="typ" value="{$typ}">
<input type="hidden" name="hCancel" value="0">
			<table width="100%" cellpadding="1" cellspacing="1" border="0" class="graybordertable">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
						   {if $ugs.v_pay.d eq 1}<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">{/if}						</td>		
						<td align="center" class="whitetext">Payment Detail </td>
						<td align="right" width="10%"><input name="submit" type="submit" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" value="Save" {if $ugs.v_pay.v eq 1 && $ugs.v_pay.m eq 0 && ($dt_arr.step neq '' || $ugs.v_pay.i eq 0)} disabled="disabled" {/if}></td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Item:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
				  		<select name="t_step" id="t_step">
				  			<option value="">--</option>
				  			{foreach key=k item=v from=$steps}
				  				<option value="{$k}" {if $dt_arr.step == $k} selected {/if} data-party="{$v}">{$k|ucwords} Fee</option>
				  			{/foreach}
				  		</select>
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>GST:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  		<input type="radio" name="t_gst" value="1" {if $dt_arr.gst_chk eq 1} checked {/if}>YES &nbsp;&nbsp;
				  		<input type="radio" name="t_gst" value="0" {if $dt_arr.gst_chk eq 0} checked {/if}>NO
					</td>
				</tr>				
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Due Amount:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  	{if $ugs.v_pay.v eq 1 && $ugs.v_pay.m eq 0 && ($dt_arr.dueamt gt 0 || $ugs.v_pay.i eq 0)}
						<input type="hidden" name="t_dueamt" value="{$dt_arr.dueamt}">
				  	{/if}					
						<input type="text" name="t_dueamt" value="{$dt_arr.dueamt}" size="30" onChange="audit_money(this)" {if $ugs.v_pay.v eq 0} style="visibility:hidden"{/if}  {if $ugs.v_pay.v eq 1 && $ugs.v_pay.m eq 0 && ($dt_arr.dueamt gt 0 || $ugs.v_pay.i eq 0)} disabled="disabled" {/if}>
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
					{if $ugs.p_duedate.v eq 1 && $ugs.p_duedate.m eq 0 && ($dt_arr.duedate neq '' || $dt_arr.duedate neq '0000-00-00' || $ugs.p_duedate.i eq 0)}
						<input type="hidden" name="t_duedate" value="{$dt_arr.duedate}">
					{/if}						
					  <input type="text" name="t_duedate" id="t_duedate" value="{$dt_arr.duedate}" size="30" onchange="audit_date(this)" {if $ugs.p_duedate.v eq 0} style="visibility:hidden"{/if} {if $ugs.p_duedate.v eq 1 && $ugs.p_duedate.m eq 0 && ($dt_arr.duedate neq '' || $dt_arr.duedate neq '0000-00-00' || $ugs.p_duedate.i eq 0)} disabled="disabled"{/if}>

					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
				  		<input type="text" name="t_party" id="t_party" value="{$dt_arr.party}" size="30">
				  		<!--
				  		<select name="t_party" id="t_party">
				  			{foreach key=k item=v from=$steps}
				  				<option value="{$v}" step="{$k}" {if $dt_arr.party == $v} selected {/if}>{$v|ucwords}</option>
				  			{/foreach}
				  		</select>
				  		-->
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction GST:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  		<input type="radio" name="t_gst_3rd" value="1" {if $dt_arr.gst_3rd_chk eq 1} checked {/if}>YES &nbsp;&nbsp;
				  		<input type="radio" name="t_gst_3rd" value="0" {if $dt_arr.gst_3rd_chk eq 0} checked {/if}>NO
					</td>
				</tr>
<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction Amount:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  	{if $ugs.v_pay.v eq 1 && $ugs.v_pay.m eq 0 && ($dt_arr.dueamt_3rd gt 0 || $ugs.v_pay.i eq 0)}
						<input type="hidden" name="t_dueamt_3rd" value="{$dt_arr.dueamt_3rd}">
				  	{/if}					
						<input type="text" name="t_dueamt_3rd" value="{$dt_arr.dueamt_3rd}" size="30" onChange="audit_money(this)" {if $ugs.v_pay.v eq 0} style="visibility:hidden"{/if}  {if $ugs.v_pay.v eq 1 && $ugs.v_pay.m eq 0 && ($dt_arr.dueamt_3rd gt 0 || $ugs.v_pay.i eq 0)} disabled="disabled" {/if}>
					</td>
				</tr>																
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Notes:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven"><textarea name="t_note" style="width:100%; height:100px;">{$dt_arr.note}</textarea></td>
				</tr>				
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>										
			</table>
</form>	
{literal}
<script type="text/javascript">
	$('#t_duedate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }); 
	
	$('#t_step').change(function(){
		//$('#t_party option[step='+$(this).val()+']').attr('selected', true);
		$('#t_party').val($(this).find('option:selected').attr('data-party'));
	});       
</script>
{/literal}	
</body>
</html>