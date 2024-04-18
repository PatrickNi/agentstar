<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:32:45
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_visa_process.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3e1d865712_82940727',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be64b7d2097309371428691a4de952dc45c514f6' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_visa_process.tpl',
      1 => 1678960396,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3e1d865712_82940727 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="vid" value="<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
">
<input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
">
<input type="hidden" name="isNew" value="<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
">
			<table border="0" width="100%" class="graybordertable" cellpadding="3" cellspacing="1">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
							<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
						</td>		
						<td align="center" class="whitetext">Visa Process Detail</td>						
						 <td align="right" width="10%">
							&nbsp;&nbsp;
						</td>
					</tr>				
				</table></td></tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
							<?php if (stripos($_smarty_tpl->tpl_vars['subject_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['itemid']],'apply') === 0 && $_smarty_tpl->tpl_vars['dt_arr']->value['date'] != '' && $_smarty_tpl->tpl_vars['dt_arr']->value['date'] != '0000-00-00' && $_smarty_tpl->tpl_vars['staff_id']->value != 3 && $_smarty_tpl->tpl_vars['dt_arr']->value['done'] == 1) {?>
								<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['date'];?>

								<input type="hidden" name="t_date" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['date'];?>
">
							<?php } else { ?>
								<input type="text" name="t_date" id="t_date" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['date'];?>
" autocomplete="off">    
							<?php }?>             
                    </td>
				</tr>
				<?php if ($_smarty_tpl->tpl_vars['isOther']->value == 1 || ($_smarty_tpl->tpl_vars['dt_arr']->value['itemid'] == '0' && $_smarty_tpl->tpl_vars['isNew']->value != 1)) {?>
					<tr>
						<td width="19%" align="left" class="rowodd">
							<strong>Additional Step:</strong>
							<br/>
							<button type="button" onclick="add_dha('DHA request')" style="font-size:smaller;">DHA request</button>
							&nbsp;
							<button type="button" onclick="add_dha('Review application')" style="font-size:smaller;">Review application</button>
						</td>
						<td align="left" width="81%" class="roweven">
							<input type="text" name="t_add" id="t_add" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['add'];?>
" style="width:600px;">
						</td>
					</tr>
				<?php } else { ?>
					<tr>
						<td width="19%" align="left" class="rowodd"><strong>Subject:</strong>&nbsp;&nbsp;</td>
						<td align="left" width="81%" class="roweven">
							<select id="t_subject" name="t_subject" onChange="sl_step()" <?php if ($_smarty_tpl->tpl_vars['isNew']->value == 1) {?>readonly<?php }?>>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subject_arr']->value, 'process', false, 'pid');
$_smarty_tpl->tpl_vars['process']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pid']->value => $_smarty_tpl->tpl_vars['process']->value) {
$_smarty_tpl->tpl_vars['process']->do_else = false;
?>
								<?php if (stripos($_smarty_tpl->tpl_vars['process']->value,'grant') !== false) {?> 
                                     <optgroup label="---------------------------------------">
                                     	<option value="<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['pid']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['itemid']) {?> selected <?php }?>>|------<?php echo $_smarty_tpl->tpl_vars['process']->value;?>
</option>
                                     	<option value="withdraw"  <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['subject'] == 'withdraw') {?> selected <?php }?>>|------Withdraw</option>
                                     	<option value="refused" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['subject'] == 'refused') {?> selected <?php }?>>|------Refused</option>
                                     	<option value="cancel agreement" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['subject'] == 'cancel agreement') {?> selected <?php }?>>|------Cancel Agreement</option>
                                     	<option value="agent stop" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['subject'] == 'agent stop') {?> selected <?php }?>>|------Stop Agent</option>
                                     	<option value="declined" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['subject'] == 'declined') {?> selected <?php }?>>|------Declined</option>
										<option value="reactive" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['subject'] == 'reactive') {?> selected <?php }?>>|------Reactive</option>
                                     </optgroup>
                                <?php } else { ?>
                                     <option value="<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['pid']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['itemid']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['process']->value;?>
</option>
								<?php }?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
								<span id="epd_span" <?php if (stripos($_smarty_tpl->tpl_vars['subject_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['itemid']],'grant') === false) {?> style="visibility:hidden;" <?php }?>>
								&nbsp;
								&nbsp;
								Expire Date: <input type="text" name="t_epdate" id="t_epdate" value="<?php echo $_smarty_tpl->tpl_vars['visa_rs']->value['epd'];?>
" size="20" <?php if (stripos($_smarty_tpl->tpl_vars['subject_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['itemid']],'grant') === false) {?> disabled="disabled"<?php }?> autocomplete="off">
								</span>								
						</td>
					</tr>
				<?php }?>										
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><input type="text" name="t_due" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['due'];?>
" id="t_due" autocomplete="off" >
                     
                    </td>
				</tr>
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<input type="checkbox" value="1"  name="t_done" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['done'] == 1) {?> checked <?php }?>>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >	
					</td>
				</tr>	
				<tr>
					<td width="19%" align="left" class="rowodd"><strong>Detail:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven"><textarea name="t_detail" style="width:600px; height:300px;"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['detail'];?>
</textarea></td>
				</tr>																						
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>									
			</table>		
</form>	

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_due').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_epdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	function sl_step() {
		 if ($("#t_subject").find("option:selected").text().indexOf('grant') != -1) {
		 	$("#epd_span").css("visibility","");
		 	$("#t_epdate").removeAttr("disabled");
		 }
		 else {
		 	$("#epd_span").css("visibility","hidden");
		 	$("#t_epdate").attr("disabled","disabled");
		 }
	}

	function add_dha(str){
		$("#t_add").val(str);
	}
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->tpl_vars['errormsg']->value;
}
}
