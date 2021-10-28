<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" src="../js/audit.js"></script>

<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="aid" value="{$aid}">
<input type="hidden" name="is_amb" value="{$is_global_ambassador}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1" >
	<tr align="left"  class="bordered_2">
	  <td colspan="8">
	  	{if $is_global_ambassador}
			<span class="highyellow">Agent: {$agent_arr[$aid].name}</span>&nbsp;&nbsp;
        </select>        
	  	{else}
	  		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='agent_add.php';this.form.submit();" value="Go back to the {if $agent_arr[$aid].cate eq 'student'}assistant{else}agent{/if} detail">
			&nbsp;&nbsp;&nbsp;&nbsp;
	   		<input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
	  	{/if}
	  </td>
	</tr>
    <tr align="center" class="totalrowodd">
        <td class="border_1">Client</td>
		<td class="border_1">Visa</td>
		<td class="border_1">Visa Subclass</td>
		<!--
		<td class="border_1">On Shore<br>/Off Shore</td>
		-->
		<td class="border_1">Agreement Date</td>
		<td class="border_1">Apply Date</td>
		<td class="border_1">Grant Date</td>
		<td class="border_1">Agreement Staff</td>
		<td class="border_1">Visa Paperwork</td>
	</tr>
	{foreach key=id item=arr from=$visa_arr}
	<tr align="center" class="roweven" >
        <td class="border_1">{$arr.cname}</td>
		<td class="border_1"><span style="{if $arr.active neq 2}font-weight:bold; color:#0066FF; {/if}cursor:pointer;" onClick="{if $arr.vuser eq $uid || $arr.auser eq $uid || $ugs.v_track.v eq 1 }window.open('client_visa_detail.php?cid={$arr.cid}&vid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7){else}alert('Permission denied');{/if}">{$arr.visa}&nbsp;&nbsp;</span></td>
		<td class="border_1">{$arr.class}</td>
		<!--
		<td class="border_1">{if $arr.shore eq 1} onshore {else} offshore {/if}</td>
		-->
		<td class="border_1">{$arr.adate}</td>
		<td class="border_1">{if array_key_exists($id, $procs)}{$procs[$id].lodge}{/if}</td>
		<td class="border_1">{if array_key_exists($id, $procs) && $procs[$id].grant != ""}{$procs[$id].grant}{else}{$arr.status}{/if}</td>
		<td class="border_1">{$user_arr[$arr.auser]}</td>
		<td class="border_1">{$user_arr[$arr.vuser]}</td>						
	</tr>
	{/foreach}
</table>
</form>	
</body>
</html>