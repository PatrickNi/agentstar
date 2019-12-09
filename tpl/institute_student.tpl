<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="{$sid}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1" >
	<tr align="left"  class="bordered_2">
	  <td colspan="2">
	  	<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">
				&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
	  </td>
	  <td align="left" colspan="9">
	 		<strong>From: &nbsp;</strong><input type="text"	 name="t_fdate" value="{$from}" id="t_fdate" >	&nbsp;&nbsp;


			<strong>To: &nbsp;</strong><input type="text"	 name="t_tdate" value="{$to}" id="t_tdate" >&nbsp;&nbsp;&nbsp;&nbsp;
             
			<input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >&nbsp;&nbsp;&nbsp;&nbsp;
			{if $ugs.export.v eq 1}
	  			<input type="submit" value="Export Student Emails" name="bt_export" style="font-weight:bold;">
			{/if}
	  </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="11"> <span class="highyellow">Insititute: {$iname}</span></td>
	</tr>			
	<tr align="left" class="greybg">
		<td colspan="12" class="title">{$page_url}&nbsp;&nbsp;&nbsp;&nbsp;Student: {$totals.total}&nbsp;&nbsp;&nbsp;&nbsp;Offer: {$totals.offer}&nbsp;&nbsp;&nbsp;&nbsp;Coe: {$totals.coe}</td>
	</tr>
	<tr align="center" class="title" style="font-weight:bold ">
		<td width="10%" nowrap="nowrap">First semester start date</td>
		<td colspan="2">Students</td>
		<td width="8%">Offer</td>
		<td width="8%">Coe</td>
		<td width="12%">Course</td>
		<td width="12%">Major</td>
		<td width="9%">Course Consultant</td>
		<td width="8%">{if $ugs.i_rev.v eq 1}Receviable Comm{/if}</td>
		<td width="6%">{if $ugs.i_rev.v eq 1}Received Comm{/if}</td>
	</tr>
	{foreach key=id item=arr from=$student_arr}
	<tr align="center" class="{cycle values='rowodd,roweven'}">
		<td>{$arr.coedate}</td>
		<td colspan="2" style="cursor:pointer;text-decoration:underline"onClick="window.open('client_course_detail.php?cid={$arr.cid}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7);">{$arr.lname} {$arr.fname}</td>
		<td>{if $arr.offer gt 0}yes{else}no{/if}</td>
		<td>{if $arr.coe gt 0}yes{else}no{/if}</td>
		<td>{$courses[$arr.course]}</td>
		<td>{$majors[$arr.course][$arr.major]}</td>
		<td>{$users[$arr.cuser]}</td>
		<td>{if $ugs.i_rev.v eq 1}{$arr.rcomm}{/if}</td>
		<td>{if $ugs.i_rev.v eq 1}{$arr.pcomm}{/if}</td>					
	</tr>
	{/foreach}
</table>
</form>	
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}	
</body>
</html>