<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="{$iid}">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
	  <td><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail"></td>
	</tr>	
	<tr align="left"  class="bordered_2">
	  <td align="center" style=" padding:5,5,5; font-size:12px; color:#FFFFFF">Sales Point</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px "> <span class="highyellow">Insititute: {$iname}</span>&nbsp;&nbsp;
		<a href="#" onClick="window.open('sale_category.php?iid={$iid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=50,width=200, location=no')" target="_blank"><button>Add Category</button></a>
	</tr>
</table>
	{foreach key=cateid item=name from=$category_arr}
	<h4 onClick="window.open('sale_category.php?iid={$iid}&cateid={$cateid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=150,width=450, location=no')" style="cursor:pointer; text-decoration:underline" >{$name} <button type="button" onClick="window.open('sale_point.php?cateid={$cateid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=300,width=500, location=no')">Add Point</button></h4>
	<ul>
		{foreach key=pid item=arr from=$points[$cateid]}
			<li style="cursor:pointer;padding-bottom:5px;" onClick="window.open('sale_point.php?cateid={$cateid}&pid={$pid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=300,width=500, location=no')" >{$arr.name}</li>
		{/foreach}
	</ul>
	{/foreach}
</form>	
