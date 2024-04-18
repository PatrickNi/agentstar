<?php
/* Smarty version 4.3.2, created on 2023-12-28 18:15:25
  from '/data/wwwroot/agentstar.geic.com.au/tpl/calendar_add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_658d4abde07dd8_72172041',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff9f00a69f594658d31bddf5bca6fa8d18dc0b46' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/calendar_add.tpl',
      1 => 1678942472,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_658d4abde07dd8_72172041 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/jquery-1.9.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/jquery-ui-1.10.3.custom.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="post" action="" target="_self" onSubmit="return isDelete()">
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['calid']->value;?>
">
	<input type="hidden" name="hdate" value="<?php echo $_smarty_tpl->tpl_vars['hdate']->value;?>
">
	<input type="hidden" name="huser" value="<?php echo $_smarty_tpl->tpl_vars['huser']->value;?>
">
<table width="100%"  class="graybordertable" cellpadding="1" cellspacing="1">
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" value="">
			<td align="left" width="10%">
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
			</td>		
			<td align="center" height="20" class="whitetext">User Calendar Detail&nbsp;&nbsp;&nbsp;<span class="highlighttext">From User: <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</span></td>	
			 <td align="right" width="10%">
				<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
			</td>
		</tr>		
	</table></td></tr>
    <tr>
        <td width="18%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%"  class="roweven"><input type="checkbox" value="1" name="t_done" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['done'] == 1) {?> checked <?php }?>></td>
    </tr>	
    <tr>
        <td align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven"><input id="t_date" name="t_date" type="text" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['date'];?>
" readonly="true">
                                
        </td>
    </tr>
    <tr>
        <td align="left" class="rowodd"><strong>Hour: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven">
			<select name="t_hour" onChange="this.form.t_title.focus()">
				<option value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['hour'];?>
"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['hour'];?>
</option>
			</select>		
			<!--				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hour_arr']->value, 'hour', false, 'id');
$_smarty_tpl->tpl_vars['hour']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['hour']->value) {
$_smarty_tpl->tpl_vars['hour']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['hour']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['hour'] == $_smarty_tpl->tpl_vars['hour']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['hour']->value;?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>-->
		</td>
    </tr>
    <tr>
        <td align="left" class="rowodd"><strong>Consultar: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven">
			<select name="t_user" onChange="this.form.t_title.focus()">
           	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['user']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>		
		</td>
    </tr>	 	
    <tr>
        <td align="left" class="rowodd"><strong>Title: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven"><textarea style="width:400px; height:50 " name="t_title"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['title'];?>
</textarea></td>
    </tr>
    <tr>
        <td align="left" class="rowodd"><strong>Description: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven"><textarea name="t_desc" style="width:400px; height:100 "><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['desc'];?>
</textarea></td>
    </tr>   
    <tr>
        <td align="left" class="rowodd"><strong>Duration: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven">			
		   <select name="t_due" onChange="this.form.t_desc.focus();">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['due_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['due'] || (!$_smarty_tpl->tpl_vars['dt_arr']->value['due'] && $_smarty_tpl->tpl_vars['id']->value == 60)) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
		</td>
    </tr>
    <tr class="greybg"><td colspan="2">&nbsp;</td></tr>	
</table>
 </form>
 
<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true,firstDay: 1 });        
<?php echo '</script'; ?>
>
	
</body>
</html><?php }
}
