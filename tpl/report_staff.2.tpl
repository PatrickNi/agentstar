<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

{include file="style.tpl"}

<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" id="form1" target="_self" method="post">
  <table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
    <tr class="bordered_2">
      <td align="left"><strong>Start Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_fdate" name="t_fdate"  value="{$fromDay}" autocomplete="off" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Finish Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_tdate" name="t_tdate"  value="{$toDay}" autocomplete="off" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Staff:</strong>&nbsp;&nbsp;
        <select name="t_staff" id='t_staff' onChange="show_startdate();this.form.bt_name.focus();">
          
                {foreach key=user_id item=user_name from=$slUsers}
                    
          <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>
          
                {/foreach}
                {if $ugs.rpt_staff.v eq 1}
                    
          <option value="all" {if $staffid eq 'all'} selected {/if}>All Staff</option>
          
                {/if}
            
        </select>
        <strong id="user_startdate" style="color:red" ></strong>
        &nbsp;&nbsp;&nbsp;&nbsp;
        {if $uid eq 3} 
            <select name="t_about">
                <option value="" selected>Choose where about us</option>
                <option value="Others" {if $query_about eq "Others"} selected {/if}>Others</option>
                {foreach item=name from=$clientfroms}
                    <option value="{$name}" {if $query_about eq $name} selected {/if}>{$name}</option>
                {/foreach}
              </select>  
        {/if}
      </td>
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
        <!--<input type="button" style="font-weight:bold" onclick="printPage();"value="Print">
        <input type="button" style="font-weight:bold" value="Print" onClick="document.all.WebBrowser.ExecWB(6,1)">
        <input type="button"style="font-weight:bold" value="Print Setting" onClick="document.all.WebBrowser.ExecWB(8,1)">
        <input type="button" style="font-weight:bold" value="Print Review" onClick="document.all.WebBrowser.ExecWB(7,1)">
        -->
        {if $from_archive}
          <strong style="color:red;">Reporting data from Archive</strong>
        {else}
          {if $uid eq 3 }
          <input type="hidden" id="bt_archive" name="bt_archive" value="">
          <button type="button" onClick="archive_confirm()" style="font-weight:bold;">Archive report</button>
          {/if}
        {/if}

        {if $uid eq 50 && $staffid eq 87}
          &nbsp;&nbsp;
          <input type="hidden" id="token" name="token" value="">
          <input type="hidden" id="bt_locked" name="bt_locked" value="">
          <button type="button" id="btn_save" style="font-weight:bolder;font-size:larger" onclick="do_save()">Locked Period</button>
        {/if}
      </td>
    </tr>
  </table>
