<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" method="post" target="_self">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="center"  class="bordered_2">
		<td class="whitetext" colspan="3" style="padding:5 ">Visa Assessment Sponsor Setting
			<input type="button" value="add new" onClick="openModel('visa_sponsor.php?spid=0&bt_name=edit', 350,150,'NO', 'form1')">
		</td>
	</tr>	
	{foreach key=id item=name from=$sponsors}
	<tr class="{cycle values='rowodd, roweven'}">
		<td><span style="text-decoration:underline; cursor:pointer" onClick="openModel('visa_sponsor.php?spid={$id}&bt_name=edit', 350,150,'NO', 'form1')">{$name}</span></td>
	</tr>
	{/foreach}
</table>	
</form>
</body>
</html>
