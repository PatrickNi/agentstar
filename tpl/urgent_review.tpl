<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
<link rel="stylesheet" href="../css/sam.css">
</head>

<script language="javascript" src="../js/RolloverTable.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script language="javascript" src="../js/audit.js"></script>
{literal}
<style>
.dotbadge {
  display: inline-block;
  padding: 0.3em 0.3em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: text-top;
  color: #212529;
  background-color: red;
  border-radius: 0.3rem;

  // Empty badges collapse automatically
  &:empty {
    display: none;
  }
}

</style>
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

	function trigger_list(view_mod,obj,view_id) {
		if (document.getElementById('view_show').value == view_mod) {
			document.getElementById('view_show').value = '';
			$('#'+view_id).css('visibility','collapse');

		}
		else {
			document.getElementById('sort_list').value='';
			document.getElementById('t_view').value=view_mod;
			obj.submit();
		}	
	}

	function birthday_done(cid, dob,obj) {
		 $.post('/scripts/urgent_review.php', '&act=check_dob&cid='+cid+'&dob='+dob, function(data){
            rtn = $.parseJSON(data);
            if(rtn.succ==1) {
            	$(obj).remove();
            }
        });
	}
</script>
{/literal}
<body>
<form name="form1" id="form1" target="_self">
<input type="hidden" id="t_view" name="t_view" value="">
<input type="hidden" id="sort_list" name="sort_list" value="{$sort_list}">
<input type="hidden" id="view_show" value="{$view_show}">

