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
<input type="hidden" name="subid" value="{$subid}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="2">	  	&nbsp;&nbsp;
		<input type="button" value="Go back to Category" style="font-weight:bold;" onClick="javascrtipt:this.form.action='visa_category.php';this.form.submit();">&nbsp;&nbsp;
	  	&nbsp;&nbsp;<span class="highlighttext">Category: {$category}</span>	  </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:3 ">Visa SubClass Setting
		<input type="submit" value="add new" style="font-weight:bold;" onClick="this.form.subid.value=0;this.form.bt_name.value='new';">
		</td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table  border="0" cellpadding="2" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<!--<td class="border_1">SubClass id</td>-->
					<td>SubClass Name</td>
					<td>Action</td>
				</tr>
				{foreach key=id item=v from=$subclass_arr}
				<tr align="center" class="roweven">
					<!--<td class="border_1">{$id}</td>-->
					<td>{$v.name}</td>
					<td>
						<select name="at_{$id}" style="font-size:9px; font-weight:bolder;" {if $arr.done eq 1} disabled {/if}>
							{foreach key=act_id item=act_name from=$act_arr}
								<option value="{$act_id}" {if $v.status == $act_id && $act_id == 'Inactive'}selected{/if}>{$act_name}</option>
							{/foreach}							
						</select>&nbsp;
						<input style="font-weight:bolder;" type="button" {if $arr.done eq 1} disabled {/if} value="OK" onClick="this.form.subid.value={$id};this.form.submit();"> 					
					</td>
				</tr>
				{/foreach}
			</table>
		</td>
	</tr>
</table>
<p />
<div id="editDiv" style="display:{$isNone}">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="2"align="center" class="whitetext">Detail Information</td>
		</tr>	
		<tr>
			<td width="50%" align="right" class="rowodd"><strong>SubClass  Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="50%" class="roweven"><input type="text" name="t_name" value="{$dt_name}"></td>
		</tr>
		<tr align="center"  class="greybg" >
			<td colspan="2">
				<input type="hidden" name="bt_name" value="">
				<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">			
			</td>
		</tr>									
	</table>		
</div>	
</form>	
</body>
</html>