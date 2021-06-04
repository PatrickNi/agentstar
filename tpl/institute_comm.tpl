<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Institute Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" >{$error_js}</script>

<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="{$sid}">
<input type="hidden" name="cid" value="{$cid}">
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
		<td class="whitetext" colspan="7" style="padding:3 ">Institute Commission 
			<input type="submit" value="Add New" style="font-weight:bold;" onClick="this.form.isNew.value='block'" {if $ugs.i_comm.i eq 0} disabled="disabled"{/if}>
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td>Start Date</td>
		<td>End Date</td>
		<td>Qualification<br>Major<br><hr>Course</td>
		<td>Commission Rate</td>
		<td >Bouns</td>
		<td>Through</td>
		<td>Action</td>
	</tr>
	{foreach key=id item=arr from=$comm_arr}
	<tr align="center" class="roweven">
	    <td>{$arr.startdate}</td>
		<td>{$arr.enddate}</td>
		<td>{$qual_arr[$arr.qual]}<br>{$major_arr[$arr.major]}<br><hr>{$arr.course}</td>
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
			<td width="20%" align="left" class="rowodd"><strong>Start Date:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input autocomplete="off" type="text" id="t_fd" name="t_fd" value="{$dt_arr.startdate}" size="30"/>
			</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Start Date:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input autocomplete="off" type="text" id="t_ed" name="t_ed" value="{$dt_arr.enddate}" size="30"/>
			</td>
		</tr>

          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
				<select name="t_qual">
                	{foreach key=id item=qual from=$qual_arr}
						<option value="{$id}" {if $id eq $dt_arr.qual} selected {/if}>{$qual}</option>
					{/foreach}
                	<option value="0" selected>All</option>
                </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
				<select name="t_major">
					{foreach key=id item=major from=$major_arr}	
	                    <option value="{$id}" {if $id eq $dt_arr.major} selected {/if}>{$major}</option>
                	{/foreach}
                	<option value="0" selected>All</option>                 
              </select>
            </td>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Course:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_course" value="{$dt_arr.course}" size="50";></td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Commission Rate:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_rate" value="{$dt_arr.rate}" size="50";></td>
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
{literal}
<script type="text/javascript">
	$('#t_fd').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_ed').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}	
</html>