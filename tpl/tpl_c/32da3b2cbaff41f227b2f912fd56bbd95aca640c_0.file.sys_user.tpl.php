<?php
/* Smarty version 4.3.2, created on 2024-01-05 15:36:35
  from '/data/wwwroot/agentstar.geic.com.au/tpl/sys_user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6597b183689449_10869664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32da3b2cbaff41f227b2f912fd56bbd95aca640c' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/sys_user.tpl',
      1 => 1247463352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6597b183689449_10869664 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>User Management</title>
</style>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/RolloverTable.js"><?php echo '</script'; ?>
>
<body>
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
<form action=""  target="_self" method="POST" name="form1">
	<input type="hidden" name="qflag" value="">
	<tr  class="title" >
		<td colspan="8">
			<input type="button" style="font-weight:bold;" value="Add New" onClick="javascript:this.form.action='sys_user_add.php';this.form.submit();">&nbsp;&nbsp;
			<input type="button" style="font-weight:bold;" value="Remove" onClick="javascript:this.form.qflag.value='remove';this.form.submit();">	
		</td>
	</tr>
	<tr class="totalrowodd" align="center">
		<td width="2%"  ><input type="checkbox" name="toggleAll" onclick="rowToggleAll(this);"></td>
		<td width="15%" >Name</td>
		<td width="10%" >Position</td>
		<td width="10%" >Mark</td>
		<td width="10%" >Email</td>
		<td width="10%" >Mobile</td>
		<td width="10%" >Telephone</td>
		<td>Address</td>		
   </tr>
   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr id="tr_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onmouseout="roff(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" onmouseover="ron(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" align="center">
		<td onclick="rowToggle(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" align="center" class="border_1"> <input type="checkbox" id="box_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onclick="toggleRow(this);" name="userId[]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"> </td> 
		<td class="border_1"><a href="sys_user_add.php?uid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" target="_self"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</a></td>
		<td class="border_1"><?php if ($_smarty_tpl->tpl_vars['arr']->value['pos']) {
echo $_smarty_tpl->tpl_vars['posarr']->value[$_smarty_tpl->tpl_vars['arr']->value['pos']];
} else { ?>&nbsp;<?php }?></td>
		<td class="border_1"><?php if ($_smarty_tpl->tpl_vars['arr']->value['mark']) {
echo $_smarty_tpl->tpl_vars['markarr']->value[$_smarty_tpl->tpl_vars['arr']->value['mark']];
} else { ?>&nbsp;<?php }?></td>
		<td class="border_1"><?php if ($_smarty_tpl->tpl_vars['arr']->value['email']) {
echo $_smarty_tpl->tpl_vars['arr']->value['email'];
} else { ?>&nbsp;<?php }?></td>
		<td class="border_1"><?php if ($_smarty_tpl->tpl_vars['arr']->value['mobile']) {
echo $_smarty_tpl->tpl_vars['arr']->value['mobile'];
} else { ?>&nbsp;<?php }?></td>
		<td class="border_1"><?php if ($_smarty_tpl->tpl_vars['arr']->value['phone']) {
echo $_smarty_tpl->tpl_vars['arr']->value['phone'];
} else { ?>&nbsp;<?php }?></td>
		<td class="border_1"><?php if ($_smarty_tpl->tpl_vars['arr']->value['add']) {
echo $_smarty_tpl->tpl_vars['arr']->value['add'];
} else { ?>&nbsp;<?php }?></td>		
   </tr>   
   <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </form> 
</table>
</body>
</html>
<?php }
}
