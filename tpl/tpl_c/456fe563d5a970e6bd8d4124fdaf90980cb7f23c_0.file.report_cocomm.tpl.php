<?php
/* Smarty version 4.3.2, created on 2023-11-27 13:21:52
  from '/data/wwwroot/agentstar.geic.com.au/tpl/report_cocomm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_65642770c78cb4_67131976',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '456fe563d5a970e6bd8d4124fdaf90980cb7f23c' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/report_cocomm.tpl',
      1 => 1476854772,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65642770c78cb4_67131976 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form name="form1" action="">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="bordered_2" >
		<td class="whitetext" style="padding:3 ">Co-Commission List
		&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
		</td>
	</tr>
	 <tr>
	 	<td align="left" class="greybg"><span class="highyellow">Total Semensters: <?php echo $_smarty_tpl->tpl_vars['total_num']->value;?>
</span></td>
	 </tr>		
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agents']->value, 'ag_name', false, 'aid');
$_smarty_tpl->tpl_vars['ag_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['aid']->value => $_smarty_tpl->tpl_vars['ag_name']->value) {
$_smarty_tpl->tpl_vars['ag_name']->do_else = false;
?>
	<?php if ((isset($_smarty_tpl->tpl_vars['semprocs']->value[$_smarty_tpl->tpl_vars['aid']->value]))) {?>
		<tr class="totalrowodd">
			<td><?php echo $_smarty_tpl->tpl_vars['ag_name']->value;?>
</td>
		</tr>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['semprocs']->value[$_smarty_tpl->tpl_vars['aid']->value], 'arr', false, 'cid');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cid']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arr']->value['course'], 'sems', false, 'ccid');
$_smarty_tpl->tpl_vars['sems']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ccid']->value => $_smarty_tpl->tpl_vars['sems']->value) {
$_smarty_tpl->tpl_vars['sems']->do_else = false;
?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sems']->value, 'darr', false, 'semid');
$_smarty_tpl->tpl_vars['darr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['semid']->value => $_smarty_tpl->tpl_vars['darr']->value) {
$_smarty_tpl->tpl_vars['darr']->do_else = false;
?>
		<tr class="roweven">
			<td><span  style="padding-left:40; cursor:pointer;<?php if ($_smarty_tpl->tpl_vars['darr']->value['date'] != '') {?>color:#33FF00;<?php }?>" onClick="window.open('client_course_sem.php?courseid=<?php echo $_smarty_tpl->tpl_vars['ccid']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&semid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
&nbsp;&nbsp;<em>(<?php echo $_smarty_tpl->tpl_vars['darr']->value['desc'];?>
)</em></span></td>
		</tr>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</form>
</body>
</html>
<?php }
}
