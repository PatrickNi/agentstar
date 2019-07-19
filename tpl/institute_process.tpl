<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="{$sid}">
<input type="hidden" name="pid" value="{$pid}">
<input type="hidden" name="isNew" value="{$isNew}">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr align="left"  class="bordered_2">
	  <td colspan="5"><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">	    &nbsp;&nbsp;
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="5"> <span class="highyellow">Insititute: {$iname}</span></td>
	</tr>			
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="5" style="padding:3 ">Institute Process 
			<input type="button" value="add new" style="font-weight:bold;" onClick="window.open('institute_proc_dt.php?&sid={$sid}&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth=500,width=380');"{if $ugs.i_proc.i eq 0} disabled="disabled"{/if}>&nbsp;
			<input type="button" value="Attachment" style="font-weight:bold" onClick="window.open('attachment.php?item={$sid}&type={$itemtype}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*3/7 +',width='+screen.width*2/7);">
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td width="10%">Date</td>
		<td width="30%">Subject</td>
		<td width="40%">Details</td>
		<td width="10%">Due Date</td>
		<td width="10%">Insert</td>
	</tr>
	{foreach key=id item=arr from=$process_arr}
	<tr align="center" class="roweven">
		<td><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span>{$arr.date}</td>
		<td><span style="cursor:pointer; text-decoration:underline;" onClick="{if $ugs.i_proc.m eq 1}openModel('institute_proc_dt.php?pid={$id}&sid={$sid}',500,380,'NO', 'form1'){else}alert('Permission denied'){/if}">{$arr.subject}</span></td>
		<td>{$arr.detail|truncate:20:"...":true}</td>
		<td>{$arr.due}</td>
		<td><img src="../images/arr_down.gif" style="cursor:pointer" onClick="{if $ugs.i_proc.i eq 1}openModel('institute_proc_dt.php?pid={$id}&sid={$sid}&isNew=1',500,380,'NO', 'form1'){else}alert('Permission denied'){/if}"></td>
	</tr>
	{/foreach}
</table>
</form>	
</body>
</html>