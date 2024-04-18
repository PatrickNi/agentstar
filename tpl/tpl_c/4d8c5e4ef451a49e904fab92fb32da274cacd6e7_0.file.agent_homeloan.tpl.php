<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:26:21
  from '/data/wwwroot/agentstar.geic.com.au/tpl/agent_homeloan.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3c9de6c0d0_13649252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d8c5e4ef451a49e904fab92fb32da274cacd6e7' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/agent_homeloan.tpl',
      1 => 1635409742,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3c9de6c0d0_13649252 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
?>
<html>
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
	  <td colspan="10">
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
		<td class="border_1">Lending Institute</td>
		<td class="border_1">Category</td>
		<td class="border_1">Property Price</td>
		<td class="border_1">Loan Amount</td>
        <td class="border_1">Agreement Staff</td>
        <td class="border_1">Refer Loan</td>
		<td class="border_1">Loan Approed</td>
		<td class="border_1">Load Settled</td>
        <td class="border_1">Comm Received</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['loan_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven" >
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
</td>
		<td class="border_1"><span style="<?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] != 2) {?>font-weight:bold; color:#0066FF; <?php }?>cursor:pointer;" onClick="window.open('client_homeloan_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['cid'];?>
&hid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['lend_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['lid']]['name'];?>
&nbsp;&nbsp;</span></td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['lend_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['lid']]['cate'];?>
</td>
		<td class="border_1"><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['arr']->value['price'],2,'.',',');?>
</td>
		<td class="border_1"><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['arr']->value['amount'],2,'.',',');?>
</td>
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['user']];?>
</td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['process']->value[$_smarty_tpl->tpl_vars['id']->value]['Referhomeloan']['date'];?>
</td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['process']->value[$_smarty_tpl->tpl_vars['id']->value]['Loanapproved']['date'];?>
</td>
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['process']->value[$_smarty_tpl->tpl_vars['id']->value]['Loansettled']['date'];?>
</td>
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['process']->value[$_smarty_tpl->tpl_vars['id']->value]['Commissionreceived']['date'];?>
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
