<?php
/* Smarty version 4.3.2, created on 2024-01-09 11:14:04
  from '/data/wwwroot/agentstar.geic.com.au/tpl/sales.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659cb9fc9ced91_26851297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4badb7ecdc612dd5c2e6436e2f343454c30a49eb' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/sales.tpl',
      1 => 1640058984,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659cb9fc9ced91_26851297 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['iid']->value;?>
">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
	  <td><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail"></td>
	</tr>	
	<tr align="left"  class="bordered_2">
	  <td align="center" style=" padding:5,5,5; font-size:12px; color:#FFFFFF">Sales Point</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px "> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['iname']->value;?>
</span>&nbsp;&nbsp;
		<a href="#" onClick="window.open('sale_category.php?iid=<?php echo $_smarty_tpl->tpl_vars['iid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=50,width=200, location=no')" target="_blank"><button>Add Category</button></a>
	</tr>
</table>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category_arr']->value, 'name', false, 'cateid');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cateid']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
	<h4 onClick="window.open('sale_category.php?iid=<?php echo $_smarty_tpl->tpl_vars['iid']->value;?>
&cateid=<?php echo $_smarty_tpl->tpl_vars['cateid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=150,width=450, location=no')" style="cursor:pointer; text-decoration:underline" ><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 <button type="button" onClick="window.open('sale_point.php?cateid=<?php echo $_smarty_tpl->tpl_vars['cateid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=300,width=500, location=no')">Add Point</button></h4>
	<ul>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['points']->value[$_smarty_tpl->tpl_vars['cateid']->value], 'arr', false, 'pid');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pid']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
			<li style="cursor:pointer;padding-bottom:5px;" onClick="window.open('sale_point.php?cateid=<?php echo $_smarty_tpl->tpl_vars['cateid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,heigth=300,width=500, location=no')" ><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</form>	
<?php }
}
