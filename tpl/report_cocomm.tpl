<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" action="">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="bordered_2" >
		<td class="whitetext" style="padding:3 ">Co-Commission List
		&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
		</td>
	</tr>
	 <tr>
	 	<td align="left" class="greybg"><span class="highyellow">Total Semensters: {$total_num}</span></td>
	 </tr>		
	{foreach key=aid item=ag_name from=$agents}
	{if isset($semprocs[$aid])}
		<tr class="totalrowodd">
			<td>{$ag_name}</td>
		</tr>
		{foreach key=cid item=arr from=$semprocs[$aid]}
		{foreach key=ccid item=sems from=$arr.course}
		{foreach key=semid item=darr from=$sems}
		<tr class="roweven">
			<td><span  style="padding-left:40; cursor:pointer;{if $darr.date != ""}color:#33FF00;{/if}" onClick="window.open('client_course_sem.php?courseid={$ccid}&cid={$cid}&semid={$semid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$arr.name}&nbsp;&nbsp;<em>({$darr.desc})</em></span></td>
		</tr>
		{/foreach}
		{/foreach}
		{/foreach}
	{/if}
	{/foreach}
</table>
</form>
</body>
</html>
