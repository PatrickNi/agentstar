<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js"></script>
{literal}
<script type="text/javascript">
var hiddencomm = 1;
function ShowComm() {
	obj = document.getElementsByTagName('TD');
	if(obj.length < 0)
	{
		return false;
	}
	for(i=0; i<obj.length; i++)
	{
		if(obj[i].id == "ShowComm")
		{
			if(hiddencomm == 1)
			{
				obj[i].style.visibility = 'visible';
			}
			else 
			{
				obj[i].style.visibility = 'hidden';
			}
		}
	}
	if(hiddencomm == 1)
	{	
		hiddencomm = 0;
	}
	else 
	{
		hiddencomm = 1;
	}
}
</script>
{/literal}
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return form_audit('form1')">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="courseid" value="{$course_id}">
<input type="hidden" name="hCancel" value="0">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
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
		<td class="whitetext" colspan="2" style="padding:3 ">
			Client Apply Course &nbsp;&nbsp;&nbsp;
            {if $ugs.c_service.i eq 1}
			<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_course_detail.php?cid={$cid}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5)">new course</span>		
            {/if}
            </td>		
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span></td>
	</tr>
	 <tr class="greybg" align="center">
	   <td align="left" colspan="2">
		<!--
	   	<strong>Course-consulant:</strong>&nbsp;&nbsp;
		{if $ugs.c_user.v eq 1 && $ugs.c_user.m eq 0 && ($client.cuser gt 0 || $ugs.c_user.i eq 0)}<input type="hidden" name="t_cuser" value="{$user_id}">{/if}		  
		<select name="t_cuser" {if $ugs.c_user.v eq 0} style="visibility:hidden"{/if} {if $ugs.c_user.v eq 1 && $ugs.c_user.m eq 0 && ($client.cuser gt 0 || $ugs.c_user.i eq 0)} disabled="disabled" {/if}>		  
			  <option value="0" selected>choose a user</option>
			{foreach key=uid item=user_name from=$user_arr}
			  <option value="{$uid}" {if $client.cuser eq $uid} selected {/if}>{$user_name}</option>
			{/foreach}

		</select>&nbsp;&nbsp;&nbsp;&nbsp;

	   <strong>Course Visit Date:</strong>&nbsp;&nbsp;
	   {if $ugs.c_user.v eq 1 && $ugs.c_user.m eq 0 && ($coursecount gt 0 || $ugs.c_user.i eq 0)}<input type="hidden" name="t_first" value="{$client.cvdate}"> {/if}
	    <input type="text" name="t_first" id="t_first" onchange="audit_date(this)"  value="{$client.cvdate}"  {if $ugs.c_user.v eq 0} style="visibility:hidden"{/if} {if $ugs.c_user.v eq 1 && $ugs.c_user.m eq 0 && ($client.cvdate != "" || $ugs.c_user.i eq 0)} disabled="disabled" {/if}>&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="submit" name="bt_name" value="Save" style="font-weight:bold ">
		-->
        {if $ugs.c_service.i eq 1}
        &nbsp;&nbsp;&nbsp;
        <input type="button" name="bt_name" value="Show comm" style="font-weight:bold" onClick="ShowComm()">
        {/if}
	   </td>
	</tr>		
	<tr>
		<td align="left" valign="top">
			<!--<fieldset>
			<legend class="green">{$name|upper}</legend>-->
			<div style="width:100%; overflow-X:scroll;">
			<table border="0" cellpadding="0" cellspacing="0" width="200%">
				<tr align="center" class="totalrowodd">
					<td class="border_1" width="15%">Institute</td>
					<td class="border_1" width="5%">Qualification</td>
					<td class="border_1" width="5%">Major</td>
					<td class="border_1" width="5%">Consultant</td>
					<td class="border_1" width="5%">Verify<br>Migration</td>
					<td class="border_1" width="5%">Consultant Date</td>							
					<td class="border_1" width="5%">Course Start<br> Date</td>
					<td class="border_1" width="5%">Course Complete<br>  Date</td>
					{foreach key=id item=col from=$col_arr}
						<td class="border_1" width="7%">{$col}</td>
					{/foreach}					
					<td class="border_1" width="7%">Tution Fee</td>
					<td class="border_1" width="7%">Duration</td>
                    <td class="border_1" width="7%">&nbsp;</td>
				</tr>
				{foreach key=id item=arr from=$course_arr}				
				<tr align="center" class="roweven" {if $arr.active eq 2} style="background-color:#E9E8DA; font-style: italic "{/if}>
					<td class="border_1">

							<span style="{if $arr.active neq 2}font-weight:bold; color:#0066FF; {/if}cursor:pointer;"  onClick="{if $show_detail eq 1}window.open('client_course_detail.php?cid={$cid}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5){else}alert('Permission denied'){/if}">{if $arr.school eq ''}N/A{else}{$arr.school}{/if}</span>
							{if $arr.active eq 1}
								<br>
								<img src="../images/arr_down.gif" alt  style="cursor:hand" width="8" height="4" border="0" onClick="open_fold('{$id}')">
							{/if}					</td>
					<td class="border_1">{$arr.qualname}</td>
					<td class="border_1">{$arr.majorname}</td>
					<td class="border_1">{$user_arr[$arr.consultant]}</td>
					<td class="border_1">{$user_arr[$arr.vma]},{$arr.vms|ucwords}</td>
					<td class="border_1">{$arr.consultant_date}</td>
					<td class="border_1">{$arr.start}</td>
					<td class="border_1">{$arr.end}</td>	
					{foreach key=col_id item=col from=$col_arr}
						<td class="border_1">
						{if is_array($course_process.$id) && array_key_exists($col_id, $course_process.$id)}
							{$course_process.$id.$col_id}
						{else}
							&nbsp;
						{/if}						</td>	
					{/foreach}
					<td class="border_1">{$arr.fee}</td>
					<td class="border_1">{$arr.due}</td>
                    <td class="border_1">&nbsp;</td>		
				</tr>
				{if $arr.active eq 1}
							<tr name="{$id}" style="display:block;  font-weight:bolder;" align="right" class="yellowbg">
								<td class="border_1"align="center"><span style="text-decoration:underline; font-weight:lighter;cursor:pointer;" onClick="{if $show_detail eq 1}window.open('client_course_sem.php?cid={$cid}&courseid={$id}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5){else}alert('Permission denied');{/if}">add semesters</span></td>
								<td class="border_1">Start Date</td>
								<td class="border_1">Complete Date</td>
								<td class="border_1">Tution Fee</td>								                                
								{if $ugs.c_rev.v eq 1}
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">R Comm</td>
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Issue Invoice Date</td>
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Received Comm</td>
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Received Date</td>
									{if $has_sub_agent eq 1}
										<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Co Comm</td>
										<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Co Date</td>
                                    {/if}
                                    <td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Discount</td>
                                    <td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Discount Pay Day</td>
								{/if}							</tr>
							{foreach key=semid item=semarr from=$course_sem[$id]}
							<tr name="{$id}" class="yellowbg" style="display:block; {if $semarr.done eq 2}background-color: #ceccc5;font-style: italic;{/if}" >
								<td class="border_1"align="center" ><span style="text-decoration:underline; cursor:pointer;" onClick="{if $show_detail eq 1}window.open('client_course_sem.php?cid={$cid}&courseid={$id}&semid={$semid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5){else}alert('Permission denied');{/if}">semester{$semarr.sem}</span></td>
								<td class="border_1" align="right">{$semarr.fdate}</td>
								<td class="border_1" align="right">{$semarr.tdate}</td>
								<td class="border_1" align="right">{$semarr.fee}</td>
                                {if $ugs.c_rev.v eq 1}
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.rcomm}</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.ivdate}</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.redcomm}</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.reddate}</td>
                                    {if $has_sub_agent eq 1}
										<td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.ccomm}</td>
										<td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.cdate}</td>
                                    {/if}
                                    <td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.discount}</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden">{$semarr.discountdate}</td>
                                  {/if}
								</tr>
							{/foreach}
				{/if}		
				{/foreach}
		  </table>
		  </div>
		  <!--</fieldset>
		  <p />-->		</td>
	</tr>
</table>
</form>	
{literal}
<script type="text/javascript">
	$('#t_first').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
</script>
{/literal}	