</form>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="left">
  {foreach key=week item=daterange from=$weeks}
  <tr>
    <td  class="highlighttext" colspan="8" style="text-decoration: underline;background-color: palegreen;">{$daterange}</td>
  </tr>
  <tr class="greybg">
    <td colspan="8" class="highyellow">Apply School</td>
  </tr>
  <tr align="center" class="totalrowodd" >
    <td>Course clients</td>
    <td>Apply Offer</td>
    <td>Received Offer</td>
    <td>Received COE</td>
    <td colspan="2">Potential Comm</td>  
    <td colspan="2">Received Comm</td>
  </tr>

  <tr align="right" class="roweven" >
    <td>
        <span onClick="openinSatff('d1_all_{$week}');" style="text-decoration:underline; cursor:pointer;">
        {$courses[$week].cnt} 
        </span>
        <br/>
        <span onClick="openinSatff('d1_{$week}');" style="text-decoration:underline; cursor:pointer;">
        (New clients: {$courses[$week].cnt_new})
        </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_{$week}">
        <ul>
          {foreach key=id item=name from=$courses[$week].name_new}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courses[$week].apo.$id eq 0}color:#0000FF{elseif $courses[$week].num.$id eq $courses[$week].refuse.$id}color:#999999;{/if}" onClick="window.open('client_course.php?cid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onClick="d1_{$week}.style.display='none'">&times;</span> 
      </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_all_{$week}">
        <ul>
          {foreach key=id item=name from=$courses[$week].name}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courses[$week].apo.$id eq 0}color:#0000FF{elseif $courses[$week].num.$id eq $courses[$week].refuse.$id}color:#999999;{/if}" onClick="window.open('client_course.php?cid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onClick="d1_all_{$week}.style.display='none'">&times;</span> 
      </div>


    </td>
    <td>
          {$courseprocs[$week].apocnt}
          <br/><span onClick="openinSatff('d2_old_{$week}');"  style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].apocnt_st} old students</span> 
          <br/>&nbsp;&nbsp;(inc {$courseprocs[$week].apocnt_aid} subagents)
          <br/><span onClick="openinSatff('d2_new_{$week}');"  style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].apo_new} new clients</span> 
          <br/>&nbsp;&nbsp;(inc {$courseprocs[$week].apo_new_aid} subagents)
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d2_old_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].aponame_old}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].reo.$id eq 0}color:#0000FF{elseif $courseprocs[$week].reo_st.$id eq -1}color:#999999;{/if}" onClick="window.open('client_course_detail.php?cid={$courseprocs.$week.apocid.$id}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d2_old_{$week}.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d2_new_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].aponame_new}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].reo.$id eq 0}color:#0000FF{elseif $courseprocs[$week].reo_st.$id eq -1}color:#999999;{/if}" onClick="window.open('client_course_detail.php?cid={$courseprocs.$week.apocid.$id}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d2_new_{$week}.style.display='none'">&times;</span> </div>
    </td>  

     <td >
           {$courseprocs[$week].reocnt}
           <br/><span onClick="openinSatff('d3_old_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].reocnt_st} old students</span> 
           <br/>&nbsp;&nbsp;(inc {$courseprocs[$week].reocnt_aid} subagents)
           <br/><span onClick="openinSatff('d3_new_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].reo_new} new clients</span> 
           <br/>&nbsp;&nbsp;(inc {$courseprocs[$week].reo_new_aid} subagents)
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d3_old_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].reoname_old}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].reo_st.$id eq 0}color:#0000FF{elseif $courseprocs[$week].reo_st.$id eq -1}color:#999999;{/if}" onClick="window.open('client_course_detail.php?cid={$courseprocs.$week.reocid.$id}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d3_old_{$week}.style.display='none'">&times;</span> </div>
        <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d3_new_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].reoname_new}
          <li><span style="text-decoration:underline; cursor:pointer; {if $courseprocs[$week].reo_st.$id eq 0}color:#0000FF{elseif $courseprocs[$week].reo_st.$id eq -1}color:#999999;{/if}" onClick="window.open('client_course_detail.php?cid={$courseprocs.$week.reocid.$id}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d3_new_{$week}.style.display='none'">&times;</span> </div>
      </td>   

    <td>
        {$courseprocs[$week].reccnt}
        <br/><span onClick="openinSatff('d4_old_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].reccnt_st} old students</span> 
        <br/>&nbsp;&nbsp;(inc {$courseprocs[$week].reccnt_aid} subagents)</span>  
        <br/><span onClick="openinSatff('d4_new_{$week}');" style="text-decoration:underline; cursor:pointer;">{$courseprocs[$week].rec_new} new clients</span> 
        <br/>&nbsp;&nbsp;(inc {$courseprocs[$week].rec_new_aid} subagents) 
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d4_old_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].recname_old}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_detail.php?cid={$courseprocs.$week.reccid.$id}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d4_old_{$week}.style.display='none'">&times;</span> </div>
     <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d4_new_{$week}">
        <ul>
          {foreach key=id item=name from=$courseprocs[$week].recname_new}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_detail.php?cid={$courseprocs.$week.reccid.$id}&courseid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span>
            {/foreach}
        </ul>
        
        <span style="font-weight:bolder; cursor:pointer;" onClick="d4_new_{$week}.style.display='none'">&times;</span> </div>
    </td>  
    <td  colspan="2">
      {if $ugs.rpt_staff_pc.v eq 1}
      <span onClick="openinSatff('d5_{$week}');" style="cursor:pointer;">
        {$coursepots[$week].rcomm|string_format:"%.2f"}<br/>
        {$coursepots[$week].rcomm_st} old students 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc {$coursepots[$week].rcomm_aid} subagents)</span><br/>  
        {$coursepots[$week].rcomm_new} new clients 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc {$coursepots[$week].rcomm_new_aid} subagents)</span>
      </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d5_{$week}">
        <table width="100%">
        <tr><td>Name</td><td  align="right">Comm($)</td></tr>
          {foreach key=id item=name from=$coursepots[$week].name}
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_sem.php?cid={$coursepots.$week.client.$id}&courseid={$coursepots.$week.course.$id}&semid={$coursepots.$week.sem.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span></td><td align="right" {if $coursepots[$week].commfail[$id] eq 1}style="color:#0000CC"{/if}>{$coursepots[$week].comm[$id]}</td></tr>{/foreach}
          </table>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d5_{$week}.style.display='none'">&times;</span> 
      </div>
      {/if}
    </td>                   
     <td  colspan="2">
       {if $ugs.rpt_staff_rc.v eq 1}
       <span onClick="openinSatff('d11_{$week}');" style="cursor:pointer;">
        {$coursesems[$week].bonus|string_format:"%.2f"}<br/>
        {$coursesems[$week].bonus_st} old students 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc {$coursesems[$week].bonus_aid} subagents)</span><br/> 
        {$coursesems[$week].bonus_new} new clients 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc {$coursesems[$week].bonus_new_aid} subagents) </span>
      </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d11_{$week}">
        <table width="100%">
        <tr><td>Name</td><td align="right">Comm($)</td></tr>
          {foreach key=id item=name from=$coursesems[$week].bonusname}
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_sem.php?cid={$coursesems.$week.client.$id}&courseid={$coursesems.$week.course.$id}&semid={$coursesems.$week.sem.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span></td><td align="right" {if $coursesems[$week].bonusfail[$id] eq 1}style="color:#0000CC"{/if}>{$coursesems[$week].bonuscomm[$id]}</td></tr>{/foreach}
        </table>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d11_{$week}.style.display='none'">&times;</span>  
        </div>
        {/if}
      </td>    
  </tr>

  <tr class="greybg">
    <td colspan="8" class="highyellow">Visa Service</td>
  </tr> 
  <tr align="center" class="totalrowodd">
    <td>Visa Consultant </td>
    <td>Consultant Fee</td>
    <td>Agreement Signed</td>
    <td>Agreement staff visa grant</td>
    <td>(Net received/Net deduction)<br/>Net profit</td>
    <td>Apply Visa </td>
    <td>Finalized Cases (Free) </td>
    <td>Finalized Cases (Paid) </td>
  </tr>

  <tr align="right" class="roweven" >
    <td><span onClick="openinSatff('d6_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visavisits[$week].pcnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d6_{$week}">
        <ul>
          {foreach key=id item=name from=$visavisits[$week].pname}
          <li><span style="text-decoration:underline; cursor:pointer; {if $visavisits.$week.decline.$id > 0}color:#999999;{elseif $visavisits.$week.sign.$id eq 0}color:#0000FF;{/if}" onClick="window.open('client_visa_detail.php?cid={$visavisits.$week.client.$id}&vid={$visavisits.$week.visa.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name}</span> {/foreach}
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d6_{$week}.style.display='none'">&times;</span> </div>
    </td>
     
    <td><span onClick="openinSatff('d66_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visavisits[$week].totalcfee}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d66_{$week}">
        <ul>
          {foreach key=id item=name from=$visavisits[$week].pname}
           {if $visavisits.$week.cfee.$id > 0}
            <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visavisits.$week.client.$id}&vid={$visavisits.$week.visa.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);">{$name} </span></li>
            {/if}
            {/foreach}
            
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d66_{$week}.style.display='none'">&times;</span> </div>
    </td> 

    <td><span onClick="openinSatff('d7_{$week}');" style="text-decoration:underline; cursor:pointer;">{$visaagrees[$week].fee|string_format:"%.2f"}&nbsp;($0:{$visaagrees[$week].sign0}/paid:{$visaagrees[$week].sign1})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d7_{$week}">
        <ul>
          {foreach key=id item=name from=$visaagrees[$week].fname}
          <li><span style="text-decoration:underline; cursor:pointer; {if $visaagrees.$week.done.$id eq 1}color:gray;{elseif $visaagrees.$week.done.$id eq 2}color:blue;{/if}" onClick="window.open('client_visa_detail.php?cid={$visaagrees.$week.client.$id}&vid={$visaagrees.$week.visa.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d7_{$week}.style.display='none'">&times;</span> </div> 
    </td>

    <td>
      {if $visagrants[$week].gc_free > 0}
        <span onClick="openinSatff('d8g_free_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visagrants[$week].gc_free})</span>&nbsp;
      {/if}
      Student:&nbsp;${$visagrants[$week].gfee_free|string_format:"%.2f"}<br/>
      {if $visagrants[$week].gc_paid > 0}
        <span onClick="openinSatff('d8g_paid_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visagrants[$week].gc_paid})</span>&nbsp;
      {/if}
      Other:&nbsp;${$visagrants[$week].gfee_paid|string_format:"%.2f"}<br/>
      <hr/>
      {if $visagrants[$week].gcnt1 > 0}
        ({$visagrants[$week].gcnt1})&nbsp;
      {/if}
      Total:&nbsp;${$visagrants[$week].gfee|string_format:"%.2f"}<br/>
      
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8g_free_{$week}">
        <ul>
          {foreach key=id item=name from=$visagrants[$week].gname_free}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visagrants.$week.gc.$id}&vid={$visagrants.$week.gv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8g_free_{$week}.style.display='none'">&times;</span> </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8g_paid_{$week}">
        <ul>
          {foreach key=id item=name from=$visagrants[$week].gname_paid}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visagrants.$week.gc.$id}&vid={$visagrants.$week.gv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8g_paid_{$week}.style.display='none'">&times;</span> </div>
    </td> 

    
    <td>
          ${$visapaids[$week].paid|string_format:"%.2f"} {if $visapaids[$week].spand > 0}&nbsp;/ -${$visapaids[$week].spand|string_format:"%.2f"}{/if}<br/>
          <hr/>
          Total: <span onClick="openinSatff('d71_{$week}');" style="text-decoration:underline; cursor:pointer;">${$visapaids[$week].paid-$visapaids[$week].spand|string_format:"%.2f"}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d71_{$week}">
        <ul>
          {foreach key=id item=name from=$visapaids[$week].show}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visapaids.$week.client.$id}&vid={$visapaids.$week.vid.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d71_{$week}.style.display='none'">&times;</span> </div></td>
      </td>

    <td>
      {if $visaprocs[$week].lc_free > 0}
        <span onClick="openinSatff('d8_free_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].lc_free})</span>&nbsp;
      {/if}
      Student:&nbsp;${$visaprocs[$week].lfee_free|string_format:"%.2f"}<br/>
      {if $visaprocs[$week].lc_paid > 0}
        <span onClick="openinSatff('d8_paid_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].lc_paid})</span>&nbsp;
      {/if}
      Other:&nbsp;${$visaprocs[$week].lfee_paid|string_format:"%.2f"}<br/>
      <hr/>
      <!--
      <span onClick="openinSatff('d8_{$week}');" style="text-decoration:underline; cursor:pointer;">[{$visaprocs[$week].lcnt0}/{$visaprocs[$week].lcnt1}]
      </span>&nbsp;&nbsp;
      -->
      {if $visaprocs[$week].lcnt1 > 0}
        ({$visaprocs[$week].lcnt1})&nbsp;
      {/if}
      Total:&nbsp;${$visaprocs[$week].lfee|string_format:"%.2f"}<br/>
      
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_free_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].lname_free}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.lc.$id}&vid={$visaprocs.$week.lv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_free_{$week}.style.display='none'">&times;</span> </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_paid_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].lname_paid}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.lc.$id}&vid={$visaprocs.$week.lv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_paid_{$week}.style.display='none'">&times;</span> </div>
    </td>  
  
 
    <!--Fee Section-->
    <td>
      {if $visaprocs[$week].gc_free > 0}
        <span onClick="openinSatff('gc_free_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].gc_free})</span>&nbsp;
      {/if}
        granted, &nbsp;${$visaprocs[$week].gfee_free|string_format:"%.2f"} <br/>

      {if $visaprocs[$week].wc_free > 0}
        <span onClick="openinSatff('wc_free_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].wc_free})</span>&nbsp;
      {/if}
        withdraw, &nbsp;${$visaprocs[$week].wfee_free|string_format:"%.2f"} <br/>   

       {if $visaprocs[$week].rc_free > 0}
        <span onClick="openinSatff('rc_free_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].rc_free})</span>&nbsp;
      {/if}
        refused, &nbsp;${$visaprocs[$week].rfee_free|string_format:"%.2f"} <br/>      

       {if $visaprocs[$week].cc_free > 0}
        <span onClick="openinSatff('cc_free_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].cc_free})</span>&nbsp;
      {/if}
        client cancel agreement, &nbsp;${$visaprocs[$week].cfee_free|string_format:"%.2f"} <br/>           

       {if $visaprocs[$week].sc_free > 0}
        <span onClick="openinSatff('sc_free_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].sc_free})</span>&nbsp;
      {/if}
        stop agent, &nbsp;${$visaprocs[$week].sfee_free|string_format:"%.2f"} <br/>                      
      
      <hr/>
      {if ($visaprocs[$week].gc_free+$visaprocs[$week].wc_free+$visaprocs[$week].rc_free+$visaprocs[$week].cc_free+$visaprocs[$week].sc_free) > 0}
      ({$visaprocs[$week].gc_free+$visaprocs[$week].wc_free+$visaprocs[$week].rc_free+$visaprocs[$week].cc_free+$visaprocs[$week].sc_free})&nbsp;
      {/if}
      Total: &nbsp;${$visaprocs[$week].gfee_free+$visaprocs[$week].wfee_free+$visaprocs[$week].rfee_free+$visaprocs[$week].cfee_free+$visaprocs[$week].sfee_free|string_format:"%.2f"}   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="gc_free_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].gname_free}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.gc.$id}&vid={$visaprocs.$week.gv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="gc_free_{$week}.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="wc_free_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].wname_free}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.wc.$id}&vid={$visaprocs.$week.wv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="wc_free_{$week}.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="rc_free_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].rname_free}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.rc.$id}&vid={$visaprocs.$week.rv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="rc_free_{$week}.style.display='none'">&times;</span> </div>  
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="cc_free_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].cname_free}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.cc.$id}&vid={$visaprocs.$week.cv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="cc_free_{$week}.style.display='none'">&times;</span> </div>   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="sc_free_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].sname_free}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.sc.$id}&vid={$visaprocs.$week.sv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="sc_free_{$week}.style.display='none'">&times;</span> </div>                   
    </td>


    <!--Paid Section-->
    <td>
      {if $visaprocs[$week].gc_paid > 0}
        <span onClick="openinSatff('gc_paid_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].gc_paid})</span>&nbsp;
      {/if}
        granted, &nbsp;${$visaprocs[$week].gfee_paid|string_format:"%.2f"} <br/>

      {if $visaprocs[$week].wc_paid > 0}
        <span onClick="openinSatff('wc_paid_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].wc_paid})</span>&nbsp;
      {/if}
        withdraw, &nbsp;${$visaprocs[$week].wfee_paid|string_format:"%.2f"} <br/>   

       {if $visaprocs[$week].rc_paid > 0}
        <span onClick="openinSatff('rc_paid_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].rc_paid})</span>&nbsp;
      {/if}
        refused, &nbsp;${$visaprocs[$week].rfee_paid|string_format:"%.2f"} <br/>      

       {if $visaprocs[$week].cc_paid > 0}
        <span onClick="openinSatff('cc_paid_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].cc_paid})</span>&nbsp;
      {/if}
        client cancel agreement, &nbsp;${$visaprocs[$week].cfee_paid|string_format:"%.2f"} <br/>           

       {if $visaprocs[$week].sc_paid > 0}
        <span onClick="openinSatff('dc_paid_{$week}');" style="text-decoration:underline; cursor:pointer;">({$visaprocs[$week].sc_paid})</span>&nbsp;
      {/if}
        stop agent, &nbsp;${$visaprocs[$week].sfee_paid|string_format:"%.2f"} <br/>                      
      
      <hr/>
      {if ($visaprocs[$week].gc_paid+$visaprocs[$week].wc_paid+$visaprocs[$week].rc_paid+$visaprocs[$week].cc_paid+$visaprocs[$week].sc_paid) > 0}
      ({$visaprocs[$week].gc_paid+$visaprocs[$week].wc_paid+$visaprocs[$week].rc_paid+$visaprocs[$week].cc_paid+$visaprocs[$week].sc_paid})&nbsp;
      {/if}
      Total: &nbsp;${$visaprocs[$week].gfee_paid+$visaprocs[$week].wfee_paid+$visaprocs[$week].rfee_paid+$visaprocs[$week].cfee_paid+$visaprocs[$week].sfee_paid|string_format:"%.2f"} 

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="gc_paid_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].gname_paid}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.gc.$id}&vid={$visaprocs.$week.gv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="gc_paid_{$week}.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="wc_paid_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].wname_paid}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.wc.$id}&vid={$visaprocs.$week.wv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="wc_paid_{$week}.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="rc_paid_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].rname_paid}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.rc.$id}&vid={$visaprocs.$week.rv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="rc_paid_{$week}.style.display='none'">&times;</span> </div>  
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="cc_paid_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].cname_paid}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.cc.$id}&vid={$visaprocs.$week.cv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="cc_paid_{$week}.style.display='none'">&times;</span> </div>   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="sc_paid_{$week}">
        <ul>
          {foreach key=id item=name from=$visaprocs[$week].sname_paid}
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid={$visaprocs.$week.sc.$id}&vid={$visaprocs.$week.sv.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span> {/foreach}
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="sc_paid_{$week}.style.display='none'">&times;</span> </div> 

    </td>

  </tr>
    <tr class="greybg">
    <td colspan="8"class="highyellow">Coach Services</td>
  </tr>   
  <tr align="center" class="totalrowodd">
    <td>Course Item</td>
    <td>hours delivered<br/>(Fee Remaining/Delivered)</td>
    <td>Students(active / current)</td>
    <td>Lessons (net hours)</td>
    <td>{if $user_pos == 'PC' || $user_pos == 'C' || $user_pos == 'M'}Received Coaching Fee{/if}</td>
    <td>{if $user_pos == 'PC' || $user_pos == 'C' || $user_pos == 'M'}Profit{/if}</td>
    <td colspan="2"></td>
  </tr>
  {assign var="total_paid" value="0"}
  {assign var="total_sale" value="0"}
  {assign var="total_hour" value="0"}
  {assign var="total_student" value="0"}
  {assign var="total_extrahour" value="0"}
  {assign var="total_lesson" value="0"}
  {assign var="total_lesson_hour" value="0"}
  {foreach key=titleid item=coach from=$coaches[$week]}
  <tr align="right" class="roweven" >
    <td align="center">{$coach.title}</td>
    <td>
      {assign var="total_hour" value=$total_hour+$coach.hour}
      {assign var="total_extrahour" value=$total_extrahour+$coach.extrahour}
      <span onClick="openinSatff('d15_{$week}_{$titleid}');" style="text-decoration:underline; cursor:pointer;">{$coach.hour}[h]|(${$coach.actual_pay}/${$coach.should_pay})</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d15_{$week}_{$titleid}">
        <ul>
          {foreach key=coach_id item=coach_st from=$coach.list}
          {if $coach_st.duehour > 0}
              <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('/scripts/client_coach_detail.php?cid={$coach_st.cid}&coachid={$coach_id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$coach_st.name} -- {$coach_st.duehour}(h)|(${$coach_st.actual_pay}/${$coach_st.should_pay})</span>
              {foreach item=lesson_st from=$coach_st.duedetail}
                <br>{$lesson_st}
              {/foreach}
              </li>
          {/if}
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d15_{$week}_{$titleid}').css('display', 'none')">&times;</span> </div>
    
    </td>
    <td>
     {assign var="tmp_student" value=$coach.list|@count}
     {assign var="total_student" value=$total_student+$tmp_student}
     <span onClick="openinSatff('d14_{$week}_{$titleid}');" style="text-decoration:underline; cursor:pointer;">{$coach.list|@count}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d14_{$week}_{$titleid}">
        <ul>
          {foreach key=coach_id item=coach_st from=$coach.list}
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('/scripts/client_coach_detail.php?cid={$coach_st.cid}&coachid={$coach_id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$coach_st.name}</span></li>
          {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d14_{$week}_{$titleid}').css('display', 'none')">&times;</span> </div>
    </td>
    <td>
      {assign var="tmp_lesson" value=$coach.lessons|@count}
      {assign var="total_lesson" value=$total_lesson+$tmp_lesson}
      {assign var="tmp_lesson_hour" value=$coach.lessons|@array_sum}
      {assign var="total_lesson_hour" value=$total_lesson_hour+$tmp_lesson_hour}
      {$coach.lessons|@count}({$coach.lessons|@array_sum} h)
    </td>
    <td>
      {if $user_pos == 'PC' || $user_pos == 'C' || $user_pos == 'M'}
        {$coaches_fee[$week].$titleid.paid|string_format:"%.2f"}
        {assign var="total_paid" value=$total_paid+$coaches_fee[$week].$titleid.paid}
      {/if}
    </td>
    <td>
      {if $user_pos == 'PC' || $user_pos == 'C' || $user_pos == 'M'}
        {$coaches_fee[$week].$titleid.sale|string_format:"%.2f"}
        {assign var="total_sale" value=$total_sale+$coaches_fee[$week].$titleid.sale}
      {/if}
    </td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr> 
  {/foreach}

    <tr align="right" class="roweven" >
      <td><strong>Total:</strong></td>
      <td><strong>{$total_hour}</strong><br/><hr/>Extra hour: {$total_extrahour}</td>
      <td><strong>{$total_student}</strong></td>
      <td><strong>{$total_lesson}({$total_lesson_hour} h)</strong></td>
      <td><strong>{$total_paid|string_format:"%.2f"}</strong></td>
      <td><strong>{$total_sale|string_format:"%.2f"}</strong></td>
    </tr>

  <tr class="greybg">
    <td colspan="8"class="highyellow">Legal Service</td>
  </tr> 
  <tr align="center" class="totalrowodd">
    <td>Legal consulted</td>
    <td>Legal consulted fees</td>
    <td>Legal agreement signed</td>
    <td>Completed legal</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr align="right" class="roweven" >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr> 
  
  <tr class="greybg">
    <td colspan="8"class="highyellow">Home Loan</td>
  </tr>   
  <tr align="center" class="totalrowodd">
    <td> Referred clients</td>
    <td >Referred commission fees</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>    
    <td colspan="2"></td>
  </tr>
  <tr align="right" class="roweven" >  
   <td >
      <span onClick="openinSatff('d12_{$week}');" style="text-decoration:underline; cursor:pointer;">{$homeloan[$week].pcnt}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d12_{$week}">
        <ul>
          {foreach key=id item=name from=$homeloan[$week].pname}
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid={$homeloan[$week].client.$id}&hid={$homeloan[$week].loan.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d12_{$week}').css('display', 'none')">&times;</span> </div>
    </td>
    <td>
     <span onClick="openinSatff('d13_{$week}');" style="text-decoration:underline; cursor:pointer;">{$homeloan_fee[$week].fee}</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d13_{$week}">
        <ul>
          {foreach key=id item=name from=$homeloan_fee[$week].pname}
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid={$homeloan_fee[$week].client.$id}&hid={$homeloan_fee[$week].loan.$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$name}</span>
            {/foreach}
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d13_{$week}').css('display', 'none')">&times;</span> </div>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr> 
  {/foreach}
</table>
<script type="text/javascript">
  {$leave_staffs};
</script>
{literal}
<script type="text/javascript">
    $('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, firstDay: 1 });        
    $('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, firstDay: 1 });

  function archive_confirm() { 
      if(confirm("Please confirm to archive report")){
        $("#bt_archive").val('archive report');
        $("#form1").submit();
      }
      return true;  
  }

	function do_save() {

      var token = prompt("Plese type in execute token");
      if (token == null) {
          return false;
      }    
      $("#token").val(token);
      $("#bt_locked").val("Locked Period");
      $("#form1").submit();
      return true;
  }

  function show_startdate() {
    staff_id = $('#t_staff').val();
    if (leave_staffs[staff_id] !== undefined ) {
      $('#user_startdate').text("(Started: " + leave_staffs[staff_id] + ")");
    }
    else {
       $('#user_startdate').text('');
    }
  }
</script>
{/literal}  
</body>
</html>
