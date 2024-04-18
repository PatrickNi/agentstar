<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>User Management</title>
</style>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<body>
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
<form action=""  target="_self" method="POST" name="form1">
	<input type="hidden" name="qflag" value="">
	<tr  class="title" >
		<td colspan="8">
			<input type="button" style="font-weight:bold;" value="Add New" onClick="javascript:this.form.action='sys_user_add.php';this.form.submit();">&nbsp;&nbsp;
			<input type="button" style="font-weight:bold;" value="Remove" onClick="javascript:this.form.qflag.value='remove';this.form.submit();">	
		</td>
	</tr>
	<tr class="totalrowodd" align="center">
		<td width="2%"  ><input type="checkbox" name="toggleAll" onclick="rowToggleAll(this);"></td>
		<td width="15%" >Name</td>
		<td width="10%" >Position</td>
		<td width="10%" >Mark</td>
		<td width="10%" >Email</td>
		<td width="10%" >Mobile</td>
		<td width="10%" >Telephone</td>
		<td>Address</td>		
   </tr>
   {foreach key=id item=arr from=$user_arr}
	<tr id="tr_{$id}" onmouseout="roff({$id});" onmouseover="ron({$id});" align="center">
		<td onclick="rowToggle({$id});" align="center" class="border_1"> <input type="checkbox" id="box_{$id}" onclick="toggleRow(this);" name="userId[]" value="{$id}"> </td> 
		<td class="border_1"><a href="sys_user_add.php?uid={$id}" target="_self">{$arr.name}</a></td>
		<td class="border_1">{if $arr.pos }{$posarr[$arr.pos]}{else}&nbsp;{/if}</td>
		<td class="border_1">{if $arr.mark }{$markarr[$arr.mark]}{else}&nbsp;{/if}</td>
		<td class="border_1">{if $arr.email }{$arr.email}{else}&nbsp;{/if}</td>
		<td class="border_1">{if $arr.mobile }{$arr.mobile}{else}&nbsp;{/if}</td>
		<td class="border_1">{if $arr.phone }{$arr.phone}{else}&nbsp;{/if}</td>
		<td class="border_1">{if $arr.add }{$arr.add}{else}&nbsp;{/if}</td>		
   </tr>   
   {/foreach}
  </form> 
</table>
</body>
</html>
