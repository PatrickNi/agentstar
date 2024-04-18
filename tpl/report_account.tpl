<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" target="_self" method="post">
<table align="center" width="100%"  class="graybordertable" cellpadding="5" cellspacing="1" border="0">
	<tr class="bordered_2">
		<td align="center">
			Client-Account List				
		</td>
	</tr>
	<!--<tr class="title">
		<td class="highyellow"></td>
	</tr>-->			
</table>
<table align="center" width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr class="title">
	    <td width="20%"  nowrap="nowrap">Client Name</td>
		<td width="10%"  nowrap="nowrap">Category</td>
		<td width="10%"  nowrap="nowrap">Subclass</td>
		<td width="30%">Total Amount</td>
		<td width="30%">Balance</td>
  	</tr>
	{foreach key=visaid item=arr from=$reports}
	<tr class="{cycle values='rowodd, roweven'}">
		<td style="text-decoration:underline; cursor:pointer" onClick="window.open('redir.php?t=va&cid={$arr.clientid}&vid={$visaid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$arr.client}</td>
		<td>{$catarr[$arr.cateid]}</td>
		<td>{$subarr[$arr.subclassid]}</td>		
		<td>{$arr.amount|string_format:"%.2f"}</td>
		<td>{$arr.balance|string_format:"%.2f"}</td>
	</tr>
	{/foreach}
</table>
</form>
</body>
</html>
