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
<input type="hidden" name="courseid" value="{$course_id}">
<input type="hidden" name="hCancel" value="0">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Qualification" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
			{if ($client_type eq 'study' || $client_type eq 'all') && ($user_active eq 'C' ||  $user_active eq 'S')}
				<input style="font-weight:bold;" type="button" value="Apply course" disabled onClick="javascript:this.form.action='client_course.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
			{if ($client_type eq 'immi' || $client_type eq 'all') && ($user_active eq 'V' ||  $user_active eq 'S')}
				<input style="font-weight:bold;" type="button" value="Visa service" onClick="javascript:this.form.action='client_visa.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:3 ">
			Client Apply Course &nbsp;&nbsp;&nbsp;
			<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="openModel('client_course_detail.php?cid={$cid}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">new course</span>
		</td>		
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Type: {$client.type}</span>&nbsp;&nbsp; </td>
	</tr>		
	<tr>
		<td align="left" valign="top">
			<div style="width:100%; overflow-X:scroll;">
			<table border="0" cellpadding="0" cellspacing="0" width="150%">
				<tr align="center" class="totalrowodd">
					<td class="border_1" width="10%">Institute</td>
					<td class="border_1" width="10%">Qualification</td>
					<td class="border_1" width="10%">Major</td>							
					<td class="border_1" width="7%">Course Start<br> Date</td>
					<td class="border_1" width="7%">Course Complete<br>  Date</td>
					{foreach key=id item=col from=$col_arr}
						<td class="border_1" width="7%">{$col}</td>
					{/foreach}					
					<td class="border_1" width="7%">Tution Fee</td>
					<td class="border_1" width="7%">Duration</td>
				</tr>
				{foreach key=id item=arr from=$course_arr}
				<tr align="center" class="roweven" {if $arr.active eq 2} style="background-color:#E9E8DA; font-style: italic "{/if}>
					<td class="border_1">

							<span style="{if $arr.active neq 2}font-weight:bold; color:#0066FF; {/if}cursor:pointer;" onClick="openModel('client_course_detail.php?cid={$cid}&courseid={$id}',screen.width*4/5,screen.height*4/5,'YES', 'form1')">{$arr.school}</span>
							{if $arr.active eq 1}
								<br>
								<img src="../images/arr_down.gif" alt  style="cursor:hand" width="8" height="4" border="0" onClick="open_fold('{$id}')">
							{/if}
					</td>
					<td class="border_1">{$qual_arr[$arr.qual]}</td>
					<td class="border_1">{$major_arr[$arr.major]}</td>
					<td class="border_1">{$arr.start}</td>
					<td class="border_1">{$arr.end}</td>	
					{foreach key=col_id item=col from=$col_arr}
						<td class="border_1">
						{if is_array($course_process.$id) && array_key_exists($col_id, $course_process.$id)}
							{$course_process.$id.$col_id}
						{else}
							&nbsp;
						{/if}	
						</td>	
					{/foreach}
					<td class="border_1">{$arr.fee}</td>
					<td class="border_1">{$arr.due}</td>		
				</tr>
				{if $arr.active eq 1}
				<!--<tr name="{$id}" style="display:block">
					<td colspan="20">
						<table width="100%" cellpadding="0" cellspacing="0">-->
							<tr name="{$id}" style="display:block;  font-weight:bolder;" align="right" class="yellowbg">
								<td class="border_1"align="center"><span style="text-decoration:underline; font-weight:lighter;color:#0066FF; cursor:pointer;" onClick="openModel('client_course_sem.php?cid={$cid}&courseid={$id}',600,700,'NO', 'form1')">add semesters</span></td>
								<td class="border_1">Start Date</td>
								<td class="border_1">Complete Date</td>
								<td class="border_1">Tution Fee</td>
								<td class="border_1">Duration</td>
								{if $adv eq 1}
									<td class="border_1" style="color:#CC3300">R Comm</td>
									<td class="border_1" style="color:#CC3300">Issue Invoice Date</td>
									<td class="border_1" style="color:#CC3300">Received Comm</td>
									<td class="border_1" style="color:#CC3300">Received Date</td>
									<td class="border_1" style="color:#CC3300">Co Comm</td>
									<td class="border_1" style="color:#CC3300">Co Date</td>
								{/if}						
							</tr>
							{foreach key=semid item=semarr from=$course_sem[$id]}
							<tr name="{$id}" style="display:block" class="yellowbg">
								<td class="border_1"align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_course_sem.php?cid={$cid}&courseid={$id}&semid={$semid}',600,700,'NO', 'form1')">semester{$semarr.sem}</span></td>
								<td class="border_1" align="right">{$semarr.fdate}</td>
								<td class="border_1" align="right">{$semarr.tdate}</td>
								<td class="border_1" align="right">{$semarr.fee}</td>
								<td class="border_1" align="right">{$semarr.due}</td>
								{if $adv eq 1}
									<td class="border_1" align="right">{$semarr.rcomm}</td>
									<td class="border_1" align="right">{$semarr.ivdate}</td>
									<td class="border_1" align="right">{$semarr.redcomm}</td>
									<td class="border_1" align="right">{$semarr.reddate}</td>
									<td class="border_1" align="right">{$semarr.ccomm}</td>
									<td class="border_1" align="right">{$semarr.cdate}</td>
								{/if}
							</tr>
							{/foreach}
					  <!--</table>
					</td>	
				</tr>-->
				{/if}		
				{/foreach}
				
		  </table>
		  </div>
		</td>
	</tr>
</table>
</form>	