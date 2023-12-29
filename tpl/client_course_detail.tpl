<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>

<script language="javascript">{$msg_alert}</script>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
  <input type="hidden" name="cid" value="{$cid}">
  <input type="hidden" name="courseid" value="{$courseid}">
  <input type="hidden" name="isChange" value="0">
  <table border="0" width="100%" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
          <tr align="center"  class="greybg">
            <input type="hidden" name="bt_name" value="">
            <td align="left"  width="31%"><input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" {if $isapprove eq 0} disabled {/if}>
              &nbsp;&nbsp;&nbsp;
              <input name="button" type="button" style="font-weight:bold" onClick="window.open('attachment.php?item={$courseid}&type={$itemtype}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=' + screen.width*6/7 +',height='+screen.height*4/7)" value="Attachment">
            </td>
            <td width="49%" align="center" class="whitetext">Apply Course Detail</td>
            <td align="right"  width="20%"><input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;"  {if $isapprove eq 0} disabled {/if}>
            </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"  class="greybg" >
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_course.php?cid={$cid}'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"><span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span></td>
    </tr>
    <tr>
      <td width="45%" style="vertical-align: top;">
        <table border="0" width="100%" cellpadding="3" cellspacing="1">
          <tr>
            <td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Status:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="done" style=" font-weight:bold;color:#FF0000" onChange="this.form.t_key.focus();refuse(this.value,'rf', 't_rf')">
                <option value="0" {if $dt_arr.active eq 0} selected {/if}>N/A</option>
                <option value="1" {if $dt_arr.active eq 1} selected {/if}>Active</option>
                <option value="2" {if $dt_arr.active eq 2} selected {/if}>Refused</option>
              </select>
            </td>
          </tr>
          <tr id="rf" style="{if $dt_arr.active neq 2}display:none;{/if}">
            <td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Refuse Reason:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%"  class="roweven"><textarea name="t_rf" style="width:300px; height:100px " {if $dt_arr.active neq 2}disabled{/if}>{$dt_arr.refuse}</textarea>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Consultant:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
             {if $ugs.c_user.m eq 1 || ($dt_arr.consultant eq 0 && $ugs.c_user.i eq 1)}
                <select name="t_consultant">      
                  <option value="0" selected>choose a consultant</option>
                  {foreach key=uid item=user_name from=$user_arr}
                    <option value="{$uid}" {if $dt_arr.consultant eq $uid || ($dt_arr.consultant eq 0 && $user_id eq $uid)} selected {/if}>{$user_name}</option>
                  {/foreach}
                </select>
              {else}
                {if $ugs.c_user.v eq 1}
                  {$user_arr[$dt_arr.consultant]}
                {/if}
                <input type="hidden" name="t_consultant" value="{$dt_arr.consultant}">
              {/if}
            </td>
          </tr>    
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Paperwork:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
                <select name="t_paperwork">      
                  <option value="0" selected>choose a paperwork</option>
                  {foreach key=uid item=user_name from=$paperwork_arr}
                    <option value="{$uid}" {if $dt_arr.paperwork eq $uid || ($dt_arr.paperwork eq 0 && $user_id eq $uid)} selected {/if}>{$user_name}</option>
                  {/foreach}
                </select>
            </td>
          </tr>   
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Consultant Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">

              {if $ugs.c_user.m eq 1 || (($dt_arr.consultant_date eq '' ||  $dt_arr.consultant_date eq '0000-00-00') && $ugs.c_user.i eq 1)}
                <input type="text" name="t_consultant_date" id="t_consultant_date" onchange="audit_date(this)"  value="{$dt_arr.consultant_date}">
              {else}
                {if $ugs.c_user.v eq 1}
                  {$dt_arr.consultant_date}
                {/if}
                <input type="hidden" name="t_consultant_date" value="{$dt_arr.consultant_date}">
              {/if}
            </td>
          </tr>                
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Category Of Institute:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_cate" onChange="this.form.isChange.value=1;this.form.submit();">
                
										{foreach key=id item=name from=$cate_arr}
                                        	
                <option value="{$id}" {if $id eq $dt_arr.catid} selected {/if}>{$name}</option>
                
										{/foreach}
										{if  not array_key_exists($dt_arr.catid, $cate_arr)}
                <option value="0" selected>choose category</option>
                {/if}
                                      
              </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Institute:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_school" onChange="this.form.isChange.value=1;this.form.submit();">
                
									  
										{foreach key=sc_id item=sc_name from=$sc_arr}
                                        	
									  
                <option value="{$sc_id}" {if $sc_id eq $dt_arr.iid} selected {/if}>{$sc_name}</option>
                
									  
										{/foreach}
										{if not array_key_exists($dt_arr.iid, $sc_arr)}
									  
                <option value="0" selected>choose institute</option>
                
									  {/if}
                                      
									  
              </select>
              {if $ugs.i_comm.v eq 1}
              &nbsp;&nbsp;&nbsp;
              <input type="button" style="font-weight:bold" value="Commission" onClick="window.open('institute_comm.php?sid={$dt_arr.iid}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*6/7 +',height=' + screen.height*4/7)">
              {/if} </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_qual" onChange="this.form.isChange.value=1;this.form.submit();">
                
										{foreach key=id item=qual from=$qual_arr}
											
                <option value="{$id}" {if $id eq $dt_arr.qual} selected {/if}>{$qual}</option>
                
										{/foreach}
										{if not array_key_exists($dt_arr.qual, $qual_arr)}
                <option value="0" selected>choose qualification</option>
                {/if}
										
              </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_major" onChange="this.form.t_key.focus();">
                
										  {foreach key=id item=major from=$major_arr}	
	                                      	
                <option value="{$id}" {if $id eq $dt_arr.major} selected {/if}>{$major}</option>
                
										  {/foreach}
										  {if not array_key_exists($dt_arr.major, $major_arr)}
                <option value="0" selected>choose major</option>
                {/if}
	                                    
              </select>
            </td>
            </tr>
           <tr>
            <td width="28%" align="left"class="rowodd"><strong>Course Completed:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              <select name="t_completed" onChange="this.form.t_key.focus();">
                  <option value="YES" {if $dt_arr.completed == 'YES'} selected {/if}>YES</option>
                  <option value="NO" {if $dt_arr.completed == 'NO' ||$dt_arr.cpmpleted == "" } selected {/if}>NO</option>                                        
              </select>
            </td>
          </tr>

          </tr>
          {if $courseid > 0}
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Verify Migration Agents:</strong></td>
            <td align="left" width="72%" class="roweven">
              <select name="t_vma">
                  <option value="0">choose an agent</option>  
                  {foreach key=id item=name from=$agent_users} 
                      <option value="{$id}" {if $id eq $dt_arr.vma} selected {/if}>{$name}</option>
                  {/foreach}
                                
              </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Verify Migration Result:</strong></td>
            <td align="left" width="72%" class="roweven">
              {if $dt_arr.vma eq $user_id}
                <select name="t_vms">
                      <option value="none" {if $dt_arr.vms == "none"} selected {/if}>n/a</option> 
                      <option value="yes" {if $dt_arr.vms == "yes"} selected {/if}>Yes</option> 
                      <option value="no" {if $dt_arr.vms == "no"} selected {/if}>No</option>   
                </select>
              {else}
                <input type="hidden" name="t_vms" value="{$dt_arr.vms}">
                {$dt_arr.vms|ucfirst}
              {/if}
            </td>
          </tr>
          {/if}
          {if $ugs.i_tta.v eq 1}
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>To top-agent :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              {if $ugs.i_tta.i eq 1 || $ugs.i_tta.m eq 1}
               <select name="t_agent" onChange="this.form.t_key.focus();">
                <option value="0" {if $dt_arr.agent eq 0 || $dt_arr.agent eq ""}selected{/if}>N/A</option>
								{foreach key=ag_id item=ag_name from=$agent_arr}                        
                  <option value="{$ag_id}" {if $ag_id eq $dt_arr.agent} selected {/if}>{$ag_name}</option>
								{/foreach}
              </select>
              {else}
                <input type="hidden" name="t_agent" value="{$dt_arr.agent}">
                {$agent_arr[$dt_arr.agent]}
              {/if}
            </td>
          </tr>
          {else}
            <input type="hidden" name="t_agent" value="{$dt_arr.agent}">
          {/if}
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Course Start Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_fdate" id="t_fdate" value="{$dt_arr.start}" size="30" >
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd" ><strong>Course Complete Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_tdate" id="t_tdate" value="{$dt_arr.end}" size="30" >
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Tution Fee:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_fee" value="{$dt_arr.fee}" size="30" onChange="audit_money(this)"></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Collect Document Due Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_apodue"  id="t_apodue" value="{$apodue}" size="30" >
            </td>
          </tr>          
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Duration:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_due" value="{$dt_arr.due}" size="10" onChange="audit_number(this)">
              &nbsp;&nbsp;
              <select name="t_unit" onChange="this.form.t_appfee.focus();">
                <option value="year" {if $dt_arr.unit eq 'year'} selected {/if}>year</option>
                <option value="month" {if $dt_arr.unit eq 'month'} selected {/if}>month</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong style="color:red">StudentID :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_studentid" value="{$dt_arr.studentid}" size="30"></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Apply Fee :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_appfee" value="{$dt_arr.appfee}" size="30" onChange="audit_money(this)"></td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>To Us Date :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_tusdate" id="t_tusdate" value="{$dt_arr.tusdate}" size="30">          
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>To School Date :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_tsdate" id="t_tsdate" value="{$dt_arr.tsdate}" size="30" >                      
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Method :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_method" onChange="this.form.t_key.focus()">
                
										{foreach key=id item=method from=$method_arr}
											
                <option value="{$id}" {if $id eq $dt_arr.method} selected {/if}>{$method}</option>
                
										{/foreach}
										{if $dt_arr.method lt 1}
                <option value="0" selected>select a method</option>
                {/if}
										
              </select>
              <span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="window.open('course_method.php','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=300,height=300')">Add new method</span> </td>
          </tr>
          <tr>
            <td align="left" colspan="2" class="roweven">
              <strong>Key Point:</strong><br/>
              <textarea name="t_key" style="width:100%; height:600px; ">{$dt_arr.key}</textarea>
            </td>
          </tr>
      </table>
      </form>
      </td>
    <td width="55%" align="left" valign="top">
        <div style="width:100%;overflow-X:auto; overflow-Y:auto;"> 
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr class="bordered_2">
                <td colspan="3" class="whitetext" align="center">Process</td>
              </tr>
              <tr align="center" class="totalrowodd">
                <td class="border_1" width="26%">Date</td>
                <td class="border_1" width="67%">Subject</td>
                <td class="border_1" width="7%">Insert</td>
              </tr>
              {foreach key=id item=arr from=$process_arr}
              <tr align="left" class="roweven">
                <td class="border_1" nowrap="nowrap"><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span> {$arr.date} </td>
                <td class="border_1" onClick="window.open('client_course_process.php?courseid={$courseid}&pid={$id}&cid={$cid}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"><span style="cursor:pointer; text-decoration:underline;">{if $arr.subject eq 0}{$arr.add}{else}{if $arr.auto eq 1}AUTO:{/if}{$item_arr[$arr.subject].name}{/if}</span></td>
                <td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_course_process.php?courseid={$courseid}&pid={$id}&cid={$cid}&isOther=1', '_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"></td>
              </tr>
              {/foreach}
            <tr>
              <td colspan="3"><hr></td>
            </tr>
            </table>
        </div>
        <hr/>
        {if $show_checklist eq 1} 
        <div style="width:100%;overflow-X:auto; overflow-Y:auto;">
          <span id="cl_msg"></span>
          <form method="posts" id="form_checklists" name="form_checklists" action="/scripts/checklist_ajax.php"> 
            <input type="hidden" name="cl_act" id="cl_act" value="">
            <input type="hidden" name="cl_typ" id="cl_typ" value="course">
            <input type="hidden" name="cl_appid" id="cl_appid" value="{$courseid}">
            <input type="hidden" name="cl_tplid" id="cl_tplid" value="1">
          </form>
        </div>
        {/if}
       </td>      
    </tr>
    <tr>
      <td colspan="2" class="greybg">&nbsp;</td>
    </tr>
  </table>
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});
	$('#t_apodue').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});	
	$('#t_tusdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_tsdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
  $('#t_consultant_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }); 

	function do_checklist(act){
		$('#cl_act').val(act);
		$('#cl_msg').html('loading...');
		$.post($('#form_checklists').attr('action'), $('#form_checklists').serialize(), function(data){
			$('#form_checklists').html(data);
			$('#cl_msg').html('');
		});	
	}
  do_checklist('');
</script>
{/literal}	