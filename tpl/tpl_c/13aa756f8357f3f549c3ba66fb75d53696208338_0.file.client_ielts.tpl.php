<?php
/* Smarty version 4.3.2, created on 2023-11-22 06:47:36
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_ielts.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d33886cc307_26217160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13aa756f8357f3f549c3ba66fb75d53696208338' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_ielts.tpl',
      1 => 1474556884,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d33886cc307_26217160 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
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
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
		<table border="0" width="100%" cellpadding="3" cellspacing="1">
		  <tr align="left"  class="bordered_2">
			<td colspan="2">
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
			  <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_detail.php';this.form.submit();" value="Client Detail">&nbsp;&nbsp;
			  <input name="button" type="button" disabled style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			  <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_qual.php';this.form.submit();" value="EDU Background">&nbsp;&nbsp;
			  <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();" value="Working experience">&nbsp;&nbsp; 
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
        <?php if (in_array('homeloan',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        <?php }?>  	
			</td>
		  </tr>		
			<tr class="greybg">
				<td colspan="2"align="center" class="whitetext">IELTS Information</td>
			</tr>	
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Module:</strong></td>
				<td align="left" width="76%" class="roweven">
					<select name="t_mod" onChange="this.form.t_testday.focus();">
						<option value="academic" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['mod'] == 'academic') {?> selected <?php }?>>Academic</option>
						<option value="general" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['mod'] == 'general') {?> selected <?php }?>>General</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Test Date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" size="30" name="t_testday"  id="t_testday" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['testday'];?>
" >  
                
                </td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Overall result:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_result" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['overall'];?>
" style="background-color:#CCCC66 "></td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Listening:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_listen" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['listen'];?>
" ></td>
			</tr>	
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Reading:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_read" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['read'];?>
" ></td>
			</tr>	
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Writing:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_write" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['write'];?>
" ></td>
			</tr>				
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Speaking:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_speak" size="30" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['speak'];?>
" ></td>
			</tr>				
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Planned attending IELTS test date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_planday" size="30"  id="t_planday" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['planday'];?>
" >
               
                </td>
			</tr>																										
			<tr align="center"  class="greybg" >
				<td colspan="2">
					<input type="hidden" name="bt_name" value="">
					<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<!--<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">-->
				</td>
			</tr>									
</table>
</form>

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_testday').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_planday').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
<?php echo '</script'; ?>
>
		
</body>
</html><?php }
}
