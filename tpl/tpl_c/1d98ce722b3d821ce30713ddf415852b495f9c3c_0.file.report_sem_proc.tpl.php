<?php
/* Smarty version 4.3.2, created on 2023-11-23 18:22:12
  from '/data/wwwroot/agentstar.geic.com.au/tpl/report_sem_proc.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655f27d4f22487_19214454',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d98ce722b3d821ce30713ddf415852b495f9c3c' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/report_sem_proc.tpl',
      1 => 1619168878,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655f27d4f22487_19214454 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form name="form1" action="">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2" >
		<td colspan="2">
	   		<input type="submit" name="btn" value="Sort by Students">&nbsp;
	   		<input type="submit" name="btn" value="Sort by Top-agents">&nbsp;
	   		<input type="submit" name="btn" value="Sort by Institutes">&nbsp;
	   		<input type="submit" name="btn" value="Account todo">&nbsp;
		</td>
	</tr>
	<tr align="center"  class="bordered_2" >
		<td class="whitetext" style="padding:3 "  colspan="2">Commission
		&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onclick="printPage();"value="Print">
		</td>
	</tr>
	 <tr>
	 	<td align="left" class="greybg"  colspan="2"><span class="highyellow">Total Study Clients: <?php echo $_smarty_tpl->tpl_vars['page_url']->value;?>
</span></td>
	 </tr>		
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['semprocs']->value, 'arr', false, 'cid');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cid']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr class="totalrowodd" >
		<td  colspan="2"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arr']->value['course'], 'procs', false, 'ccid');
$_smarty_tpl->tpl_vars['procs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ccid']->value => $_smarty_tpl->tpl_vars['procs']->value) {
$_smarty_tpl->tpl_vars['procs']->do_else = false;
?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['procs']->value, 'darr', false, 'procid');
$_smarty_tpl->tpl_vars['darr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['procid']->value => $_smarty_tpl->tpl_vars['darr']->value) {
$_smarty_tpl->tpl_vars['darr']->do_else = false;
?>
	<tr class="roweven">
		<td align="right"><?php echo $_smarty_tpl->tpl_vars['darr']->value['date'];?>
</td>
		<td align="left"><span  style="padding-left:40; cursor:pointer;<?php if ($_smarty_tpl->tpl_vars['darr']->value['key'] == $_smarty_tpl->tpl_vars['step2']->value) {?>color:#33FF00;<?php }?>" onClick="window.open('client_course_sem.php?courseid=<?php echo $_smarty_tpl->tpl_vars['ccid']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['darr']->value['cid'];?>
&semid=<?php echo $_smarty_tpl->tpl_vars['procid']->value;?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">
		<?php if ($_smarty_tpl->tpl_vars['is_agent']->value == 1) {
echo $_smarty_tpl->tpl_vars['darr']->value['client'];?>
&nbsp;&nbsp;<?php }
echo $_smarty_tpl->tpl_vars['darr']->value['desc'];?>



		</span></td>
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
</table>
</form>
</body>
</html>
<?php }
}
