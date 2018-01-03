<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/audit.js"></script>
{literal}
<script language="javascript">
function setSortOrd(col, ord){
     var cols = document.getElementById('sort_list').value;
//	 alert(cols);
	 if(cols == ''){
	 	document.getElementById('sort_list').value = col+':'+ord;
//		alert('N1=>'+document.getElementById('sort_list').value);
	 }
	 else {
	 	var flag = false;
		var colarr = cols.split('|');
		for(var i=0; i<colarr.length; i++){
			var co = colarr[i].split(':');
			if(co.length == 2 && col == co[0]){
				colarr[i] = col+':'+ord;
				flag = true;
			}
		}
		if(!flag){
		   colarr[i] = col+':'+ord;
		}
		
	 	document.getElementById('sort_list').value = colarr.join('|');
//		alert('N2=>'+document.getElementById('sort_list').value);
		
	 }
}
</script>
{/literal}
<body>
<form name="form1" id="form1" target="_self">
<input type="hidden" id="t_view" name="t_view" value="">
<input type="hidden" id="sort_list" name="sort_list" value="{$sort_list}">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
	<tr><td align="center" class="title" style="font-size:14px; padding:3">
		Urgent List&nbsp;&nbsp;&nbsp;&nbsp;
	   <!--<input type="button" style="font-weight:bold" onClick="printPage();"value="Print">-->
	</td></tr>
	{if $ugs.v_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="document.getElementById('sort_list').value='';document.getElementById('t_view').value='v';form1.submit();">
    		Visa List&nbsp;&nbsp;
      </td></tr>
	{if $viewWhat eq 'v'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="5%">
              	        <select name="vUid" onChange="sort_list.value='';t_view.value='v';form1.submit();">
                        {foreach key=user_id item=user_name from=$slUsers}		
                          <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>  
                        {/foreach}
                        {if $ugs.todo_visa.v eq 1}				
                          <option value="0" {if $staffid eq '0'} selected {/if}>All Staff</option>  
                        {/if}		
                    </select>
                    </td>
					<td align="left" nowrap="nowrap">Client Name&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(1,0);t_view.value='v';form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(1,1);t_view.value='v';form1.submit();"/>
					</td>		
					<td align="left" nowrap="nowrap">Category&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(2,0);t_view.value='v';form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(2,1);t_view.value='v';form1.submit();"/>
					</td>
					<td align="left">SubClass&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(3,0);t_view.value='v';form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(3,1);t_view.value='v';form1.submit();"/>					
					</td>
					<td align="left" width="40%">Process&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(4,0);t_view.value='v';form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(4,1);t_view.value='v';form1.submit();"/>					
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;						
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(5,0);t_view.value='v';form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(5,1);t_view.value='v';form1.submit();"/>			<br/><input type="checkbox" name="vdu" value="1" {if $vdu eq 1} checked {/if} onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)
		
					</td>
				</tr>
				{foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
					<td width="2%"><input type="checkbox" onClick="if(this.checked);"></td>
				 	<td align="left" nowrap="nowrap">{$arr.name}</td>
					<td align="left" nowrap="nowrap">{$arr.cate}</td>
					<td align="left">{$arr.class}</td>
					<!-- onClick="openModel('client_visa_process.php?pid={$id}&cid={$arr.clientid}&vid={$arr.visaid}',800,560,'NO', 'form1')"-->
					<td align="left" style="{if $arr.islodge eq 1}color:#FF3300;{/if}cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid={$arr.clientid}&vid={$arr.visaid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				{/foreach}	
			</table>
	</td></tr>{/if}{/if}	
	{if $ugs.c_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="document.getElementById('sort_list').value='';document.getElementById('t_view').value='c';form1.submit();">Course List&nbsp;&nbsp;</td></tr>
	{if $viewWhat eq 'c'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="left" class="title">
					<td colspan="6">
              	        <select name="cUid" onChange="sort_list.value='';t_view.value='c';form1.submit();">
                        {foreach key=user_id item=user_name from=$slUsers}		
                          <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>  
                        {/foreach}
                        {if $ugs.todo_course.v eq 1}				
                          <option value="0" {if $staffid eq '0'} selected {/if}>All Staff</option>  
                        {/if}		
                    </select>
                    </td>
                 </tr>
   				<tr align="center" class="title">
					<td align="left" width="100px">Client Name &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(1,1);form1.submit();"/>					
					</td>	
					<td align="left" width="100px">Institute &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(2,1);;form1.submit();"/>										
					</td>
					<td align="left" width="100px">Qualification&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(3,1);form1.submit();"/>									
					</td>
					<td align="left" width="100px">Major&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(4,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(4,1);form1.submit();"/>										
					</td>		
					<td align="left"width="300px">Process &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(5,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(5,1);form1.submit();"/>							
					</td>
					<td width="100px">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,1);form1.submit();"/>			
						<br/><input type="checkbox" name="cdu" value="1" {if $cdu eq 1} checked {/if} onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)							
					</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
					<td align="left">{$arr.name}</td>
					<td align="left">{$arr.school}</td>
					<td align="left">{$arr.qual}</td>
					<td align="left">{$arr.major}</td>
					<td style="cursor:pointer; text-decoration:underline; {if $arr.isColor eq 1}color:#0000FF{/if}"  onClick="window.open('client_course_detail.php?cid={$arr.clientid}&courseid={$arr.courseid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>
	</td></tr>{/if}{/if}
	{if $ugs.i_proc.v eq 1}	
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="document.getElementById('sort_list').value='';document.getElementById('t_view').value='i';form1.submit();">Institute List&nbsp;&nbsp;</td></tr>
	{if $viewWhat eq 'i'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">Institute&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(1,1);form1.submit();"/>										
					</td>	
					<td align="left" width="70%">Process&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(2,1);form1.submit();"/>							
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(3,1);form1.submit();"/>			
						<br/><input type="checkbox" name="idu" value="1" {if $idu eq 1} checked {/if} onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)					
					</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" >{$arr.school}</td>
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="window.open('institute_process.php?sid={$arr.iid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>	
	</td></tr>{/if}{/if}
	{if $ugs.a_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="t_view.value='asub';sort_list.valaue='';form1.submit();">Sub Agent List&nbsp;&nbsp;</td></tr>		
	{if $viewWhat eq 'asub'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">Agent &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,1);form1.submit();"/>															
					</td>	
					<td align="left" width="40%">Process &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,1);;form1.submit();"/>															
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,1);form1.submit();"/>			
						<br/><input type="checkbox" name="asubdu" value="1" {if $asubdu eq 1} checked {/if} onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)																	
					</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" nowrap="nowrap">{$arr.agent}</td>
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openAgentPage({$arr.aid});window.open('redir.php?t=agt&pid={$id}&aid={$arr.aid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>
	</td></tr>{/if}	

	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="t_view.value='atop';sort_list.valaue='';form1.submit();">Top Agent List&nbsp;&nbsp;</td></tr>		
	{if $viewWhat eq 'atop'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">Agent &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,1);form1.submit();"/>															
					</td>	
					<td align="left" width="40%">Process &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,1);;form1.submit();"/>															
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,1);form1.submit();"/>
						<br/><input type="checkbox" name="atopdu" value="1" {if $atopdu eq 1} checked {/if} onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)																				
					</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" nowrap="nowrap">{$arr.agent}</td>
					<!--onClick="openModel('institute_process.php?pid={$id}&cid={$arr.clientid}&courseid={$arr.courseid}',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openAgentPage({$arr.aid});window.open('redir.php?t=agt&pid={$id}&aid={$arr.aid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>
	</td></tr>{/if}	


	{/if}
	{if $ugs.b_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="t_view.value='s';sort_list.value='';form1.submit();">Services List&nbsp;&nbsp;</td></tr>
	{if $viewWhat eq 's'}
	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">ClientName&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='s';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='s';setSortOrd(1,1);form1.submit();"/>																	
					</td>	
					<td align="left"nowrap="nowrap" width="40%">Process&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='s';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='s';setSortOrd(2,1);form1.submit();"/>																				
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='s';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='s';setSortOrd(3,1);form1.submit();"/>			
						<br/><input type="checkbox" name="sdu" value="1" {if $sdu eq 1} checked {/if} onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)																							
					</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left">{$arr.name}</td>
					<!--onClick="openModel('institute_process.php?pid={$id}&cid={$arr.clientid}&courseid={$arr.courseid}',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openClientPage({$arr.clientid});window.open('redir.php?t=ser&pid={$id}&cid={$arr.clientid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>					
	</td></tr>{/if}{/if}
</table>
</form>
</body>
</html>
