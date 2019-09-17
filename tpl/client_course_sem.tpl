<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="courseid" value="{$courseid}">
<input type="hidden" name="semid" value="{$semid}">
			<table border="0" width="100%" cellpadding="1" cellspacing="1">			
			
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="13%">
				      <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" {if $isapprove eq 0} disabled {/if}>
                            <input type="submit" value="Back to Course" style="font-weight:bold" onClick="javascript:this.form.action='client_course_detail.php';this.form.submit();" {if $isapprove eq 0} disabled {/if}>
						</td>
					  <td width="77%" align="center" class="whitetext">Semester Detail</td>		
		  <td align="right" width="10%">
							<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" {if $isapprove eq 0} disabled {/if}>
						</td>
					</tr>
				</table></td></tr>
				<tr>
					<td width="80%"><table border="0" width="100%" cellpadding="3" cellspacing="1">
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>School Name:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">{$dt_arr.school}&nbsp;&nbsp;
								<span style="font-weight:bold; text-decoration:underline; cursor:pointer;" onClick="window.open('institute_comm.php?sid={$dt_arr.iid}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')">[D]</span>								</td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">{$qual_name}</td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">{$major_name}</td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Semester:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">
								   {if count($sem_all) gt 0}
										<select name="t_semid" style="font-weight:bold;" onChange="this.form.semid.value=this.value;this.form.submit();">
										{foreach key=id item=arr from=$sem_all}
											<option value="{$id}" {if $id eq $semid} selected {/if}>semester {$arr.sem}</option>
										{/foreach}
										{if $semid eq 0} 
											<option value="0" selected>please add =></option>
										 {/if}	
										</select>
									{/if}
									&nbsp;&nbsp;<input type="submit" value="add new semester" onClick="this.form.bt_name.value='add new semester';" style="font-weight:bolder;">								 </td>
							</tr>								
							<tr>
								<td colspan="2"><hr></td>
							</tr>			
							<tr>
								<td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Status:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">
									<select name="done" style=" font-weight:bold;color:#FF0000" onChange="refuse(this.value,'rf', 't_rf')">
										<option value="1" {if $sem_arr.active eq 1} selected {/if}>Active</option>
										<option value="2" {if $sem_arr.active eq 2} selected {/if}>Cancel</option>
									</select>								</td>
							</tr>
							<tr id="rf" style="{if $sem_arr.active neq 2}display:none;{/if}">
								<td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Cancel Reason:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven">
									<textarea name="t_rf" style="width:300px; height:100px " {if $sem_arr.active neq 2}disabled{/if}>{$sem_arr.refuse}</textarea>								
								</td>
							</tr>				
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Semester Start Date:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><input type="text" name="t_fdate" id="t_fdate" value="{$sem_arr.fdate}" size="30" >
                             </td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Semester Complete Date:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><input type="text" name="t_tdate" id="t_tdate" value="{$sem_arr.tdate}" size="30" >
 </td>
							</tr>
							<tr>
								<td width="28%" align="left" class="rowodd"><strong>Tution Fee:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%" class="roweven"><input type="text" name="t_fee" value="{$sem_arr.fee}" size="30" onChange="audit_money(this)" ></td>
							</tr>
							<!--<tr>
								<td width="28%" align="left"><strong>Duration:</strong>&nbsp;&nbsp;</td>
								<td align="left" width="72%"><input type="text" name="t_due" value="{$sem_arr.due}" size="30" onChange="audit_money(this)" ></td>
							</tr>-->
							
							{if $ugs.c_rev.m eq 1}
								<tr>
									<td width="28%" align="left" style="color:#CC3300" class="rowodd"> <strong>Receivable commission:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_rcomm" value="{$sem_arr.rcomm}" size="30" onChange="audit_money(this)" ></td>
								</tr>
								<tr>
									<td width="28%" align="left"class="rowodd"  style="color:#CC3300"><strong>Issue Invoice Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_ivdate" id="t_ivdate" value="{$sem_arr.ivdate}" size="30" ></td>                                
								</tr>	
								<tr>
									<td width="28%" align="left"class="rowodd"  style="color:#CC3300"><strong>Global invoice no:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_ginvo" id="t_ginvo" value="{$sem_arr.ginvo}" size="30" ></td>                                
								</tr>									
								<tr> 
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Recevied Commission:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_redcomm" value="{$sem_arr.redcomm}" size="30" onChange="audit_money(this)" ></td>
								</tr>					
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Recevied Commission Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_reddate" id="t_reddate" value="{$sem_arr.reddate}" size="30">
                                 </td>
								</tr>
								{if $has_sub_agent eq 1}	
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Co-potential comm amount:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_ccomm" value="{$sem_arr.ccomm}" size="30" onChange="audit_money(this)"></td>
								</tr>
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Notify Sub-agent Date:</strong>&nbsp;&nbsp;</td>
								  <td align="left" width="72%" class="roweven"><input type="text" name="t_nfdate" id="t_nfdate" value="{$sem_arr.nfdate}" size="30" ></td>
								</tr>			
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Co-comm invoice Recevied Date:</strong>&nbsp;&nbsp;</td>
								  <td align="left" width="72%" class="roweven"><input type="text" name="t_coidate" id="t_coidate" value="{$sem_arr.coidate}" size="30" ></td>
								</tr>	
								<tr>
									<td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Sub-agent invoice no:</strong>&nbsp;&nbsp;</td>
								  <td align="left" width="72%" class="roweven"><input type="text" name="t_subainvo" id="t_subainvo" value="{$sem_arr.subainvo}" size="30" ></td>
								</tr>																					
								<tr>
									<td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Co-potential comm Paid Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_cdate" id="t_cdate" value="{$sem_arr.cdate}" size="30">
                         
                                    
                                    </td>
					  			</tr>
								{/if}
								<tr>
									<td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Discount:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_discount" value="{$sem_arr.discount}" size="30" onChange="audit_money(this)"></td>
								</tr>	
                               	<tr>
									<td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Discount PayDay:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_discountdate" id="t_discountdate"value="{$sem_arr.discountdate}" size="30">
                          
                                    </td>
								</tr>													
							{/if}
				  </table></td>
					
					<td width="20%" align="left" valign="top"><div style="width:500px; height:300px; overflow-X:auto; overflow-Y:auto;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr class="greybg">
									<td colspan="4" class="whitetext" align="center">Process &nbsp;
										{if $semid gt 0}<input type="button" value="add new" style="font-weight:bold "onClick="window.open('client_course_sem_proc.php?semid={$semid}&isNew=1','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')" {if $isapprove eq 0} disabled {/if}>{/if}
									</td>				
							</tr>							
							<tr align="center" class="totalrowodd">
								<td class="border_1" width="32%">Date</td>
								<td class="border_1" width="59%">Subject</td>
								<td class="border_1" width="9%">Insert</td>
							</tr>
							{foreach key=id item=arr from=$process_arr}
							<tr align="center" class="roweven">
								<td class="border_1" align="left"><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span>{$arr.date}</td>
								<td class="border_1" align="left"><span style="cursor:pointer; text-decoration:underline;" onClick="openModel('client_course_sem_proc.php?semid={$semid}&pid={$id}&cid={$cid}',500,380,'NO', 'form1')">{$arr.subject}</span></td>
								<td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_course_sem_proc.php?semid={$semid}&pid={$id}&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"></td>
							</tr>
							{/foreach}
						</table>
					</div></td>	
				</tr>
				<tr><td colspan="2" class="greybg">&nbsp;</td></tr>																																																								
			</table>		
</form>	
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_ivdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_reddate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_nfdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_discountdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_cdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });		
	$('#t_coidate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });			
</script>
{/literal}	
</body>
</html>
