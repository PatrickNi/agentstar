<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" target="_self" method="post">
  <table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
    <tr class="bordered_2">
      <td align="left"><strong>Start Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_fdate" name="t_fdate"  value="{$fromDay}" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Finish Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_tdate" name="t_tdate"  value="{$toDay}" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Staff:</strong>&nbsp;&nbsp;
        <select name="t_staff" onChange="this.form.bt_name.focus();">
          
				{foreach key=user_id item=user_name from=$slUsers}
					
          <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>
          
				{/foreach}
				{if $ugs.rpt_staff.v eq 1}
					
          <option value="all" {if $staffid eq 'all'} selected {/if}>All Staff</option>
          
				{/if}
			
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp; </td>
    </tr>
    <tr class="bordered_2" align="center">
      <td align="left" colspan="2"> Report Type:&nbsp;
        <select name="rp_type" onChange="this.form.bt_name.focus();">
          <option value="d" {if $isAll eq 'd'} selected {/if}>Detail</option>
          <option value="s" {if $isAll eq 's'} selected {/if}>Summary</option>
        </select>
        &nbsp;&nbsp;&nbsp;
        <input type="submit" name="bt_name" value="create report" style="font-weight:bold ">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <!--<input type="button" style="font-weight:bold" onclick="printPage();"value="Print">-->
        <input type="button" style="font-weight:bold" value="Print" onClick="document.all.WebBrowser.ExecWB(6,1)">
        <input type="button"style="font-weight:bold" value="Print Setting" onClick="document.all.WebBrowser.ExecWB(8,1)">
        <input type="button" style="font-weight:bold" value="Print Review" onClick="document.all.WebBrowser.ExecWB(7,1)"></td>
    </tr>
  </table>
