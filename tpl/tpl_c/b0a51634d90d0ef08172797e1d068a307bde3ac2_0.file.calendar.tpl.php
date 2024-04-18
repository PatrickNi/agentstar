<?php
/* Smarty version 4.3.2, created on 2023-12-28 18:12:19
  from '/data/wwwroot/agentstar.geic.com.au/tpl/calendar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_658d4a030e3c50_59751927',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0a51634d90d0ef08172797e1d068a307bde3ac2' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/calendar.tpl',
      1 => 1703758326,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_658d4a030e3c50_59751927 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Calendar Management</title>
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

<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="id" value="0">
<input type="hidden" name="t_hour" value="0">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
		<td colspan="2" align="left">
				 Date: <input type="text" id="t_date" value="<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" name="t_date" alert('please use Query to refresh')" onChange="audit_date(this)" <?php if ($_smarty_tpl->tpl_vars['content']->value == 1) {?>style="font-weight:bolder; background-color:#FFCC99 "<?php }?>>

                 
                 &nbsp;&nbsp; 
				 Consultar: 
				<select name="t_user" style="overflow: visible !important;" onChange="this.form.action='calendar.php';this.form.submit();" >
					<?php if ($_smarty_tpl->tpl_vars['user']->value == 0) {?>
						<option value="0" selected>select a user</option>
					<?php }?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['user']->value == $_smarty_tpl->tpl_vars['id']->value && $_smarty_tpl->tpl_vars['id']->value != 0) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</select>
				&nbsp; <input type="submit" value="Query"  style="font-weight:bold" >
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Calendar Management </td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr align="center" class="totalrowodd">
					<td class="border_1" width="5%">Time(Hour)</td>
					<td class="border_1" width="70%">Subject</td>				
				</tr>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['calendar_arr']->value, 'arr', false, 'hour');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hour']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<tr align="center" bgcolor="#FFFFD9" style="cursor:pointer; font-weight:bolder; " <?php if ($_smarty_tpl->tpl_vars['arr']->value['over'] != 1) {?>onClick="window.open('<?php if ($_smarty_tpl->tpl_vars['arr']->value['coach'] != '') {
echo $_smarty_tpl->tpl_vars['arr']->value['coach'];
} else { ?>calendar_add.php?id=<?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1 || $_smarty_tpl->tpl_vars['arr']->value['title'] != '' || $_smarty_tpl->tpl_vars['arr']->value['over'] == 1) {
echo $_smarty_tpl->tpl_vars['arr']->value['id'];
} else { ?>0<?php }?>&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
&t_user=<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
&t_hour=<?php echo $_smarty_tpl->tpl_vars['hour']->value;
}?>','_blank','alwaysRaised=yes,scrollbars=yes,ocation=no,width='+screen.width*1/2+',height='+screen.height*1/2)"<?php }?> >
					<td class="border_1" <?php if (stristr("[0-9][0-9]:00",$_smarty_tpl->tpl_vars['hour']->value)) {?>style=" border-top-style: groove; border-top-width:thin"<?php }?>><?php if (stristr("[0-9][0-9]:00",$_smarty_tpl->tpl_vars['hour']->value)) {
echo $_smarty_tpl->tpl_vars['hour']->value;
} else { ?>&nbsp;<?php }?></td>
					<td class="border_1"style="<?php if (stristr('[0-9][0-9]:00',$_smarty_tpl->tpl_vars['hour']->value)) {?> border-top-style: groove; border-top-width:thin;<?php }?>" bgcolor = "<?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?>#999999<?php } elseif ($_smarty_tpl->tpl_vars['arr']->value['title'] != '' || $_smarty_tpl->tpl_vars['arr']->value['over'] == 1) {?>#3A87AD<?php } else { ?>#FFFFD9<?php }?>"><?php if ($_smarty_tpl->tpl_vars['arr']->value['title']) {
echo $_smarty_tpl->tpl_vars['arr']->value['title'];
} else { ?>&nbsp;<?php }?></td>
				</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
		</td>
	</tr>
</table>
</form>	

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, firstDay: 1 });        
<?php echo '</script'; ?>
>
	
<?php }
}
