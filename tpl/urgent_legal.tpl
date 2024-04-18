<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Urgent Legal</title>
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
<form name="form1" id="form1" target="_self" method="get">
<input type="hidden" id="t_view" name="t_view" value="{$viewWhat}">
<input type="hidden" id="sort_list" name="sort_list" value="{$sort_list}">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">

	<tr><td class="menu"  align="center" style="cursor:pointer" onClick="document.getElementById('sort_list').value='';document.getElementById('t_view').value='legal';form1.submit();">
    		Legal TODO list&nbsp;&nbsp;
      </td></tr>
    <tr>
      <td align="right" class="rowodd">{$page_url}</td>
    </tr>

	<tr><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="5%">
              	        <select name="vUid" onChange="sort_list.value='';t_view.value='legal';form1.submit();">
                        {foreach key=user_id item=user_name from=$slUsers}		
                          <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>  
                        {/foreach}
                        {if $ugs.todo_visa.v eq 1}				
                          <option value="0" {if $staffid eq '0'} selected {/if}>All Staff</option>  
                        {/if}		
                    </select>
                    </td>
					<td align="left" nowrap="nowrap">Client Name&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(1,1);form1.submit();"/>
					</td>		
					<td align="left" nowrap="nowrap">Category&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(2,1);form1.submit();"/>
					</td>
					<td align="left">Type&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(3,1);form1.submit();"/>					
					</td>
					<td align="left" width="40%">Process&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(4,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(4,1);form1.submit();"/>					
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;						
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(5,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(5,1);form1.submit();"/>			
						<br/>
						<input type="checkbox" name="vdu" value="1" {if $vdu eq 1} checked {/if} onChange="form1.submit()"/> ex(0000-00-00)
					</td>
				</tr>
				{foreach key=id item=arr from=$urgent_arr}
				 <tr align="center" class="{cycle values='rowodd,roweven'}">
					<td width="2%"><input type="checkbox" onClick="if(this.checked);"></td>
				 	<td align="left" nowrap="nowrap">{$arr.name}</td>
					<td align="left" nowrap="nowrap">{$arr.cate}</td>
					<td align="left">{$arr.class}</td>
					<!-- onClick="openModel('client_visa_process.php?pid={$id}&cid={$arr.clientid}&vid={$arr.visaid}',800,560,'NO', 'form1')"-->
					<td align="left" style="{if $arr.islodge eq 1}color:#FF3300;{/if}cursor:pointer; text-decoration:underline" onclick="window.open('client_legal_detail.php?cid={$arr.clientid}&vid={$arr.visaid}','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')">{$arr.item}</td>
					<td nowrap="nowrap" {if $arr.isTodo neq 1}style="color:#660000; font-weight:bold"{/if}>{$arr.due}</td>
				 </tr>
				{/foreach}	
			</table>
	</td></tr>
</table>
</form>
</body>
</html>
