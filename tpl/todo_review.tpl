<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" id="form1" target="_self" method="post">
<input type="hidden" id="t_view" name="t_view" value="">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
	<tr><td align="center" class="title" style="font-size:14px; padding:3">
		To-Do List&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onclick="printPage();"value="Print">
	</td></tr>
	{if $ugs.v_service.v eq 1}
	<tr><td align="left"  class="menu" style="cursor:pointer" onClick="t_view.value='v';form1.submit();">Visa List</td></tr>
	{if $viewWhat eq 'v'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td  align="left" nowrap="nowrap">Client Name</td>		
					<td align="left" nowrap="nowrap">Category</td>
					<td align="left" nowrap="nowrap">SubClass</td>
					<td align="left" nowrap="nowrap"width="40%">Process</td>
					<td nowrap="nowrap">Due Date</td>
				</tr>
				{foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
					<td width="2%"><input type="checkbox" onClick="if(this.checked);"></td>
				 	<td  align="left" nowrap="nowrap">{$arr.name}</td>
					<td  align="left"  nowrap="nowrap">{$arr.cate}</td>
					<td  align="left"  nowrap="nowrap">{$arr.class}</td>
					<!--onClick="openModel('client_visa_process.php?pid={$id}&cid={$arr.clientid}&vid={$arr.visaid}',800,560,'NO', 'form1')"-->
					<td   align="left"  nowrap="nowrap" style="{if $arr.islodge eq 1}color:#FF3300;{/if}cursor:pointer; text-decoration:underline" onClick="openClientPage({$arr.clientid});window.open('redir.php?t=vtl&pid={$id}&cid={$arr.clientid}&vid={$arr.visaid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)" >{$arr.item}</td>
					<td nowrap="nowrap" style=" color:#FF3300; font-weight:bold">{$arr.due}</td>
				 </tr>
				{/foreach}	
			</table>
	</td></tr>{/if}{/if}		
	{if $ugs.c_service.v eq 1}
	<tr ><td class="menu"  align="left" style="cursor:pointer" onClick="t_view.value='c';form1.submit();">Course List</td></tr>
	{if $viewWhat eq 'c'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap" width='10%'>Client Name</td>	
					<td align="left" nowrap="nowrap" width='10%'>Institute</td>
					<td align="left" nowrap="nowrap" width='10%'>Qualification</td>
					<td align="left" width='20%'>Major</td>		
					<td align="left"width="40%">Process</td>
					<td nowrap="nowrap" with='8%'>Due Date</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" nowrap="nowrap">{$arr.name}</td>
					<td align="left" nowrap="nowrap">{$arr.school}</td>
					<td align="left">{$arr.qual}</td>
					<td align="left">{$arr.major}</td>
					<!--onClick="openModel('client_course_process.php?pid={$id}&cid={$arr.clientid}&courseid={$arr.courseid}',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openClientPage({$arr.clientid});window.open('redir.php?t=ctl&pid={$id}&cid={$arr.clientid}&ccid={$arr.courseid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap" style=" color:#660000; font-weight:bold">{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>
	</td></tr>{/if}{/if}
	{if $ugs.i_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="t_view.value='i';form1.submit();">Institue List</td></tr>	
	{if $viewWhat eq 'i'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">Institute</td>	
					<td align="left"width="70%">Process</td>
					<td nowrap="nowrap">Due Date</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td  align="left"nowrap="nowrap">{$arr.school}</td>
					<!--onClick="openModel('institute_process.php?pid={$id}&cid={$arr.clientid}&courseid={$arr.courseid}',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openSchoolPage({$arr.iid});window.open('redir.php?t=ins&pid={$id}&sid={$arr.iid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap" style=" color:#660000; font-weight:bold">{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>	
	</td></tr>{/if}{/if}
	{if $ugs.a_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="t_view.value='a';form1.submit();">Agent List</td></tr>
	{if $viewWhat eq 'a'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">Agent</td>	
					<td  align="left"width="40%">Process</td>
					<td nowrap="nowrap" style=" color:#660000; font-weight:bold">Due Date</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" nowrap="nowrap">{$arr.agent}</td>
					<!--onClick="openModel('institute_process.php?pid={$id}&cid={$arr.clientid}&courseid={$arr.courseid}',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openAgentPage({$arr.aid});window.open('redir.php?t=agt&pid={$id}&aid={$arr.aid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap">{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>	
	</td></tr>{/if}{/if}
	{if $ugs.a_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="t_view.value='s';form1.submit();">Service List</td></tr>		
	{if $viewWhat eq 's'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">ClientName</td>	
					<td align="left"width="40%">Process</td>
					<td nowrap="nowrap" style=" color:#660000; font-weight:bold">Due Date</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" nowrap="nowrap">{$arr.name}</td>
					<!--onClick="openModel('institute_process.php?pid={$id}&cid={$arr.clientid}&courseid={$arr.courseid}',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openClientPage({$arr.clientid});window.open('redir.php?t=ser&pid={$id}&cid={$arr.clientid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap" style=" color:#660000; font-weight:bold">{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>								
	</td></tr>{/if}{/if}
</table>
</form>
</body>
</html>
