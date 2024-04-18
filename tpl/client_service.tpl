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
		<td colspan="4">
		{if $ugs.b_service.v eq 1}
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input name="button" type="button"  style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" disabled value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
		{/if}
        {if in_array('study', $client_type) && $ugs.c_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('immi', $client_type) && $ugs.v_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('coach', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service">
        &nbsp;
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
		<td class="whitetext" colspan="4" style="padding:3 ">Service
		<input type="button" value="add new" style="font-weight:bold;" onClick="openModel('client_service_dt.php?&cid={$cid}&isNew=1',550,450,'NO', 'form1')"></td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="4"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span></td>
	</tr>	
	<tr align="center" class="totalrowodd">
		<td width="10%">Date</td>
		<td width="25%">Subject</td>
		<td>Detail</td>
		<td width="10%">Due Date</td>
	</tr>
	{foreach key=id item=arr from=$services}
	<tr align="center" class="roweven">
		<td><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span>{$arr.date}</td>
		<td><span style="cursor:pointer; text-decoration:underline;" onClick="openModel('client_service_dt.php?sid={$id}&cid={$cid}',550,450,'NO', 'form1')">{$arr.subject}</span></td>
		<td>{$arr.detail|truncate:30:"...":true}</td>
		<td>{$arr.due}</td>
	</tr>
	{/foreach}
</table>	
</form>	
</body>
</html>