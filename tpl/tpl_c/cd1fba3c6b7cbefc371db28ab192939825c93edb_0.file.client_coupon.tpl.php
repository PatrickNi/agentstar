<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:37:16
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_coupon.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3f2c692238_45766769',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd1fba3c6b7cbefc371db28ab192939825c93edb' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_coupon.tpl',
      1 => 1641190192,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3f2c692238_45766769 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/calendar.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
">
<table align="center" width="100%"  class="graybordertable" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="5">
		<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input name="button" type="button"  style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" disabled value="Coupons" onClick="javascript:this.form.action='client_coupon.php';this.form.submit();">&nbsp;&nbsp;
		<?php }?>          
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="5" style="padding:3 ">Coupons
        <span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_coupon_detail.php?&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+450 +',width='+550)">add new</span>    
        </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="5"> <span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span></td>
	</tr>	
	<tr align="center" class="totalrowodd">
		<td width="30%">Title</td>
		<td width="15%">Start Date</td>
        <td width="15%">End Date</td>
        <td width="20%">Amount</td>
        <td width="20%">Status</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coupons']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven">
		<td>
			<span style="cursor:pointer;" onClick="window.open('client_coupon_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&couponid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">
			<?php echo $_smarty_tpl->tpl_vars['arr']->value['title'];?>

			</span>
		</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['sdate'];?>
</span></td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['edate'];?>
</td>
		<td align="right">$<?php echo $_smarty_tpl->tpl_vars['arr']->value['amount'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['arr']->value['status'];?>
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
