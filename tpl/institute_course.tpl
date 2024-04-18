<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" method="post" target="_self">
<input type="hidden" name="sid" value="{$iid}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="5">
		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>	
	</tr>
	<tr align="center"  class="bordered_2" >
		<td class="whitetext" colspan="5" style="padding:3 ">Institute Course</td>
	</tr>	
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="5"> <span class="highyellow">Insititute: {$iname}</span>&nbsp;<input type="button" value="add qualification" onClick="window.open('institute_qual.php?iid={$iid}','_blank','alwaysRaised=yes,height=150,width=350, location=no');" {if $ugs.i_course.i eq 0} disabled="disabled" {/if}></td>
	</tr>			

</table>	
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	{foreach key=qualid item=name from=$quals}
	<tr class="totalrowodd">
            <td><span  onClick="{if $ugs.i_course.m eq 1}window.open('institute_qual.php?id={$qualid}&iid={$iid}','_blank','alwaysRaised=yes,height=150,width=350, location=no');{else}alert('Permission denied');{/if}" style="cursor:pointer;">{$name}</span></td>
		<td><input type="button" value="add major" onClick=" window.open('institute_major.php?qual={$qualid}','_blank','alwaysRaised=yes,height=150,width=350, location=no')" {if $ugs.i_course.i eq 0} disabled="disabled" {/if}></td>
	</tr>
	{foreach key=majorid item=name from=$majors[$qualid]}
	<tr class="roweven">

		<td colspan="2"><span onClick="{if $ugs.i_course.m eq 1}window.open('institute_major.php?id={$majorid}&qual={$qualid}','_blank','alwaysRaised=yes,height=150,width=350, location=no');{else}alert('Permission denied');{/if}" style="padding-left:50; cursor:pointer; text-decoration:underline" >{$name}</span></li></td>
	</tr>
	{/foreach}
	{/foreach}
</table>
</form>
</body>
</html>
