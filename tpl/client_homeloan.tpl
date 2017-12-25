<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Home Loan Service</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return form_audit('form1')">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="hid" value="{$hid}">
<input type="hidden" name="hCancel" value="0">
<table align="center" class="graybordertable" width="100%" cellpadding="0" cellspacing="0">
	<tr align="left"  class="bordered_2">
		<td colspan="9">
		 {if $ugs.b_service.v eq 1}
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
		{/if}
        {if in_array('study', $client_type) && $ugs.c_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('immi', $client_type) && $ugs.v_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('homeloan', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        {/if}		
        {if in_array('legal', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_legal.php';this.form.submit();" value="Legal Service">
        &nbsp;&nbsp; 
        {/if}            
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="9" style="padding:3 ">Home Loan Service
			&nbsp;&nbsp;&nbsp;&nbsp;
         {if $ugs.v_service.i eq 1}
			<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_homeloan_detail.php?cid={$cid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">add new</span>		
         {/if}
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="9"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span>&nbsp;&nbsp; </td>
	</tr>		
	<tr align="center" class="totalrowodd">
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
		<td class="border_1"><span style="{if $arr.active neq 2}font-weight:bold; color:#0066FF; {/if}cursor:pointer;" onClick="window.open('client_homeloan_detail.php?cid={$cid}&hid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$lend_arr[$arr.lid].name}&nbsp;&nbsp;</span></td>
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