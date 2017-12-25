<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Function Group Managment</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<body>
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
<form action=""  target="_self" method="POST" name="form1">
	<input type="hidden" name="qflag" value="">
	<tr  class="bordered_2" >
		<td colspan="6">
			<input type="button" value="Add New" style="font-weight:bold;" onClick="javascript:this.form.action='sys_group_add.php';this.form.submit();">&nbsp;&nbsp;
			<input type="button" value="Remove" style="font-weight:bold;" onClick="javascript:this.form.qflag.value='remove';this.form.submit();">	
		</td>
	</tr>
	<tr class="totalrowodd">
		<td width="2%"  align="center"><input type="checkbox" name="toggleAll" onclick="rowToggleAll(this);"></td>
		<td width="40%" align="center">Group Name</td>
		<td width="58%" align="center">Mark</td>				
   </tr>
   {foreach key=id item=arr from=$group_arr}
	<tr id="tr_{$id}" onmouseout="roff({$id});" onmouseover="ron({$id});">
		<td onclick="rowToggle({$id});" align="center" style="border-bottom: solid #C0C0C0 1px; border-right: solid #C0C0C0 1px;"> <input type="checkbox" id="box_{$id}" onclick="toggleRow(this);" name="groupId[]" value="{$id}"> </td> 
		<td align="center"style="border-bottom: solid #C0C0C0 1px; border-right: solid #C0C0C0 1px;"><a href="sys_group_add.php?groupid={$id}" target="_self">{$arr.name}</a></td>
		<td align="center"style="border-bottom: solid #C0C0C0 1px; border-right: solid #C0C0C0 1px;">{$arr.mark}</td>							
   </tr>   
   {/foreach}
   <tr >
   	<td align="right" colspan="6">&nbsp;</td>
   </tr>
  </form> 
</table>
</body>
</html>