<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
	<tr><td align="center" class="title" style="font-size:14px; padding:3">
		Todo List&nbsp;&nbsp;&nbsp;&nbsp;
	   <!--<input type="button" style="font-weight:bold" onClick="printPage();"value="Print">-->
	</td></tr>
	{if $ugs.v_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('v',form1,'view_v');">
    		Visa List&nbsp;&nbsp;
      </td></tr>
	{if $viewWhat eq 'v'}
	<tr id="view_v"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="5%">
              	        <select name="vUid" onChange="sort_list.value='';t_view.value='v';form1.submit();">
                        {foreach key=user_id item=user_name from=$slUsers}		
                          <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>  
                        {/foreach}
                        {if $ugs.todo_visa.v eq 1}				
                          <option value="0" {if $staffid eq '0'} selected {/if}>All Staff</option>  
                           <option value="-1" {if $staffid eq '-1'} selected {/if}>Unassigned</option>  
                        {/if}		
                    </select>
                    </td>
					<td align="left" nowrap="nowrap">Client Name
					</td>		
					<td align="left" nowrap="nowrap">Category
					</td>
					<td align="left">SubClass				
					</td>
					<td align="left" width="40%">Process&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(4,0);t_view.value='v';form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(4,1);t_view.value='v';form1.submit();"/>					
					</td>
					<td nowrap="nowrap">Agreement Staff
					</td>
					<td nowrap="nowrap">Paperwork
					</td>
					<td nowrap="nowrap">Reviewer
					</td>
					<td nowrap="nowrap">Due Date<br/>
						<input type="checkbox" name="vdu" value="1" {if $vdu eq 1} checked {/if} onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)
					</td>
				</tr>
				{assign var="rank" value="0"}
				{foreach key=id item=arr from=$urgent_arr}
				{assign var="rank" value=$rank+1}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
					<td width="2%">{$rank}</td>
				 	<td align="left" nowrap="nowrap">{$arr.name}</td>
					<td align="left" nowrap="nowrap">{$arr.cate}</td>
					<td align="left">{$arr.class}</td>
					<!-- onClick="openModel('client_visa_process.php?pid={$id}&cid={$arr.clientid}&vid={$arr.visaid}',800,560,'NO', 'form1')"-->
					<td align="left" style="{if $arr.islodge eq 1}color:#FF3300;{elseif stripos($arr.item, 'DHA request') === 0 || stripos($arr.item, 'apply onshore') === 0}color:red;{elseif $arr.isApply eq 1}color:blue;{/if}cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid={$arr.clientid}&vid={$arr.visaid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.item}</td>
					<td nowrap="nowrap">{$slUsers[$arr.auid]}</td>
					<td nowrap="nowrap">
						<span {if $arr.is_review eq 2 && $arr.status != 'grant' && $arr.status != 'refused' && stripos($arr.item, 'apply onshore') === 0}style="color:red;"{/if}>{$slUsers[$arr.vuid]}</span>
					</td>
					<td nowrap="nowrap" align="left">
						<span>{$slUsers[$arr.reviewer]}</span>
					</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				{/foreach}	
			</table>
	</td></tr>
	{/if}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('vreview',form1,'view_vreview');">
    		Visa Review List
			{if $hasReviews}
				&nbsp;
				<span class="dotbadge"></span>
			{/if}
      </td>
	</tr>
	{if $viewWhat eq 'vreview'}
	<tr id="view_vreview">
		<td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="5%">
              	        <select name="vUid" onChange="sort_list.value='';t_view.value='vreview';form1.submit();">
                        {foreach key=user_id item=user_name from=$slUsers}		
                          <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>  
                        {/foreach}
                        {if $ugs.todo_visa.v eq 1}				
                          <option value="0" {if $staffid eq '0'} selected {/if}>choose a staff</option>  
                        {/if}		
                    </select>
                    </td>
					<td align="left" nowrap="nowrap">Client Name</td>		
					<td align="left" nowrap="nowrap">Category</td>
					<td align="left">SubClass</td>
					<td align="left" width="40%">Process</td>
					<td nowrap="nowrap">Agreement Staff</td>
					<td nowrap="nowrap">Paperwork</td>
					<td nowrap="nowrap">Reviewer</td>
					<td nowrap="nowrap">Due Date</td>
				</tr>
				{assign var="rank" value="0"}
				{foreach key=id item=arr from=$urgent_arr}
				{assign var="rank" value=$rank+1}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
					<td width="2%">{$rank}</td>
				 	<td align="left" nowrap="nowrap">{$arr.name}</td>
					<td align="left" nowrap="nowrap">{$arr.cate}</td>
					<td align="left">{$arr.class}</td>
					<td align="left" style="{if $arr.islodge eq 1}color:#FF3300;{elseif stripos($arr.item, 'DHA request') === 0 || stripos($arr.item, 'apply onshore') === 0}color:red;{elseif $arr.isApply eq 1}color:blue;{/if}cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid={$arr.clientid}&vid={$arr.visaid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.item}</td>
					<td nowrap="nowrap">{$slUsers[$arr.auid]}</td>
					<td nowrap="nowrap">{$slUsers[$arr.vuid]}</td>
					<td nowrap="nowrap" align="left">
						<span {if $arr.is_review eq 1  && stripos($arr.item, 'review application') === 0}style="color:red;"{/if}>{$slUsers[$arr.reviewer]}</span>
					</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				{/foreach}	
			</table>
		</td>	
	</tr>
	{/if}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('vexp',form1,'view_vexp');">
    		Visa Expire List
      </td>
	</tr>
	{if $viewWhat eq 'vexp'}
	<tr id="view_vexp">
		<td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
			<tr align="center" class="totalrowodd">
				<td width="5%">
					<select name="vUid" onChange="sort_list.value='';t_view.value='vexp';form1.submit();">
					{foreach key=user_id item=user_name from=$slUsers}		
						<option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>  
					{/foreach}
					{if $ugs.todo_visa.v eq 1}				
						<option value="0" {if $staffid eq '0'} selected {/if}>All Staff</option>  
						<option value="-1" {if $staffid eq '-1'} selected {/if}>Unassigned</option>  
					{/if}		
				</select>
				</td>
				<td>Expire Date </td>
				<td>Last Name</td>
				<td>Firset Name</td>
				<td>Visa Category</td>
				<td>Visa SubClass</td>
			</tr>
			{foreach key=id item=arr from=$urgent_arr}
			<tr align="center" class="roweven">
				<td>{$arr.type}</td>
				<td>{$arr.date}</td>
				<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_detail.php?cid={if $arr.main gt 0}{$arr.main}{else}{$arr.cid}{/if}&vid={$arr.vid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$arr.lname}</span></td>
				<td>{$arr.fname}</td>
				<td>{$arr.category}</td>
				<td>{$arr.subclass}</td>
			</tr>
			{/foreach}
			</table>
		</td>
	</tr>
	{/if}

	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('vm',form1,'view_vm');">
    		Verify Migration Course List&nbsp;&nbsp;
      </td></tr>
	{if $viewWhat eq 'vm'}
	<tr id="view_vm"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="left" class="title">
					<td colspan="6">
              	        <select name="vmUid" onChange="sort_list.value='';t_view.value='vm';form1.submit();">
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
						<br/><input type="checkbox" name="cdu" value="1" {if $cdu eq 1} checked {/if} onChange="t_view.value='vm';form1.submit()"/> ex(0000-00-00)							
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
	</td></tr>{/if}

	{/if}	
	{if $ugs.c_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('c',form1,'view_c');">Course List&nbsp;&nbsp;</td></tr>
	{if $viewWhat eq 'c'}
	<tr id="view_c"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="left" class="title">
					<td colspan="9">
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
					<td align="center" width="3%">No.</td>
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
					<td width="100px">Consultant</td>
					<td width="100px">Paperwork</td>
					<td width="100px">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,1);form1.submit();"/>			
						<br/><input type="checkbox" name="cdu" value="1" {if $cdu eq 1} checked {/if} onChange="t_view.value='c';form1.submit()"/> ex(0000-00-00)							
					</td>
				</tr>
				{assign var="rank" value="0"}
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td align="center">
						 {assign var="rank" value=$rank+1}
						 {$rank}
					</td>
					<td align="left">{$arr.name}</td>
					<td align="left">{$arr.school}</td>
					<td align="left">{$arr.qual}</td>
					<td align="left">{$arr.major}</td>
					<td style="cursor:pointer; text-decoration:underline; {if $arr.isColor eq 1}color:#0000FF {elseif $arr.item == 'Add new semester'} color:blue{elseif $arr.item == 'Pay tuition fee'} color:red{/if}"  onClick="window.open('client_course_detail.php?cid={$arr.clientid}&courseid={$arr.courseid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.item}</td>
					<td align="center">{$slCourseViewer[$arr.consultant]}</td>
					<td align="center">{$slCourseViewer[$arr.paperwork]}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>
	</td></tr>{/if}{/if}
	{if $ugs.i_proc.v eq 1}	
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('i',form1,'view_i');">Institute List&nbsp;&nbsp;</td></tr>
	{if $viewWhat eq 'i'}
	<tr id="view_i"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left">Category</td>
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
						<br/><input type="checkbox" name="idu" value="1" {if $idu eq 1} checked {/if} onChange="t_view.value='i';form1.submit()"/> ex(0000-00-00)					
					</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" width="10%" >{$arr.cate}</td>
					<td align="left" >{$arr.school}</td>
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="window.open('institute_process.php?sid={$arr.iid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				 {/foreach}
			</table>	
	</td></tr>{/if}{/if}
	{if $ugs.a_service.v eq 1}
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('asub',form1,'view_asub');">Sub Agent List&nbsp;&nbsp;</td></tr>		
	{if $viewWhat eq 'asub'}
	<tr id="view_asub"><td>
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
						<br/><input type="checkbox" name="asubdu" value="1" {if $asubdu eq 1} checked {/if} onChange="t_view.value='asub';form1.submit()"/> ex(0000-00-00)																	
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

	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('atop',form1,'view_atop')">Top Agent List&nbsp;&nbsp;</td></tr>		
	{if $viewWhat eq 'atop'}
	<tr id="view_atop"><td>
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
						<br/><input type="checkbox" name="atopdu" value="1" {if $atopdu eq 1} checked {/if} onChange="t_view.value='atop';form1.submit()"/> ex(0000-00-00)																				
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
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('s',form1,'view_s')">Birthday List&nbsp;&nbsp;</td></tr>
	{if $viewWhat eq 's'}
	<tr id="view_s"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="left" class="title">
					<td colspan="6">
              	        <select name="cUid" onChange="sort_list.value='';t_view.value='s';form1.submit();">
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
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">ClientName															
					</td>	
					<td align="left"nowrap="nowrap" width="40%">Process
																									
					</td>
					<td nowrap="nowrap">Due Date
					</td>
					<td>Link</td>
				</tr>
				 {foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left">{$arr.name}</td>
					<!--onClick="openModel('institute_process.php?pid={$id}&cid={$arr.clientid}&courseid={$arr.courseid}',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openClientPage({$arr.clientid});window.open('redir.php?t=ser&pid={$id}&cid={$arr.clientid}','','height='+screen.width*3/5+','+'width='+screen.width*4/5)">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
					<td>{if $arr.isTodo eq 1}<input type="button" value="Done" onClick="birthday_done('{$arr.clientid}','{$arr.due}', this)">{/if}</td>
				 </tr>
				 {/foreach}
			</table>					
	</td></tr>{/if}{/if}
</table>
</form>
</body>
</html>
