<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body {$forbid_sl} {$forbid_cp} {$forbid_rc}>
<form name="form1" action="" target="_self" method="post">
<input type="hidden" name="sid" value="{$sid}">
<input type="hidden" name="isChange" value="0">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
			<input style="font-weight:bold;" type="button" value="Institute Detail" onClick="javascript:this.form.action='institute_detail.php';this.form.submit();">&nbsp;&nbsp;
			{if $ugs.i_course.v eq 1}
			<input style="font-weight:bold;" type="button" value="Course" onClick="javascript:this.form.action='institute_course.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
			<input style="font-weight:bold;" type="button" value="Sales Point" onClick="javascript:this.form.action='sales.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Staff" onClick="javascript:this.form.action='institute_staff.php';this.form.submit();">&nbsp;&nbsp;
			{if $ugs.i_proc.v eq 1}
			<input style="font-weight:bold;" type="button" value="Progress" onClick="javascript:this.form.action='institute_process.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
			{if $ugs.i_comm.v eq 1}
			<input style="font-weight:bold;" type="button" value="Commission" onClick="javascript:this.form.action='institute_comm.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
			{if $ugs.i_st.v eq 1}
			<input style="font-weight:bold;" type="button" value="Student" onClick="javascript:this.form.action='institute_student.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
			{if $ugs.i_proc.v eq 1}
			<input type="button" value="Attachment" style="font-weight:bold" onClick="openModel('attachment.php?item={$sid}&type={$itemtype}',screen.width*6/7,screen.height*4/7,'NO', 'form1')">
			{/if}
		</td>
	</tr>
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg" >					
			<td width="15%" align="left">
				{if $ugs.i_del.v eq 1}<input type="button"value="Delete" style="font-weight:bold;" onClick="a=confirm('are you sure you want to delete institute of {$dt_arr.name}');{literal}if(a==true){this.form.bt_name.value='delete';this.form.submit();}{/literal}">{/if}
			</td>
			<td width="63%" align="center" class="whitetext">Institute Detail</td>
			<td width="22%" align="right">
					<input type="hidden" name="bt_name" value="">
					<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">
			</td>
		</tr>
	</table></td></tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Insititute: {$dt_arr.name}</span></td>
	</tr>	
	<tr>
		<td align="center"  valign="top">
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>Category:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_cate" onChange="this.form.isChange.value=1;this.form.submit();">
						{foreach key=id item=name from=$category_arr}
							<option value="{$id}" {if $id eq $dt_arr.cate} selected {/if}>{$name}</option>
						{/foreach}
						{if not array_key_exists($dt_arr.cate, $category_arr)}<option value="0" selected>choose category</option>{/if}
						</select>
					</td>
				</tr>	
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>Sub Category:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_subcate" onChange="this.form.t_school.focus();">
						{foreach key=id item=name from=$subcate_arr}
							<option value="{$id}" {if $id eq $dt_arr.subcate} selected {/if}>{$name}</option>
						{/foreach}
						{if not array_key_exists($dt_arr.subcate, $subcate_arr)}<option value="0" selected>choose sub category</option>{/if}
						</select>
					</td>
				</tr>										
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>School Name:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_school" value="{$dt_arr.school}" style=" width:500px;" ></td>
				</tr>
				<tr>
					<td width="19%" height="30" align="left" class="rowodd"><strong>Web Site:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_web" value="{$dt_arr.web}" style=" width:500px;"></td>
				</tr>
				<tr>
					<td width="19%" height="30" align="left" class="rowodd"><strong>Agent Status:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_agent" onChange="this.form.t_note.focus();">
						{foreach key=id item=name from=$status_arr}
							<option value="{$id}" {if $id eq $dt_arr.agent} selected {/if}>{$name}</option>
						{/foreach}
						</select>&nbsp;&nbsp;&nbsp;
						<span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="openModel('institute_status.php',300,300,'NO','form1')">add new status</span>
					</td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Note:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_note" rows="3" style=" width:500px; height:200px ">{$dt_arr.note}</textarea></td>
				</tr>														
			</table>	  
	  	</td>
	</tr>								
</table>
</form>
</body>
</html>
