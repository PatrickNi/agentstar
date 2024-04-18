<?php
/* Smarty version 4.3.2, created on 2023-11-27 13:20:47
  from '/data/wwwroot/agentstar.geic.com.au/tpl/report_expir.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6564272f962510_63519053',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3ff7e3479bd2aeb91100ed5afb62399a65b0646' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/report_expir.tpl',
      1 => 1640286570,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6564272f962510_63519053 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/RolloverTable.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form name="form1" target="_self" method="post">
<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
<tr>
	<td width="5%">
		<select name="staff_id" onChange="form1.submit();">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>  
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                    			  
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['visa_expire']['v'] == 1) {?>        			
				<option value="0" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '0') {?> selected <?php }?>>All Staff</option>          
			<?php }?>    		
		</select>
	</td>
	<td align="center" class="title" style="font-size:14px; padding:3">Visa Expire Date</td>
</tr>
</table>
		<table border="0" cellpadding="1" cellspacing="1" width="100%">								  
			<tr align="center" class="totalrowodd">
				<td>Category</td>
				<td>Expire Date </td>
				<td>Last Name</td>
				<td>Firset Name</td>
				<td>Visa Category</td>
				<td>Visa SubClass</td>
			</tr>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['main_expire']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
			<tr align="center" class="roweven">
				<td>Main Visa</td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
				<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_detail.php?cid=<?php if ($_smarty_tpl->tpl_vars['arr']->value['main'] > 0) {
echo $_smarty_tpl->tpl_vars['arr']->value['main'];
} else {
echo $_smarty_tpl->tpl_vars['arr']->value['cid'];
}?>&vid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['vid'];?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
</span></td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['category'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['subclass'];?>
</td>
			</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_epd']['v'] == 1) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visa_expire']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<tr align="center" class="roweven">
					<td>Visa Service</td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
					<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_detail.php?cid=<?php if ($_smarty_tpl->tpl_vars['arr']->value['main'] > 0) {
echo $_smarty_tpl->tpl_vars['arr']->value['main'];
} else {
echo $_smarty_tpl->tpl_vars['arr']->value['cid'];
}?>&vid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['vid'];?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
</span></td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['category'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['subclass'];?>
</td>
				</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>		
			<?php }?>				
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_epd']['v'] == 1) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other_expire']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<tr align="center" class="roweven">
					<td>Other Service</td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
					<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['cid'];?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
</span></td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['category'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['subclass'];?>
</td>
					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>		
			<?php }?>

    </table>											
<p />													
</form>
</body>
</html>
<?php }
}
