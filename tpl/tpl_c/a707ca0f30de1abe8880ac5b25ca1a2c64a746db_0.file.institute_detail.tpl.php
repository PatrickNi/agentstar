<?php
/* Smarty version 4.3.2, created on 2023-12-28 18:36:10
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_658d4f9abb37b7_13567739',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a707ca0f30de1abe8880ac5b25ca1a2c64a746db' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute_detail.tpl',
      1 => 1619780148,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_658d4f9abb37b7_13567739 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body <?php echo $_smarty_tpl->tpl_vars['forbid_sl']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['forbid_cp']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['forbid_rc']->value;?>
>
<form name="form1" action="" target="_self" method="get">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
">
<input type="hidden" name="isChange" value="0">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
			<input style="font-weight:bold;" type="button" value="Institute Detail" onClick="javascript:window.location.href='/scripts/institute_detail.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Course" onClick="javascript:window.location.href='/scripts/institute_course.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
			<?php }?>
			<input style="font-weight:bold;" type="button" value="Sales Point" onClick="javascript:window.location.href='/scripts/sales.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Staff" onClick="javascript:window.location.href='/scripts/institute_staff.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Progress" onClick="javascript:window.location.href='/scripts/institute_process.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Commission" onClick="javascript:window.location.href='/scripts/institute_comm.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_st']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Student" onClick="javascript:window.location.href='/scripts/institute_student.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['v'] == 1) {?>
			<input type="button" value="Attachment" style="font-weight:bold" onClick="window.open('attachment.php?item=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*3/7 +',width='+screen.width*2/7);">
			<?php }?>
			<input style="font-weight:bold;" type="button" value="Bank" onClick="javascript:window.location.href='/scripts/institute_bank.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
';">&nbsp;&nbsp;
		</td>
	</tr>
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg" >					
			<td width="15%" align="left">
				<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_del']['v'] == 1) {?><input type="button"value="Delete" style="font-weight:bold;" onClick="a=confirm('are you sure you want to delete institute of <?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['name'];?>
');if(a==true){this.form.bt_name.value='delete';this.form.submit();}"><?php }?>
			</td>
			<td width="63%" align="center" class="whitetext">Institute Detail</td>
			<td width="22%" align="right">
					<input type="hidden" name="bt_name" value="">
					<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">
			</td>
		</tr>
	</table></td></tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['name'];?>
</span></td>
	</tr>	
	<tr>
		<td align="center"  valign="top">
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>Category:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_cate" onChange="this.form.isChange.value=1;this.form.submit();">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['cate']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if (!array_key_exists($_smarty_tpl->tpl_vars['dt_arr']->value['cate'],$_smarty_tpl->tpl_vars['category_arr']->value)) {?><option value="0" selected>choose category</option><?php }?>
						</select>
					</td>
				</tr>	
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>Sub Category:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_subcate" onChange="this.form.t_school.focus();">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subcate_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['subcate']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if (!array_key_exists($_smarty_tpl->tpl_vars['dt_arr']->value['subcate'],$_smarty_tpl->tpl_vars['subcate_arr']->value)) {?><option value="0" selected>choose sub category</option><?php }?>
						</select>
					</td>
				</tr>										
				<tr>
					<td width="19%" height="31" align="left" class="rowodd"><strong>School Name:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_school" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['school'];?>
" style=" width:500px;" ></td>
				</tr>
				<tr>
					<td width="19%" height="30" align="left" class="rowodd"><strong>Web Site:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_web" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['web'];?>
" style=" width:500px;"></td>
				</tr>
				<tr>
					<td width="19%" height="30" align="left" class="rowodd"><strong>Agent Status:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_agent" onChange="this.form.t_note.focus();">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['status_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['agent']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</select>&nbsp;&nbsp;&nbsp;
						<span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="openModel('institute_status.php',300,300,'NO','form1')">add new status</span>
					</td>
				</tr>
				<tr>
					<td width="19%" height="30" align="left" class="rowodd"><strong>Top Agent:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						 <?php if (($_smarty_tpl->tpl_vars['dt_arr']->value['topagent'] > 0 && $_smarty_tpl->tpl_vars['ugs']->value['i_tta']['m'] == 0) || ($_smarty_tpl->tpl_vars['ugs']->value['i_tta']['i'] == 0 && $_smarty_tpl->tpl_vars['ugs']->value['i_tta']['m'] == 0)) {?>
						 	<?php echo $_smarty_tpl->tpl_vars['top_agents']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['topagent']]['name'];?>

							<input type="hidden" name="t_agent_top" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['topagent'];?>
"/>
						 <?php } else { ?>
							<select name="t_agent_top" onChange="this.form.t_note.focus();">
							<option value="0" selected>n/a</option>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['top_agents']->value, 'ta', false, 'id');
$_smarty_tpl->tpl_vars['ta']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['ta']->value) {
$_smarty_tpl->tpl_vars['ta']->do_else = false;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['topagent']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['ta']->value['name'];?>
</option>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
						 <?php }?>
						
					</td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Note:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_note" rows="3" style=" width:500px; height:200px "><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['note'];?>
</textarea></td>
				</tr>														
			</table>	  
	  	</td>
	</tr>								
</table>
</form>
</body>
</html>
<?php }
}
