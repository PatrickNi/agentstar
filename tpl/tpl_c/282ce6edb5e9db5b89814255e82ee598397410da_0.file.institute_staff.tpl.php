<?php
/* Smarty version 4.3.2, created on 2024-01-08 10:31:28
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute_staff.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659b5e80281f21_44467642',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '282ce6edb5e9db5b89814255e82ee598397410da' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute_staff.tpl',
      1 => 1247463294,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659b5e80281f21_44467642 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/calendar.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
">
<input type="hidden" name="fid" value="<?php echo $_smarty_tpl->tpl_vars['fid']->value;?>
">
<input type="hidden" name="isNew" value="<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
">
<table align="center" class="graybordertable" width="100%"   border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="7"><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="7"> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['iname']->value;?>
</span></td>
	</tr>		
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="7" style="padding:3 ">Institute Staff Information 
			<input type="submit" value="Add New" style="font-weight:bold;" onClick="this.form.isNew.value='block'">
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td>Name</td>
		<td>Position</td>
		<td>Phone</td>
		<td>Fax</td>
		<td>Mobile</td>
		<td>Email</td>
		<td>Action</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['staff_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven">
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['positions']->value[$_smarty_tpl->tpl_vars['arr']->value['pos']];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['phone'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['fax'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['mobile'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['email'];?>
</td>
		<td>
			<select name="at_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" style="font-size:9px; font-weight:bolder;" <?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?> disabled <?php }?>>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['act_arr']->value, 'act_name', false, 'act_id');
$_smarty_tpl->tpl_vars['act_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['act_id']->value => $_smarty_tpl->tpl_vars['act_name']->value) {
$_smarty_tpl->tpl_vars['act_name']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['act_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['act_name']->value;?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>							
			</select>&nbsp;
			<input style="font-weight:bolder;" type="button" <?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?> disabled <?php }?> value="OK" onClick="this.form.fid.value=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;this.form.submit();"> 					
		</td>
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<p />
<div id="editDiv" style="display:<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
 ">
	<table border="0" width="100%" cellpadding="3">
		<tr class="greybg">
			<td colspan="2"align="center" class="whitetext">Detail Information</td>
		</tr>	
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_name" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['name'];?>
" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Position:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven">
				<select name="t_pos">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['positions']->value, 'pos', false, 'id');
$_smarty_tpl->tpl_vars['pos']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['pos']->value) {
$_smarty_tpl->tpl_vars['pos']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['pos']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['pos']->value;?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['pos'] < 1) {?><option value="0" selected>select a position</option><?php }?>
				</select>
				<span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="openModel('position.php',300,300,'NO', 'form1')">Add new position</span>
			</td>		
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Phone:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_phone" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['phone'];?>
" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Fax:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_fax" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['fax'];?>
" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_mobile" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['mobile'];?>
" size="30"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Email:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_email" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['email'];?>
" size="50" onChange="audit_email(this.value)"></td>
		</tr>
		<tr>
			<td width="15%" align="left" class="rowodd"><strong>Address:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="85%" class="roweven"><input type="text" name="t_add" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['add'];?>
" size="50"></td>
		</tr>																																	
		<tr align="center"  class="greybg" >
			<td colspan="2"><input type="submit" value="Save" name="bt_name" style="font-weight:bold "></td>
		</tr>									
	</table>
</div>			
</form>	
</body>
</html>
<?php }
}
