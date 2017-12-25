<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return form_audit('form1')">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="vid" value="{$vid}">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Client Account Service&nbsp;&nbsp;&nbsp;&nbsp;
		<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="openModel('client_account_detail.php?cid={$cid}&vid={$vid}',500,400,'NO', 'form1')">add payment</span>
		 </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Type: {$client.type}</span>&nbsp;&nbsp; </td>
	</tr>			
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<td >Due Steps</td>
					<td >Due Amount</td>
					<td >Total Paid</td>
					<td >Balance</td>
					<td >Due Date</td>
				</tr>
				{foreach key=id item=arr from=$account_arr}
				<tr align="center" class="roweven">
					<td style="text-decoration:underline; cursor:pointer" onClick="openModel('client_account_detail.php?vid={$vid}&aid={$id}&cid={$cid}',500,400,'NO', 'form1')" >{$arr.step}</td>
					<td >{$arr.dueamt|string_format:"%.2f"}</td>
					<td ><span {if $ugs.p_h.v eq 1}style="text-decoration:underline; cursor:pointer;" title="payment history" onClick="openModel('client_payment.php?aid={$id}',700,300,'NO', 'form1')" {/if}>{$arr.paid|string_format:"%.2f"}</span></td>
					<td >{if ($arr.duedate eq '' || $arr.duedate eq '0000-00-00') && $arr.dueamt gt 0}0.00{else}{$arr.dueamt-$arr.paid|string_format:"%.2f"}{/if}</td>
					<td >{$arr.duedate}</td>
				</tr>
				{/foreach}
			</table>
		</td>
	</tr>
</table>
</form>	
</body>
</html>