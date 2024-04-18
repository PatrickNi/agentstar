<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Function Managment</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<body>
<form action=""  target="_self" method="POST" name="form1">
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
	<input type="hidden" name="qflag" value="">
	<tr  class="title" >
		<td colspan="6">
			User Select:&nbsp;&nbsp;
			<select name="uid" class="select" onChange="this.form.submit();">
			{foreach key=id item=name from=$user_arr}
				<option value="{$id}" {if $id eq $uid} selected {/if}>{$name}</option>
			{/foreach}
			{if $uid eq 0}
				<option value="0" selected>select a user</option>
			{/if}
			</select>
			&nbsp;&nbsp;
			<input type="button" style="font-weight:bold;" value="Approve the premission" onClick="javascript:this.form.qflag.value='approve';this.form.submit();">
		</td>
	</tr>
	<tr class="totalrowodd">
		<td width="50%" align="center">Function</td>
		<td width="50%"  align="center">Premission<input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>
   </tr>
  {foreach key=id item=arr from=$func_arr}
	<tr id="tr_{$id}"  onmouseout="roff({$id});" onMouseOver="ron({$id});" {if $arr.select eq 1} bgcolor="#DDE4F2"{/if}>
		<td align="center"style="border-bottom: solid #C0C0C0 1px; border-right: solid #C0C0C0 1px;">{$arr.name}</td>	
		<td onClick="rowToggle({$id});" align="center" style="border-bottom: solid #C0C0C0 1px; border-right: solid #C0C0C0 1px;"> <input type="checkbox" id="box_{$id}" onClick="toggleRow(this);" name="funcId[]" value="{$id}" {if $arr.select eq 1} checked {/if}> </td> 
   </tr>   
  {/foreach} 
   <tr >
   	<td align="right" colspan="2">&nbsp;</td>
   </tr>
