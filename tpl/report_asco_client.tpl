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
	<tr align="left"  class="bordered_2" >
		<td class="whitetext" style="padding:3 ">
		<input type="button" value="Go back to Assessment" style="font-weight:bold;" onClick="javascrtipt:this.form.action='visa_abody.php';this.form.submit();">&nbsp;&nbsp;
		<span class="highlighttext">Assessment: {$assename}</span>&nbsp;&nbsp;<span class="highlighttext">ASCO: {$asconame}</span>	  	  
		</td>
	</tr>
	 <tr>
	 	<td align="left" class="greybg"><span class="highyellow">Total Apply Visas: {$page_url}</span></td>
	 </tr>		
	{foreach key=cid item=arr from=$ascoarr}
	<tr class="totalrowodd">
		<td>{$clientarr.$cid}</td>
	</tr>
	{foreach key=vid item=varr from=$arr}
	<tr class="roweven">
		<td><span  style="padding-left:40; cursor:pointer;{if $darr.key eq $step2}color:#33FF00;{/if}" onClick="window.open('redir.php?t=vs&vid={$vid}&cid={$cid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$varr.visa}-{$varr.class} Expire Date: {$varr.epd}</span></td>
	</tr>
	{/foreach}
	{/foreach}
</table>
</form>
</body>
</html>
