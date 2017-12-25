<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" action="">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="bordered_2" >
		<td class="whitetext" style="padding:3 ">Commission
		&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onclick="printPage();"value="Print">
		</td>
	</tr>
	 <tr>
	 	<td align="left" class="greybg"><span class="highyellow">Total Study Clients: {$page_url}</span></td>
	 </tr>		
	{foreach key=cid item=arr from=$semprocs}
	<tr class="totalrowodd">
		<td>{$arr.name}</td>
	</tr>
	{foreach key=ccid item=procs from=$arr.course}
	{foreach key=procid item=darr from=$procs}
	<tr class="roweven">
		<td><span  style="padding-left:40; cursor:pointer;{if $darr.key eq $step2}color:#33FF00;{/if}" onClick="window.open('redir.php?t=comm&semid={$procid}&ccid={$ccid}&cid={$cid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$darr.desc}</span></td>
	</tr>
	{/foreach}
	{/foreach}
	{/foreach}
</table>
</form>
</body>
</html>
