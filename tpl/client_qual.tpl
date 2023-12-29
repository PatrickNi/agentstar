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
<table align="center" width="100%"  class="graybordertable" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
		{if $ugs.b_service.v eq 1}
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input name="button" type="button"  style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" disabled value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
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
			<td class="whitetext" style="font-size:16px ">Client Qualification
				<input type="button" value="add new" style="font-weight:bold;" onclick="window.open('client_qual_dt.php?&cid={$cid}&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')">&nbsp;&nbsp;
				<input type="button" value="Attachment" style="font-weight:bold" onClick="window.open('attachment.php?item={$cid}&type={$itemtype}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*6/7 +',height=' + screen.height*4/7)">
			</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px "> 
			<span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span>&nbsp;&nbsp; 
		</td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<td width="10%" >Start date</td>
					<td width="10%">Complete date</td>
					<td width="15%" >School Name </td>
					<td width="15%">School Country</td>
					<td width="*" >Qualification</td>
					<td width="12%" >Major</td>
                    <td width="5%" >Completed</td>
					<td width="5%" >Full/Part(time)</td>   
					<td width="10%" >Note</td>   
					<td width="5%">Insert</td>
				</tr>
				{foreach key=id item=arr from=$show_arr}
				<tr align="center" class="roweven">
					<td>{$arr.fdate}</td>
					<td >{$arr.tdate}</td>
					<td ><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_qual_dt.php?qid={$id}&cid={$cid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')">{$arr.school}</span></td>
					<td >{$country_arr[$arr.country]}</td>
					<td>{$arr.qual}</td>
					<td >{$arr.major}</td>
					<td >{$arr.status}</td>
                    <td >{if $arr.fulltime == 1}Fulltime{else}Parttime{/if}</td>  
					<td >{$arr.note}</td>                   
					<td><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_qual_dt.php?qid={$id}&cid={$cid}&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')"></td>
				</tr>
				{/foreach}
			</table>
		</td>
	</tr>
</table>
</form>	
</body>
</html>