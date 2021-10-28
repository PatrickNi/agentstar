<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" action="" target="_self" method="post">
<input type="hidden" name="aid" value="{$aid}">
<input type="hidden" name="t_type" value="{if $dt_arr.type}{$dt_arr.type}{else}{$exType}{/if}">
<table align="center" width="100%"  class="graybordertable">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
			<input style="font-weight:bold;" type="button" value="{if $dt_arr.cate eq 'student'}Ambassador{else}Agent{/if} Detail" onClick="javascript:this.form.action='agent_add.php';this.form.submit();">&nbsp;&nbsp;
			{if $aid > 0 && (($exType eq 'top' && $ugs.a_proc.v eq 1) || ($exType eq 'sub' && $dt_arr.cate eq 'education' && $ugs.ap_pa.v eq 1) || ($exType eq 'sub' && $dt_arr.cate eq "student" && $ugs.aa_pa.v eq 1))}
			<input style="font-weight:bold;" type="button" value="Process" onClick="javascript:this.form.action='agent_process.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
			{if $aid > 0 && (($exType eq 'top' && $ugs.a_st.v eq 1) || ($exType eq 'sub' && $dt_arr.cate eq 'education' && $ugs.ap_st.v eq 1) || ($exType eq 'sub' && $dt_arr.cate eq "student" && $ugs.aa_st.v eq 1))}
			<input style="font-weight:bold;" type="button" value="Student" onClick="javascript:this.form.action='agent_student.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Visa" onClick="javascript:this.form.action='agent_visa.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Coach" onClick="javascript:this.form.action='agent_coach.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Legal" onClick="javascript:this.form.action='agent_legal.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Home Loan" onClick="javascript:this.form.action='agent_homeloan.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
			{if $aid > 0 && ($exType eq 'top' || ($exType eq 'sub' && $dt_arr.cate eq 'education' && $ugs.ap_pa.v eq 1) || ($exType eq 'sub' && $dt_arr.cate eq "student" && $ugs.aa_pa.v eq 1))}
			<input type="button" value="Attachment" style="font-weight:bold"
			onClick="window.open('attachment.php?item={$aid}&type={$itemtype}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*3/7 +',width='+screen.width*2/7);">
			{/if}
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2">{if $dt_arr.cate eq 'student'}Ambassador{else}Agent{/if} Detail</td>
	</tr>
	<tr>
		<td width="58%" align="center"  valign="top">
			<table width="100%" cellspacing="1" cellpadding="3"border="0">		
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>Category:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
                    	<select name="t_cate"{if $ugs.a_delambassador.v eq 0 && $dt_arr.type eq 'sub'}disabled{/if}>
                    		{if $exType eq 'top'}
                        		<option value="education" {if $dt_arr.cate eq "education"} selected {/if}>Education agent</option>
                        		<option value="inactive" {if $dt_arr.cate eq "inactive"} selected {/if}>Inactive agent</option>    
                        	{elseif $exType eq 'sub'}
                        		{if $dt_arr.cate eq "education"}
							    	<option value="education" selected>Global Partner</option>
							    {elseif $dt_arr.cate eq "student"}
                        			<option value="student" selected >Ambassador</option>  
                        		{else}
                        			<option value="inactive" selected >Inactive agent</option> 
                        		{/if}   
							{else}
                        		<option value="education" {if $dt_arr.cate eq "education"} selected {/if}>Education agent</option>
                        		<option value="company" {if $dt_arr.cate eq "company"} selected {/if}>Company agent</option>
                        		<option value="student" {if $dt_arr.cate eq "student"} selected {/if}>Student Assistant</option>  
                        		<option value="inactive" {if $dt_arr.cate eq "inactive"} selected {/if}>Inactive agent</option>    
                        	{/if}                          
                                                                                  
                        </select>
                        {if $ugs.a_delambassador.v eq 0 && $dt_arr.type eq 'sub'}
							<input type="hidden" name="t_cate" value="{$dt_arr.cate}">
                        {/if}
					</td>
				</tr>	                	
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>Verified:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
						<input type="checkbox" name="t_verify" value=1 {if $dt_arr.verify eq 1} checked {/if}>
					</td>
				</tr>
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>REFCODE:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
						<input type="text"  name="t_code" value="{$dt_arr.code}">
						{if $aid > 0}
							<input type="submit" value="Generate Code" name="bt_code" style="font-weight:bold ">
						{/if}
					</td>
				</tr>
				<tr>
					<td width="12%" height="30" align="left" class="rowodd" style=" color:#FF0000"><strong>Operator:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">
			        	<select name="t_uid">
			        		<option value="0">select an operator</option>
			          		{foreach key=user_id item=user_name from=$slUsers}
			            		<option value="{$user_id}" {if $dt_arr.uid eq $user_id} selected {/if}>{$user_name}</option>
			          		{/foreach}
			          	</select>
					</td>
				</tr>						
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Company Name:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" style=" width:500px;" name="t_name" value="{$dt_arr.name}"></td>
				</tr>			
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_tel" value="{$dt_arr.tel}" size="30"></td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Wechat ID:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_wechatid" value="{$dt_arr.wechatid}" size="30"></td>
				</tr>
				<!--
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Fax:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_fax" value="{$dt_arr.fax}" size="30"></td>
				</tr>-->								
				<tr>
					<td width="12%" height="30" align="left" class="rowodd"><strong>Web Site:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_web" value="{$dt_arr.web}" style=" width:500px;"></td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Address:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_add" value="{$dt_arr.add}" style=" width:500px;"></td>
				</tr>
				<tr> 
					<td width="12%" height="31" align="left"  class="rowodd">  <strong>State:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_state" value="{$dt_arr.state}" style=" width:500px;"></td>
				</tr>
				<tr> 
					<td width="12%" height="31" align="left"  class="rowodd">  <strong>City:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_city" value="{$dt_arr.city}" style=" width:500px;"></td>
				</tr>		
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Country:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven">	
						<select name="t_country" onChange="this.form.isChange.value=1;this.form.submit();">
						{foreach key=id item=country from=$country_arr}
						  <option value="{$id}" {if $id eq $dt_arr.country} selected {/if}>{$country}</option>
						{/foreach}
						{if $dt_arr.country lt 1}
						  <option value="0" selected>select a country</option>
						{/if}
						</select>			
						<span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="openModel('country.php',300,300,'NO', 'form1')">Add new country</span>
					</td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Contact:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_contact" value="{$dt_arr.contact}" style=" width:500px;"></td>
				</tr>	
				<tr>
					<td width="12%" height="31" align="left"  class="rowodd"><strong>Position:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><input type="text" name="t_pos" value="{$dt_arr.pos}" style=" width:500px;"></td>
				</tr>
				<tr>
					<td width="12%" height="31" align="left" class="rowodd"><strong>Email:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%"  class="roweven"><input type="text" name="t_email" value="{$dt_arr.email}" style=" width:500px;"></td>
				</tr>															
				<tr>
					<td width="12%" height="30" align="left"  class="rowodd"><strong>Agent Status:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="81%" class="roweven">
						<select name="t_status" onChange="this.form.t_note.focus();">
						{foreach key=id item=name from=$status_arr}
							<option value="{$id}" {if $id eq $dt_arr.stid} selected {/if}>{$name}</option>
						{/foreach}
						</select>&nbsp;&nbsp;&nbsp;
						<span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="openModel('institute_status.php',300,300,'NO','form1')">add new status</span>
					</td>
				</tr>			
				<tr>
					<td width="12%" height="30" align="left"  class="rowodd"><strong>Note:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="88%" class="roweven"><textarea name="t_note" rows="3" style=" width:500px; height:200px ">{$dt_arr.note}</textarea></td>
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
