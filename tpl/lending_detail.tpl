<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Lending Detail</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body {$forbid_sl} {$forbid_cp} {$forbid_rc}>
<form name="form1" action="" target="_self" method="post">
<input type="hidden" name="lid" value="{$lid}">
<input type="hidden" name="isChange" value="0">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
			<input style="font-weight:bold;" type="button" value="Lending Detail" onClick="javascript:this.form.action='lending_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Staff" onClick="javascript:this.form.action='lending_staff.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Clients" onClick="javascript:this.form.action='lending_student.php';this.form.submit();">&nbsp;&nbsp;
		</td>
	</tr>
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg" >					
			<td width="15%" align="left">
				{if $ugs.i_del.v eq 1}<input type="button"value="Delete" style="font-weight:bold;" onClick="a=confirm('are you sure you want to delete Lending of {$dt_arr.name}');{literal}if(a==true){this.form.bt_name.value='delete';this.form.submit();}{/literal}">{/if}
			</td>
			<td width="63%" align="center" class="whitetext">Lending Detail</td>
			<td width="22%" align="right">
					<input type="hidden" name="bt_name" value="">
					<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">
			</td>
		</tr>
	</table></td></tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Lending: {$dt_arr.name}</span></td>
	</tr>	
	<tr>
		<td align="center"  valign="top">
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>Category:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_cate">
						{foreach key=id item=name from=$category_arr}
							<option value="{$name}" {if $name eq $dt_arr.cate} selected {/if}>{$name}</option>
						{/foreach}
						{if not in_array($dt_arr.cate, $category_arr)}<option value="" selected>choose category</option>{/if}
						</select>
					</td>
				</tr>									
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>Lending Name:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_name" value="{$dt_arr.name}" style=" width:500px;" ></td>
				</tr>
				<tr>
					<td width="19%" height="30" align="left" class="rowodd"><strong>Commission Rate:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_cr" value="{$dt_arr.cr*100}" size="10">%</td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Notes:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_contact" rows="3" style=" width:500px; height:200px ">{$dt_arr.contact}</textarea></td>
				</tr>														
			</table>	  
	  	</td>
	</tr>								
</table>
</form>
</body>
</html>
