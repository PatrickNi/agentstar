<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:26:19
  from '/data/wwwroot/agentstar.geic.com.au/tpl/agent_legal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3c9be5d945_60071338',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ed94a655368724b267617e021bea61b624b7165' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/agent_legal.tpl',
      1 => 1635408456,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3c9be5d945_60071338 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<?php echo '<script'; ?>
 src="../js/jquery-1.9.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/jquery-ui-1.10.3.custom.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
">
<input type="hidden" name="is_amb" value="<?php echo $_smarty_tpl->tpl_vars['is_global_ambassador']->value;?>
">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1" >
	<tr align="left"  class="bordered_2">
	  <td colspan="8">
	  	<?php if ($_smarty_tpl->tpl_vars['is_global_ambassador']->value) {?>
			<span class="highyellow">Agent: <?php echo $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['name'];?>
</span>&nbsp;&nbsp;
        </select>        
	  	<?php } else { ?>
	  		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='agent_add.php';this.form.submit();" value="Go back to the <?php if ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['cate'] == 'student') {?>assistant<?php } else { ?>agent<?php }?> detail">
			&nbsp;&nbsp;&nbsp;&nbsp;
	   		<input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
	  	<?php }?>
	  </td>
	</tr>
	<tr align="center" class="totalrowodd">
        <td class="border_1">Client</td>
		<td class="border_1">Category</td>
		<td class="border_1">Type</td>
		<td class="border_1">Status</td>
		<td class="border_1">Consult Date</td>
		<td class="border_1">Agreement Staff</td>
		<td class="border_1">Legal Paperwork</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visa_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven" >
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['cname'];?>
</td>
		<td class="border_1"><span style="cursor:pointer;" onClick="window.open('client_legal_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['cid'];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['cate'];?>
&nbsp;&nbsp;</span></td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['class'];?>
</td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['status'];?>
</td>
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['vdate'];?>
</td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['auser']];?>
</td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['vuser']];?>
</td>						
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</form>	
</body>
</html><?php }
}
