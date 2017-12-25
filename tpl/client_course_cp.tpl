<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:3 ">
			Client Apply Course </td>		
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Type: {$client.type}</span>&nbsp;&nbsp; </td>
	</tr>
		
	<tr>
		<td align="left" valign="top">
			<!--<fieldset>
			<legend class="green">{$name|upper}</legend>-->
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
			{foreach key=catid item=name from=$cate_arr}
				{if array_key_exists($catid, $course_arr)}				
					{foreach key=id item=arr from=$course_arr[$catid]}
					<tr align="center" class="roweven" {if $arr.active eq 2} style="background-color:#E9E8DA; font-style: italic "{/if}>
						<td class="border_1">
	
								<span style="{if $arr.active neq 2}font-weight:bold; color:#0066FF; {/if}cursor:pointer;" onClick="openModel('client_course_detail_cp.php?cid={$cid}&courseid={$id}',screen.width*4/5,screen.height*4/5,'YES', 'form1')">{$arr.school}</span>
								{if $arr.active eq 1}
									<br>
									<img src="../images/arr_down.gif" alt  style="cursor:hand" width="8" height="4" border="0" onClick="open_fold('{$id}')">
								{/if}					</td>
						<td class="border_1">{$arr.qualname}</td>
						<td class="border_1">{$arr.majorname}</td>
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
					</tr>
				{/foreach}
			{/if}	
		{/foreach}	
	 </table>
		  </div>
</td>
	</tr>
</table>
</form>	