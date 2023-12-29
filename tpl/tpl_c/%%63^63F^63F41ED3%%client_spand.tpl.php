<?php /* Smarty version 2.6.13, created on 2020-10-24 05:46:24
         compiled from client_spand.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'client_spand.tpl', 36, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>

<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="aid" value="<?php echo $this->_tpl_vars['aid']; ?>
">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Net Spand History</span>
		 </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">3rd Party Amount:<?php echo $this->_tpl_vars['account']['dueamt_3rd']; ?>
</span></td>
	</tr>			
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<td width="2%">&nbsp;</td>
					<td >Paid Date</td>
					<td >Paid Amount</td>
				</tr>
				<?php $_from = $this->_tpl_vars['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['arr']):
?>
				<tr align="center" class="roweven">
					<td ><input type="radio" name="pid" value="<?php echo $this->_tpl_vars['id']; ?>
" onClick="setPayment(this)"></td>
					<td id="d_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['arr']['date']; ?>
</td>
					<td id="a_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
			</table>
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr><td colspan="2"><hr></td></tr>
				<tr><td colspan="2" align="center" class="totalrowodd"><input type="checkbox" name="t_new" id="t_new" value="1" onClick="newPayment(this)">&nbsp;Add new</td></tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Date</strong></td>
					<td width="50%" align="left" class="roweven"><input name="t_date" id="t_date" id="t_date" value="" size="30">                      
                    </td>
				</tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Amount</strong></td>
					<td width="50%" align="left"  class="roweven"><input name="t_paid" id="t_paid" value="" size="30" onChange="audit_money(this)"></td>
				</tr>
				<tr align="center"  class="greybg">
					<input type="hidden" name="bt_name" value="">
					<td align="left">
						<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
					</td>		
					 <td align="right">
						<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>	

<?php echo '
<script type="text/javascript">
	$(\'#t_date\').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});        
</script>
'; ?>
	
</body>
</html>