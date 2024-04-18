<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" media="all" href="../js/calendar/calendar.css" title="win2k-cold-1">
<script type="text/javascript" src="../js/calendar/calendar.js"></script>
<script type="text/javascript" src="../js/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="../js/calendar/calendar-setup.js"></script>
<script language="javascript" src="../js/audit.js"></script>
{literal}
	<script type="text/javascript">
	 function changeClientFrom(obj1,obj2){
		if(obj1.value>0){
			obj2.value='SubAgent';
		}
	 }
	 
	 function changeAboutInput(str,obj1){
	 	if(str == ''){
			obj1.disabled = false;
			obj1.style.visibility="visible";
		}
		else{
			obj1.disabled = true;
			obj1.style.visibility="hidden";		
		}
	 }
	</script>
{/literal}	
<body>
<form name="form1" action="" target="_self" method="post">
  <input type="hidden" name="cid" value="{$cid}">
  <input type="hidden" name="visaChange" value="0">
  <table align="center" width="100%"  class="graybordertable" cellspacing="1" cellpadding="1" border="0">
    <tr align="left"  class="bordered_2">
      <td colspan="2"> {if $ugs.b_service.v eq 1}
        <input name="button" type="button" disabled style="font-weight:bold;" onClick="javascript:this.form.action='client_detail.php';this.form.submit();" value="Client Detail">
        &nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">
        &nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_qual.php';this.form.submit();" value="Qualification">
        &nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();" value="Working experience">
        &nbsp;&nbsp;
        <input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">
        &nbsp;&nbsp;
        {/if}
        {if ($client_type eq 'study' || $client_type eq 'all') && $ugs.c_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        {/if} 
        {if ($client_type eq 'immi' || $client_type eq 'all') && $ugs.v_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        {/if} </td>
    </tr>
    <tr>
      <td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
          <tr align="center"  class="greybg" >
            <input type="hidden" name="bt_name" value="">
            <td align="left" width="10%">{if $ugs.b_service.d eq 1}
              <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
              {/if}</td>
            <td class="whitetext" align="center">Client Detail</td>
            <td align="right" width="10%"><input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" ></td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"  class="greybg" >
      <td align="left" colspan="2" style="font-size:16px "><span class="highyellow">Client: {$arr.lname} {$arr.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$arr.dob}</span>&nbsp;&nbsp; <span class="highyellow">Type: {$arr.type}</span>&nbsp;&nbsp; </td>
    </tr>
    <!--<tr>
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
        </select></td>
    </tr>
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Visa Expiry Date:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"> {if $ugs.b_visa.v eq 1 && $ugs.b_visa.m eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)}
        <input type="hidden" name="t_epdate" value="{$arr.epdate}">
        {/if}
        <input id='t_epdate' type="text" name="t_epdate" value="{$arr.epdate}"  size="30" onChange="audit_date(this)" {if $ugs.b_visa.v eq 0} style="visibility:hidden"{/if} {if $ugs.b_visa.v eq 1 && $ugs.b_visa.m eq 0 && ($cid gt 0 || $ugs.b_visa.i eq 0)} disabled {/if}>
        {literal}
        <script type="text/javascript">
					Calendar.setup({
								inputField : "t_epdate",
								ifFormat   : "%Y-%m-%d",
								eventName  : "dblclick",
								step       :  1
					});
				</script>
        {/literal} </td>
    </tr>
    <tr>
      <td colspan="2"><hr></td>
    </tr>!-->
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Country of passport:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><select name="t_country" onChange="this.form.t_sign.focus();">
          
					{foreach key=id item=name from=$country_arr}
						
          <option value="{$id}" {if $id eq $arr.country} selected {/if}>{$name}</option>
          
					{/foreach}
					{if  $arr.country lt 1}
					  
          <option value="0" selected>select a country</option>
          
					{/if}
				
        </select>
        &nbsp;&nbsp;&nbsp; <span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="openModel('country.php',300,300,'NO','form1')">add new country</span></td>
    </tr>
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Input Date:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven">
      	<input type="text" id='t_sign' name="t_sign" value="{$arr.sign}" size="30" onChange="audit_date(this)">
      	      	{literal}
          		<script type="text/javascript">
					Calendar.setup({
								inputField : "t_sign",
								ifFormat   : "%Y-%m-%d",
								eventName  : "dblclick",
								step       :  1
					});
				</script> 
          {/literal}   
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
      	<input type="text" id='t_dob' name="t_dob" value="{$arr.dob}" size="30" onChange="audit_date(this)">
      	{literal}
          		<script type="text/javascript">
					Calendar.setup({
								inputField : "t_dob",
								ifFormat   : "%Y-%m-%d",
								eventName  : "dblclick",
								step       :  1
					});
				</script> 
          {/literal} 
      </td>
    </tr>
    <tr>
      <td wwidth="28%"  align="left" class="rowodd"><strong>English Name:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><input type="text" name="t_ename" value="{$arr.ename}" size="30"></td>
    </tr>
    <tr>
      <td width="28%"  align="left" class="rowodd" ><strong>Email:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><input type="text" name="t_email" value="{$arr.email}" size="30" onChange="audit_email(this.value)">
        <A HREF="mailto:{$arr.email}">send mail</A></td>
    </tr>
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Home Tel:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><input type="text" name="t_tel" value="{$arr.tel}" size="30"></td>
    </tr>
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><input type="text" name="t_mobile" value="{$arr.mobile}" size="30"></td>
    <tr>
      <td height="30" align="left" class="rowodd"><strong>Current residential addres:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><input type="text" size="50" name="t_add" value="{$arr.add}"></td>
    </tr>
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Client Type:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"> {if $ugs.b_ctype.v eq 1 && $ugs.b_ctype.m eq 0 && ($cid gt 0 || $ugs.b_ctype.i eq 0)}
        <input type="hidden" name="t_type" value="{$arr.type}">
        {/if}
        <select name="t_type" onChange="this.form.t_note.focus();" {if $ugs.b_ctype.v eq 0} style="visibility:hidden"{/if} {if $ugs.b_ctype.v eq 1 && $ugs.b_ctype.m eq 0 && ($cid gt 0 || $ugs.b_ctype.i eq 0)} disabled {/if}>
        {foreach key=id item=type from=$type}
        <option value="{$type}" {if $type eq $arr.type} selected {/if} >{$id}</option>
        {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp; {if $isDependant}<span style="color:#FF0000">[Dependant]</span>{/if} </td>
    </tr>
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Note:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><textarea style="width:300px; height:100px;" name="t_note">{$arr.note}</textarea></td>
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
      <td width="28%" align="left" class="rowodd"><strong>SubAgent:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"> {if $ugs.b_suba.v eq 1 && $ugs.b_suba.m eq 0 && ($cid gt 0 || $ugs.b_suba.i eq 0)}
        <input type="hidden" name="t_agent" value="{$arr.agent}">
        {/if}
        <select name="t_agent" onChange="changeClientFrom(this,this.form.t_about);" {if $ugs.b_suba.v eq 0} style="visibility:hidden"{/if} {if $ugs.b_suba.v eq 1 && $ugs.b_suba.m eq 0 && ($cid gt 0 || $ugs.b_suba.i eq 0)} disabled {/if}>
        {foreach key=ag_id item=ag_name from=$agent_arr}
        <option value="{$ag_id}" {if $ag_id eq $arr.agent} selected {/if}>{$ag_name}</option>
        {/foreach}
        {if  $arr.agent lt 1}
        <option value="0" selected>select an agent</option>
        {/if}
        </select>
        <a href="#" onClick="openModel('./agent_add.php?aid={$arr.agent}',screen.width*4/7,screen.height*3/7,'NO','form1')">Display</a></td>
    </tr>    
    <tr>
      <td width="28%"  align="left" class="rowodd"><strong>Where do you know about us:</strong>&nbsp;&nbsp;</td>
      <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar，Passby, Friends, other-->
      <select name="t_about" onChange="changeAboutInput(this.value,this.form.t_aboutTxt);">
      	{foreach item=name from=$clientfroms}
      		<option value="{$name}" {if $arr.about eq $name} selected {/if}>{$name}</option>
      	{/foreach}
        	<option value="" {if $arr.about eq ""} selected {/if}>Others</option>
      </select>
      <input type="text" name="t_aboutTxt"value="{$arr.about}" {if $aboutinput eq 1} disabled  style="visibility:hidden"{/if}>
        </td>
    </tr>
    <tr class="greybg">
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
