<?php
/* Smarty version 4.3.2, created on 2024-01-09 15:21:18
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_visa_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659cf3ee7d5811_90053452',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4db4262add90cfb1bd73f6c7ecfba2f08288f8f' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_visa_detail.tpl',
      1 => 1704784864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659cf3ee7d5811_90053452 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/function.math.php','function'=>'smarty_function_math',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
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
 language="javascript" src="../js/audit.js?v1"><?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

<body> 
  <table border="0" width="95%" cellpadding="2" cellspacing="3"> 
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<td align="left" width="10%">
				<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['d'] == 1) {?>
				<input type="submit" value="Delete" style="font-weight:bold" onClick="del_visa(this)">&nbsp;&nbsp;&nbsp;
				<?php }?>
                <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['auser'] != $_smarty_tpl->tpl_vars['uid']->value) {?>
				<input type="button" value="Attachment" style="font-weight:bold"
			onClick="window.open('/scripts/attachment.php?item=<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*4/7);">
                <?php }?>
			</td>					
			<td align="center" class="whitetext"> Visa Service Detail &nbsp;&nbsp; </td> 			
			<td align="left" width="30%">
				<input type="button" value="Save" style="font-weight:bold" onClick="save_visa(this, false);" >
                <input type="button" value="Save &amp; Close" style="font-weight:bold" onClick="save_visa(this, true);">
			</td>
		</tr>		
	</table></td></tr>
    <tr align="center"  class="greybg" > 
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_visa.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"> <span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span>&nbsp;&nbsp; </td> 
    </tr> 
    <tr>
      	<td width="60%" align="left" valign="top"> 
		<form method="get" id="form1" name="form1" action="/scripts/client_visa_detail.php" target="_self" onSubmit="return isDelete()" >
			<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
"> 
			<input type="hidden" name="vid" id="vid" value="<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
"> 
			<input type="hidden" name="hCancel" value="0"> 
			<input type="hidden" name="bt_name" id="bt_name" value="">
		  <table border="0" width="100%" cellpadding="3" cellspacing="1">
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Status</strong></td> 
				<td align="left" width="64%" class="roweven">
					<span class="highlighttext"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['status'];?>
</span>
					<input type="hidden" name="t_status", value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['status'];?>
">
					<!--
					<select name="t_status" class="highlighttext">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['status']->value, 'st', false, 'id');
$_smarty_tpl->tpl_vars['st']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['st']->value) {
$_smarty_tpl->tpl_vars['st']->do_else = false;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['st']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['st']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['status']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['st']->value;?>
</option>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>&nbsp;&nbsp;&nbsp;
					-->
					<?php if ($_smarty_tpl->tpl_vars['showCourse']->value == 1) {?><a href="./client_course_cp.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
" target="_blank">show course</a><?php }?>
				</td> 
			</tr>	  	  
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Visa Category:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven"> 
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['i'] == 0)) {?><input type="hidden" name="t_visa" value="<?php echo $_smarty_tpl->tpl_vars['catid']->value;?>
"> <?php }?>
					<select name="t_visa" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['i'] == 0)) {?> disabled <?php }?>> 
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cate_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>										 
						<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['catid']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>                 
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if ($_smarty_tpl->tpl_vars['catid']->value == 0) {?><option value="0" selected>select a category</option><?php }?> 
					</select>
				</td> 
			</tr> 
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Visa Subclass:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven"> 
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['i'] == 0)) {?><input type="hidden" name="t_class" value="<?php echo $_smarty_tpl->tpl_vars['subid']->value;?>
"> <?php }?>
					<select name="t_class" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_visa']['i'] == 0)) {?> disabled <?php }?>> 
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['class_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?> 
							<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['subid']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option> 
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if ($_smarty_tpl->tpl_vars['subid']->value == 0) {?><option value="0" selected>select a subclass</option><?php }?>
					</select>			
				</td> 
			</tr>   
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Dependant Expire Date:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven">
					<?php if ($_smarty_tpl->tpl_vars['vid']->value > 0 && $_smarty_tpl->tpl_vars['ugs']->value['v_dp']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_dp']['m'] == 1) {?> <input type="button" value="add dependant" onClick="openModel('client_dep.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&vid=<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
',800,400,'NO', 'form1')">         
					<br><?php }?>
					<table width="100%" border="0" cellpadding="2" cellspacing="0" class="yellowbg" >
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dependants']->value, 'arr', false, 'depid');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['depid']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
						<tr align="left">
							<td>
								<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_dp']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_dp']['m'] == 0 && ($_smarty_tpl->tpl_vars['arr']->value['expdate'] != '' && $_smarty_tpl->tpl_vars['arr']->value['expdate'] != '0000-00-00' || $_smarty_tpl->tpl_vars['ugs']->value['v_dp']['i'] == 0)) {?>
									<input name="dep_<?php echo $_smarty_tpl->tpl_vars['depid']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['expdate'];?>
">
								<?php }?>
								<input name="dep_<?php echo $_smarty_tpl->tpl_vars['depid']->value;?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['expdate'];?>
" size="30" onchange="audit_date(this)" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_dp']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_dp']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_dp']['m'] == 0 && ($_smarty_tpl->tpl_vars['arr']->value['expdate'] != '' && $_smarty_tpl->tpl_vars['arr']->value['expdate'] != '0000-00-00' || $_smarty_tpl->tpl_vars['ugs']->value['v_dp']['i'] == 0)) {?> disabled <?php }?>>
							</td>
							<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
						</tr>			
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</table>
				</td> 
			</tr> 		  	
			<tr> 
				<td colspan="2" height="5"><hr></td> 
			</tr>		  		  		  
			<?php if ($_smarty_tpl->tpl_vars['isViewBody']->value) {?>
			<tr>
				<td width="36%" align="left" class="rowodd"><strong>Assessment  Body:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="64%" class="roweven">
				<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['i'] == 0)) {?><input type="hidden" name="t_body" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['body'];?>
"> <?php }?>				
				<select name="t_body" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['i'] == 0)) {?> disabled <?php }?>>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['abodys']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['body']) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
				<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['body'] == 0) {?><option value="0" selected>n/a</option><?php }?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="36%" align="left" class="rowodd"><strong>ASCO:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="64%" class="roweven">
				<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['i'] == 0)) {?><input type="hidden" name="t_asco" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['asco'];?>
"> <?php }?>				
				<select name="t_asco"  <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_abas']['i'] == 0)) {?> disabled <?php }?>>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ascos']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['asco']) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
				<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['asco'] == 0) {?><option value="0" selected>n/a</option><?php }?>
				</select>
				</td>
			</tr>		  
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['isViewState']->value) {?>
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>State Sponsor:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven">
					<select name="t_sponsor">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sponsors']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['state']) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
					</select>			
				</td> 
			</tr> 
		  	<?php }?>

			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Agreement Staff:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven"> 
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['i'] == 0)) {?><input type="hidden" name="t_auser" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['auser'];?>
"> <?php }?>
					<select name="t_auser" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['i'] == 0)) {?> disabled <?php }?>>
										<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['auser'] < 1 || !(isset($_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['auser']]))) {?>
						<option  value="0" selected >select a user</option>
					<?php }?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
					<option  value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['auser'] == $_smarty_tpl->tpl_vars['id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>			
				</td> 
			</tr> 
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Visa Paperwork:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven"> 
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['i'] == 0)) {?><input type="hidden" name="t_vuser" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['vuser'];?>
"> <?php }?>
					<select name="t_vuser" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['m'] == 0 && ($_smarty_tpl->tpl_vars['vid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['i'] == 0)) {?> disabled <?php }?>>         
										<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['vuser'] < 1 || !(isset($_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['vuser']]))) {?>
						<option  value="0" selected >select a user</option>
					<?php }?>        
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
						<option  value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['vuser'] == $_smarty_tpl->tpl_vars['id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option> 
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>			
				</td> 
			</tr>
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Reviewer:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven"> 
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_reviewer']['m'] == 0 && $_smarty_tpl->tpl_vars['dt_arr']->value['reviewer'] > 0) {?>
						<input type="hidden" name="t_reviewer" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['reviewer'];?>
">
						<?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['reviewer']];?>

					<?php } else { ?>
						<select name="t_reviewer">      
						<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['reviewer'] < 1 || !(isset($_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['reviewer']]))) {?>
							<option  value="0" selected >select a reviwer</option>
						<?php }?>           
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
							<option  value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['reviewer'] == $_smarty_tpl->tpl_vars['id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option> 
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</select>	
					<?php }?>		
				</td> 
			</tr>
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Consult Date:</strong></td> 
				<td align="left" width="64%" class="roweven">
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['m'] == 0 && (($_smarty_tpl->tpl_vars['dt_arr']->value['vdate'] != '' && $_smarty_tpl->tpl_vars['dt_arr']->value['vdate'] != '0000-00-00') || $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['i'] == 0)) {?>
						<input type="hidden" name="t_first" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['vdate'];?>
" autocomplete="off"> 
					<?php }?>
					<input autocomplete="off" type="text" id="t_first" name="t_first" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['vdate'];?>
" size="30" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['m'] == 0 && (($_smarty_tpl->tpl_vars['dt_arr']->value['vdate'] != '' && $_smarty_tpl->tpl_vars['dt_arr']->value['vdate'] != '0000-00-00') || $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['i'] == 0)) {?> disabled <?php }?>>               
				</td> 
			</tr>           
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Consult Fee:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven">
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['m'] == 0 && (($_smarty_tpl->tpl_vars['dt_arr']->value['cfee'] > 0) || $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['i'] == 0)) {?>
						<input type="hidden" name="t_cfee" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['cfee'];?>
"> 
					<?php }?>
					<input type="text" id="t_cfee" name="t_cfee" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['cfee'];?>
" size="30" onChange="audit_money(this)"  <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['m'] == 0 && (($_smarty_tpl->tpl_vars['dt_arr']->value['cfee'] > 0) || $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['i'] == 0)) {?> disabled <?php }?>> 
				</td> 
			</tr> 
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Net Amount:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven">
					<?php echo $_smarty_tpl->tpl_vars['net_camount']->value;?>
 
				</td> 
			</tr>          
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Agreement Date:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven">
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['m'] == 0 && (($_smarty_tpl->tpl_vars['dt_arr']->value['adate'] != '' && $_smarty_tpl->tpl_vars['dt_arr']->value['adate'] != '0000-00-00') || $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['i'] == 0)) {?>
						<input type="hidden" name="t_adate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['adate'];?>
"> 
					<?php }?>
					<input autocomplete="off" type="text" id="t_adate" name="t_adate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['adate'];?>
" size="30" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['m'] == 0 && (($_smarty_tpl->tpl_vars['dt_arr']->value['adate'] != '' && $_smarty_tpl->tpl_vars['dt_arr']->value['adate'] != '0000-00-00') || $_smarty_tpl->tpl_vars['ugs']->value['v_agd']['i'] == 0)) {?> disabled <?php }?>> 
				</td> 
			</tr> 
			<tr> 
				<td width="36%" align="left" class="rowodd"><strong>Company:</strong>&nbsp;&nbsp;</td> 
				<td align="left" width="64%" class="roweven">
					<select name="t_company">
						<option  value="" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['company'] == '') {?>selected<?php }?>>n/a</option>
						<option  value="geic" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['company'] == "geic") {?>selected<?php }?>>GEIC</option>
						<option  value="global_law_center" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['company'] == "global_law_center") {?>selected<?php }?>>Global Law Center</option>      
					</select>						
				</td> 
			</tr> 
          	<tr><td colspan="2"><hr/></td></tr>                    
			<tr>
				<td colspan="2"> 
			
					<table border="0" cellpadding="1" cellspacing="1" width="100%"> 
						<tr class="greybg"> 
						<td colspan="11" class="whitetext" align="center">Payment</td> 
						</tr>
						<tr align="center" class="totalrowodd">
							<td>Item</td>
							<td>Gross<br/>Due</td>
							<td>GST</td>
							<td>Total<br/>Received</td>
							<td>Deduction</td>
							<td>Gross<br/>Deduction</td>
							<td>GST</td>
							<td>Total Paid</td>
							<td>Gross Profit</td>
							<td>Net Profit</td>
							<!--
							<td>Agreement<br/>Profit</td>
							<td>Paperwork<br/>Profit</td>
							-->
						</tr>
						<?php $_smarty_tpl->_assignInScope('total_profit', "0");?>
						<?php $_smarty_tpl->_assignInScope('total_profit_3rd', "0");?>
						<?php $_smarty_tpl->_assignInScope('total_dueamt', "0");?>
						<?php $_smarty_tpl->_assignInScope('total_received', "0");?>
						<?php $_smarty_tpl->_assignInScope('agreement_profit', "0");?>
						<?php $_smarty_tpl->_assignInScope('paperwork_profit', "0");?>
						<?php $_smarty_tpl->_assignInScope('net_profit', "0");?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['account_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
						<tr align="center" class="roweven">
							<td style="text-decoration:underline; cursor:pointer" onClick="window.open('client_account_detail.php?vid=<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
&aid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&typ=visa','_blank', 'alwaysRaised=yes,height=500, width=800,location=no,scrollbars=yes')" ><?php echo ucwords($_smarty_tpl->tpl_vars['arr']->value['step']);?>
</td>
							<td align="right">
								<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['dueamt']);?>

								<?php $_smarty_tpl->_assignInScope('total_dueamt', $_smarty_tpl->tpl_vars['total_dueamt']->value+$_smarty_tpl->tpl_vars['arr']->value['dueamt']);?>	
							</td>
							<td align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['gst']);?>
</td>
							<td align="right">
									<span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_payment.php?aid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['paid']);?>
</span>
									<?php $_smarty_tpl->_assignInScope('total_received', $_smarty_tpl->tpl_vars['total_received']->value+$_smarty_tpl->tpl_vars['arr']->value['paid']);?>	
							</td>
							<td><?php echo ucwords($_smarty_tpl->tpl_vars['arr']->value['party']);?>

							</td>
							<td align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['dueamt_3rd']);?>
</td>
							<td align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['gst_3rd']);?>
</td>
							<td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_spand.php?aid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['spand']);?>
</span></td>
							<td align="right">
								<?php echo sprintf("%.2f",($_smarty_tpl->tpl_vars['arr']->value['paid']-$_smarty_tpl->tpl_vars['arr']->value['spand']));?>
	
							</td>
							<td align="right">
								<?php if ($_smarty_tpl->tpl_vars['arr']->value['gst'] > 0) {?>
									<?php echo smarty_function_math(array('equation'=>"(x - y)/1.1",'x'=>$_smarty_tpl->tpl_vars['arr']->value['paid'],'y'=>$_smarty_tpl->tpl_vars['arr']->value['spand'],'assign'=>"net_profit"),$_smarty_tpl);?>

								<?php } else { ?>
									<?php $_smarty_tpl->_assignInScope('net_profit', $_smarty_tpl->tpl_vars['arr']->value['paid']-$_smarty_tpl->tpl_vars['arr']->value['spand']);?>
								<?php }?>
								
								<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['net_profit']->value);?>

								<?php if ($_smarty_tpl->tpl_vars['arr']->value['step'] == 'agreement' || $_smarty_tpl->tpl_vars['arr']->value['step'] == 'extra-agreement') {?>
									<?php $_smarty_tpl->_assignInScope('total_profit', $_smarty_tpl->tpl_vars['total_profit']->value+$_smarty_tpl->tpl_vars['net_profit']->value);?>
								<?php } else { ?>
									<?php $_smarty_tpl->_assignInScope('total_profit_3rd', $_smarty_tpl->tpl_vars['total_profit_3rd']->value+$_smarty_tpl->tpl_vars['net_profit']->value);?>
								<?php }?>
							</td>
							<!--
							<td align="right">
								<?php if ($_smarty_tpl->tpl_vars['arr']->value['step'] != 'app') {?>
									<?php echo sprintf("%.2f",($_smarty_tpl->tpl_vars['arr']->value['dueamt']-$_smarty_tpl->tpl_vars['arr']->value['gst']-'dueamt_3rd'+$_smarty_tpl->tpl_vars['arr']->value['gst_3rd']));?>

									<?php $_smarty_tpl->_assignInScope('agreement_profit', $_smarty_tpl->tpl_vars['agreement_profit']->value+$_smarty_tpl->tpl_vars['arr']->value['dueamt']-$_smarty_tpl->tpl_vars['arr']->value['gst']-'dueamt_3rd'+$_smarty_tpl->tpl_vars['arr']->value['gst_3rd']);?>
								<?php } else { ?>
									0.00
								<?php }?>
							</td>
							<td align="right">
								<?php if ($_smarty_tpl->tpl_vars['arr']->value['step'] != 'app') {?>
									<?php echo sprintf("%.2f",($_smarty_tpl->tpl_vars['arr']->value['paid']-$_smarty_tpl->tpl_vars['arr']->value['gst']-$_smarty_tpl->tpl_vars['arr']->value['spand']+$_smarty_tpl->tpl_vars['arr']->value['gst_3rd']));?>

									<?php $_smarty_tpl->_assignInScope('paperwork_profit', $_smarty_tpl->tpl_vars['paperwork_profit']->value+$_smarty_tpl->tpl_vars['arr']->value['paid']-$_smarty_tpl->tpl_vars['arr']->value['gst']-$_smarty_tpl->tpl_vars['arr']->value['spand']+$_smarty_tpl->tpl_vars['arr']->value['gst_3rd']);?>
								<?php } else { ?>
									0.00
								<?php }?>
							</td>
							-->                                                
						</tr>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<tr align="center" class="roweven">
							<td align="right"><strong>Total Due:</strong></td>
							<td align="right"><strong><?php echo sprintf("%.2f",($_smarty_tpl->tpl_vars['total_dueamt']->value-$_smarty_tpl->tpl_vars['total_received']->value));?>
</strong></td>
							<td align="right" colspan="7"><strong>Total:</strong></td>
							<td align="right"><strong><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total_profit']->value);?>
</strong></td>
						</tr>	
						<tr align="center" class="roweven">
							<td align="right" colspan="9"><strong>Total 3rd:</strong></td>
							<td align="right"><strong><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total_profit_3rd']->value);?>
</strong></td>
						</tr>						
						<tr align="center" class="roweven">
							<td colspan="11" align="center">
								<?php if ($_smarty_tpl->tpl_vars['vid']->value > 0 && ($_smarty_tpl->tpl_vars['dt_arr']->value['adate'] != '' && $_smarty_tpl->tpl_vars['dt_arr']->value['adate'] != '0000-00-00')) {?>        
									<input type="button" value="Add new" onclick="window.open('client_account_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&vid=<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
&typ=visa','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')" />
								<?php } else { ?>
									<span id='btn_payment'></span>
								<?php }?>
							</td>
						</tr>				          	
					</table>
			
				</td>	
			</tr>   

			<tr> 
				<td colspan="2" height="5"><hr></td> 
			</tr>
			<tr>
				<td align="left" class="roweven" colspan="2" >
					<strong>Notes</strong>
					<textarea style="width:100%; height:100% " name="t_key"  rows="50"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['key'];?>
</textarea>
				</td> 
			</tr>
        </table>
		</form>
        </td>
        <td width="40%" align="left" valign="top"> 
      		<div style="width:100%;overflow-X:auto; overflow-Y:auto;"> 
	          <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
	            <tr class="greybg"> 
	              <td colspan="4" class="whitetext" align="center">Process &nbsp; 
                    <?php if ($_smarty_tpl->tpl_vars['vid']->value > 0) {?>
	                	<input type="button" value="add new" style="font-weight:bold" onClick="window.open('client_visa_process.php?vid=<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&isNew=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')"></td> 
	                <?php } else { ?>
						<span id='btn_process'></span>
					<?php }?>
                </tr> 
	            <tr align="center" class="totalrowodd"> 
	              <td class="border_1" width="15%">Date</td> 
	              <td class="border_1" width="65%">Subject</td> 
				  <td class="border_1" width="15%">Due</td>
	              <td class="border_1" width="5%">Insert</td> 
	            </tr> 
	            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['process_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	            <tr align="left" class="roweven"> 
	              <td class="border_1"><span style="font-size:16px;font-weight:bolder; color:#990000"><?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?>&radic;<?php } else { ?>?<?php }?></span><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td> 
	              <td class="border_1"><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_process.php?vid=<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank','alwaysRaised=yes,height='+screen.height*1/3+',width='+screen.width*1/2+', location=no')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['subject'];?>
</span></td>
				  <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
	              <td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_visa_process.php?vid=<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&isNew=1&isOther=1','_blank','alwaysRaised=yes,height='+screen.height*1/3+',width='+screen.width*1/2+', location=no')"></td> 
	            </tr> 
	            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	          </table> 
        	</div>
        	<hr/>
			<?php if ($_smarty_tpl->tpl_vars['show_checklist']->value == 1) {?> 
			<div style="width:100%;overflow-X:auto; overflow-Y:auto;">
				<span id="cl_msg"></span>
				<form method="posts" id="form_checklists" name="form_checklists" action="/scripts/checklist_ajax.php"> 
				 	<input type="hidden" name="cl_act" id="cl_act" value="">
					<input type="hidden" name="cl_typ" id="cl_typ" value="visa">
    				<input type="hidden" name="cl_appid" id="cl_appid" value="<?php echo $_smarty_tpl->tpl_vars['vid']->value;?>
">
					<input type="hidden" name="cl_tplid" id="cl_tplid" value="1">
				</form>
			</div>
			<?php }?>
    	</td> 
    </tr> 
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>
  </table> 

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_epdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_first').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_adate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

	init_href = window.location.href;
    function save_visa(obj,close_w){
        $('#bt_name').val('save');
        btn_n = $(obj).val();
        $(obj).val('waiting...');
        //ContentType UTF-8
        $.post($('#form1').attr('action'), $('#form1').serialize(), function(data){
			console.log(data);
            rtn = $.parseJSON(data);
            
            $(obj).val(btn_n);
/*
			if (rtn.id > 0) {
                $('#vid').val(rtn.id);
				$('#cl_appid').val(rtn.id);
			    $('#btn_payment').html('<input type="button" value="Add new" onclick="window.open(\''+rtn.btn_payment+'\',\'_blank\', \'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes\')">');
				$('#btn_process').html('<input type="button" value="add new" style="font-weight:bold" onClick="window.open(\''+rtn.btn_process+'\',\'_blank\',\'alwaysRaised=yes,height=500,width=800, location=no\')">');
				do_checklist('');
			}
            else {
                
            }
*/
			if (rtn.id == 0) {
				alert(rtn.msg);
                return false;
			}
            if (close_w) {
                if(window.opener && !window.opener.closed){
                    window.opener.location.reload(true);
                }
                window.close();
            }
            else{
                if (init_href.indexOf('&vid=' + rtn.id) == -1){
			window.location.href = init_href + '&vid=' + rtn.id;  
		}
		else {
			window.location.href = init_href;
		}  

            }
        });
    }

	function del_visa(obj) {
		if(confirm("Do your want to DELETE currency visa case?")) {
			$('#bt_name').val('delete');
			$('#form1').submit();
		}
	}	

	function do_checklist(act){
		$('#cl_act').val(act);
		$('#cl_msg').html('loading...');
		$.post($('#form_checklists').attr('action'), $('#form_checklists').serialize(), function(data){
			if (data == 'Incorrect parameters') {
				$('#cl_msg').html(data);	
			}
			else {
				$('#form_checklists').html(data);
				$('#cl_msg').html('');
			}

		});	
	}
    do_checklist('');
<?php echo '</script'; ?>
>

<?php }
}
