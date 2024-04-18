<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:26:11
  from '/data/wwwroot/agentstar.geic.com.au/tpl/agent_student.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3c938af924_55915390',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f19c5b976920691377c742d86630c8257afc33c1' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/agent_student.tpl',
      1 => 1594763050,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3c938af924_55915390 (Smarty_Internal_Template $_smarty_tpl) {
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
	  <td colspan="4">
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
	  <td align="right" colspan="8">
	  		<!--
	  		Staff: &nbsp;&nbsp;
        	<select name="t_staff" onChange="this.form.submit();">
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
          	</select>
          -->
	 		<strong>From: &nbsp;</strong><input type="text"	 name="t_fdate" id="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
" onChange="audit_date(this)">	  
            &nbsp;&nbsp;
			<strong>To: &nbsp;</strong><input type="text"	 name="t_tdate" id="t_tdate" value="<?php echo $_smarty_tpl->tpl_vars['to']->value;?>
" onChange="audit_date(this)">&nbsp;&nbsp;
           
			<input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
	  </td>
	</tr>
	<tr align="left" class="greybg">
		<td colspan="12" class="title"><?php echo $_smarty_tpl->tpl_vars['page_url']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;Student: <?php echo $_smarty_tpl->tpl_vars['totals']->value['total'];?>
&nbsp;&nbsp;&nbsp;&nbsp; Offer: <?php echo $_smarty_tpl->tpl_vars['totals']->value['offer'];?>
&nbsp;&nbsp;&nbsp;&nbsp; Coe: <?php echo $_smarty_tpl->tpl_vars['totals']->value['coe'];?>
</td>
	</tr>
	<tr align="center" class="title" style="font-weight:bold ">
		<td width="11%">First semester start date</td>
		<td colspan="2">Students</td>
		<td width="8%">Offer</td>
		<td width="8%">Coe</td>
		<td width="12%">Institute</td>
		<td width="17%">Course</td>
		<td width="16%">Major</td>
		<td width="9%">Course Consultant</td>
		<?php if (($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['type'] == 'top' && $_smarty_tpl->tpl_vars['ugs']->value['a_rev']['v'] == 1) || ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['type'] == 'sub' && $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['cate'] == 'education' && $_smarty_tpl->tpl_vars['ugs']->value['ap_ppc']['v'] == 1) || ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['type'] == 'sub' && $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['cate'] == 'student' && $_smarty_tpl->tpl_vars['ugs']->value['aa_ppc']['v'] == 1)) {?>
			<td width="6%">Receivable Commissions</td>
			<td width="6%">Received Commissions</td>
		<?php } else { ?>
			<td width="6%"></td>
			<td width="6%"></td>				
		<?php }?>
	
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
		<td colspan="2" style="cursor:pointer;text-decoration:underline"onClick="window.open('client_course.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['cid'];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7);"><?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</td>
		<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['offer'] > 0) {?>yes<?php } else { ?>no<?php }?></td>
		<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['coe'] > 0) {?>yes<?php } else { ?>no<?php }?></td>
		<td><?php echo $_smarty_tpl->tpl_vars['schools']->value[$_smarty_tpl->tpl_vars['arr']->value['school']];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['arr']->value['school']][$_smarty_tpl->tpl_vars['arr']->value['course']];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['majors']->value[$_smarty_tpl->tpl_vars['arr']->value['course']][$_smarty_tpl->tpl_vars['arr']->value['major']];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['users']->value[$_smarty_tpl->tpl_vars['arr']->value['cuser']];?>
</td>
		<?php if (($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['type'] == 'top' && $_smarty_tpl->tpl_vars['ugs']->value['a_rev']['v'] == 1) || ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['type'] == 'sub' && $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['cate'] == 'education' && $_smarty_tpl->tpl_vars['ugs']->value['ap_ppc']['v'] == 1) || ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['type'] == 'sub' && $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['cate'] == 'student' && $_smarty_tpl->tpl_vars['ugs']->value['aa_ppc']['v'] == 1)) {?>
			<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['ccomm'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['pcomm'];?>
</td>
		<?php } else { ?>
			<td></td>
			<td></td>			
		<?php }?>					
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
