<?php
/* Smarty version 4.3.2, created on 2023-11-22 06:46:48
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_workexp_dt.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3358746c60_21110577',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e24cfe7156881c24629282bbfa442a57f547bd1' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_workexp_dt.tpl',
      1 => 1593264044,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3358746c60_21110577 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="wid" value="<?php echo $_smarty_tpl->tpl_vars['wid']->value;?>
">
<table border="0" width="100%" cellpadding="3" cellspacing="1">
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" value="">
			<td align="left" width="10%">
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
			</td>		
			<td align="center" class="whitetext">Detail Information</td>
			<td align="right" width="10%">
				<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
			</td>
		</tr>		
	</table></td></tr>
	<tr>
		<td width="22%" align="left" class="rowodd"><strong>Start Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="78%" class="roweven"><input type="text" name="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['fdate'];?>
" id="t_fdate" size="30">
  
        
        </td>
	</tr>
	<tr>
		<td width="22%" align="left" class="rowodd"><strong>Complete Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="78%" class="roweven"><input type="text" name="t_tdate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['tdate'];?>
" id="t_tdate"  size="30">
      
        </td>
	</tr>
	<tr>
		<td width="22%" align="left" class="rowodd"><strong>Company:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="78%" class="roweven"><input type="text" name="t_com" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['com'];?>
" size="30"></td>
	</tr>
	<tr>
		<td width="22%" align="left" class="rowodd"><strong>Country:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="78%" class="roweven">
			<select name="t_country" onChange="this.form.t_note.focus();">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['country_arr']->value, 'country', false, 'id');
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['country']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['country']->value;?>
</option>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['country'] < 1) {?><option value="0" selected>select a country</option><?php }?>
			</select>
			<span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="window.open('/scripts/country.php','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=300,width=300')">Add new country</span>
		</td>
	</tr>
	<tr>
		<td width="22%" align="left" class="rowodd"><strong>Position:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="78%" class="roweven">
            <input type="text" name="t_pos" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['pos'];?>
" size="50">
		</td>				
	</tr>
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Fulltime/Parttime:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven">										
            <input type="radio" name="t_fulltime" value="1" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['fulltime'] == 1) {?> checked <?php }?>>Fulltime
            &nbsp;&nbsp;
            <input type="radio" name="t_fulltime" value="0" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['fulltime'] == 0) {?> checked <?php }?>>Parttime
		</td>
	</tr>    	
	<tr>
		<td width="22%" align="left" class="rowodd"><strong>Note:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="78%" class="roweven"><textarea style="width:100%; height:100%;" rows="10" name="t_note"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['note'];?>
</textarea></td>
	</tr>								
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>							
</table>
</form>	

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
<?php echo '</script'; ?>
>
	
</body>
</html><?php }
}
