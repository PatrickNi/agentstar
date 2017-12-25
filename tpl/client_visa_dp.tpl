<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return form_audit('form1')">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="vid" value="{$vid}">
<table align="center" class="graybordertable" width="100%" cellpadding="0" cellspacing="0">
	<tr align="left"  class="bordered_2">
		<td colspan="9">
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Qualification" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Visa service" disabled onClick="javascript:this.form.action='client_visa.php';this.form.submit();">&nbsp;&nbsp;
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="9" style="padding:3 ">Client Visa Service</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="9"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Type: {$client.type}</span>&nbsp;&nbsp; </td>
	</tr>	
	<tr align="center" class="totalrowodd">
		<td class="border_1">Visa</td>
		<td class="border_1">Visa Subclass</td>
		<td class="border_1">On Shore / Off Shore</td>
		<td class="border_1">&nbsp;</td>
	</tr>
	{foreach key=id item=arr from=$visa_arr}
	<tr align="center" class="roweven" >
		<td class="border_1">{$arr.visa}</td>
		<td class="border_1">{$arr.class}</td>
		<td class="border_1">{if $arr.shore eq 1} onshore {else} offshore {/if}</td>
		<td class="border_1"><a href="client_visa.php?vid=0&cid={$arr.cid}" style="text-decoration:underline; color:#CC3300; cursor:pointer" target="_self">Dependant</a></td>			
	</tr>
	{/foreach}
</table>
</form>	