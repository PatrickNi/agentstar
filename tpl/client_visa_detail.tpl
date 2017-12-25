<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js?v1"></script>
{$msg}
<body> 
<form method="get" id="form1" name="form1" action="/scripts/client_visa_detail.php" target="_self" onSubmit="return isDelete()"> 
  <input type="hidden" name="cid" value="{$cid}"> 
  <input type="hidden" name="vid" id="vid" value="{$vid}"> 
  <input type="hidden" name="hCancel" value="0"> 
  <table border="0" width="95%" cellpadding="2" cellspacing="3"> 
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" id="bt_name" value="">
			<td align="left" width="10%">
				{if $ugs.v_visa.d eq 1}
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">&nbsp;&nbsp;&nbsp;
				{/if}
                {if $dt_arr.auser != $uid}
				<input name="button" type="button" style="font-weight:bold" onClick="openModel('attachment.php?item={$vid}&type={$itemtype}',screen.width*6/7,screen.height*4/7,'NO', 'form1')" value="Attachment">
                {/if}
			</td>					
			<td align="center" class="whitetext"> Detail Information &nbsp;&nbsp; </td> 			
			<td align="left" width="30%">
				<input type="button" value="Save" style="font-weight:bold" onClick="save_visa(this, false);" >
                <input type="button" value="Close &amp; Refresh " style="font-weight:bold" onClick="save_visa(this, true);">
			</td>
		</tr>		
	</table></td></tr>
    <tr align="center"  class="greybg" > 
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_visa.php?cid={$cid}'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span>&nbsp;&nbsp; </td> 
    </tr> 
    <tr> 
      <td width="60%" align="left" valign="top"> <table border="0" width="100%" cellpadding="3" cellspacing="1"> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Status</strong></td> 
            <td align="left" width="64%" class="roweven">
                <span class="highlighttext">{$dt_arr.status}</span>
                <input type="hidden" name="t_status", value="{$dt_arr.status}">
				<!--
                <select name="t_status" class="highlighttext">
				{foreach key=id item=st from=$status}
					<option value="{$st}" {if $st eq $dt_arr.status} selected {/if}>{$st}</option>
				{/foreach}
				</select>&nbsp;&nbsp;&nbsp;
                -->
				{if $showCourse eq 1}<a href="./client_course_cp.php?cid={$cid}" target="_blank">show course</a>{/if}
			</td> 
          </tr>	  	  
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Visa Category:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				{if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($vid gt 0 || $ugs.v_visa.i eq 0)}<input type="hidden" name="t_visa" value="{$catid}"> {/if}
				<select name="t_visa" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" {if $ugs.v_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($vid gt 0 || $ugs.v_visa.i eq 0)} disabled {/if}> 
					{foreach key=id item=name from=$cate_arr}										 
					<option value="{$id}" {if $id eq $catid} selected {/if}>{$name}</option>                 
					{/foreach}
					{if $catid eq 0}<option value="0" selected>select a category</option>{/if} 
              	</select>
			</td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Visa Subclass:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				{if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($vid gt 0 || $ugs.v_visa.i eq 0)}<input type="hidden" name="t_class" value="{$subid}"> {/if}
				<select name="t_class" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" {if $ugs.v_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($vid gt 0 || $ugs.v_visa.i eq 0)} disabled {/if}> 
                	{foreach key=id item=name from=$class_arr} 
		                <option value="{$id}" {if $id eq $subid} selected {/if}>{$name}</option> 
        			{/foreach}
					{if $subid eq 0}<option value="0" selected>select a subclass</option>{/if}
				</select>			
			</td> 
          </tr>   
          <!--
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>On / Off Shore</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
			{if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($vid gt 0 || $ugs.v_visa.i eq 0)}<input type="hidden" name="t_shore" value="{$dt_arr.shore}"> {/if}			
			  <input type="radio" name="t_shore" value="1" {if $dt_arr.shore eq 1} checked {/if} {if $ugs.v_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($vid gt 0 || $ugs.v_visa.i eq 0)} disabled {/if}> 
              On Shore&nbsp;&nbsp; 
              <input type="radio" name="t_shore" value="0" {if $dt_arr.shore eq 0} checked {/if} {if $ugs.v_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($vid gt 0 || $ugs.v_visa.i eq 0)} disabled {/if}> 
              Off Shore&nbsp;&nbsp;
			</td> 
          </tr> 
		  <tr>
			<td width="36%"  align="left" class="rowodd"><strong>Main Applicant Visa Expire Date:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="64%" class="roweven">
				{if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($isExpireSet neq 1 || $ugs.vinsert eq 0)}<input type="hidden" name="t_epdate" value="{$dt_arr.epdate}"> {/if}
				<input type="text" name="t_epdate" id="t_epdate" value="{$dt_arr.epdate}" size="30" {if $ugs.v_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_visa.v eq 1 && $ugs.v_visa.m eq 0 && ($isExpireSet neq 1 || $ugs.v_visa.i eq 0)} disabled="disabled" {/if}>
   
             
			</td>
		  </tr>
        -->
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Dependant Expire Date:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				{if $vid gt 0 && $ugs.v_dp.v eq 1 && $ugs.v_dp.m eq 1} <input type="button" value="add dependant" onClick="openModel('client_dep.php?cid={$cid}&vid={$vid}',800,400,'NO', 'form1')">         
                <br>{/if}
				<table width="100%" border="0" cellpadding="2" cellspacing="0" class="yellowbg" >
				{foreach key=depid item=arr from=$dependants}
					<tr align="left">
						<td>
							{if $ugs.v_dp.v eq 1 && $ugs.v_dp.m eq 0 && ($arr.expdate neq '' && $arr.expdate neq '0000-00-00' || $ugs.v_dp.i eq 0)}
								<input name="dep_{$depid}" type="hidden" value="{$arr.expdate}">
							{/if}
							<input name="dep_{$depid}" type="text" value="{$arr.expdate}" size="30" onchange="audit_date(this)" {if $ugs.v_dp.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_dp.v eq 1 && $ugs.v_dp.m eq 0 && ($arr.expdate neq '' && $arr.expdate neq '0000-00-00' || $ugs.v_dp.i eq 0)} disabled {/if}>
						</td>
						<td>{$arr.name}</td>
					</tr>			
				{/foreach}
				</table>
			</td> 
          </tr> 		  	
          <tr> 
            <td colspan="2" height="5"><hr></td> 
          </tr>		  		  		  
		  {if $isViewBody}
			<tr>
				<td width="36%" align="left" class="rowodd"><strong>Assessment  Body:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="64%" class="roweven">
				{if $ugs.v_abas.v eq 1 && $ugs.v_abas.m eq 0 && ($vid gt 0 || $ugs.v_abas.i eq 0)}<input type="hidden" name="t_body" value="{$dt_arr.body}"> {/if}				
				<select name="t_body" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" {if $ugs.v_abas.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_abas.v eq 1 && $ugs.v_abas.m eq 0 && ($vid gt 0 || $ugs.v_abas.i eq 0)} disabled {/if}>
				{foreach key=id item=name from=$abodys}
					<option value="{$id}" {if $id eq $dt_arr.body} selected="selected"{/if}>{$name}</option>
				{/foreach}	
				{if $dt_arr.body eq 0}<option value="0" selected>n/a</option>{/if}
				</select>
				</td>
			</tr>
			<tr>
				<td width="36%" align="left" class="rowodd"><strong>ASCO:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="64%" class="roweven">
				{if $ugs.v_abas.v eq 1 && $ugs.v_abas.m eq 0 && ($vid gt 0 || $ugs.v_abas.i eq 0)}<input type="hidden" name="t_asco" value="{$dt_arr.asco}"> {/if}				
				<select name="t_asco"  {if $ugs.v_abas.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_abas.v eq 1 && $ugs.v_abas.m eq 0 && ($vid gt 0 || $ugs.v_abas.i eq 0)} disabled {/if}>
				{foreach key=id item=name from=$ascos}
					<option value="{$id}" {if $id eq $dt_arr.asco} selected="selected"{/if}>{$name}</option>
				{/foreach}	
				{if $dt_arr.asco eq 0}<option value="0" selected>n/a</option>{/if}
				</select>
				</td>
			</tr>		  
		  {/if}
          {if $isViewState}
		  <tr> 
            <td width="36%" align="left" class="rowodd"><strong>State Sponsor:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				<select name="t_sponsor">
				{foreach key=id item=name from=$sponsors}
					<option value="{$id}" {if $id eq $dt_arr.state} selected="selected"{/if}>{$name}</option>
				{/foreach}	
				</select>			
			</td> 
          </tr> 
		  {/if}
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Staff:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				{if $ugs.v_agsf.v eq 1 && $ugs.v_agsf.m eq 0 && ($vid gt 0 || $ugs.v_agsf.i eq 0)}<input type="hidden" name="t_auser" value="{$dt_arr.auser}"> {/if}
				<select name="t_auser" {if $ugs.v_agsf.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_agsf.v eq 1 && $ugs.v_agsf.m eq 0 && ($vid gt 0 || $ugs.v_agsf.i eq 0)} disabled {/if}>
				{foreach key=id item=name from=$user_arr}
	              <option  value="{$id}" {if $dt_arr.auser eq $id} selected {/if}>{$name}</option>
    			{/foreach}
				{if $dt_arr.auser lt 1}
					<option  value="0" selected >select a user</option>
                {/if}
				</select>			
			</td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Visa Paperwork:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				{if $ugs.v_vpwk.v eq 1 && $ugs.v_vpwk.m eq 0 && ($vid gt 0 || $ugs.v_vpwk.i eq 0)}<input type="hidden" name="t_vuser" value="{$dt_arr.vuser}"> {/if}
				<select name="t_vuser" {if $ugs.v_vpwk.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_vpwk.v eq 1 && $ugs.v_vpwk.m eq 0 && ($vid gt 0 || $ugs.v_vpwk.i eq 0)} disabled {/if}>                 
				{foreach key=id item=name from=$user_arr}
					<option  value="{$id}" {if $dt_arr.vuser eq $id} selected {/if}>{$name}</option> 
                {/foreach}
				{if $dt_arr.auser lt 1} 
	                <option  value="0" selected >select a user</option> 
    			{/if}
				</select>			</td> 
          </tr>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Consult Date:</strong></td> 
            <td align="left" width="64%" class="roweven">
                {if $ugs.v_agd.v eq 1 && $ugs.v_agd.m eq 0 && (($dt_arr.vdate neq '' && $dt_arr.vdate neq '0000-00-00') || $ugs.v_agd.i eq 0)}
                    <input type="hidden" name="t_first" value="{$dt_arr.vdate}"> 
                {/if}
                <input type="text" id="t_first" name="t_first" value="{$dt_arr.vdate}" size="30" {if $ugs.v_agd.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_agd.v eq 1 && $ugs.v_agd.m eq 0 && (($dt_arr.vdate neq '' && $dt_arr.vdate neq '0000-00-00') || $ugs.v_agd.i eq 0)} disabled {/if}>               
            </td> 
          </tr>           
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Consult Fee:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
                {if $ugs.v_agd.v eq 1 && $ugs.v_agd.m eq 0 && (($dt_arr.cfee > 0) || $ugs.v_agd.i eq 0)}
                    <input type="hidden" name="t_cfee" value="{$dt_arr.cfee}"> 
                {/if}
                <input type="text" id="t_cfee" name="t_cfee" value="{$dt_arr.cfee}" size="30" onChange="audit_money(this)"  {if $ugs.v_agd.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_agd.v eq 1 && $ugs.v_agd.m eq 0 && (($dt_arr.cfee > 0) || $ugs.v_agd.i eq 0)} disabled {/if}> 
			</td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Net Amount:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				{$net_camount} 
			</td> 
          </tr>          

          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Date:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				{if $ugs.v_agd.v eq 1 && $ugs.v_agd.m eq 0 && (($dt_arr.adate neq '' && $dt_arr.adate neq '0000-00-00') || $ugs.v_agd.i eq 0)}
                	<input type="hidden" name="t_adate" value="{$dt_arr.adate}"> 
                {/if}
				<input type="text" id="t_adate" name="t_adate" value="{$dt_arr.adate}" size="30" {if $ugs.v_agd.v eq 0} style="visibility:hidden"{/if} {if $ugs.v_agd.v eq 1 && $ugs.v_agd.m eq 0 && (($dt_arr.adate neq '' && $dt_arr.adate neq '0000-00-00') || $ugs.v_agd.i eq 0)} disabled {/if}> 
               
                
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
		          		<td>Due<br/>Amount</td>
		          		<td>GST</td>
		          		<td>Total<br/>Received</td>
		          		<td>3rd Party</td>
		          		<td>3rd Party<br/>Amount</td>
		          		<td>GST</td>
		          		<td>Total Paid</td>
		          		<td>Profit</td>
                        <!--
                        <td>Agreement<br/>Profit</td>
                        <td>Paperwork<br/>Profit</td>
		          	    -->
                      </tr>
		          	{assign var="total_profit" value="0"}
                    {assign var="agreement_profit" value="0"}
                    {assign var="paperwork_profit" value="0"}
	                {foreach key=id item=arr from=$account_arr}
					<tr align="center" class="roweven">
						<td style="text-decoration:underline; cursor:pointer" onClick="window.open('client_account_detail.php?vid={$vid}&aid={$id}&cid={$cid}&typ=visa','_blank', 'alwaysRaised=yes,height=500, width=800,location=no,scrollbars=yes')" >{$arr.step|ucwords}</td>
						<td align="right">{$arr.dueamt|string_format:"%.2f"}</td>
						<td align="right">{$arr.gst|string_format:"%.2f"}</td>
						<td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_payment.php?aid={$id}','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')">{$arr.paid|string_format:"%.2f"}</span></td>
						<td>{$arr.party|ucwords}</td>
						<td align="right">{$arr.dueamt_3rd|string_format:"%.2f"}</td>
						<td align="right">{$arr.gst_3rd|string_format:"%.2f"}</td>
						<td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_spand.php?aid={$id}','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')">{$arr.spand|string_format:"%.2f"}</span></td>
						<td align="right">
                            {if $arr.step != 'app'}
							    {$arr.paid-$arr.dueamt_3rd|string_format:"%.2f"}
							    {assign var="total_profit" value=$total_profit+$arr.paid-$arr.dueamt_3rd}
                            {else}
                                0.00
                            {/if}
						</td>
                        <!--
                        <td align="right">
                            {if $arr.step != 'app'}
                                {$arr.dueamt-$arr.gst-dueamt_3rd+$arr.gst_3rd|string_format:"%.2f"}
                                {assign var="agreement_profit" value=$agreement_profit+$arr.dueamt-$arr.gst-dueamt_3rd+$arr.gst_3rd}
                            {else}
                                0.00
                            {/if}
                        </td>
                        <td align="right">
                            {if $arr.step != 'app'}
                                {$arr.paid-$arr.gst-$arr.spand+$arr.gst_3rd|string_format:"%.2f"}
                                {assign var="paperwork_profit" value=$paperwork_profit+$arr.paid-$arr.gst-$arr.spand+$arr.gst_3rd}
                            {else}
                                0.00
                            {/if}
                        </td>
                        -->                                                
					</tr>
					{/foreach}
					<tr align="center" class="roweven">
						<td align="right" colspan="8"><strong>Total:</strong></td>
						<td align="right"><strong>{$total_profit|string_format:"%.2f"}</strong></td>
                        <!--
                        <td align="right"><strong>{$agreement_profit|string_format:"%.2f"}</strong></td>
                        <td align="right"><strong>{$paperwork_profit|string_format:"%.2f"}</strong></td>
					    -->
                    </tr>	
                  
					<tr align="center" class="roweven">
						<td colspan="11" align="center">
                            {if $vid > 0}        
                            <input type="button" value="Add new" onclick="window.open('client_account_detail.php?cid={$cid}&vid={$vid}&typ=visa','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')" />
                            {/if}
                        </td>
					</tr>				          	
		        </table>
	    
          	</td>	
          	
          </tr>   

          <tr> 
            <td colspan="2" height="5"><hr></td> 
          </tr>
        </table> 
        
        </td> 
      <td width="40%" align="left" valign="top"> 
      		<div style="width:100%;overflow-X:auto; overflow-Y:auto;"> 
	          <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
	            <tr class="greybg"> 
	              <td colspan="4" class="whitetext" align="center">Process &nbsp; 
                    {if $vid > 0}
	                <input type="button" value="add new" style="font-weight:bold" onClick="window.open('client_visa_process.php?vid={$vid}&cid={$cid}&isNew=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')"></td> 
	                {/if}
                </tr> 
	            <tr align="center" class="totalrowodd"> 
	              <td class="border_1" width="33%">Date</td> 
	              <td class="border_1" width="60%">Subject</td> 
	              <td class="border_1" width="7%">Insert</td> 
	            </tr> 
	            {foreach key=id item=arr from=$process_arr}
	            <tr align="left" class="roweven"> 
	              <td class="border_1"><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span>{$arr.date}</td> 
	              <td class="border_1"><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_process.php?vid={$vid}&pid={$id}&cid={$cid}','_blank','alwaysRaised=yes,height=500,width=800, location=no')">{$arr.subject}</span></td>
	              <td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_visa_process.php?vid={$vid}&pid={$id}&cid={$cid}&isNew=1&isOther=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')"></td> 
	            </tr> 
	            {/foreach}
	          </table> 
        	</div>
        	<hr/>
    	</td> 
    </tr> 
    <tr>
    	<td align="left" class="roweven">
        	<strong>Key Point</strong>
        	<textarea style="width:100%; height:100% " name="t_key"  rows="30">{$dt_arr.key}</textarea>
         </td> 
        <td align="left" class="roweven">
           	<strong>Note</strong>
        	<textarea style="width:100%; height:100% " name="t_note2" rows="30">{$dt_arr.note2}</textarea>
        </td>        
    </tr>
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>
  </table> 
</form> 
{literal}
<script type="text/javascript">
	$('#t_epdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_first').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_adate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

    function save_visa(obj,close_w){
        $('#bt_name').val('save');
        btn_n = $(obj).val();
        $(obj).val('waiting...');
        //ContentType UTF-8
        $.post($('#form1').attr('action'), $('#form1').serialize(), function(data){
            rtn = $.parseJSON(data);
            
            $(obj).val(btn_n);
            if (rtn.id > 0)
                $('#vid').val(rtn.id);
            else {
                alert(rtn.msg);
                return false;
            }

            if (rtn.msg != 'Save OK')
                close_w = false
            
            if (close_w) {
                if(window.opener && !window.opener.closed){
                    window.opener.location.reload(true);
                }
                window.close();
            }
            else{
                alert(rtn.msg);
                if (rtn.id > 0) 
                  window.location.href = window.location.href + '&vid=' + rtn.id;    
                else
                  window.location.reload();    
            }
        });
        
    }
</script>
{/literal}	