</table>
<table width="100%" class="graybordertable" cellpadding="1" cellspacing="1">   
   <tr class="title"><td align="left" colspan="2">Advance Setting</td></tr>   
   {if $uid gt 0}
   <!-- Basic Service --> 
   <tr class="rowodd"><td align="left" colspan="2"><li>Basic Information&nbsp;<input type="checkbox" name="g_b_service[]" value="{$grant.b_service.v}" {if $ugs.b_service.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</li></td></tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Track all clients</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_seeall[]" value="{$grant.seeall.v}" {if $ugs.seeall.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Forbid cut/copy on client detail</ul></td>
		<td width="79%" align="left">on&nbsp;<input type="checkbox" name="g_b_nocp[]" value="{$grant.b_nocp.v}" {if $ugs.b_nocp.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Show abouts percentage</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_b_abouts[]" value="{$grant.b_abouts.v}" {if $ugs.b_abouts.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Export Emails</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_export[]" value="{$grant.export.v}" {if $ugs.export.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</td>
   </tr>     
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Current visa setting</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_visa[]" value="{$grant.b_visa.v}" {if $ugs.b_visa.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_visa[]" value="{$grant.b_visa.i}" {if $ugs.b_visa.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_visa[]" value="{$grant.b_visa.m}" {if $ugs.b_visa.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Clients remove</ul></td>
		<td width="79%" align="left">delete&nbsp;<input type="checkbox" name="g_b_service[]" value="{$grant.b_service.d}" {if $ugs.b_service.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Clients Type</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_ctype[]" value="{$grant.b_ctype.v}" {if $ugs.b_ctype.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_ctype[]" value="{$grant.b_ctype.i}" {if $ugs.b_ctype.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_ctype[]" value="{$grant.b_ctype.m}" {if $ugs.b_ctype.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" ><ul>From Subagent</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_suba[]" value="{$grant.b_suba.v}" {if $ugs.b_suba.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_suba[]" value="{$grant.b_suba.i}" {if $ugs.b_suba.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_suba[]" value="{$grant.b_suba.m}" {if $ugs.b_suba.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>   
    <tr class="roweven">
		<td width="21%" align="left" ><ul>Expire Date Report</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_epd[]" value="{$grant.b_epd.v}" {if $ugs.b_epd.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_epd[]" value="{$grant.b_epd.i}" {if $ugs.b_epd.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_epd[]" value="{$grant.b_epd.m}" {if $ugs.b_epd.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>From to selection</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_b_fromto[]" value="{$grant.b_fromto.v}" {if $ugs.b_fromto.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</td>
   </tr>     
   <!-- Course Service -->   
   <tr class="rowodd"><td align="left" colspan="2"><li>Course Service&nbsp;<input type="checkbox" name="g_c_service[]" value="{$grant.c_service.v}" {if $ugs.c_service.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</li></td></tr>
      <tr class="roweven">
		<td align="left" ><ul>Track all course for all clients</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_c_track[]" value="{$grant.c_track.v}" {if $ugs.c_track.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td align="left" ><ul>Course consultant &amp; Visit date</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_c_user[]" value="{$grant.c_user.v}" {if $ugs.c_user.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_c_user[]" value="{$grant.c_user.i}" {if $ugs.c_user.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_c_user[]" value="{$grant.c_user.m}" {if $ugs.c_user.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;	
		</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Add Course</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_c_service[]" value="{$grant.c_service.i}" {if $ugs.c_service.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
        remove&nbsp;<input type="checkbox" name="g_c_service[]" value="{$grant.c_service.d}" {if $ugs.c_service.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;        
        </td>
   </tr>      
   <tr class="roweven">
		<td align="left" ><ul>Potential commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_c_pot[]" value="{$grant.c_pot.v}" {if $ugs.c_pot.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_c_pot[]" value="{$grant.c_pot.i}" {if $ugs.c_pot.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_c_pot[]" value="{$grant.c_pot.m}" {if $ugs.c_pot.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>    
   <tr class="roweven">
		<td align="left" ><ul>Received and Paid commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_c_rev[]" value="{$grant.c_rev.v}" {if $ugs.c_rev.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_c_rev[]" value="{$grant.c_rev.m}" {if $ugs.c_rev.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr> 
   <!-- Visa Service -->  
   <tr class="rowodd"><td align="left" colspan="2"><li>Visa Service&nbsp;<input type="checkbox" name="g_v_service[]" value="{$grant.v_service.v}" {if $ugs.v_service.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</li></td></tr>
   <tr class="roweven">
		<td align="left" ><ul>Track all visa for all clients</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_track[]" value="{$grant.v_track.v}" {if $ugs.v_track.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Add Visa</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_v_service[]" value="{$grant.v_service.i}" {if $ugs.v_service.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;     
        </td>
   </tr>    
   <tr class="roweven">
		<td align="left" ><ul>Apply visa setting</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_visa[]" value="{$grant.v_visa.v}" {if $ugs.v_visa.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_visa[]" value="{$grant.v_visa.i}" {if $ugs.v_visa.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_visa[]" value="{$grant.v_visa.m}" {if $ugs.v_visa.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_v_visa[]" value="{$grant.v_visa.d}" {if $ugs.v_visa.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>        
    <tr class="roweven">
		<td align="left" ><ul>Dependant Add</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_dp[]" value="{$grant.v_dp.v}" {if $ugs.v_dp.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;		
			insert&nbsp;<input type="checkbox" name="g_v_dp[]" value="{$grant.v_dp.i}" {if $ugs.v_dp.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_dp[]" value="{$grant.v_dp.m}" {if $ugs.v_dp.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_v_dp[]" value="{$grant.v_dp.d}" {if $ugs.v_dp.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;	
		</td>
   </tr>     
   <tr class="roweven">
		<td align="left" ><ul>Assessment Body and ASOC</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_abas[]" value="{$grant.v_abas.v}" {if $ugs.v_abas.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_abas[]" value="{$grant.v_abas.i}" {if $ugs.v_abas.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_abas[]" value="{$grant.v_abas.m}" {if $ugs.v_abas.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>     
   <tr class="roweven">
		<td align="left" ><ul>Agreement Staff</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_agsf[]" value="{$grant.v_agsf.v}" {if $ugs.v_agsf.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_agsf[]" value="{$grant.v_agsf.i}" {if $ugs.v_agsf.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_agsf[]" value="{$grant.v_agsf.m}" {if $ugs.v_agsf.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>    
   <tr class="roweven">
		<td align="left" ><ul>Visa Paperwork</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_vpwk[]" value="{$grant.v_vpwk.v}" {if $ugs.v_vpwk.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_vpwk[]" value="{$grant.v_vpwk.i}" {if $ugs.v_vpwk.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_vpwk[]" value="{$grant.v_vpwk.m}" {if $ugs.v_vpwk.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="roweven">
		<td align="left" ><ul>Agreement Date</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_agd[]" value="{$grant.v_agd.v}" {if $ugs.v_agd.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_agd[]" value="{$grant.v_agd.i}" {if $ugs.v_agd.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_agd[]" value="{$grant.v_agd.m}" {if $ugs.v_agd.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr> 
   <tr class="roweven">
		<td align="left" ><ul>Agreement Fee</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_agf[]" value="{$grant.v_agf.v}" {if $ugs.v_agf.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_agf[]" value="{$grant.v_agf.i}" {if $ugs.v_agf.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_agf[]" value="{$grant.v_agf.m}" {if $ugs.v_agf.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>       
   <tr class="roweven">
		<td align="left" ><ul>Visa payment</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_pay[]" value="{$grant.v_pay.v}" {if $ugs.v_pay.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_pay[]" value="{$grant.v_pay.i}" {if $ugs.v_pay.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_pay[]" value="{$grant.v_pay.m}" {if $ugs.v_pay.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_v_pay[]" value="{$grant.v_pay.d}" {if $ugs.v_pay.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>  
   <!--
    <tr class="roweven">
		<td align="left" ><ul>Payment Due Date</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_p_duedate[]" value="{$grant.p_duedate.v}" {if $ugs.p_duedate.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_p_duedate[]" value="{$grant.p_duedate.i}" {if $ugs.p_duedate.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_p_duedate[]" value="{$grant.p_duedate.m}" {if $ugs.p_duedate.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_p_duedate[]" value="{$grant.p_duedate.d}" {if $ugs.p_duedate.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>    
    -->
    <tr class="roweven">
		<td align="left" ><ul>Paid History</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_p_h[]" value="{$grant.p_h.v}" {if $ugs.p_h.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_p_h[]" value="{$grant.p_h.m}" {if $ugs.p_h.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_p_h[]" value="{$grant.p_h.d}" {if $ugs.p_h.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>        
  
    <tr class="roweven">
		<td align="left" ><ul>ExpireDate Report</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_v_epd[]" value="{$grant.v_epd.v}" {if $ugs.v_epd.v eq 1} checked="checked" {/if}>			&nbsp;&nbsp;
		</td>
   </tr>      
       <tr class="roweven">
		<td align="left" ><ul>Reviewer</ul></td>
		<td align="left">
			modify&nbsp;
			<input type="checkbox" name="g_v_reviewer[]" value="{$grant.v_reviewer.m}" {if $ugs.v_reviewer.m eq 1} checked="checked" {/if}>			&nbsp;&nbsp;
		</td>
   </tr>  
   <!-- EDU -->  
   <tr class="rowodd"><td align="left" colspan="2"><li>Institutes&nbsp;<input type="checkbox" name="g_i_service[]" value="{$grant.i_service.v}" {if $ugs.i_service.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;[Grants for to-do and urgent list]</li></td></tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Forbid cut/copy on institute detail</ul></td>
		<td width="79%" align="left">on&nbsp;<input type="checkbox" name="g_i_nocp[]" value="{$grant.i_nocp.v}" {if $ugs.no_cp.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td align="left" ><ul>Course</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_course[]" value="{$grant.i_course.v}" {if $ugs.i_course.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_i_course[]" value="{$grant.i_course.i}" {if $ugs.i_course.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_i_course[]" value="{$grant.i_course.m}" {if $ugs.i_course.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_i_course[]" value="{$grant.i_course.d}" {if $ugs.i_course.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td align="left" ><ul>Process</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_proc[]" value="{$grant.i_proc.v}" {if $ugs.i_proc.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_i_proc[]" value="{$grant.i_proc.i}" {if $ugs.i_proc.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_i_proc[]" value="{$grant.i_proc.m}" {if $ugs.i_proc.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_i_proc[]" value="{$grant.i_proc.d}" {if $ugs.i_proc.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td align="left" ><ul>Commissions</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_comm[]" value="{$grant.i_comm.v}" {if $ugs.i_comm.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_i_comm[]" value="{$grant.i_comm.i}" {if $ugs.i_comm.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_i_comm[]" value="{$grant.i_comm.m}" {if $ugs.i_comm.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_i_comm[]" value="{$grant.i_comm.d}" {if $ugs.i_comm.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td align="left" ><ul>Student Stats</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_st[]" value="{$grant.i_st.v}" {if $ugs.i_st.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="roweven">
		<td align="left" ><ul>Potential commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_rev[]" value="{$grant.i_rev.v}" {if $ugs.i_rev.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td align="left" ><ul>Receivable and Paid commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_rev[]" value="{$grant.i_rev.v}" {if $ugs.i_rev.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>  
    <tr class="roweven">
		<td align="left" ><ul>Institutes Remove</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_i_del[]" value="{$grant.i_del.v}" {if $ugs.i_del.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>  
    <tr class="roweven">
		<td align="left" ><ul>Expoart All Staff Emails</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_i_export[]" value="{$grant.i_export.v}" {if $ugs.i_export.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr> 
    <tr class="roweven">
		<td align="left" ><ul>Student, Offer, COE</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_i_soc[]" value="{$grant.i_soc.v}" {if $ugs.i_soc.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr> 
    <tr class="roweven">
        <td align="left" ><ul>To Top-Agent</ul></td>
        <td align="left">
            view&nbsp;
            <input type="checkbox" name="g_i_tta[]" value="{$grant.i_tta.v}" {if $ugs.i_tta.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
            insert&nbsp;
            <input type="checkbox" name="g_i_tta[]" value="{$grant.i_tta.i}" {if $ugs.i_tta.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
            modify&nbsp;
            <input type="checkbox" name="g_i_tta[]" value="{$grant.i_tta.m}" {if $ugs.i_tta.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
        </td>
   </tr>        
   <!-- Agent -->  
   <tr class="rowodd"><td align="left" colspan="2"><li>Top Agents&nbsp;<input type="checkbox" name="g_a_service[]" value="{$grant.a_service.v}" {if $ugs.a_service.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;[Grants for to-do and urgent list]</li></td></tr>
   <tr class="roweven">
		<td align="left" ><ul>View Top Agents</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_top[]" value="{$grant.a_top.v}" {if $ugs.a_top.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>
   <!--
   <tr class="roweven">
		<td align="left" ><ul>View Sub Agents</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_sub[]" value="{$grant.a_sub.v}" {if $ugs.a_sub.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>   
-->
   <tr class="roweven">
		<td align="left" ><ul>Details</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_dt[]" value="{$grant.a_dt.v}" {if $ugs.a_dt.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_a_dt[]" value="{$grant.a_dt.i}" {if $ugs.a_dt.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_a_dt[]" value="{$grant.a_dt.m}" {if $ugs.a_dt.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_a_dt[]" value="{$grant.a_dt.d}" {if $ugs.a_dt.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>      
   <tr class="roweven">
		<td align="left" ><ul>Progress/Attachment</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_proc[]" value="{$grant.a_proc.v}" {if $ugs.a_proc.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_a_proc[]" value="{$grant.a_proc.i}" {if $ugs.a_proc.i eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_a_proc[]" value="{$grant.a_proc.m}" {if $ugs.a_proc.m eq 1} checked="checked" {/if}>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_a_proc[]" value="{$grant.a_proc.d}" {if $ugs.a_proc.d eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>         
   <tr class="roweven">
		<td align="left" ><ul>Students</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_st[]" value="{$grant.a_st.v}" {if $ugs.a_st.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td align="left" ><ul>Receivable and received commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_rev[]" value="{$grant.a_rev.v}" {if $ugs.a_rev.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="rowodd"><td align="left" colspan="2"><li>Global Agent (Sub-agents)</li></td></tr>
     <tr class="roweven">
        <td align="left" ><ul>Details</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_d[]" value="{$grant.ap_d.v}" {if $ugs.ap_d.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Progress/Attachment</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_pa[]" value="{$grant.ap_pa.v}" {if $ugs.ap_pa.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Students</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_st[]" value="{$grant.ap_st.v}" {if $ugs.ap_st.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Payable and paid commission</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_ppc[]" value="{$grant.ap_ppc.v}" {if $ugs.ap_ppc.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
     <tr class="roweven">
		<td align="left" ><ul>Remove</ul></td>
		<td align="left">
			<input type="checkbox" name="g_a_delpartner[]" value="{$grant.a_delpartner.v}" {if $ugs.a_delpartner.v eq 1} checked="checked" {/if}>
		</td>
     </tr>   
        <tr class="roweven">
        <td align="left" ><ul>Email Export</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_emailpartner[]" value="{$grant.a_emailpartner.v}" {if $ugs.a_emailpartner.v eq 1} checked="checked" {/if}>
        </td>
   </tr>  
      <tr class="rowodd"><td align="left" colspan="2"><li>Global Partner (Sub-agents)</li></td></tr>
     <tr class="roweven">
        <td align="left" ><ul>Details</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_d[]" value="{$grant.aa_d.v}" {if $ugs.aa_d.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Progress/Attachment</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_pa[]" value="{$grant.aa_pa.v}" {if $ugs.aa_pa.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Students</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_st[]" value="{$grant.aa_st.v}" {if $ugs.aa_st.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Payable and paid commission</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_ppc[]" value="{$grant.aa_ppc.v}" {if $ugs.aa_ppc.v eq 1} checked="checked" {/if}>
        </td>
     </tr> 
    <tr class="roweven">
        <td align="left" ><ul>Remove</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_delambassador[]" value="{$grant.a_delambassador.v}" {if $ugs.a_delambassador.v eq 1} checked="checked" {/if}>
        </td>
    </tr>   
    <tr class="roweven">
        <td align="left" ><ul>Email Export</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_emailambassador[]" value="{$grant.a_emailambassador.v}" {if $ugs.a_emailambassador.v eq 1} checked="checked" {/if}>
        </td>
    </tr>
    <tr class="roweven">
        <td align="left" ><ul>Change Category</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_gpeditcate[]" value="{$grant.a_gpeditcate.v}" {if $ugs.a_gpeditcate.v eq 1} checked="checked" {/if}>
        </td>
    </tr> 

   <tr class="rowodd"><td align="left" colspan="2"><li>Staff Performance</li></td></tr>  
   <tr class="roweven">
		<td align="left" ><ul>Check all staff</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_rpt_staff[]" value="{$grant.rpt_staff.v}" {if $ugs.rpt_staff.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>     
   <tr class="roweven">
		<td align="left" ><ul>Potential Comm</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_rpt_staff_pc[]" value="{$grant.rpt_staff_pc.v}" {if $ugs.rpt_staff_pc.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="roweven">
		<td align="left" ><ul>Received Comm</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_rpt_staff_rc[]" value="{$grant.rpt_staff_rc.v}" {if $ugs.rpt_staff_rc.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>               
   <tr class="rowodd"><td align="left" colspan="2"><li>Report Todo List</li></td></tr>  
   <tr class="roweven">
		<td align="left" ><ul>Visa List</ul></td>
		<td align="left">
			view all paperwork&nbsp;
			<input type="checkbox" name="g_todo_visa[]" value="{$grant.todo_visa.v}" {if $ugs.todo_visa.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
		</td>
   </tr>            
   <tr class="roweven">
		<td align="left" ><ul>Course List</ul></td>
		<td align="left">
			view all consultant&nbsp;
			<input type="checkbox" name="g_todo_course[]" value="{$grant.todo_course.v}" {if $ugs.todo_course.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
            <!--
            view Hunter cases&nbsp;
            <input type="checkbox" name="sys_views[]" value="course_37" {if is_array($sys_views.course) && in_array(37, $sys_views.course)} checked="checked" {/if}>&nbsp;&nbsp;
            view Mary cases&nbsp;
            <input type="checkbox" name="sys_views[]" value="course_45" {if is_array($sys_views.course) && in_array(45, $sys_views.course)} checked="checked" {/if}>&nbsp;&nbsp;
		    view Stella cases&nbsp;
            <input type="checkbox" name="sys_views[]" value="course_73" {if is_array($sys_views.course) && in_array(73, $sys_views.course)} checked="checked" {/if}>&nbsp;&nbsp;
            -->
        </td>
   </tr>
   <tr class="roweven">
        <td align="left" ><ul>Todo Alarm</ul></td>
        <td align="left">
            open&nbsp;
            <input type="checkbox" name="g_todo_alert[]" value="{$grant.todo_alert.v}" {if $ugs.todo_alert.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
        </td>
   </tr>     
               <tr class="roweven">
                <td align="left">
                    <ul>Visa Expire Date</ul>
                </td>
                <td align="left">
                    view all cases&nbsp;
                    <input type="checkbox" name="g_visa_expire[]" value="{$grant.visa_expire.v}" {if $ugs.visa_expire.v eq 1} checked="checked" {/if}>&nbsp;&nbsp;
                </td>
            </tr>           
   {/if}       
</table>            
</form> 
</body>
</html>