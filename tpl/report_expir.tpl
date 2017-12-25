<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" target="_self" method="post">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
<tr><td align="center" class="title" style="font-size:14px; padding:3">Visa Expire Date</td></tr>
</table>
{if $ugs.v_epd.v eq 1}
<div>
	<fieldset>
		<legend class="green">Visa Service</legend>
		<table border="0" cellpadding="1" cellspacing="1" width="100%">								  
			<tr align="center" class="totalrowodd">
				<td>Expire Date </td>
				<td>Last Name</td>
				<td>Firset Name</td>
				<td>Visa Category</td>
				<td>Visa SubClass</td>
			</tr>
			{foreach key=id item=arr from=$visa_expire}
			<tr align="center" class="roweven">
				<td>{$arr.date}</td>
				<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_detail.php?cid={if $arr.main gt 0}{$arr.main}{else}{$arr.cid}{/if}&vid={$arr.vid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$arr.lname}</span></td>
				<td>{$arr.fname}</td>
				<td>{$arr.category}</td>
				<td>{$arr.subclass}</td>
			</tr>
			{/foreach}		
    </table>											
	</fieldset>
</div><br>
{/if}
{if $ugs.b_epd.v eq 1}
<div>
	<fieldset>
		<legend class="green">Service</legend>
		<table border="0" cellpadding="1" cellspacing="1" width="100%">								  
			<tr align="center" class="totalrowodd">
				<td>Expire Date</td>
				<td>Last Name</td>
				<td>Firset Name</td>
				<td>Visa Category</td>
				<td>Visa SubClass</td>
			</tr>
			{foreach key=id item=arr from=$other_expire}
			<tr align="center" class="roweven">
				<td>{$arr.date}</td>
				<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_detail.php?cid={$arr.cid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$arr.lname}</span></td>
				<td>{$arr.fname}</td>
				<td>{$arr.category}</td>
				<td>{$arr.subclass}</td>
			</tr>
			{/foreach}		
    </table>											
	</fieldset>
</div>
{/if}
<p />													
</form>
</body>
</html>
