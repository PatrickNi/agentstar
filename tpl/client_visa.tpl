<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" action="" target="_self" method="get">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="vid" value="{$vid}">
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
		<td class="whitetext" colspan="9" style="padding:3 ">Client Visa Service
			&nbsp;&nbsp;&nbsp;&nbsp;
         {if $ugs.v_service.i eq 1}
			<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid={$cid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">add visa</span>		
         {/if}
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="9"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span>&nbsp;&nbsp; </td>
	</tr>		
	<tr align="center" class="totalrowodd">
		<td class="border_1">Visa</td>
		<td class="border_1">Visa Subclass</td>
		<td class="border_1">On Shore<br>/Off Shore</td>
		<td class="border_1">Agreement Date</td>
		<td class="border_1">Apply Date</td>
		<td class="border_1">Grant Date</td>
		<td class="border_1">Agreement Staff</td>
		<td class="border_1">Visa Paperwork</td>
	</tr>
	{foreach key=id item=arr from=$visa_arr}
	<tr align="center" class="roweven" >
		<td class="border_1"><span style="{if $arr.active neq 2}font-weight:bold; color:#0066FF; {/if}cursor:pointer;" onClick="{if $arr.vuser eq $uid || $arr.auser eq $uid || $ugs.v_track.v eq 1 }window.open('client_visa_detail.php?cid={$cid}&vid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7){else}alert('Permission denied');{/if}">{$arr.visa}&nbsp;&nbsp;</span></td>
		<td class="border_1">{$arr.class}</td>
		<td class="border_1">{if $arr.shore eq 1} onshore {else} offshore {/if}</td>
		<td class="border_1">{$arr.adate}</td>
		<td class="border_1">{if array_key_exists($id, $procs)}{$procs[$id].lodge}{/if}</td>
		<td class="border_1">{if array_key_exists($id, $procs) && $procs[$id].grant != ""}{$procs[$id].grant}{else}{$arr.status}{/if}</td>
		<td class="border_1">{$user_arr[$arr.auser]}</td>
		<td class="border_1">{$user_arr[$arr.vuser]}</td>						
	</tr>
	{/foreach}
</table>
</form>	