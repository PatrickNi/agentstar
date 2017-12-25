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
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="isNew" value="{$isNew}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="5">
		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>	
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="5"> <span class="highyellow">Insititute: {$iname}</span></td>
	</tr>			
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="5" style="padding:3 ">Institute Commission 
			<input type="submit" value="Add New" style="font-weight:bold;" onClick="this.form.isNew.value='block'" {if $ugs.i_comm.i eq 0} disabled="disabled"{/if}>
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td >Course</td>
		<td>Commission Rate</td>
		<td >Bouns</td>
		<td>Through</td>
		<td>Action</td>
	</tr>
	{foreach key=id item=arr from=$comm_arr}
	<tr align="center" class="roweven">
		<td>{$arr.course}</td>
		<td >{$arr.rate}</td>
		<td>{$arr.boun}</td>
		<td>{$arr.agent}</td>
		<td>
			<select name="at_{$id}" style="font-size:9px; font-weight:bolder;" {if $arr.done eq 1} disabled {/if}>
				{foreach key=act_id item=act_name from=$act_arr}
                	{if ($ugs.i_comm.m eq 1 && $act_id == 'E') || ($ugs.i_comm.d eq 1 && $act_id == 'D')}
					<option value="{$act_id}">{$act_name}</option>
                    {/if}
				{/foreach}							
			</select>&nbsp;
			<input style="font-weight:bolder;" type="button" {if $arr.done eq 1} disabled {/if} value="OK" onClick="this.form.cid.value={$id};this.form.submit();"> 					
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
			<td width="20%" align="left" class="rowodd"><strong>Course:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_course" value="{$dt_arr.course}"></td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Commission Rate:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_rate" value="{$dt_arr.rate}"></td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Bouns:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_boun" value="{$dt_arr.boun}"></td>
		</tr>				
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Through:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">						
				<select name="t_agent">
				{foreach key=aid item=agent from=$agent_arr}
					<option value="{$aid}" {if $aid eq $dt_arr.agentid} selected {/if}>{$agent}</option>
				{/foreach}
				</select></td>
		</tr>
		<tr align="center"  class="greybg" >
	
			<td colspan="2"><input type="submit" value="Save" name="bt_name" style="font-weight:bold "></td>
		</tr>									
	</table>
</div>			
</form>	
</body>
</html>