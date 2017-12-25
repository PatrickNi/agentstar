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

<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="aid" value="{$aid}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1" >
	<tr align="left"  class="bordered_2">
	  <td colspan="4">
	  	<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='agent_add.php';this.form.submit();" value="Go back to the agent detail">
		&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
	  </td>
	  <td align="right" colspan="8">
	 		<strong>From: &nbsp;</strong><input type="text"	 name="t_fdate" id="t_fdate" value="{$from}" onChange="audit_date(this)">	  
            &nbsp;&nbsp;
			<strong>To: &nbsp;</strong><input type="text"	 name="t_tdate" id="t_tdate" value="{$to}" onChange="audit_date(this)">&nbsp;&nbsp;
           
			<input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
	  </td>
	</tr>
	<tr align="left" class="greybg">
		<td colspan="12" class="title">{$page_url}&nbsp;&nbsp;&nbsp;&nbsp;Student: {$totals.total}&nbsp;&nbsp;&nbsp;&nbsp; Offer: {$totals.offer}&nbsp;&nbsp;&nbsp;&nbsp; Coe: {$totals.coe}</td>
	</tr>
	<tr align="center" class="title" style="font-weight:bold ">
		<td width="11%">First semester start date</td>
		<td colspan="2">Students</td>
		<td width="8%">Offer</td>
		<td width="8%">Coe</td>
		<td width="12%">Institute</td>
		<td width="17%">Course</td>
		<td width="16%">Major</td>
		<td width="9%">Course Consultant</td>
		<td width="6%">{if $ugs.a_rev.v eq 1}Payable Co-Comm{/if}</td>
		<td width="6%">{if $ugs.a_rev.v eq 1}Paid Amount{/if}</td>
	</tr>
	{foreach key=id item=arr from=$student_arr}
	<tr align="center" class="{cycle values='rowodd,roweven'}">
		<td>{$arr.coedate}</td>
		<td colspan="2" style="cursor:pointer;text-decoration:underline"onClick="openExModel('client_course.php?cid={$arr.cid}',800,600,'NO', 'form1')">{$arr.lname} {$arr.fname}</td>
		<td>{if $arr.offer gt 0}yes{else}no{/if}</td>
		<td>{if $arr.coe gt 0}yes{else}no{/if}</td>
		<td>{$schools[$arr.school]}</td>
		<td>{$courses[$arr.school][$arr.course]}</td>
		<td>{$majors[$arr.course][$arr.major]}</td>
		<td>{$users[$arr.cuser]}</td>
		<td>{if $ugs.a_rev.v eq 1}{$arr.ccomm}{/if}</td>
		<td>{if $ugs.a_rev.v eq 1}{$arr.pcomm}{/if}</td>					
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