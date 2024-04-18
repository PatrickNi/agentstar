<?php
/* Smarty version 4.3.2, created on 2024-01-08 10:30:56
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute_student.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659b5e607a19e6_02263413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19acbfadef469b731b07758204bcfb4acfa30c36' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute_student.tpl',
      1 => 1617051132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659b5e607a19e6_02263413 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/function.cycle.php','function'=>'smarty_function_cycle',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1" >
	<tr align="left"  class="bordered_2">
	  <td colspan="2">
	  	<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">
				&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
	  </td>
	  <td align="left" colspan="9">
	 		<strong>From: &nbsp;</strong><input type="text"	 name="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
" id="t_fdate" >	&nbsp;&nbsp;


			<strong>To: &nbsp;</strong><input type="text"	 name="t_tdate" value="<?php echo $_smarty_tpl->tpl_vars['to']->value;?>
" id="t_tdate" >&nbsp;&nbsp;&nbsp;&nbsp;
             
			<input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['export']['v'] == 1) {?>
	  			<input type="submit" value="Export Student Emails" name="bt_export" style="font-weight:bold;">
			<?php }?>
	  </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="11"> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['iname']->value;?>
</span></td>
	</tr>			
	<tr align="left" class="greybg">
		<td colspan="13" class="title"><?php echo $_smarty_tpl->tpl_vars['page_url']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;Student: <?php echo $_smarty_tpl->tpl_vars['totals']->value['total'];?>
&nbsp;&nbsp;&nbsp;&nbsp;Offer: <?php echo $_smarty_tpl->tpl_vars['totals']->value['offer'];?>
&nbsp;&nbsp;&nbsp;&nbsp;Coe: <?php echo $_smarty_tpl->tpl_vars['totals']->value['coe'];?>
</td>
	</tr>
	<tr align="center" class="title" style="font-weight:bold ">
		<td width="10%" nowrap="nowrap">First semester start date</td>
		<td colspan="2">Students</td>
		<td width="8%">Offer</td>
		<td width="8%">Coe</td>
		<td width="8%">Confirmation<br/>no commission</td>
		<td width="12%">Course</td>
		<td width="12%">Major</td>
		<td width="9%">Course Consultant</td>
		<td width="8%"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {?>Receviable Comm<?php }?></td>
		<td width="6%"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {?>Received Comm<?php }?></td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['student_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['coedate'];?>
</td>
		<td colspan="2" style="cursor:pointer;text-decoration:underline"onClick="window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['cid'];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7);"><?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</td>
		<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['offer'] > 0) {?>yes<?php } else { ?>no<?php }?></td>
		<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['coe'] > 0) {?>yes<?php } else { ?>no<?php }?></td>
		<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['cnoc'] > 0) {?>yes<?php } else { ?>no<?php }?></td>
		<td><?php echo $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['arr']->value['course']];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['majors']->value[$_smarty_tpl->tpl_vars['arr']->value['course']][$_smarty_tpl->tpl_vars['arr']->value['major']];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['users']->value[$_smarty_tpl->tpl_vars['arr']->value['cuser']];?>
</td>
		<td><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {
echo $_smarty_tpl->tpl_vars['arr']->value['rcomm'];
}?></td>
		<td><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {
echo $_smarty_tpl->tpl_vars['arr']->value['pcomm'];
}?></td>					
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</form>	

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
<?php echo '</script'; ?>
>
	
</body>
</html><?php }
}
