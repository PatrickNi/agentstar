<?php
/* Smarty version 4.3.2, created on 2023-11-27 13:11:10
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_payment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_656424eeb21e44_48387548',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc782ff8e7b476678669d775c7650f0c369b2791' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_payment.tpl',
      1 => 1618316714,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_656424eeb21e44_48387548 (Smarty_Internal_Template $_smarty_tpl) {
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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"><?php echo '</script'; ?>
>

<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Payment History</span>
		 </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Due Amount:<?php echo $_smarty_tpl->tpl_vars['account']->value['dueamt'];?>
</span>&nbsp;&nbsp; <span class="highyellow">Due Date: <?php echo $_smarty_tpl->tpl_vars['account']->value['duedate'];?>
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
					<input id="r_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['remark'];?>
"/>
				</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
			<?php if (count($_smarty_tpl->tpl_vars['coupons']->value) > 0) {?>
			 <table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr><td colspan="2"><hr></td></tr>
				<tr><td colspan="2" align="center" class="totalrowodd">Active Coupons</td></tr>
				<tr align="left">
					<td colspan="2" class="roweven">
						<select name="t_coupon">
						<option value="0" selected>Choose a coupon</option>	
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coupons']->value, 'title', false, 'couponid');
$_smarty_tpl->tpl_vars['title']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['couponid']->value => $_smarty_tpl->tpl_vars['title']->value) {
$_smarty_tpl->tpl_vars['title']->do_else = false;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['couponid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							
						</select>
						&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Redeem" style="font-weight:bold" onClick="this.form.bt_name.value='redeem';this.disable=false;" >
					</td>
				</tr>				
			</table>
			<?php }?>
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr><td colspan="2"><hr></td></tr>
				<tr><td colspan="2" align="center" class="totalrowodd"><input type="checkbox" name="t_new" id="t_new" value="1" onClick="newPayment(this)">&nbsp;Add new</td></tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Date</strong></td>
					<td width="50%" align="left" class="roweven"><input name="t_date" id="t_date" id="t_date" value="" size="30" autocomplete="off">                      
                    </td>
				</tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Amount</strong></td>
					<td width="50%" align="left"  class="roweven"><input name="t_paid" id="t_paid" value="" size="30"></td>
				</tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Remark</strong></td>
					<td width="50%" align="left"  class="roweven"><textarea name="t_remark" id="t_remark" rows="5" style="width:100%"></textarea></td>
				</tr>
				<tr align="center"  class="greybg">
					<input type="hidden" name="bt_name" value="">
					<td align="left">
						<?php if (($_smarty_tpl->tpl_vars['account']->value['type'] == 'visa' && $_smarty_tpl->tpl_vars['ugs']->value['v_pay']['d'] == 1) || $_smarty_tpl->tpl_vars['account']->value['type'] != 'visa') {?>
							<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
						<?php }?>
					</td>		
					 <td align="right">
					 	<?php if (($_smarty_tpl->tpl_vars['account']->value['type'] == 'visa' && ($_smarty_tpl->tpl_vars['ugs']->value['v_pay']['m'] == 1 || $_smarty_tpl->tpl_vars['ugs']->value['v_pay']['i'] == 1)) || $_smarty_tpl->tpl_vars['account']->value['type'] != 'visa') {?>
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
						<?php }?>
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
