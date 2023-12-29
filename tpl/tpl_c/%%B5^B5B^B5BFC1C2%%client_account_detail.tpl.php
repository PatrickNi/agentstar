<?php /* Smarty version 2.6.13, created on 2020-10-24 05:36:50
         compiled from client_account_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucwords', 'client_account_detail.tpl', 38, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>


<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
">
<input type="hidden" name="aid" value="<?php echo $this->_tpl_vars['aid']; ?>
">
<input type="hidden" name="vid" value="<?php echo $this->_tpl_vars['vid']; ?>
">
<input type="hidden" name="typ" value="<?php echo $this->_tpl_vars['typ']; ?>
">
<input type="hidden" name="hCancel" value="0">
			<table width="100%" cellpadding="1" cellspacing="1" border="0" class="graybordertable">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">
						   <?php if ($this->_tpl_vars['ugs']['v_pay']['d'] == 1): ?><input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;"><?php endif; ?>						</td>		
						<td align="center" class="whitetext">Payment Detail </td>
						<td align="right" width="10%"><input name="submit" type="submit" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" value="Save" <?php if ($this->_tpl_vars['ugs']['v_pay']['v'] == 1 && $this->_tpl_vars['ugs']['v_pay']['m'] == 0 && ( $this->_tpl_vars['dt_arr']['step'] != '' || $this->_tpl_vars['ugs']['v_pay']['i'] == 0 )): ?> disabled="disabled" <?php endif; ?>></td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Item:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
				  		<select name="t_step" id="t_step">
				  			<option value="">--</option>
				  			<?php $_from = $this->_tpl_vars['steps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				  				<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['dt_arr']['step'] == $this->_tpl_vars['k']): ?> selected <?php endif; ?> data-party="<?php echo $this->_tpl_vars['v']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
 Fee</option>
				  			<?php endforeach; endif; unset($_from); ?>
				  		</select>
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>GST:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  		<input type="radio" name="t_gst" value="1" <?php if ($this->_tpl_vars['dt_arr']['gst_chk'] == 1): ?> checked <?php endif; ?>>YES &nbsp;&nbsp;
				  		<input type="radio" name="t_gst" value="0" <?php if ($this->_tpl_vars['dt_arr']['gst_chk'] == 0): ?> checked <?php endif; ?>>NO
					</td>
				</tr>				
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Due Amount:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  	<?php if ($this->_tpl_vars['ugs']['v_pay']['v'] == 1 && $this->_tpl_vars['ugs']['v_pay']['m'] == 0 && ( $this->_tpl_vars['dt_arr']['dueamt'] > 0 || $this->_tpl_vars['ugs']['v_pay']['i'] == 0 )): ?>
						<input type="hidden" name="t_dueamt" value="<?php echo $this->_tpl_vars['dt_arr']['dueamt']; ?>
">
				  	<?php endif; ?>					
						<input type="text" name="t_dueamt" value="<?php echo $this->_tpl_vars['dt_arr']['dueamt']; ?>
" size="30" onChange="audit_money(this)" <?php if ($this->_tpl_vars['ugs']['v_pay']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?>  <?php if ($this->_tpl_vars['ugs']['v_pay']['v'] == 1 && $this->_tpl_vars['ugs']['v_pay']['m'] == 0 && ( $this->_tpl_vars['dt_arr']['dueamt'] > 0 || $this->_tpl_vars['ugs']['v_pay']['i'] == 0 )): ?> disabled="disabled" <?php endif; ?>>
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Due Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
					<?php if ($this->_tpl_vars['ugs']['p_duedate']['v'] == 1 && $this->_tpl_vars['ugs']['p_duedate']['m'] == 0 && ( $this->_tpl_vars['dt_arr']['duedate'] != '' || $this->_tpl_vars['dt_arr']['duedate'] != '0000-00-00' || $this->_tpl_vars['ugs']['p_duedate']['i'] == 0 )): ?>
						<input type="hidden" name="t_duedate" value="<?php echo $this->_tpl_vars['dt_arr']['duedate']; ?>
">
					<?php endif; ?>						
					  <input type="text" name="t_duedate" id="t_duedate" value="<?php echo $this->_tpl_vars['dt_arr']['duedate']; ?>
" size="30" onchange="audit_date(this)" <?php if ($this->_tpl_vars['ugs']['p_duedate']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['p_duedate']['v'] == 1 && $this->_tpl_vars['ugs']['p_duedate']['m'] == 0 && ( $this->_tpl_vars['dt_arr']['duedate'] != '' || $this->_tpl_vars['dt_arr']['duedate'] != '0000-00-00' || $this->_tpl_vars['ugs']['p_duedate']['i'] == 0 )): ?> disabled="disabled"<?php endif; ?>>

					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
				  		<input type="text" name="t_party" id="t_party" value="<?php echo $this->_tpl_vars['dt_arr']['party']; ?>
" size="30">
				  		<!--
				  		<select name="t_party" id="t_party">
				  			<?php $_from = $this->_tpl_vars['steps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				  				<option value="<?php echo $this->_tpl_vars['v']; ?>
" step="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['dt_arr']['party'] == $this->_tpl_vars['v']): ?> selected <?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
</option>
				  			<?php endforeach; endif; unset($_from); ?>
				  		</select>
				  		-->
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction GST:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  		<input type="radio" name="t_gst_3rd" value="1" <?php if ($this->_tpl_vars['dt_arr']['gst_3rd_chk'] == 1): ?> checked <?php endif; ?>>YES &nbsp;&nbsp;
				  		<input type="radio" name="t_gst_3rd" value="0" <?php if ($this->_tpl_vars['dt_arr']['gst_3rd_chk'] == 0): ?> checked <?php endif; ?>>NO
					</td>
				</tr>
<tr>
					<td width="25%" align="left" class="rowodd"><strong>Deduction Amount:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
				  	<?php if ($this->_tpl_vars['ugs']['v_pay']['v'] == 1 && $this->_tpl_vars['ugs']['v_pay']['m'] == 0 && ( $this->_tpl_vars['dt_arr']['dueamt_3rd'] > 0 || $this->_tpl_vars['ugs']['v_pay']['i'] == 0 )): ?>
						<input type="hidden" name="t_dueamt_3rd" value="<?php echo $this->_tpl_vars['dt_arr']['dueamt_3rd']; ?>
">
				  	<?php endif; ?>					
						<input type="text" name="t_dueamt_3rd" value="<?php echo $this->_tpl_vars['dt_arr']['dueamt_3rd']; ?>
" size="30" onChange="audit_money(this)" <?php if ($this->_tpl_vars['ugs']['v_pay']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?>  <?php if ($this->_tpl_vars['ugs']['v_pay']['v'] == 1 && $this->_tpl_vars['ugs']['v_pay']['m'] == 0 && ( $this->_tpl_vars['dt_arr']['dueamt_3rd'] > 0 || $this->_tpl_vars['ugs']['v_pay']['i'] == 0 )): ?> disabled="disabled" <?php endif; ?>>
					</td>
				</tr>																
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Notes:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven"><textarea name="t_note" style="width:100%; height:100px;"><?php echo $this->_tpl_vars['dt_arr']['note']; ?>
</textarea></td>
				</tr>				
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>										
			</table>
</form>	
<?php echo '
<script type="text/javascript">
	$(\'#t_duedate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }); 
	
	$(\'#t_step\').change(function(){
		//$(\'#t_party option[step=\'+$(this).val()+\']\').attr(\'selected\', true);
		$(\'#t_party\').val($(this).find(\'option:selected\').attr(\'data-party\'));
	});       
</script>
'; ?>
	
</body>
</html>