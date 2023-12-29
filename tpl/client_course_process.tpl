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
<script language="javascript">{$msg}</script>
<body>
<form method="get" name="form1" id="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="courseid" value="{$course_id}">
<input type="hidden" name="pid" value="{$pid}">
<input type="hidden" name="isOther" value="{$isOther}">
		<table border="0" width="100%" cellpadding="3" cellspacing="1">
			<tr class="greybg">
				
			</tr>	
			<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
				<tr align="center"  class="greybg">
					<input type="hidden" id="bt_name" name="bt_name" value="">
					<input type="hidden" id="itemid" name="itemid"  value=0>
					<td align="left" width="10%">
						<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" {if $isapprove eq 0} disabled {/if}>
					</td>	
					<td align="center" class="whitetext">Detail Information</td>
					<td align="right" width="10%">
						{if count($forward_btn) > 1}
							<input type="button" value="Save" style="font-weight:bold" onClick="done_check()">
						{else}
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" {if $isapprove eq 0} disabled {/if}>
						{/if}					
					</td>
				</tr>				
			</table></td></tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven">
                <input type="text" name="t_date" id="t_date" value="{$dt_arr.date}" {if $dt_arr.subject eq 5 && $dt_arr.date neq '' && $dt_arr.date neq '0000-00-00'} disabled {/if}>

                </td>
			</tr>
			{if $isOther eq 1 || $dt_arr.subject eq 0}
				<tr>
					<td width="24%" align="left" class="rowodd"><strong>Additional Step:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="76%" class="roweven">						
						<input type="text" name="t_add" value="{$dt_arr.add}" size="30">
					</td>
				</tr>
			{else}	
				<tr>
					<td width="24%" align="left" class="rowodd"><strong>Subject:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="76%" class="roweven">
						<select name="t_subject" onChange="this.form.t_detail.focus();">
						{foreach key=id item=arr from=$process_arr}
							<option value="{$id}" {if $id eq $dt_arr.subject} selected {/if}>{$arr.name}</option>
						{/foreach}
						</select>
					</td>					
				</tr>
			{/if}	

          {if $ugs.i_tta.v eq 1 && count($agent_arr) > 0}
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>To top-agent :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              {if $ugs.i_tta.i eq 1 || $ugs.i_tta.m eq 1}
               <select name="t_agent">
                	<option value="0" {if $agent_id eq 0 || $agent_id eq ""}selected{/if}>N/A</option>
					{foreach key=ag_id item=ag_name from=$agent_arr}                        
                  		<option value="{$ag_id}" {if $ag_id eq $agent_id} selected {/if}>{$ag_name}</option>
					{/foreach}
              </select>
              {else}
                <input type="hidden" name="t_agent" value="{$agent_id}">
                {$agent_arr[$agent_id]}
              {/if}
            </td>
          </tr>
          {else}
            <input type="hidden" name="t_agent" value="{$agent_id}">
          {/if}

			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><textarea name="t_detail" style="width:300px; height:100px ">{$dt_arr.detail}</textarea></td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_due" id="t_due" value="{$dt_arr.due}" >
 
                </td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven">
						<input type="checkbox" value="1" id="t_done" name="t_done" {if $dt_arr.done eq 1} checked {/if}>
				</td>
			</tr>		

			{if count($forward_btn) > 1}
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Forword Processes:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven">
					{foreach key=id item=name from=$forward_btn}
						<input type="button" value="{$name}" style="font-weight:bold" onClick="save_process({$id})">
						&nbsp;&nbsp;
					{/foreach}
				</td>
			</tr>					
			{/if}									
			<tr class="greybg"><td colspan="2">&nbsp;</td></tr>								
		</table>
</form>	
{literal}
<script type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_due').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	
	function save_process($forward_process_id) {
		if ($('#t_done').is(':checked')) {
			$('#bt_name').val('save');
			$('#itemid').val($forward_process_id);
			$('#form1').submit();
		}
		else {
			alert('Please checked "Done" first!')
		}
	}

	function done_check() {
		if ($('#t_done').is(':checked')) {
			alert('Multi-process cannot "Save" with the "Done" checked!');
		}
		else {
			$('#bt_name').val('save');
			$('#form1').submit();
		}
	}

</script>
{/literal}	