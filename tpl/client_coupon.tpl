<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="sid" value="{$sid}">
<table align="center" width="100%"  class="graybordertable" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="5">
		{if $ugs.b_service.v eq 1}
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input name="button" type="button"  style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" disabled value="Coupons" onClick="javascript:this.form.action='client_coupon.php';this.form.submit();">&nbsp;&nbsp;
		{/if}          
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="5" style="padding:3 ">Coupons
        <span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_coupon_detail.php?&cid={$cid}&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+450 +',width='+550)">add new</span>    
        </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="5"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span></td>
	</tr>	
	<tr align="center" class="totalrowodd">
		<td width="30%">Title</td>
		<td width="15%">Start Date</td>
        <td width="15%">End Date</td>
        <td width="20%">Amount</td>
        <td width="20%">Status</td>
	</tr>
	{foreach key=id item=arr from=$coupons}
	<tr align="center" class="roweven">
		<td>{$arr.title}</td>
		<td>{$arr.sdate}</span></td>
		<td>{$arr.edate}</td>
		<td align="right">${$arr.amount}</td>
        <td>{$arr.status}</td>
	</tr>
	{/foreach}
</table>	
</form>	
</body>
</html>