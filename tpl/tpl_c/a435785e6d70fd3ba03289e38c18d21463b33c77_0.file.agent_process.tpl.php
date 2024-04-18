<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:26:08
  from '/data/wwwroot/agentstar.geic.com.au/tpl/agent_process.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3c909a2a60_91123942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a435785e6d70fd3ba03289e38c18d21463b33c77' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/agent_process.tpl',
      1 => 1593202036,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3c909a2a60_91123942 (Smarty_Internal_Template $_smarty_tpl) {
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
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
">
<input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="5"><input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='agent_add.php';this.form.submit();" value="Go back to the agent detail">	    &nbsp;&nbsp;
	</tr>

	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="5" style="padding:3 ">Agent Process 
			<input type="button" value="add new" style="font-weight:bold;" onClick="window.open('/scripts/agent_process_dt.php?aid=<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
&isNew=1','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_proc']['i'] == 0) {?> disabled="disabled" <?php }?>>	  
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
		<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('/scripts/agent_process_dt.php?pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&aid=<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['subject'];?>
</span></td>
		
		<td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['arr']->value['detail'],20,"...",true);?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
		<td><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('/scripts/agent_process_dt.php?pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&aid=<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
&isNew=1','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"></td>
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</form>
</body>	
</html><?php }
}
