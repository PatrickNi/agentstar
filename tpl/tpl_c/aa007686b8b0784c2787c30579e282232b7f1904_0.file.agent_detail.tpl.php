<?php
/* Smarty version 4.3.2, created on 2024-01-18 16:55:50
  from '/data/wwwroot/agentstar.geic.com.au/tpl/agent_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_65a8e796514742_53996713',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa007686b8b0784c2787c30579e282232b7f1904' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/agent_detail.tpl',
      1 => 1703762469,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65a8e796514742_53996713 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form name="form1" action="" target="_self" method="post">
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
">
<input type="hidden" name="t_type" value="<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['type']) {
echo $_smarty_tpl->tpl_vars['dt_arr']->value['type'];
} else {
echo $_smarty_tpl->tpl_vars['exType']->value;
}?>">
<table align="center" width="100%"  class="graybordertable">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
			<input style="font-weight:bold;" type="button" value="<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == 'student') {?>Ambassador<?php } else { ?>Agent<?php }?> Detail" onClick="javascript:this.form.action='agent_add.php';this.form.submit();">&nbsp;&nbsp;
			<?php if ($_smarty_tpl->tpl_vars['aid']->value > 0 && (($_smarty_tpl->tpl_vars['exType']->value == 'top' && $_smarty_tpl->tpl_vars['ugs']->value['a_proc']['v'] == 1) || ($_smarty_tpl->tpl_vars['exType']->value == 'sub' && $_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == 'education' && $_smarty_tpl->tpl_vars['ugs']->value['ap_pa']['v'] == 1) || ($_smarty_tpl->tpl_vars['exType']->value == 'sub' && $_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "student" && $_smarty_tpl->tpl_vars['ugs']->value['aa_pa']['v'] == 1))) {?>
			<input style="font-weight:bold;" type="button" value="Process" onClick="javascript:this.form.action='agent_process.php';this.form.submit();">&nbsp;&nbsp;
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['aid']->value > 0 && (($_smarty_tpl->tpl_vars['exType']->value == 'top' && $_smarty_tpl->tpl_vars['ugs']->value['a_st']['v'] == 1) || ($_smarty_tpl->tpl_vars['exType']->value == 'sub' && $_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == 'education' && $_smarty_tpl->tpl_vars['ugs']->value['ap_st']['v'] == 1) || ($_smarty_tpl->tpl_vars['exType']->value == 'sub' && $_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "student" && $_smarty_tpl->tpl_vars['ugs']->value['aa_st']['v'] == 1))) {?>
			<input style="font-weight:bold;" type="button" value="Student" onClick="javascript:this.form.action='agent_student.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Visa" onClick="javascript:this.form.action='agent_visa.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Coach" onClick="javascript:this.form.action='agent_coach.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Legal" onClick="javascript:this.form.action='agent_legal.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Home Loan" onClick="javascript:this.form.action='agent_homeloan.php';this.form.submit();">&nbsp;&nbsp;
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['aid']->value > 0 && ($_smarty_tpl->tpl_vars['exType']->value == 'top' || ($_smarty_tpl->tpl_vars['exType']->value == 'sub' && $_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == 'education' && $_smarty_tpl->tpl_vars['ugs']->value['ap_pa']['v'] == 1) || ($_smarty_tpl->tpl_vars['exType']->value == 'sub' && $_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "student" && $_smarty_tpl->tpl_vars['ugs']->value['aa_pa']['v'] == 1))) {?>
			<input type="button" value="Attachment" style="font-weight:bold"
			onClick="window.open('attachment.php?item=<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*3/7 +',width='+screen.width*2/7);">
			<?php }?>
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2"><?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == 'student') {?>Ambassador<?php } else { ?>Agent<?php }?> Detail</td>
	</tr>
	<tr>
		<td width="58%" align="center"  valign="top">
			<table width="100%" cellspacing="1" cellpadding="3"border="0">		
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>Category:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
                    	<select name="t_cate"<?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_gpeditcate']['v'] == 0 && $_smarty_tpl->tpl_vars['dt_arr']->value['type'] == 'sub') {?>disabled<?php }?>>
                    		<?php if ($_smarty_tpl->tpl_vars['exType']->value == 'top') {?>
                        		<option value="education" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "education") {?> selected <?php }?>>Education agent</option>
                        		<option value="inactive" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "inactive") {?> selected <?php }?>>Inactive agent</option>    
                        	<?php } elseif ($_smarty_tpl->tpl_vars['exType']->value == 'sub') {?>
                        		<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "education" || $_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "student") {?>
									<option value="student" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "student") {?>selected<?php }?> >Global Partner</option>
							    	<option value="education" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "education") {?> selected <?php }?>>Global Agent</option>
                        		<?php } else { ?>
                        			<option value="inactive" selected >Inactive agent</option> 
                        		<?php }?>   
							<?php } else { ?>
                        		<option value="education" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "education") {?> selected <?php }?>>Education agent</option>
                        		<option value="company" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "company") {?> selected <?php }?>>Company agent</option>
                        		<option value="student" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "student") {?> selected <?php }?>>Student Assistant</option>  
                        		<option value="inactive" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['cate'] == "inactive") {?> selected <?php }?>>Inactive agent</option>    
                        	<?php }?>                          
                                                                                  
                        </select>
                        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_gpeditcate']['v'] == 0 && $_smarty_tpl->tpl_vars['dt_arr']->value['type'] == 'sub') {?>
							<input type="hidden" name="t_cate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['cate'];?>
">
                        <?php }?>
					</td>
				</tr>	                	
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>Verified:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
						<input type="checkbox" name="t_verify" value=1 <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['verify'] == 1) {?> checked <?php }?>>
					</td>
				</tr>
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>REFCODE:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
						<?php if ($_smarty_tpl->tpl_vars['aid']->value > 0 && $_smarty_tpl->tpl_vars['dt_arr']->value['code'] == '') {?>
							<input type="submit" value="Generate Code" name="bt_code" style="font-weight:bold ">
						<?php } else { ?>
							<strong><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['code'];?>
</strong>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>Operator:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
			        	<select name="t_uid">
			        		<option value="0">select an operator</option>
			          		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
			            		<option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['uid'] == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>
			          		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			          	</select>
					</td>
				</tr>						
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Company Name:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" style=" width:500px;" name="t_name" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['name'];?>
"></td>
				</tr>			
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_tel" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['tel'];?>
" size="30"></td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Wechat ID:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_wechatid" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['wechatid'];?>
" size="30"></td>
				</tr>
				<!--
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Fax:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_fax" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['fax'];?>
" size="30"></td>
				</tr>-->								
				<tr>
					<td width="12%" height="30" align="left" class="rowodd"><strong>Web Site:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_web" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['web'];?>
" style=" width:500px;"></td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Address:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_add" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['add'];?>
" style=" width:500px;"></td>
				</tr>
				<tr> 
					<td width="12%" height="31" align="left"  class="rowodd">  <strong>State:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_state" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['state'];?>
" style=" width:500px;"></td>
				</tr>
				<tr> 
					<td width="12%" height="31" align="left"  class="rowodd">  <strong>City:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_city" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['city'];?>
" style=" width:500px;"></td>
				</tr>		
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Country:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">	
						<select name="t_country" onChange="this.form.isChange.value=1;this.form.submit();">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['country_arr']->value, 'country', false, 'id');
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
?>
						  <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['country']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['country']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['country'] < 1) {?>
						  <option value="0" selected>select a country</option>
						<?php }?>
						</select>			
						<span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="window.open('/scripts/country.php','_blank', 'alwaysRaised=yes,height=300,width=300,location=no,scrollbars=yes')">Add new country</span>
					</td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Contact:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_contact" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['contact'];?>
" style=" width:500px;"></td>
				</tr>	
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Position:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_pos" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['pos'];?>
" style=" width:500px;"></td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Email:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%"  class="roweven"><input type="text" name="t_email" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['email'];?>
" style=" width:500px;"></td>
				</tr>															
				<tr>
					<td width="12%" height="30" align="left"  class="rowodd"><strong>Agent Status:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_status" onChange="this.form.t_note.focus();">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['status_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['stid']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</select>&nbsp;&nbsp;&nbsp;
						<span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="openModel('institute_status.php',300,300,'NO','form1')">add new status</span>
					</td>
				</tr>			
				<tr>
					<td width="12%" height="30" align="left"  class="rowodd"><strong>Note:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><textarea name="t_note" rows="3" style=" width:500px; height:200px "><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['note'];?>
</textarea></td>
				</tr>														
			</table>	  
	  	</td>
	</tr>
	<tr align="center"  class="greybg" >					
			<td colspan="2">
				<input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
	</tr>								
</table>
</form>
</body>
</html>
<?php }
}
