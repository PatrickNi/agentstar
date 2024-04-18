<?php
/* Smarty version 4.3.2, created on 2023-09-21 18:15:43
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_visa.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_650c17cf2bc724_95073359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2e814a61a455495941fd4c1e96143c561761f11' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_visa.tpl',
      1 => 1635413764,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650c17cf2bc724_95073359 (Smarty_Internal_Template $_smarty_tpl) {
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
<form name="form1" action="" target="_self" method="get">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="vid" value="<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
">
<input type="hidden" name="hCancel" value="0">
<table align="center" class="graybordertable" width="100%" cellpadding="0" cellspacing="0">
	<tr align="left"  class="bordered_2">
		<td colspan="9">
		 <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
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
		<td class="whitetext" colspan="9" style="padding:3 ">Client Visa Service
			&nbsp;&nbsp;&nbsp;&nbsp;
         <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_service']['i'] == 1) {?>
			<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">add visa</span>		
         <?php }?>
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="8"> <span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span>&nbsp;&nbsp; </td>
	</tr>		
	<tr align="center" class="totalrowodd">
		<td class="border_1">Visa</td>
		<td class="border_1">Visa Subclass</td>
		<!--
		<td class="border_1">On Shore<br>/Off Shore</td>
		-->
		<td class="border_1">Agreement Date</td>
		<td class="border_1">Apply Date</td>
		<td class="border_1">Grant Date</td>
		<td class="border_1">Agreement Staff</td>
		<td class="border_1">Visa Paperwork</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visa_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven" >
		<td class="border_1"><span style="<?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] != 2) {?>font-weight:bold; color:#0066FF; <?php }?>cursor:pointer;" onClick="<?php if ($_smarty_tpl->tpl_vars['arr']->value['vuser'] == $_smarty_tpl->tpl_vars['uid']->value || $_smarty_tpl->tpl_vars['arr']->value['auser'] == $_smarty_tpl->tpl_vars['uid']->value || $_smarty_tpl->tpl_vars['ugs']->value['v_track']['v'] == 1) {?>window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&vid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)<?php } else { ?>alert('Permission denied');<?php }?>"><?php echo $_smarty_tpl->tpl_vars['arr']->value['visa'];?>
&nbsp;&nbsp;</span></td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['class'];?>
</td>
		<!--
		<td class="border_1"><?php if ($_smarty_tpl->tpl_vars['arr']->value['shore'] == 1) {?> onshore <?php } else { ?> offshore <?php }?></td>
		-->
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['adate'];?>
</td>
		<td class="border_1"><?php if (array_key_exists($_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['procs']->value)) {
echo $_smarty_tpl->tpl_vars['procs']->value[$_smarty_tpl->tpl_vars['id']->value]['lodge'];
}?></td>
		<td class="border_1"><?php if (array_key_exists($_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['procs']->value) && $_smarty_tpl->tpl_vars['procs']->value[$_smarty_tpl->tpl_vars['id']->value]['grant'] != '') {
echo $_smarty_tpl->tpl_vars['procs']->value[$_smarty_tpl->tpl_vars['id']->value]['grant'];
} else {
echo $_smarty_tpl->tpl_vars['arr']->value['status'];
}?></td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['auser']];?>
</td>
		<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['vuser']];?>
</td>						
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</form>	<?php }
}
