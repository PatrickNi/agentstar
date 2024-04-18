<?php
/* Smarty version 4.3.2, created on 2024-01-08 10:30:53
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute_course.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659b5e5d20ae80_64649744',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d860a96daf913c080b171d4cc0a5e096f633737' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute_course.tpl',
      1 => 1561484560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659b5e5d20ae80_64649744 (Smarty_Internal_Template $_smarty_tpl) {
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
<form name="form1" method="post" target="_self">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['iid']->value;?>
">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="5">
		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>	
	</tr>
	<tr align="center"  class="bordered_2" >
		<td class="whitetext" colspan="5" style="padding:3 ">Institute Course</td>
	</tr>	
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="5"> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['iname']->value;?>
</span>&nbsp;<input type="button" value="add qualification" onClick="window.open('institute_qual.php?iid=<?php echo $_smarty_tpl->tpl_vars['iid']->value;?>
','_blank','alwaysRaised=yes,height=150,width=350, location=no');" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['i'] == 0) {?> disabled="disabled" <?php }?>></td>
	</tr>			

</table>	
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['quals']->value, 'name', false, 'qualid');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['qualid']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
	<tr class="totalrowodd">
            <td><span  onClick="<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['m'] == 1) {?>window.open('institute_qual.php?id=<?php echo $_smarty_tpl->tpl_vars['qualid']->value;?>
&iid=<?php echo $_smarty_tpl->tpl_vars['iid']->value;?>
','_blank','alwaysRaised=yes,height=150,width=350, location=no');<?php } else { ?>alert('Permission denied');<?php }?>" style="cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span></td>
		<td><input type="button" value="add major" onClick=" window.open('institute_major.php?qual=<?php echo $_smarty_tpl->tpl_vars['qualid']->value;?>
','_blank','alwaysRaised=yes,height=150,width=350, location=no')" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['i'] == 0) {?> disabled="disabled" <?php }?>></td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['majors']->value[$_smarty_tpl->tpl_vars['qualid']->value], 'name', false, 'majorid');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['majorid']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
	<tr class="roweven">

		<td colspan="2"><span onClick="<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['m'] == 1) {?>window.open('institute_major.php?id=<?php echo $_smarty_tpl->tpl_vars['majorid']->value;?>
&qual=<?php echo $_smarty_tpl->tpl_vars['qualid']->value;?>
','_blank','alwaysRaised=yes,height=150,width=350, location=no');<?php } else { ?>alert('Permission denied');<?php }?>" style="padding-left:50; cursor:pointer; text-decoration:underline" ><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span></li></td>
	</tr>
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
