<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Calendar Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" src="../js/audit.js"></script>

<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="id" value="0">
<input type="hidden" name="t_hour" value="0">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
		<td colspan="2" align="left">
				 Date: <input type="text" id="t_date" value="{$t_date}" name="t_date" alert('please use Query to refresh')" onChange="audit_date(this)" {if $content eq 1}style="font-weight:bolder; background-color:#FFCC99 "{/if}>

                 
                 &nbsp;&nbsp; 
				 Consultar: 
				<select name="t_user" style="overflow: visible !important;" onChange="this.form.action='calendar.php';this.form.submit();" >
					{if $user eq 0}
						<option value="0" selected>select a user</option>
					{/if}
					{foreach key=id item=name from=$user_arr}
						<option value="{$id}" {if $user eq $id && $id ne 0} selected {/if}>{$name}</option>
					{/foreach}
				</select>
				&nbsp; <input type="submit" value="Query"  style="font-weight:bold" >
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Calendar Management </td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr align="center" class="totalrowodd">
					<td class="border_1" width="5%">Time(Hour)</td>
					<td class="border_1" width="70%">Subject</td>				
				</tr>
				{foreach key=hour item=arr from=$calendar_arr}
				<tr align="center" bgcolor="#FFFFD9" style="cursor:pointer; font-weight:bolder; " {if $arr.over neq 1}onClick="window.open('{if $arr.coach != ''}{$arr.coach}{else}calendar_add.php?id={if $arr.done eq 1 || $arr.title neq '' || $arr.over eq 1}{$arr.id}{else}0{/if}&t_date={$t_date}&t_user={$user}&t_hour={$hour}{/if}','_blank','alwaysRaised=yes,scrollbars=yes,ocation=no,width='+screen.width*1/2+',height='+screen.height*1/2)"{/if} >
					<td class="border_1" {if stristr("[0-9][0-9]:00", $hour)}style=" border-top-style: groove; border-top-width:thin"{/if}>{if stristr("[0-9][0-9]:00", $hour)}{$hour}{else}&nbsp;{/if}</td>
					<td class="border_1"style="{if stristr('[0-9][0-9]:00', $hour)} border-top-style: groove; border-top-width:thin;{/if}" bgcolor = "{if $arr.done eq 1}#999999{elseif $arr.title neq '' || $arr.over eq 1}#3A87AD{else}#FFFFD9{/if}">{if $arr.title}{$arr.title}{else}&nbsp;{/if}</td>
				</tr>
				{/foreach}
			</table>
		</td>
	</tr>
</table>
</form>	
{literal}
<script type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, firstDay: 1 });        
</script>
{/literal}