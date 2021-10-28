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
	  <td colspan="10">
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
		<td class="border_1">Lending Institute</td>
		<td class="border_1">Category</td>
		<td class="border_1">Property Price</td>
		<td class="border_1">Loan Amount</td>
        <td class="border_1">Agreement Staff</td>
        <td class="border_1">Refer Loan</td>
		<td class="border_1">Loan Approed</td>
		<td class="border_1">Load Settled</td>
        <td class="border_1">Comm Received</td>
	</tr>
	{foreach key=id item=arr from=$loan_arr}
	<tr align="center" class="roweven" >
		<td class="border_1">{$arr.fname} {$arr.lname}</td>
		<td class="border_1"><span style="{if $arr.active neq 2}font-weight:bold; color:#0066FF; {/if}cursor:pointer;" onClick="window.open('client_homeloan_detail.php?cid={$arr.cid}&hid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$lend_arr[$arr.lid].name}&nbsp;&nbsp;</span></td>
		<td class="border_1">{$lend_arr[$arr.lid].cate}</td>
		<td class="border_1">{$arr.price|number_format:2:'.':','}</td>
		<td class="border_1">{$arr.amount|number_format:2:'.':','}</td>
        <td class="border_1">{$user_arr[$arr.user]}</td>
		<td class="border_1">{$process[$id].Referhomeloan.date}</td>
		<td class="border_1">{$process[$id].Loanapproved.date}</td>
        <td class="border_1">{$process[$id].Loansettled.date}</td>
        <td class="border_1">{$process[$id].Commissionreceived.date}</td>						
	</tr>
	{/foreach}
</table>
</form>	
</body>
</html>