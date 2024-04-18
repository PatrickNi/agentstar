<?php
/* Smarty version 4.3.2, created on 2023-11-27 13:13:12
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_sem.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_65642568abcf10_01555805',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abece2a3d7731b2ae4f4f46d4d9151f001287534' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_sem.tpl',
      1 => 1647148230,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65642568abcf10_01555805 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"><?php echo '</script'; ?>
>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="courseid" value="<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
">
<input type="hidden" name="semid" value="<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
">
			<table border="0" width="100%" cellpadding="1" cellspacing="1">			
			
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="13%">
				      <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>>
                            <input type="submit" value="Back to Course" style="font-weight:bold" onClick="javascript:this.form.action='client_course_detail.php';this.form.submit();" <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>>
						</td>
					  <td width="77%" align="center" class="whitetext">Semester Detail</td>		
		  <td align="right" width="10%">
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>>
						</td>
					</tr>
				</table></td></tr>
				<tr align="center"  class="greybg" >
      				<td align="left" style="font-size:16px " colspan="2" onClick="window.open('/scripts/client_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5)" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'">
      					<span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; 
      					<span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp;
      					<span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span>
      				</td>
    			</tr>
				<tr>
					<td width="80%" valign="top"><table border="0" width="100%" cellpadding="3" cellspacing="1">
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>School Name:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['school'];?>
&nbsp;&nbsp;
								<span style="font-weight:bold; text-decoration:underline; cursor:pointer;" onClick="window.open('institute_comm.php?sid=<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['iid'];?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')">[D]</span>								</td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><?php echo $_smarty_tpl->tpl_vars['qual_name']->value;?>
</td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><?php echo $_smarty_tpl->tpl_vars['major_name']->value;?>
</td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Semester:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">
								   <?php if (count($_smarty_tpl->tpl_vars['sem_all']->value) > 0) {?>
										<select name="t_semid" style="font-weight:bold;" onChange="this.form.semid.value=this.value;this.form.submit();">
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sem_all']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
											<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['semid']->value) {?> selected <?php }?>>semester <?php echo $_smarty_tpl->tpl_vars['arr']->value['sem'];?>
</option>
										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										<?php if ($_smarty_tpl->tpl_vars['semid']->value == 0) {?> 
											<option value="0" selected>please add =></option>
										 <?php }?>	
										</select>
									<?php }?>
									&nbsp;&nbsp;<input type="submit" value="add new semester" onClick="this.form.bt_name.value='add new semester';" style="font-weight:bolder;">								 </td>
							</tr>								
							<tr>
								<td colspan="2"><hr></td>
							</tr>			
							<tr>
								<td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Status:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">
									<select name="done" style=" font-weight:bold;color:#FF0000" onChange="refuse(this.value,'rf', 't_rf')">
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['sem_arr']->value['active'] == 1) {?> selected <?php }?>>Active</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['sem_arr']->value['active'] == 2) {?> selected <?php }?>>Cancel</option>
									</select>								</td>
							</tr>
							<tr id="rf" style="<?php if ($_smarty_tpl->tpl_vars['sem_arr']->value['active'] != 2) {?>display:none;<?php }?>">
								<td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Cancel Reason:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">
									<textarea name="t_rf" style="width:300px; height:100px " <?php if ($_smarty_tpl->tpl_vars['sem_arr']->value['active'] != 2) {?>disabled<?php }?>><?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['refuse'];?>
</textarea>								
								</td>
							</tr>				
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Semester Start Date:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><input type="text" name="t_fdate" id="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['fdate'];?>
" size="30" >
                             </td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Semester Complete Date:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><input type="text" name="t_tdate" id="t_tdate" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['tdate'];?>
" size="30" >
 </td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Tution Fee:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><input type="text" name="t_fee" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['fee'];?>
" size="30" onChange="audit_money(this)" ></td>
							</tr>
							<!--<tr>
								<td width="28%" align="left"><strong>Duration:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%"><input type="text" name="t_due" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['due'];?>
" size="30" onChange="audit_money(this)" ></td>
							</tr>-->
							
							<?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_rev']['m'] == 1) {?>
								<tr>
									<td width="28%" align="left" style="color:#CC3300" class="rowodd"> <strong>Receivable commission:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_rcomm" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['rcomm'];?>
" size="30" onChange="audit_money(this)" ></td>
								</tr>
								<tr>
									<td width="28%" align="left"class="rowodd"  style="color:#CC3300"><strong>Issue Invoice Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_ivdate" id="t_ivdate" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['ivdate'];?>
" size="30" ></td>                                
								</tr>	
								<tr>
									<td width="28%" align="left"class="rowodd"  style="color:#CC3300"><strong>Global invoice no:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_ginvo" id="t_ginvo" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['ginvo'];?>
" size="30" ></td>                                
								</tr>									
								<tr> 
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Recevied Commission:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_redcomm" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['redcomm'];?>
" size="30" onChange="audit_money(this)" ></td>
								</tr>					
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Recevied Commission Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_reddate" id="t_reddate" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['reddate'];?>
" size="30">
                                 </td>
								</tr>
								<?php if ($_smarty_tpl->tpl_vars['has_sub_agent']->value == 1) {?>	
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Co-potential comm amount:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_ccomm" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['ccomm'];?>
" size="30" onChange="audit_money(this)"></td>
								</tr>
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Notify Sub-agent Date:</strong>&nbsp;&nbsp;</td>
								  <td align="left" width="72%" class="roweven"><input type="text" name="t_nfdate" id="t_nfdate" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['nfdate'];?>
" size="30" ></td>
								</tr>			
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Co-comm invoice Recevied Date:</strong>&nbsp;&nbsp;</td>
								  <td align="left" width="72%" class="roweven"><input type="text" name="t_coidate" id="t_coidate" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['coidate'];?>
" size="30" ></td>
								</tr>	
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Sub-agent invoice no:</strong>&nbsp;&nbsp;</td>
								  <td align="left" width="72%" class="roweven"><input type="text" name="t_subainvo" id="t_subainvo" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['subainvo'];?>
" size="30" ></td>
								</tr>																					
								<tr>
									<td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Co-potential comm Paid Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_cdate" id="t_cdate" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['cdate'];?>
" size="30">
                         
                                    
                                    </td>
					  			</tr>
								<?php }?>
								<tr>
									<td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Discount:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_discount" value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['discount'];?>
" size="30" onChange="audit_money(this)"></td>
								</tr>	
                               	<tr>
									<td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Discount PayDay:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_discountdate" id="t_discountdate"value="<?php echo $_smarty_tpl->tpl_vars['sem_arr']->value['discountdate'];?>
" size="30">
                          
                                    </td>
								</tr>													
							<?php }?>

							 <tr><td colspan="2"><hr/></td></tr>                    
								<tr>
									<td colspan="2">      	
										<table border="0" cellpadding="1" cellspacing="1" width="100%"> 
											<tr class="greybg"> 
											<td colspan="11" class="whitetext" align="center">Payment</td> 
											</tr>
											<tr align="center" class="totalrowodd">
												<td>Item</td>
												<td>Due<br/>Amount</td>
												<td>GST</td>
												<td>Total<br/>Received</td>
												<td>Deduction</td>
												<td>Deduction<br/>Amount</td>
												<td>GST</td>
												<td>Total Paid</td>
												<td>Profit</td>
												<!--
												<td>Agreement<br/>Profit</td>
												<td>Paperwork<br/>Profit</td>
												-->
											</tr>
											<?php $_smarty_tpl->_assignInScope('total_profit', "0");?>
											<?php $_smarty_tpl->_assignInScope('total_dueamt', "0");?>
											<?php $_smarty_tpl->_assignInScope('agreement_profit', "0");?>
											<?php $_smarty_tpl->_assignInScope('paperwork_profit', "0");?>
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
&typ=semester','_blank', 'alwaysRaised=yes,height=500, width=800,location=no,scrollbars=yes')" ><?php echo ucwords($_smarty_tpl->tpl_vars['arr']->value['step']);?>
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
													<?php if ($_smarty_tpl->tpl_vars['arr']->value['step'] != 'app') {?>
														<?php echo $_smarty_tpl->tpl_vars['arr']->value['paid']-sprintf("%.2f",$_smarty_tpl->tpl_vars['arr']->value['dueamt_3rd']);?>

														<?php $_smarty_tpl->_assignInScope('total_profit', $_smarty_tpl->tpl_vars['total_profit']->value+$_smarty_tpl->tpl_vars['arr']->value['paid']-$_smarty_tpl->tpl_vars['arr']->value['dueamt_3rd']);?>
													<?php } else { ?>
														0.00
													<?php }?>
												</td>                                              
											</tr>
											<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											<tr align="center" class="roweven">
												<td align="right"><strong>Total:</strong></td>
												<td align="right"><strong><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total_dueamt']->value);?>
</strong></td>
												<td align="right" colspan="6"><strong>Total:</strong></td>
												<td align="right"><strong><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total_profit']->value);?>
</strong></td>
											</tr>	
										
											<tr align="center" class="roweven">
												<td colspan="11" align="center">
													<?php if ($_smarty_tpl->tpl_vars['semid']->value > 0) {?>        
													<input type="button" value="Add new" onclick="window.open('client_account_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&vid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
&typ=semester','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')" />
													<?php }?>
												</td>
											</tr>				          	
										</table>	    
									</td>
								</tr>  
				  </table></td>
					
					<td width="20%" align="left" valign="top">
						<div style="width:500px; height:300px; overflow-X:auto; overflow-Y:auto;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr class="greybg">
										<td colspan="4" class="whitetext" align="center">Account Process &nbsp;
											<?php if ($_smarty_tpl->tpl_vars['semid']->value > 0) {?><input type="button" value="add new" style="font-weight:bold "onClick="window.open('client_course_sem_proc.php?semid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
&isNew=1','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')" <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>><?php }?>
										</td>				
								</tr>							
								<tr align="center" class="totalrowodd">
									<td class="border_1" width="32%">Date</td>
									<td class="border_1" width="59%">Subject</td>
									<td class="border_1" width="9%">Insert</td>
								</tr>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['process_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
								<tr align="center" class="roweven">
									<td class="border_1" align="left"><span style="font-size:16px;font-weight:bolder; color:#990000"><?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?>&radic;<?php } else { ?>?<?php }?></span><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
									<td class="border_1" align="left"><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_course_sem_proc.php?semid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['subject'];?>
</span></td>
									<td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_course_sem_proc.php?semid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"></td>


								</tr>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</table>
							<p/>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr class="greybg">
									<td colspan="4" class="whitetext" align="center">Consultant Process</td>				
								</tr>							
								<tr align="center" class="totalrowodd">
									<td class="border_1" width="32%">Date</td>
									<td class="border_1" width="59%">Subject</td>
									<td class="border_1" width="9%">Due</td>
								</tr>
								<?php if ($_smarty_tpl->tpl_vars['chase']->value['id'] > 0) {?>
									<tr align="center" class="roweven">
										<td class="border_1" align="left"><span style="font-size:16px;font-weight:bolder; color:#990000"><?php if ($_smarty_tpl->tpl_vars['chase']->value['done'] == 1) {?>&radic;<?php } else { ?>?<?php }?></span><?php echo $_smarty_tpl->tpl_vars['chase']->value['date'];?>
</td>
										<td class="border_1" align="left"><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_course_process.php?courseid=<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['chase']->value['id'];?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"><?php echo $_smarty_tpl->tpl_vars['chase']->value['subject'];?>
</span></td>
										<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['chase']->value['due'];?>
</td>
									</tr>
								<?php }?>
							</table>
							<p/>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr class="greybg">
									<td colspan="4" class="whitetext" align="center">Internal Transfer Notes</td>				
								</tr>							
								<tr align="center" class="totalrowodd">
									<td class="border_1" width="32%">Transfer Date</td>
									<td class="border_1" width="59%">Comm. to Company</td>
								</tr>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['transfer_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
									<tr align="center" class="roweven">
										<td class="border_1" align="left"><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('/scripts/internal_transfer_note.php?courseid=<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
&semid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&tid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</span></td>
										<td class="border_1" align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['comm2biz'];?>
</td>
									</tr>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								<tr align="center" class="roweven">
									<td class="border_1" colspan="2" width="100%"><button type="button" onClick="window.open('/scripts/internal_transfer_note.php?courseid=<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
&semid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&tid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&bt_name=addnew','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380');">Generate new tranfer notes</button><br/></td>
								</tr>								
							</table>
						</div>
				    </td>	
				</tr>
				<tr><td colspan="2" class="greybg">&nbsp;</td></tr>																																																								
			</table>		
</form>	

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_ivdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_reddate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_nfdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_discountdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_cdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });		
	$('#t_coidate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });			
<?php echo '</script'; ?>
>
	
</body>
</html>
<?php }
}
