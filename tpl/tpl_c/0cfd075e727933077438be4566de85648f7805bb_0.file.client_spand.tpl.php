<?php
/* Smarty version 4.3.2, created on 2023-12-28 18:30:10
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_spand.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_658d4e32bb9140_58372839',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0cfd075e727933077438be4566de85648f7805bb' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_spand.tpl',
      1 => 1458372980,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_658d4e32bb9140_58372839 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<?php echo '<script'; ?>
 src="../js/jquery-1.9.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/jquery-ui-1.10.3.custom.js"><?php echo '</script'; ?>
>

<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Net Spand History</span>
		 </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">3rd Party Amount:<?php echo $_smarty_tpl->tpl_vars['account']->value['dueamt_3rd'];?>
</span></td>
	</tr>			
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<td width="2%">&nbsp;</td>
					<td >Paid Date</td>
					<td >Paid Amount</td>
				</tr>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payments']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<tr align="center" class="roweven">
					<td ><input type="radio" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onClick="setPayment(this)"></td>
					<td id="d_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
					<td id="a_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['paid']);?>
</td>
				</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr><td colspan="2"><hr></td></tr>
				<tr><td colspan="2" align="center" class="totalrowodd"><input type="checkbox" name="t_new" id="t_new" value="1" onClick="newPayment(this)">&nbsp;Add new</td></tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Date</strong></td>
					<td width="50%" align="left" class="roweven"><input name="t_date" id="t_date" id="t_date" value="" size="30">                      
                    </td>
				</tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Amount</strong></td>
					<td width="50%" align="left"  class="roweven"><input name="t_paid" id="t_paid" value="" size="30" onChange="audit_money(this)"></td>
				</tr>
				<tr align="center"  class="greybg">
					<input type="hidden" name="bt_name" value="">
					<td align="left">
						<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
					</td>		
					 <td align="right">
						<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>	


<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});        
<?php echo '</script'; ?>
>
	
</body>
</html><?php }
}
