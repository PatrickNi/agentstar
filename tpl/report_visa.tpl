<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" media="all" href="../js/calendar/calendar.css" title="win2k-cold-1">
<script type="text/javascript" src="../js/calendar/calendar.js"></script>
<script type="text/javascript" src="../js/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="../js/calendar/calendar-setup.js"></script>

<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" target="_self" method="post">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
	<tr class="bordered_2">
		<td align="left">
			 <strong>Start Date</strong>&nbsp;&nbsp;
			<input type="text" name="t_fdate"  id="t_fdate" onChange="audit_date(this)" value="{$fromDay}">&nbsp;&nbsp;&nbsp;&nbsp;
{literal}
<script type="text/javascript">
		Calendar.setup({
		inputField : "t_fdate",
		ifFormat   : "%Y-%m-%d",
		eventName  : "dblclick",
		step       :  1
	});
</script> 
{/literal}   
            
			<strong>Finish Date</strong>&nbsp;&nbsp;
			<input type="text" name="t_tdate" id="t_tdate"onChange="audit_date(this)" value="{$toDay}">&nbsp;&nbsp;&nbsp;&nbsp;	
{literal}
<script type="text/javascript">
		Calendar.setup({
		inputField : "t_tdate",
		ifFormat   : "%Y-%m-%d",
		eventName  : "dblclick",
		step       :  1
	});
</script> 
{/literal}            
			<strong>Paperwork</strong>&nbsp;&nbsp;
			<select name="t_staff" onChange="this.form.bt_name.focus();">
				{foreach key=user_id item=user_name from=$slUsers}
					<option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>
				{/foreach}
				{if $isView eq 1}
					<option value="all" {if $staffid eq 'all'} selected {/if}>All Staff</option>
				{/if}
			</select>&nbsp;&nbsp;&nbsp;&nbsp;				
		    <input type="submit" name="bt_name" value="create report" style="font-weight:bold ">	
			&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">				
		</td>
	</tr>
	<tr class="title">
		<td class="highyellow">
			Total Open Case: {$all.open}&nbsp;&nbsp;Total Close Case: {$all.close}&nbsp;&nbsp;
			{if $ugs.i_rev.v eq 1}Total trust:{$all.amount|string_format:"%.2f"}{/if}
		</td>
	</tr>			
</table>
<table align="center" width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr class="title">
		<td>Category</td>
		<td>Subclass</td>
		<td>Open Cases</td>
		<td>Close Cases</td>
		{if $ugs.i_rev.v eq 1}<td>Total-trust Amount</td>{/if}
  </tr>
{foreach key=catid item=catname from=$catarr}
{foreach key=subid item=subname from=$subarr[$catid]}
	<tr class="{cycle values='rowodd, roweven'}">
		<td>{$catname}</td>
		<td>{$subname}</td>
		<td>{if $review[$catid][$subid].open gt 0}
				<span  style="cursor:pointer; text-decoration:underline" onClick="openModel('report_visa_opencase.php?fd={$fromDay}&td={$toDay}&catid={$catid}&subid={$subid}&sf={$sf}&op=1',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$review[$catid][$subid].open}</span>
			{else}&nbsp;{/if}</td>
		<td>{if $review[$catid][$subid].close gt 0}
				<span  style="cursor:pointer; text-decoration:underline" onClick="openModel('report_visa_opencase.php?fd={$fromDay}&td={$toDay}&catid={$catid}&subid={$subid}&sf={$sf}&op=0',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$review[$catid][$subid].close}</span>
		    {else}&nbsp;{/if}</td>
		{if $ugs.i_rev.v eq 1}<td>{if $review[$catid][$subid].amount-$review[$catid][$subid].paid gt 0}{$review[$catid][$subid].amount-$review[$catid][$subid].paid|string_format:"%.2f"}{else}&nbsp;{/if}</td>{/if}
	</tr>
{/foreach}
{/foreach}
<tr></tr>
</table>
</form>
</body>
</html>
