<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="tid" value="{$tid}">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr class="bordered_2">
			<td colspan="6" class="whitetext" align="center" style="padding:5,5,5 ">Task List </td>				
	</tr>
	<tr class="greybg">
			<td align="left" colspan="6">
				<input type="radio" name="t_type" value="1" {if $isFrom eq 1} checked {/if} onClick="this.form.submit();"><strong>Receive</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="t_type" value="0" {if $isFrom eq 0} checked {/if} onClick="this.form.submit();"><strong>Assigned</strong>										
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="Add Task" onClick="openModel('task_process.php?tid=0',screen.width*5/7,screen.height*5/7, 'NO', 'form1')">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="Delete Task" onClick="this.form.submit();">
			</td>							
	</tr>
</table>	

{foreach key=userid item=varr from=$tasks}
<div>
	<fieldset>
		<legend class="green">{$users[$userid]}</legend>
		<table border="0" cellpadding="1" cellspacing="1" width="100%">								  
			<tr align="center" class="totalrowodd">
				<td width="1%"><input type="checkbox" onClick="selectAll('del_task[]', this)"></td>
				<td width="2%"></td>
				<td  width="10%">Sign Date</td>
				<td width="13%">From</td>
				<td width="22%">Task</td>
				<td>Detail</td>
				<td width="10%">Due Date</td>
				<td width="10%">Due Hour</td>
			</tr>
			{foreach key=id item=arr from=$varr}
			<tr align="center" class="roweven">
				<td ><input type="checkbox" name="del_task[]" value="{$id}"></td>
				<td ><span style="font-size:14px;font-weight:bolder; color:{if $arr.done}#999999{else}#990000{/if}">{if $arr.done eq 1}&radic;{else}?{/if}</span></td>
				<td stytle="color:{if $arr.done}#999999{/if};">{$arr.date}</td>
				<td stytle="color:{if $arr.done}#999999{/if};">{$users[$arr.from]}</td>
				<td stytle="color:{if $arr.done}#999999{/if};" style="cursor:pointer" onClick="openModel('task_process.php?tid={$id}',700,400,'NO', 'form1')">{$arr.task}</td>
				<td stytle="color:{if $arr.done}#999999{/if};">{$arr.detail}</td>
				<td {if $arr.done eq 0 && $arr.due le $today}style="color:#990000;font-weight:bolder; "{/if}>{$arr.due}</td>
				<td {if $arr.done eq 0 && $arr.due le $today}style="color:#990000;font-weight:bolder; "{/if}>{$arr.duehour}</td>				
			</tr>
			{/foreach}		
    </table>											
	</fieldset>
</div>												
{/foreach}
</form>	