<?php
/* Smarty version 4.3.2, created on 2023-11-27 13:15:04
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_sem_process.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_656425d86eae81_58803069',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '121bd9b3bc91cdca9a9b0ba1485f9e475c2f5fa7' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_sem_process.tpl',
      1 => 1462396154,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_656425d86eae81_58803069 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" media="all" href="../js/calendar/calendar.css" title="win2k-cold-1">
<?php echo '<script'; ?>
 type="text/javascript" src="../js/calendar/calendar.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../js/calendar/lang/calendar-en.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../js/calendar/calendar-setup.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="semid" value="<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
">
<input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
">
<input type="hidden" name="isNew" value="<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
">
			<table border="0" width="100%" class="graybordertable" cellpadding="3" cellspacing="1">
				<tr><td colspan="2"><table cellspacing="0" cellpadding="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
							<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>>
						</td>		
						<td align="center" class="whitetext">Semester Process Detail</td>
						 <td align="right" width="10%">
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>>
						</td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_date" id="t_date" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['date'];?>
" onChange="audit_date(this)">
      	      	
          		<?php echo '<script'; ?>
 type="text/javascript">
					Calendar.setup({
								inputField : "t_date",
								ifFormat   : "%Y-%m-%d",
								eventName  : "dblclick",
								step       :  1
					});
				<?php echo '</script'; ?>
> 
                                 
                    
                    </td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Subject:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<input type="text" name="t_subject" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['subject'];?>
" size="50">
					</td>
				</tr>									
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_detail" style="width:300px; height:100px;"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['detail'];?>
</textarea></td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_due" id="t_due" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['due'];?>
" onChange="audit_date(this)">
      	      	
          		<?php echo '<script'; ?>
 type="text/javascript">
					Calendar.setup({
								inputField : "t_due",
								ifFormat   : "%Y-%m-%d",
								eventName  : "dblclick",
								step       :  1
					});
				<?php echo '</script'; ?>
> 
                              
                    </td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="checkbox" value="1"  name="t_done" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['done'] == 1) {?> checked <?php }?>></td>
				</tr>																							
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>					
			</table>		
</form>	
<?php echo $_smarty_tpl->tpl_vars['errormsg']->value;?>

</body>
</html><?php }
}
