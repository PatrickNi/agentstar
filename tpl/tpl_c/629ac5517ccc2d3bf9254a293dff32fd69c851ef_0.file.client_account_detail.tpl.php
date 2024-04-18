<?php
/* Smarty version 4.3.2, created on 2023-11-23 06:20:56
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_account_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655e7ec800e4e9_25024620',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '629ac5517ccc2d3bf9254a293dff32fd69c851ef' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_account_detail.tpl',
      1 => 1645419624,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655e7ec800e4e9_25024620 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"><?php echo '</script'; ?>
>


<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
">
<input type="hidden" name="vid" value="<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
">
<input type="hidden" name="typ" value="<?php echo $_smarty_tpl->tpl_vars['typ']->value;?>
">
<input type="hidden" name="hCancel" value="0">
<input type="hidden" name="t_duedate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['duedate'];?>
">
			<table width="100%" cellpadding="1" cellspacing="1" border="0" class="graybordertable">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
							<?php if ($_smarty_tpl->tpl_vars['typ']->value != 'visa' || ($_smarty_tpl->tpl_vars['typ']->value == 'visa' && (($_smarty_tpl->tpl_vars['aid']->value == 0 && $_smarty_tpl->tpl_vars['ugs']->value['v_agf']['i'] == 1) || ($_smarty_tpl->tpl_vars['aid']->value > 0 && $_smarty_tpl->tpl_vars['ugs']->value['v_agf']['m'] == 1)))) {?>
						  		<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;"><?php }?>	  
							</td>		
						<td align="center" class="whitetext">Payment Detail </td>
						<td align="right" width="10%">
							<?php if ($_smarty_tpl->tpl_vars['typ']->value != 'visa' || ($_smarty_tpl->tpl_vars['typ']->value == 'visa' && (($_smarty_tpl->tpl_vars['aid']->value == 0 && $_smarty_tpl->tpl_vars['ugs']->value['v_agf']['i'] == 1) || ($_smarty_tpl->tpl_vars['aid']->value > 0 && $_smarty_tpl->tpl_vars['ugs']->value['v_agf']['m'] == 1)))) {?>
								<input name="submit" type="submit" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" value="Save">
							<?php }?>
						</td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Item:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
				  		<select name="t_step" id="t_step">
				  			<option value="">--</option>
				  			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['steps']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
				  				<option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['step'] == $_smarty_tpl->tpl_vars['k']->value) {?> selected <?php }?> data-party="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo ucwords($_smarty_tpl->tpl_vars['k']->value);?>
 Fee</option>
				  			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				  		</select>
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>GST:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  		<input type="radio" name="t_gst" value="1" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['gst_chk'] == 1) {?> checked <?php }?>>YES &nbsp;&nbsp;
				  		<input type="radio" name="t_gst" value="0" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['gst_chk'] == 0) {?> checked <?php }?>>NO
					</td>
				</tr>				
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Due Amount:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
						<input type="text" name="t_dueamt" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['dueamt'];?>
" size="30">
					</td>
				</tr>
				<!--
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
						<input type="text" name="t_duedate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['duedate'];?>
" size="30">
					</td>
				</tr>
				-->
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
				  		<input type="text" name="t_party" id="t_party" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['party'];?>
" size="30">
				  		<!--
				  		<select name="t_party" id="t_party">
				  			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['steps']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
				  				<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" step="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['party'] == $_smarty_tpl->tpl_vars['v']->value) {?> selected <?php }?>><?php echo ucwords($_smarty_tpl->tpl_vars['v']->value);?>
</option>
				  			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				  		</select>
				  		-->
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction GST:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  		<input type="radio" name="t_gst_3rd" value="1" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['gst_3rd_chk'] == 1) {?> checked <?php }?>>YES &nbsp;&nbsp;
				  		<input type="radio" name="t_gst_3rd" value="0" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['gst_3rd_chk'] == 0) {?> checked <?php }?>>NO
					</td>
				</tr>
<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction Amount:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">	
						<input type="text" name="t_dueamt_3rd" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['dueamt_3rd'];?>
" size="30">
					</td>
				</tr>																
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Notes:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven"><textarea name="t_note" style="width:100%; height:100px;"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['note'];?>
</textarea></td>
				</tr>				
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>										
			</table>
</form>	

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_duedate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }); 
	
	$('#t_step').change(function(){
		//$('#t_party option[step='+$(this).val()+']').attr('selected', true);
		$('#t_party').val($(this).find('option:selected').attr('data-party'));
	});       
<?php echo '</script'; ?>
>
	
</body>
</html><?php }
}
