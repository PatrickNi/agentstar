<?php
/* Smarty version 4.3.2, created on 2024-01-09 11:14:11
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute_process.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659cba03ab7472_32881866',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61ff8f5ce04d3d2fa67e0a59497a3fcadc93eac7' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute_process.tpl',
      1 => 1593263126,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659cba03ab7472_32881866 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
">
<input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
">
<input type="hidden" name="isNew" value="<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr align="left"  class="bordered_2">
	  <td colspan="5"><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">	    &nbsp;&nbsp;
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="5"> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['iname']->value;?>
</span></td>
	</tr>			
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="5" style="padding:3 ">Institute Process 
			<input type="button" value="add new" style="font-weight:bold;" onClick="window.open('institute_proc_dt.php?&sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth=500,width=380');"<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['i'] == 0) {?> disabled="disabled"<?php }?>>&nbsp;
			<input type="button" value="Attachment" style="font-weight:bold" onClick="window.open('attachment.php?item=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*3/7 +',width='+screen.width*2/7);">
		</td>
	</tr>

	<tr align="center" class="totalrowodd">
		<td width="10%">Date</td>
		<td width="30%">Subject</td>
		<td width="40%">Details</td>
		<td width="10%">Due Date</td>
		<td width="10%">Insert</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['process_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven">
		<td><span style="font-size:16px;font-weight:bolder; color:#990000"><?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?>&radic;<?php } else { ?>?<?php }?></span><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
		<td><span style="cursor:pointer; text-decoration:underline;" onClick="<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['m'] == 1) {?>	window.open('institute_proc_dt.php?pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth=500,width=380')<?php } else { ?>alert('Permission denied')<?php }?>"><?php echo $_smarty_tpl->tpl_vars['arr']->value['subject'];?>
</span></td>
		<td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['arr']->value['detail'],20,"...",true);?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
		<td><img src="../images/arr_down.gif" style="cursor:pointer" onClick="<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['i'] == 1) {?>	window.open('institute_proc_dt.php?pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth=500,width=380')<?php } else { ?>alert('Permission denied')<?php }?>"></td>
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</form>	
</body>
</html><?php }
}
