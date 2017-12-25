<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="{$iid}">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
	  <td><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail"></td>
	</tr>	
	<tr align="left"  class="bordered_2">
	  <td align="center" style=" padding:5,5,5; font-size:12px; color:#FFFFFF">Sales Point</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px "> <span class="highyellow">Insititute: {$iname}</span>&nbsp;&nbsp;<input type="button" value="add category" onClick="openModel('sale_category.php?iid={$iid}', 450,150,'NO', 'form1')"></td>
	</tr>
</table>
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	{foreach key=cateid item=name from=$category_arr}
	<tr class="totalrowodd">
		<td><span onClick="openModel('sale_category.php?iid={$iid}&cateid={$cateid}',450,150,'NO', 'form1')" style="cursor:pointer;">{$name}</span></td>
		<td><input type="button" value="add point" onClick="openModel('sale_point.php?cateid={$cateid}',500,300,'NO', 'form1')"></td>
	</tr>
	{foreach key=pid item=arr from=$points[$cateid]}
	<tr class="roweven">
		<td colspan="2"><span onClick="openModel('sale_point.php?cateid={$cateid}&pid={$pid}',500,300,'NO', 'form1')" style="padding-left:50; cursor:pointer; text-decoration:underline" >{$arr.name}</span></li></td>
	</tr>
	{/foreach}
	{/foreach}
</table>
</form>	