</form>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="left">
  {foreach key=week item=daterange from=$weeks}
  <tr>
    <td  class="highlighttext" colspan="2">{$daterange}</td>
  </tr>
  <tr class="greybg">
    <td colspan="2" align="center" class="highyellow">Apply School</td>
  </tr>
  <tr align="left">
    <td width="16%" class="totalrowodd"  valign="middle">Course clients</td>
    <td width="19%" class="roweven"  valign="middle"><span onClick="openinSatff('d1_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courses[$week].cnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_{$week}">
        <ul>
          {foreach key=id item=name from=$courses[$week].name}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courses[$week].apo.$id eq 0}color:#0000FF{elseif $courses[$week].num.$id eq $courses[$week].refuse.$id}color:#999999;{/if}" onClick="openModel('client_course.php?cid={$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onClick="d1_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd">Apply Offer</td>
    <td class="roweven"><span onClick="openinSatff('d2_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].apocnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d2_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].aponame}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].reo.$id eq 0}color:#0000FF{elseif $courseprocs[$week].reo_st.$id eq -1}color:#999999;{/if}" onClick="openModel('client_course_detail.php?cid={$courseprocs.$week.apocid.$id}&courseid={$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d2_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd">Received Offer</td>
    <td class="roweven"><span onClick="openinSatff('d3_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].reocnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d3_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].reoname}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].reo_st.$id eq 0}color:#0000FF{elseif $courseprocs[$week].reo_st.$id eq -1}color:#999999;{/if}" onClick="openModel('client_course_detail.php?cid={$courseprocs.$week.reocid.$id}&courseid={$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d3_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd">Received COE</td>
    <td class="roweven"><span onClick="openinSatff('d4_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].reccnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d4_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].recname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_course_detail.php?cid={$courseprocs.$week.reccid.$id}&courseid={$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d4_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  {if $ugs.rpt_staff_pc.v eq 1}
  <tr align="left">
    <td class="totalrowodd">Potential Comm</td>
    <td class="roweven"><span onClick="openinSatff('d5_{$week}');" style="text-decoration:underline; cursor:pointer;">{$coursepots[$week].rcomm|string_format:"%.2f"}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d5_{$week}">
        <table width="100%">
        <tr><td>Name</td><td  align="right">Comm($)</td></tr>
          {foreach key=id item=name from=$coursepots[$week].name}
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_course_sem.php?cid={$coursepots.$week.client.$id}&courseid={$coursepots.$week.course.$id}&semid={$coursepots.$week.sem.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span></td><td align="right" {if $coursepots[$week].commfail[$id] eq 1}style="color:#0000CC"{/if}>{$coursepots[$week].comm[$id]}</td></tr>{/foreach}
          </table>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d5_{$week}.style.display='none'">&times;</span> 
        
        </div></td>
  </tr>
  {/if}
  {if $ugs.rpt_staff_rc.v eq 1}
  <tr align="left">
    <td class="totalrowodd">Received Comm</td>
    <td class="roweven"><span onClick="openinSatff('d11_{$week}');" style="text-decoration:underline; cursor:pointer;">{$coursesems[$week].bonus|string_format:"%.2f"}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d11_{$week}">
        <table width="100%">
        <tr><td>Name</td><td align="right">Comm($)</td></tr>
          {foreach key=id item=name from=$coursesems[$week].bonusname}
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_course_sem.php?cid={$coursesems.$week.client.$id}&courseid={$coursesems.$week.course.$id}&semid={$coursesems.$week.sem.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span></td><td align="right" {if $coursesems[$week].bonusfail[$id] eq 1}style="color:#0000CC"{/if}>{$coursesems[$week].bonuscomm[$id]}</td></tr>{/foreach}
        </table>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d11_{$week}.style.display='none'">&times;</span> 
        
        </div></td>
  </tr>
  {/if}
   <tr>
    <td height="15" colspan="2">&nbsp;</td>
  </tr> 
  <tr class="greybg">
    <td colspan="2" align="center" class="highyellow">Visa Service</td>
  </tr> 
  <tr align="left">
    <td width="16%" class="totalrowodd">Visa Consultant </td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d6_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visavisits[$week].pcnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d6_{$week}">
        <ul>
          {foreach key=id item=name from=$visavisits[$week].pname}
          <li><span style="text-decoration:underline; cursor:pointer; {if $visavisits.$week.decline.$id > 0}color:#999999;{elseif $visavisits.$week.sign.$id eq 0}color:#0000FF;{/if}" onClick="openModel('client_visa_detail.php?cid={$visavisits.$week.client.$id}&vid={$visavisits.$week.visa.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d6_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td width="16%" class="totalrowodd">Consultant Fee</td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d66_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visavisits[$week].totalcfee}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d66_{$week}">
        <ul>
          {foreach key=id item=name from=$visavisits[$week].pname}
           {if $visavisits.$week.cfee.$id > 0}
	          <li><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_visa_detail.php?cid={$visavisits.$week.client.$id}&vid={$visavisits.$week.visa.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name} </span></li>
            {/if}
            {/foreach}
              
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d66_{$week}.style.display='none'">&times;</span> </div></td>
  </tr> 
  <tr align="left">
    <td class="totalrowodd" width="16%">Agreement Signed</td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d7_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visaagrees[$week].fee|string_format:"%.2f"}&nbsp;($0/paid : {$visaagrees[$week].sign0}/{$visaagrees[$week].sign1})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d7_{$week}">
        <ul>
          {foreach key=id item=name from=$visaagrees[$week].fname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaagrees.$week.client.$id}&vid={$visaagrees.$week.visa.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d7_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd" width="16%">Apply Visa </td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d8_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visaprocs[$week].lfee|string_format:"%.2f"}&nbsp;(free ${$visaprocs[$week].lfee_free|string_format:".%.2f"}/paid ${$visaprocs[$week].lfee_paid|string_format:".%.2f"}: {$visaprocs[$week].lcnt0}/{$visaprocs[$week].lcnt1})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].lname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.lc.$id}&vid={$visaprocs.$week.lv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd" width="16%">Granted Visa </td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d9_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visaprocs[$week].gfee|string_format:"%.2f"}&nbsp;(free ${$visaprocs[$week].gfee_free|string_format:".%.2f"}/paid ${$visaprocs[$week].gfee_paid|string_format:".%.2f"}: {$visaprocs[$week].gcnt0}/{$visaprocs[$week].gcnt1})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d9_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].gname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.gc.$id}&vid={$visaprocs.$week.gv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d9_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr>
    <td height="15" colspan="2">&nbsp;</td>
  </tr>
  <tr class="greybg">
    <td colspan="2" align="center" class="highyellow">Legal Service</td>
  </tr> 
  <tr align="left">
    <td width="16%" class="totalrowodd">Legal consulted</td>
    <td width="19%" class="roweven"></td>
  </tr> 
  <tr align="left">
    <td width="16%" class="totalrowodd">Legal consulted fees</td>
    <td width="19%" class="roweven"></td>
  </tr>     
  <tr align="left">
    <td width="16%" class="totalrowodd">Legal agreement signed</td>
    <td width="19%" class="roweven"></td>
  </tr>   
  <tr align="left">
    <td width="16%" class="totalrowodd">Completed legal</td>
    <td width="19%" class="roweven"></td>
  </tr>   
  <tr>
    <td height="15" colspan="2">&nbsp;</td>
  </tr>
  <tr class="greybg">
    <td colspan="2" align="center" class="highyellow">Home Loan</td>
  </tr>   
  <tr align="left">
    <td width="16%" class="totalrowodd">Referred clients</td>
    <td width="19%" class="roweven">
      <span onClick="openinSatff('d12_{$week}');" style="text-decoration:underline; cursor:pointer;">{$homeloan[$week].pcnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d12_{$week}">
        <ul>
          {foreach key=id item=name from=$homeloan[$week].pname}
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid={$homeloan[$week].client.$id}&hid={$homeloan[$week].loan.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d12_{$week}').css('display', 'none')">&times;</span> </div>
    </td>
  </tr> 
  <tr align="left">
    <td width="16%" class="totalrowodd">Referred commission fees</td>
    <td width="19%" class="roweven">
     <span onClick="openinSatff('d13_{$week}');" style="text-decoration:underline; cursor:pointer;">{$homeloan_fee[$week].fee}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d13_{$week}">
        <ul>
          {foreach key=id item=name from=$homeloan_fee[$week].pname}
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid={$homeloan_fee[$week].client.$id}&hid={$homeloan_fee[$week].loan.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d13_{$week}').css('display', 'none')">&times;</span> </div>
    </td>
  </tr>   
  <tr>
    <td  class="highlighttext" colspan="2"><hr/><br/></td>
  </tr>  
  {/foreach}
</table>
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}	
</body>
</html>
