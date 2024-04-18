<?php
/* Smarty version 4.3.2, created on 2024-01-09 11:20:20
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute_bank.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659cbb7479fed2_81238262',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cba10e43dc45a68650e7de2cf707123fa147576' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute_bank.tpl',
      1 => 1619780050,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659cbb7479fed2_81238262 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Institute Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" ><?php echo $_smarty_tpl->tpl_vars['error_js']->value;
echo '</script'; ?>
>

<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
">
<input type="hidden" name="bankid" value="<?php echo $_smarty_tpl->tpl_vars['bankid']->value;?>
">
<input type="hidden" name="isNew" value="<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="7">
		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>	
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="7"> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['iname']->value;?>
</span></td>
	</tr>			
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="7" style="padding:3 ">Institute Bank 
			<input type="submit" value="Add New" style="font-weight:bold;" onClick="this.form.isNew.value='block'">
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td>Account Name</td>
		<td>BSB</td>
		<td>Account No</td>
		<td>Action</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bank_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven">
	    <td><?php echo $_smarty_tpl->tpl_vars['arr']->value['aname'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['bsb'];?>
</td>
        <td ><?php echo $_smarty_tpl->tpl_vars['arr']->value['ano'];?>
</td>
		<td>
			<select name="at_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" style="font-size:9px; font-weight:bolder;">
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
            <input style="font-weight:bolder;" type="button" value="OK" onClick="this.form.bankid.value=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;this.form.submit();"> 
		</td>
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<p />
<div id="editDiv" style="display:<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
;">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="2"align="center" class="whitetext">Detail Information</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Account Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input type="text" name="t_aname" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['aname'];?>
" size="50"/>
			</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>BSB:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input type="text" name="t_bsb" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['bsb'];?>
" size="50"/>
			</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Account No:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input type="text" name="t_ano" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['ano'];?>
" size="50"/>
			</td>
		</tr>
		<tr align="center"  class="greybg" >
			<td colspan="2"><input type="submit" value="Save" name="bt_name" style="font-weight:bold "></td>
		</tr>									
	</table>
</div>			
</form>	
</body>
</html><?php }
}
