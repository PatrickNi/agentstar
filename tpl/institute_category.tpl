<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="catid" value="{$catid}">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr align="left"  class="bordered_2">
	  <td colspan="2">&nbsp;</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:3 ">Institute Category Setting
			<input type="submit" value="add new" style="font-weight:bold;" onClick="this.form.catid.value=0;this.form.bt_name.value='new';">
		</td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table  border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<!--<td class="border_1">Category id</td>-->
					<td>Category Name</td>
					<td>Action</td>
				</tr>
				{foreach key=id item=name from=$category_arr}
				<tr align="center" class="roweven">
					<!--<td class="border_1">{$id}</td>-->
					<td>{$name}</td>
					<td>
						<select name="at_{$id}" style="font-size:9px; font-weight:bolder;" {if $arr.done eq 1} disabled {/if}>
							{foreach key=act_id item=act_name from=$act_arr}
								<option value="{$act_id}">{$act_name}</option>
							{/foreach}							
						</select>&nbsp;
						<input style="font-weight:bolder;" type="button" {if $arr.done eq 1} disabled {/if} value="OK" onClick="this.form.catid.value='{$id}';this.form.submit();"> 					
					</td>
				</tr>
				{/foreach}
			</table>
		</td>
	</tr>
</table>
<p />
<div id="editDiv" style="display:{$isNone}">
	<table border="0" width="100%" cellpadding="3">
		<tr class="greybg">
			<td colspan="2"align="center" class="whitetext">Detail Information</td>
		</tr>	
		<tr>
			<td width="50%" align="right" class="rowodd"><strong>Category Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="50%" class="roweven"><input type="text" name="t_name" value="{$dt_name}"></td>
		</tr>
		<tr align="center"  class="greybg" >
			<td colspan="2">
				<input type="hidden" name="bt_name" value="">
				<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
			</td>
		</tr>									
	</table>		
</div>
</form>	
</body>
</html>