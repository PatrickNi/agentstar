<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" media="all" href="../js/calendar/calendar.css" title="win2k-cold-1">
<script type="text/javascript" src="../js/calendar/calendar.js"></script>
<script type="text/javascript" src="../js/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="../js/calendar/calendar-setup.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" target="_self" method="post">
  <table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
    <tr class="bordered_2">
      <td align="left"><strong>Start Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_fdate" name="t_fdate" onChange="audit_date(this)" value="{$fromDay}" >
        {literal}
        <script type="text/javascript">
					Calendar.setup({
								inputField : "t_fdate",
								ifFormat   : "%Y-%m-%d",
								eventName  : "dblclick",
								step       :  1
					});
				</script>
        {/literal} 
        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Finish Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_tdate" name="t_tdate" onDblClick="calendar()" onChange="audit_date(this)" value="{$toDay}" >
                {literal}
        <script type="text/javascript">
					Calendar.setup({
								inputField : "t_tdate",
								ifFormat   : "%Y-%m-%d",
								eventName  : "dblclick",
								step       :  1
					});
				</script>
        {/literal} 
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
    <td  class="highlighttext">{$daterange}</td>
  </tr>
  <tr align="left">
    <td width="16%" class="totalrowodd"  valign="middle">Course clients</td>
    <td width="19%" class="roweven"  valign="middle"><span onClick="openinSatff('d1_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courses[$week].cnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_{$week}">
        <ul>
          {foreach key=id item=name from=$courses[$week].name}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courses[$week].apo.$id eq 0}color:#0000FF{/if}" onClick="openModel('client_course.php?cid={$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span>
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
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].reo.$id eq 0}color:#0000FF{/if}" onClick="openModel('client_course_detail.php?cid={$courseprocs.$week.apocid.$id}&courseid={$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span>
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
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].rec.$id eq 0}color:#0000FF{/if}" onClick="openModel('client_course_detail.php?cid={$courseprocs.$week.reocid.$id}&courseid={$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span>
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
  <tr align="left">
    <td class="totalrowodd">Potential Comm</td>
    <td class="roweven"><span onClick="openinSatff('d5_{$week}');" style="text-decoration:underline; cursor:pointer;">{$coursepots[$week].rcomm|string_format:"%.2f"}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d5_{$week}">
        <ul>
          {foreach key=id item=name from=$coursepots[$week].name}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_course_sem.php?cid={$coursepots.$week.client.$id}&courseid={$coursepots.$week.course.$id}&semid={$coursepots.$week.sem.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}&nbsp;&nbsp;&nbsp;DoB:{$coursepots.$week.dob.$id}</span>{/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d5_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd">Received Comm</td>
    <td class="roweven"><span onClick="openinSatff('d11_{$week}');" style="text-decoration:underline; cursor:pointer;">{$coursesems[$week].bonus|string_format:"%.2f"}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d11_{$week}">
        <ul>
          {foreach key=id item=name from=$coursesems[$week].bonusname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_course_sem.php?cid={$coursesems.$week.client.$id}&courseid={$coursesems.$week.course.$id}&semid={$coursesems.$week.sem.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}&nbsp;&nbsp;&nbsp;DoB:{$coursesems.$week.dob.$id}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d11_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr>
    <td height="15" colspan="3">&nbsp;</td>
  </tr>
  <tr align="left">
    <td width="16%" class="totalrowodd">Visa Consultant </td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d6_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visavisits[$week].pcnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d6_{$week}">
        <ul>
          {foreach key=id item=name from=$visavisits[$week].pname}
          <li><span style="text-decoration:underline; cursor:pointer; {if $visavisits.$week.sign.$id eq 0}color:#03F{/if}" onClick="openModel('client_visa_detail.php?cid={$visavisits.$week.client.$id}&vid={$visavisits.$week.visa.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d6_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd" width="16%">Agreement Signed</td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d7_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visaagrees[$week].fee|string_format:"%.2f"}&nbsp;({$visaagrees[$week].sign})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d7_{$week}">
        <ul>
          {foreach key=id item=name from=$visaagrees[$week].fname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_visa_detail.php?cid={$visaagrees.$week.client.$id}&vid={$visaagrees.$week.visa.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d7_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr>
    <td height="15" colspan="3">&nbsp;</td>
  </tr>
  <tr align="left">
    <td class="totalrowodd" width="16%">Lodged Visa </td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d8_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visaprocs[$week].lfee|string_format:"%.2f"}&nbsp;({$visaprocs[$week].lcnt})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].lname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_visa_detail.php?cid={$visaprocs.$week.lc.$id}&vid={$visaprocs.$week.lv.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr align="left">
    <td class="totalrowodd" width="16%">Granted Visa </td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d9_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visaprocs[$week].gfee|string_format:"%.2f"}&nbsp;({$visaprocs[$week].gcnt})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d9_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].gname}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="openModel('client_visa_detail.php?cid={$visaprocs.$week.gc.$id}&vid={$visaprocs.$week.gv.$id}',screen.width*4/5,screen.height*4/5,'NO', 'form1')">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d9_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr>
    <td height="15" colspan="3">&nbsp;</td>
  </tr>
  <tr align="left">
    <td class="totalrowodd" width="16%">Paid Amount</td>
    <td width="19%" class="roweven"><span onClick="openinSatff('d10_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visapaids[$week].paid}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d10_{$week}">
        <ul>
          {foreach item=name from=$visapaids[$week].name}
          <li>{$name}
            {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d10_{$week}.style.display='none'">&times;</span> </div></td>
  </tr>
  <tr>
    <td height="15" colspan="3">&nbsp;</td>
  </tr>
  {/foreach}
</table>
</body>
</html>
