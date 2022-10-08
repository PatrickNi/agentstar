<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

{include file="style.tpl"}

<script language="javascript" src="../js/audit.js"></script>
<body {$forbid_sl} {$forbid_cp} {$forbid_rc}>
<form name="form1" action="" target="_self" method="get" onSubmit="return isDelete()">
  <input type="hidden" name="cid" id="client_id" value="{$cid}">
  <input type="hidden" name="visaChange" value="0">
  <table align="center" width="100%"  class="graybordertable" cellspacing="1" cellpadding="1" border="0">
    <tr align="left"  class="bordered_2">
      <td colspan="2"> {if $ugs.b_service.v eq 1}
        <input name="button" type="button" disabled style="font-weight:bold;" onClick="javascript:this.form.action='client_detail.php';this.form.submit();" value="Client Detail">
        <input name="button2" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_qual.php';this.form.submit();" value="EDU Background">
        &nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();" value="Working experience">
        &nbsp;&nbsp;
        <input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">
        &nbsp;&nbsp;
        {/if}
        {if in_array('study', $client_type) && $ugs.c_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('immi', $client_type) && $ugs.v_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('coach', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service">
        &nbsp;
        {/if}
        {if in_array('homeloan', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        {/if}
        {if in_array('legal', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_legal.php';this.form.submit();" value="Legal Service">
        &nbsp;&nbsp; 
        {/if}  
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coupon.php';this.form.submit();" value="Coupons">
        &nbsp;&nbsp;
      </td>
    </tr>
    <tr>
      <td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
          <tr align="center"  class="greybg" >
            <input type="hidden" name="bt_name" value="">
            <td align="left" width="10%">{if $ugs.b_service.d eq 1}
              <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
              {/if}</td>
            <td class="whitetext" align="center">Client Detail</td>
            <td align="right" width="10%">
            	<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
            </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"  class="greybg" >
      <td align="left" colspan="2" style="font-size:16px "><span class="highyellow">Client: {$arr.lname} {$arr.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$arr.dob}</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: {$arr.visa_n}-{$arr.class_n}, expr: {$arr.epdate}</span>&nbsp;&nbsp;             	
      {if $arr.status == 'new'}
	      <input type="submit" value="Approve From GEIC" style="font-weight:bold; color:#FF0000" onClick="this.form.bt_name.value='approved';this.disable=false;" >
      {/if}
      </td>
    </tr>
    <tr align="center">
      <td width="70%" valign="top">
          <table align="center" width="100%">
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Password Reset:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <input type="password" size="20" name="t_pass" value=""></td>
              </tr>    
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Cryption Link:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                    <span id="cryption_link" style="background-color: yellow;">{$cryption_link}</span>&nbsp;&nbsp;&nbsp;
                    <button onclick="gen_crypt_link()">Generate</button>
                    <button onclick="expire_crypt_link()">Expired</button>
                </td>
              </tr>   
              <tr>
                <td colspan="2"><hr></td>
              </tr>    
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Current Visa type:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> {if $ugs.b_visa.v eq 1 && $ugs.b_visa.m eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)}
                  <input type="hidden" name="t_visa" value="{$catid}">
                  {/if}
                  <select name="t_visa" onChange="this.form.visaChange.value=1;this.form.submit();" {if $ugs.b_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.b_visa.v eq 1 && $ugs.b_visa.m eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)} disabled {/if}>
                  {foreach key=id item=name from=$visa_arr}
                  <option value="{$id}" {if $id eq $catid} selected {/if}>{$name}</option>
                  {/foreach}
                  {if $catid eq 0}
                  <option value="0" selected>choose a category</option>
                  {/if}
                  </select></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Current Visa subclass:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> {if $ugs.b_visa.v eq 1 && $ugs.b_visa.v eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)}
                  <input type="hidden" name="t_class" value="{$classid}">
                  {/if}
                  <select name="t_class" onChange="this.form.t_epdate.focus();" {if $ugs.b_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.b_visa.v eq 1 && $ugs.b_visa.m eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)} disabled {/if}>
                  {foreach key=id item=name from=$visaclass_arr}
                  <option value="{$id}" {if $id eq $classid} selected {/if}>{$name}</option>
                  {/foreach}
                  {if $classid eq 0}
                  <option value="0" selected>choose a subclass</option>
                  {/if}
                  </select>
                  &nbsp;
                  <input type="text" size="50" name="t_classtxt" value="{$arr.classtxt}">
                  
                  </td>
              </tr>    
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Visa Expiry Date:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> {if $ugs.b_visa.v eq 1 && $ugs.b_visa.m eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)}
                  <input type="hidden" name="t_epdate" value="{$arr.epdate}">
                  {/if}
                  <input id='t_epdate' type="text" name="t_epdate" value="{$arr.epdate}"  size="30" {if $ugs.b_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.b_visa.v eq 1 && $ugs.b_visa.m eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)} disabled {/if}>
                 </td>
              </tr> 
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Consultant Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_staffname' type="text" name="t_staffname" value="{$arr.staff_name}"  size="30">
                 </td>
              </tr>  
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat ID:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_id' type="text" name="t_wechat_id" value="{$arr.wechatid}"  size="50">
                 </td>
              </tr> 
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat Linked Phone:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_phone' type="text" name="t_wechat_phone" value="{$arr.wechatphone}"  size="50">
                 </td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat Linked Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_email' type="text" name="t_wechat_email" value="{$arr.wechatemail}"  size="50">
                 </td>
              </tr> 
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Country of passport:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><select name="t_country" onChange="this.form.t_sign.focus();">
                  
                    
                              {foreach key=id item=name from=$country_arr}
                                  
                    
                  <option value="{$id}" {if $id eq $arr.country} selected {/if}>{$name}</option>
                  
                    
                              {/foreach}
                              {if  $arr.country lt 1}
                                
                    
                  <option value="0" selected>select a country</option>
                  
                    
                              {/if}
                          
                  
                </select>        &nbsp;&nbsp;&nbsp; <span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="openModel('country.php',300,300,'NO','form1')">add new country</span></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Input Date:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input type="text" id='t_sign' name="t_sign" value="{$arr.sign}" size="30">
                </td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Last Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_lname" value="{$arr.lname}" size="30"></td>
              </tr>
              <tr>
                <td hwidth="28%"  align="left" class="rowodd"><strong>First Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_fname" value="{$arr.fname}" size="30"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Gender:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><select name="t_gender" onChange="this.form.t_dob.focus()">
                    <option value="F" {if $arr.gender eq "F"} selected {/if}>Female</option>
                    <option value="M" {if $arr.gender eq "M"} selected {/if}>Male</option>
                  </select></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>DoB:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input type="text" id='t_dob' name="t_dob" value="{$arr.dob}" size="30">
                </td>
              </tr>
              <tr>
                <td wwidth="28%"  align="left" class="rowodd"><strong>English Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_ename" value="{$arr.ename}" size="30"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd" ><strong>Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_email" value="{$arr.email}" size="60" onChange="audit_email(this.value);this.form.t_email.focus();">
                  <A HREF="mailto:{$arr.email}">send mail</A></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Home Tel:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_tel" value="{$arr.tel}" size="60"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_mobile" value="{$arr.mobile}" size="60"></td>
              <tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Matrial Status:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                        <select name="t_m" class="text">
                                <option value="married" {if $arr.married == 'married'} selected {/if} >���??(Married)</option>
                                <option value="divorce" {if $arr.married == 'divorce'} selected {/if}>���??(Divorce)</option>
                                <option value="never_married" {if $arr.married == 'never_married'} selected {/if}>δ��(Never Married)</option>
                                <option value="separated" {if $arr.married == 'separated'} selected {/if}>�־�(Separated)</option>
                                <option value="defacto" {if $arr.married == 'defacto'} selected {/if}>ͬ��(Defacto Relationship)</option>
                        </select>
                </td>
              <tr>    
                <td height="30" align="left" class="rowodd"><strong>Current residential addres:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" size="100" name="t_add" value="{$arr.add}"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Client Type:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  <!--
                  {if $ugs.b_ctype.v eq 1 && $ugs.b_ctype.m eq 0 && ($cid gt 0 || $ugs.b_ctype.i eq 0)}
                  <input type="hidden" name="t_type" value="{$arr.type}">
                  {/if}
                  <select name="t_type" onChange="this.form.t_note.focus();" {if $ugs.b_ctype.v eq 0} style="visibility:hidden"{/if} {if $ugs.b_ctype.v eq 1 && $ugs.b_ctype.m eq 0 && ($cid gt 0 || $ugs.b_ctype.i eq 0)} disabled {/if}>
                  {foreach key=id item=type from=$type}
                  <option value="{$type}" {if $type eq $arr.type} selected {/if} >{$id}</option>
                  {/foreach}
                  </select>
                  -->
                  {foreach key=id item=t from=$all_types}
                      <input type="checkbox" name="t_type[]" value="{$t}" {if in_array($t, $arr.type)} checked {/if}>{$id}&nbsp;&nbsp;
                  {/foreach}
                  &nbsp;&nbsp;&nbsp; {if $isDependant}<span style="color:#FF0000">[Dependant]</span>{/if} </td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Have contact Person:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="checkbox" name="t_c" value="1" onClick="has_contact(this.checked)" {if $arr.c_name neq ""} checked {/if}></td>
              </tr>
              
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Contact Person Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_name" value="{$arr.c_name}" size="30" {if $arr.c_name eq ""} disabled {/if}></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Relationship to you:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input name="t_c_rtu" type="text" class="form-control" value="{$arr.c_rtu}" {if $arr.c_name eq ""} disabled {/if}/>
              </tr>    
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Contact Home Tel:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%"class="roweven"><input type="text" name="t_c_tel" value="{$arr.c_tel}" size="30" {if $arr.c_name eq ""} disabled {/if}></td>
              </tr>
              <tr>
                <td height="30" align="left" class="rowodd"><strong>Contact Mobile:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_mobile" value="{$arr.c_mobile}" size="30" {if $arr.c_name eq ""} disabled {/if}></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Contact Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_email" value="{$arr.c_email}" size="30" onChange="audit_email(this.value)" {if $arr.c_name eq ""} disabled {/if}></td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Contact Address:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" size="50" name="t_c_add" value="{$arr.c_add}" {if $arr.c_name eq ""} disabled {/if}></td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Where do you know about us:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar��Passby, Friends, other-->
                <select name="t_about" onChange="changeAboutInput(this.value,this.form.t_aboutTxt);">
                  <option value="" selected >Others</option>
                  {foreach item=name from=$clientfroms}
                      <option value="{$name}" {if $arr.about eq $name} selected {/if}>{$name}</option>
                  {/foreach}          
                </select>
                <input type="text" name="t_aboutTxt"value="{$arr.about}" {if $aboutinput eq 1} disabled  style="visibility:hidden"{/if}>        </td>
              </tr>

              <tr id="tr_gp" {if $arr.about ne 'Global Partner'}style="visibility:collapse"{/if}>
                <td width="28%" align="left" class="rowodd"><strong>Global Partner:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  {if $ugs.b_suba.v eq 1 && $ugs.b_suba.m eq 0 && ($cid gt 0 || $ugs.b_suba.i eq 0)}
                      <input type="hidden" name="t_agent_p" value="{$arr.agent}">
                  {/if}
                  <select id="t_agent_p" name="t_agent_p" {if $ugs.b_suba.v eq 1 && $ugs.b_suba.m eq 0 && ($cid gt 0 || $ugs.b_suba.i eq 0)} disabled {/if}>
                    <option value="0">choose a Global Partner</option>
                    {foreach key=ag_id item=v from=$agent_partner}
                        <option value="{$ag_id}" {if $ag_id eq $arr.agent} selected {/if}>{$v.name}</option>
                    {/foreach}
                    
                  </select>
                </td>
              </tr>    
              <tr  id="tr_ab" {if $arr.about ne 'Ambassador' }style="visibility:collapse"{/if}>
                <td width="28%" align="left" class="rowodd"><strong>Ambassador:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  {if $ugs.b_suba.v eq 1 && $ugs.b_suba.m eq 0 && ($cid gt 0 || $ugs.b_suba.i eq 0)}
                      <input type="hidden" name="t_agent_a" value="{$arr.agent}">
                  {/if}
                  <select id="t_agent_a" name="t_agent_a"{if $ugs.b_suba.v eq 0 || ($ugs.b_suba.m eq 0 && $cid gt 0) || ($ugs.b_suba.i eq 0 && $cid eq 0)} disabled {/if}>
                  <option value="0">choose an Ambassador</option>
                  {foreach key=ag_id item=v from=$agent_ambassador}
                      <option value="{$ag_id}" {if $ag_id eq $arr.agent} selected {/if}>{$v.name}</option>
                  {/foreach}
                  </select>
                </td>
              </tr> 
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Activated Membership:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar��Passby, Friends, other-->
                    <select name="t_actm" >
                      <option value="" {if $arr.actm == ""} selected {/if}>--</option>
                      <option value="ct" {if $arr.actm == "ct"} selected {/if}> Client testimonoial</option>
                      <option value="fb" {if $arr.actm == "fb"} selected {/if}> Facebook</option>
                      <option value="gr" {if $arr.actm == "gr"} selected {/if}> Google review</option>      
                    </select>
                    <input type="text" id='t_d_actm' name="t_d_actm" value="{$arr.d_actm}" size="30">
                </td>
              </tr>     
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Do You have an Australian bank account:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar��Passby, Friends, other-->
                    <select name="t_bank" >
                      <option value="" {if $arr.bank == ""} selected {/if}> --</option>
                      <option value="nab" {if $arr.bank == "nab"} selected {/if}> NAB</option>
                      <option value="cba" {if $arr.bank == "cba"} selected {/if}> CBA</option>  
                      <option value="wetspac" {if $arr.bank == "wetspac"} selected {/if}> Wetspac</option>
                      <option value="anz" {if $arr.bank == "anz"} selected {/if}> ANZ</option>
                      <option value="stgeorge" {if $arr.bank == "stgeorge"} selected {/if}> StGeorge</option>   
                      <option value="other" {if $arr.bank == "other"} selected {/if}> Others</option>               
                    </select>
                </td>
              </tr>  
          </table>
      </td>
      <td width="30%" valign="top">
          <strong>Notes:</strong><br/>
          <textarea style="width:100%; height:600px;" name="t_note">{$arr.note}</textarea>
          <p></p>
          <strong>Customer Notes:</strong><br/>
          <textarea style="width:100%; height:200px;" name="t_cus_note">{$arr.cus_note}</textarea>
      </td>
    </tr>    
     
    <tr class="greybg">
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
{literal}
<script type="text/javascript">
	 function changeClientFrom(obj1,obj2,obj_id){
		if(obj1.value>0){
			obj2.value='SubAgent';
		}
    $('#'+obj_id).val(0);
	 }
	 
	 function changeAboutInput(str,obj1){
	 	if(str == ''){
			obj1.disabled = false;
			obj1.style.visibility="visible";
		}
    else if(str == 'Global Partner') {
      $('#tr_gp').css('visibility','visible');
      $('#tr_ab').css('visibility','collapse');
    }
    else if(str == "Ambassador") {
      $('#tr_ab').css('visibility','visible');
      $('#tr_gp').css('visibility','collapse');
    }
		else{
			obj1.disabled = true;
			obj1.style.visibility="hidden";		
		}
	 }
	$('#t_sign').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_epdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_dob').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
  $('#t_d_actm').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

  function gen_crypt_link() {
    $.post('/scripts/client_detail.php', 'crypt_link=gen&cid='+$('#client_id').val(), function(data){
            rtn = $.parseJSON(data);
            if (rtn.succ != 0) {
                $('#cryption_link').html(rtn.link);
            }
            else {
                alert("Generate cryption link failed!");
            }
        });
  }

  function expire_crypt_link() {
    $.post('/scripts/client_detail.php', 'crypt_link=expire&cid='+$('#client_id').val(), function(data){
            rtn = $.parseJSON(data);
            if (rtn.succ != 0) {
                $('#cryption_link').html('');
            }
            else {
                alert("Expired cryption link failed!");
            }
        });
  }
</script>
{/literal}	
</body>
</html>
