<?php
/* Smarty version 4.3.2, created on 2023-11-22 06:46:24
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_service.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3340cc2af7_07203215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13794ddfde274ce68f49dc1a1e690818f2a43e9c' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_service.tpl',
      1 => 1606070858,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3340cc2af7_07203215 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<html>
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
		<td colspan="4">
		<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input name="button" type="button"  style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" disabled value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
		<?php }?>
        <?php if (in_array('study',$_smarty_tpl->tpl_vars['client_type']->value) && $_smarty_tpl->tpl_vars['ugs']->value['c_service']['v'] == 1) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        <?php }?> 
        <?php if (in_array('immi',$_smarty_tpl->tpl_vars['client_type']->value) && $_smarty_tpl->tpl_vars['ugs']->value['v_service']['v'] == 1) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        <?php }?> 
        <?php if (in_array('coach',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service">
        &nbsp;
        <?php }?>
        <?php if (in_array('homeloan',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        <?php }?>	
        <?php if (in_array('legal',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_legal.php';this.form.submit();" value="Legal Service">
        &nbsp;&nbsp; 
        <?php }?>           
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="4" style="padding:3 ">Service
		<input type="button" value="add new" style="font-weight:bold;" onClick="openModel('client_service_dt.php?&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&isNew=1',550,450,'NO', 'form1')"></td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="4"> <span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span></td>
	</tr>	
	<tr align="center" class="totalrowodd">
		<td width="10%">Date</td>
		<td width="25%">Subject</td>
		<td>Detail</td>
		<td width="10%">Due Date</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven">
		<td><span style="font-size:16px;font-weight:bolder; color:#990000"><?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?>&radic;<?php } else { ?>?<?php }?></span><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
		<td><span style="cursor:pointer; text-decoration:underline;" onClick="openModel('client_service_dt.php?sid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
',550,450,'NO', 'form1')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['subject'];?>
</span></td>
		<td><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['arr']->value['detail'],30,"...",true);?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
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
