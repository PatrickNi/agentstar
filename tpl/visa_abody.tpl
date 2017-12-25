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
		<td class="whitetext" colspan="3" style="padding:5 ">Assessment Setting
			<input type="button" value="add new" onClick="openModel('visa_abody.php?bid=0&bt_name=edit', 350,150,'NO', 'form1')">
	  </td>
	</tr>	
</table>	
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	{foreach key=id item=name from=$abodys}
	<tr class="totalrowodd">
		<td><span style="text-decoration:underline; cursor:pointer" onClick="openModel('visa_abody.php?bid={$id}&bt_name=edit', 350,150,'NO', 'form1')">{$name}</span></td>
		<td><input type="button" value="add asco" onClick="openModel('visa_abody_asco.php?abodyid={$id}',350,150,'NO', 'form1')"></td>
	</tr>
	{foreach key=ascoid item=name from=$ascos[$id]}
	<tr class="roweven">
		<td ><span onClick="openModel('visa_abody_asco.php?abodyid={$id}&ascoid={$ascoid}',350,150,'NO', 'form1')" style="padding-left:50; cursor:pointer; text-decoration:underline" >{$name}</span></td>
		<td ><a href="report_asco_client.php?abodyid={$id}&ascoid={$ascoid}" target="_self">see client list</a></td>
	</tr>
	{/foreach}
	{/foreach}
</table>
</form>
</body>
</html>
