<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="aid" value="{$aid}">
<input type="hidden" name="pid" value="{$pid}">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="5"><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='agent_add.php';this.form.submit();" value="Go back to the agent detail">	    &nbsp;&nbsp;
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="5" style="padding:3 ">Agent Process 
			<input type="button" value="add new" style="font-weight:bold;" onClick="openModel('agent_process_dt.php?&aid={$aid}&isNew=1',500,380,'NO', 'form1')" {if $ugs.a_proc.i eq 0} disabled="disabled" {/if}>	  
		</td>
	</tr>					
	<tr align="center" class="totalrowodd">
		<td width="10%">Date</td>
		<td width="30%">Subject</td>
		<td width="40%">Details</td>
		<td width="10%">Due Date</td>
		<td width="10%">Insert</td>
	</tr>
	{foreach key=id item=arr from=$process_arr}
	<tr align="center" class="roweven">
		<td><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span>{$arr.date}</td>
		<td><span style="cursor:pointer; text-decoration:underline;" onClick="openModel('agent_process_dt.php?pid={$id}&aid={$aid}',500,380,'NO', 'form1')">{$arr.subject}</span></td>
		<td>{$arr.detail|truncate:20:"...":true}</td>
		<td>{$arr.due}</td>
		<td><img src="../images/arr_down.gif" style="cursor:pointer" onClick="openModel('agent_process_dt.php?pid={$id}&aid={$aid}&isNew=1',500,380,'NO', 'form1')"></td>
	</tr>
	{/foreach}
</table>
</form>
</body>	
</html>