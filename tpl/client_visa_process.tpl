<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="vid" value="{$vid}">
<input type="hidden" name="pid" value="{$pid}">
<input type="hidden" name="isNew" value="{$isNew}">
			<table border="0" width="100%" class="graybordertable" cellpadding="3" cellspacing="1">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
							<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
						</td>		
						<td align="center" class="whitetext">Visa Process Detail</td>						
						 <td align="right" width="10%">
							&nbsp;&nbsp;
						</td>
					</tr>				
				</table></td></tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
							{if stripos($subject_arr[$dt_arr.itemid], 'apply') === 0 && $dt_arr.date != "" && $dt_arr.date != '0000-00-00' && $staff_id != 3 && $dt_arr.done eq 1}
								{$dt_arr.date}
								<input type="hidden" name="t_date" value="{$dt_arr.date}">
							{else}
								<input type="text" name="t_date" id="t_date" value="{$dt_arr.date}" autocomplete="off">    
							{/if}             
                    </td>
				</tr>
				{if $isOther eq 1 || ($dt_arr.itemid eq '0' && $isNew neq 1)}
					<tr>
						<td width="19%" align="left" class="rowodd">
							<strong>Additional Step:</strong>
							<br/>
							<button type="button" onclick="add_dha('DHA request')" style="font-size:smaller;">DHA request</button>
							&nbsp;
							<button type="button" onclick="add_dha('Review application')" style="font-size:smaller;">Review application</button>
						</td>
						<td align="left" width="81%" class="roweven">
							<input type="text" name="t_add" id="t_add" value="{$dt_arr.add}" style="width:600px;">
						</td>
					</tr>
				{else}
					<tr>
						<td width="19%" align="left" class="rowodd"><strong>Subject:</strong>&nbsp;&nbsp;</td>
						<td align="left" width="81%" class="roweven">
							<select id="t_subject" name="t_subject" onChange="sl_step()" {if $isNew eq 1}readonly{/if}>
							{foreach key=pid item=process from=$subject_arr}
								{if stripos($process, 'grant') !== false} 
                                     <optgroup label="---------------------------------------">
                                     	<option value="{$pid}" {if $pid eq $dt_arr.itemid} selected {/if}>|------{$process}</option>
                                     	<option value="withdraw"  {if $dt_arr.subject eq 'withdraw'} selected {/if}>|------Withdraw</option>
                                     	<option value="refused" {if $dt_arr.subject eq 'refused'} selected {/if}>|------Refused</option>
                                     	<option value="cancel agreement" {if $dt_arr.subject eq 'cancel agreement'} selected {/if}>|------Cancel Agreement</option>
                                     	<option value="agent stop" {if $dt_arr.subject eq 'agent stop'} selected {/if}>|------Stop Agent</option>
                                     	<option value="declined" {if $dt_arr.subject eq 'declined'} selected {/if}>|------Declined</option>
										<option value="reactive" {if $dt_arr.subject eq 'reactive'} selected {/if}>|------Reactive</option>
                                     </optgroup>
                                {else}
                                     <option value="{$pid}" {if $pid eq $dt_arr.itemid} selected {/if}>{$process}</option>
								{/if}
							{/foreach}
							</select>
								<span id="epd_span" {if stripos($subject_arr[$dt_arr.itemid], 'grant') === false} style="visibility:hidden;" {/if}>
								&nbsp;
								&nbsp;
								Expire Date: <input type="text" name="t_epdate" id="t_epdate" value="{$visa_rs.epd}" size="20" {if stripos($subject_arr[$dt_arr.itemid], 'grant') === false} disabled="disabled"{/if} autocomplete="off">
								</span>								
						</td>
					</tr>
				{/if}										
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_due" value="{$dt_arr.due}" id="t_due" autocomplete="off" >
                     
                    </td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<input type="checkbox" value="1"  name="t_done" {if $dt_arr.done eq 1} checked {/if}>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >	
					</td>
				</tr>	
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_detail" style="width:600px; height:300px;">{$dt_arr.detail}</textarea></td>
				</tr>																						
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>									
			</table>		
</form>	
{literal}
<script type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_due').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_epdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	function sl_step() {
		 if ($("#t_subject").find("option:selected").text().indexOf('grant') != -1) {
		 	$("#epd_span").css("visibility","");
		 	$("#t_epdate").removeAttr("disabled");
		 }
		 else {
		 	$("#epd_span").css("visibility","hidden");
		 	$("#t_epdate").attr("disabled","disabled");
		 }
	}

	function add_dha(str){
		$("#t_add").val(str);
	}
</script>
{/literal}
{$errormsg}