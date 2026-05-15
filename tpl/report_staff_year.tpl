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
    <table align="center" width="100%" class="graybordertable" cellpadding="1" cellspacing="1" border="0">
      <tr class="bordered_2">
        <td align="left">
          <strong>Staff:</strong>&nbsp;&nbsp;
          <select name="t_staff" id='t_staff' onChange="show_startdate();this.form.bt_name.focus();">
            {foreach key=user_id item=user_name from=$slUsers}
            <option value="{$user_id}" {if $staffid eq $user_id} selected {/if}>{$user_name}</option>
            {/foreach}
            {if $ugs.rpt_staff.v eq 1}
            <option value="all" {if $staffid eq 'all' } selected {/if}>All Staff</option>
            {/if}
          </select>

          <input type="submit" name="bt_name" value="create report" style="font-weight:bold ">
          <strong id="user_startdate" style="color:red"></strong>
        </td>
      </tr>
    </table>
  </form>
  <table width="100%" cellpadding="3" cellspacing="1" border="0" align="left">
    <tr class="greybg" align="center">
      <td class="highyellow">Apply School</td>
      {foreach item=report from=$reports}
      <td class="highyellow">{$report.year}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Weeks</td>
      {foreach item=report from=$reports}
      <td>{$report.weeks}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Course Clients</td>
      {foreach item=report from=$reports}
      <td>{$report.courses}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Course Clients Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.courses gt 0}style="color:blue;" {/if}>{($report.courses/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Apply Offer</td>
      {foreach item=report from=$reports}
      <td>{$report.courseprocs_apo}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Apply Offer Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.courseprocs_apo gt 0}style="color:blue;" {/if}>
        {($report.courseprocs_apo/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Received Offer</td>
      {foreach item=report from=$reports}
      <td>{$report.courseprocs_reo}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Received Offer Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.courseprocs_reo gt 0}style="color:blue;" {/if}>
        {($report.courseprocs_reo/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Received COE</td>
      {foreach item=report from=$reports}
      <td>{$report.courseprocs_rec}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Received COE Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.courseprocs_rec gt 0}style="color:blue;" {/if}>
        {($report.courseprocs_rec/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Potential Comm</td>
      {foreach item=report from=$reports}
      <td>{$report.coursepots}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Potential Comm Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.coursepots gt 0}style="color:blue;" {/if}>
        {($report.coursepots/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Received Comm</td>
      {foreach item=report from=$reports}
      <td>{$report.coursesems}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Received Comm Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.coursesems gt 0}style="color:blue;" {/if}>
        {($report.coursesems/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr class="greybg" align="center">
      <td class="highyellow">Visa Service</td>
      {foreach item=report from=$reports}
      <td class="highyellow">{$report.year}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Weeks</td>
      {foreach item=report from=$reports}
      <td>{$report.weeks}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Visa Consultant</td>
      {foreach item=report from=$reports}
      <td>{$report.visavisits_vc}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Visa Consultant Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.visavisits_vc gt 0}style="color:blue;" {/if}>
        {($report.visavisits_vc/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Consultant Fee</td>
      {foreach item=report from=$reports}
      <td>{$report.visavisits_cf}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Consultant Fee Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.visavisits_cf gt 0}style="color:blue;" {/if}>
        {($report.visavisits_cf/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Agreement Signed</td>
      {foreach item=report from=$reports}
      <td>{$report.visaagrees}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Agreement Signed Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.visaagrees gt 0}style="color:blue;" {/if}>
        {($report.visaagrees/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Agreement staff visa grant</td>
      {foreach item=report from=$reports}
      <td>{$report.visagrants}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Agreement staff visa grant Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.visagrants gt 0}style="color:blue;" {/if}>
        {($report.visagrants/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Net Profit</td>
      {foreach item=report from=$reports}
      <td>{$report.net_profit}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Net Profit Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.net_profit gt 0}style="color:blue;" {/if}>
        {($report.net_profit/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Apply Visa</td>
      {foreach item=report from=$reports}
      <td>{$report.apply_visa}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Apply Visa Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.apply_visa gt 0}style="color:blue;" {/if}>
        {($report.apply_visa/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Finalized Cases (Free)</td>
      {foreach item=report from=$reports}
      <td>{$report.finalized_free}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Finalized Cases (Free) Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.finalized_free gt 0}style="color:blue;" {/if}>
        {($report.finalized_free/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Finalized Cases (Paid)</td>
      {foreach item=report from=$reports}
      <td>{$report.finalized_paid}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Finalized Cases (Paid) Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.finalized_paid gt 0}style="color:blue;" {/if}>
        {($report.finalized_paid/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Reviewer</td>
      {foreach item=report from=$reports}
      <td>{$report.reviewer}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Reviewer Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.reviewer gt 0}style="color:blue;" {/if}>
        {($report.reviewer/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr class="greybg" align="center">
      <td class="highyellow">Coach Service</td>
      {foreach item=report from=$reports}
      <td class="highyellow">{$report.year}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Weeks</td>
      {foreach item=report from=$reports}
      <td>{$report.weeks}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Hours Delivered</td>
      {foreach item=report from=$reports}
      <td>{$report.coach_hour}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Hours Delivered Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.coach_hour gt 0}style="color:blue;" {/if}>
        {($report.coach_hour/$report.weeks)|string_format:"%.2f"}
      </td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Students</td>
      {foreach item=report from=$reports}
      <td>{$report.coach_student}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Students Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.coach_student gt 0}style="color:blue;" {/if}>
        {($report.coach_student/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Lessons</td>
      {foreach item=report from=$reports}
      <td>{$report.coach_lessons}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Lessons Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.coach_lessons gt 0}style="color:blue;" {/if}>
        {($report.coach_lessons/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Received Coaching Fee</td>
      {foreach item=report from=$reports}
      <td>{$report.coach_paid}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Received Coaching Fee Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.coach_paid gt 0}style="color:blue;" {/if}>
        {($report.coach_paid/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
    <tr align="right" class="roweven">
      <td>Profit </td>
      {foreach item=report from=$reports}
      <td>{$report.coach_sale}</td>
      {/foreach}
    </tr>
    <tr align="right" class="rowodd">
      <td>Profit Weekly</td>
      {foreach item=report from=$reports}
      <td {if $report.coach_sale gt 0}style="color:blue;" {/if}>
        {($report.coach_sale/$report.weeks)|string_format:"%.2f"}</td>
      {/foreach}
    </tr>
  </table>
  <script type="text/javascript">
    { $leave_staffs };
  </script>
  {literal}
  <script type="text/javascript">

    function show_startdate() {
      staff_id = $('#t_staff').val();
      if (leave_staffs[staff_id] !== undefined) {
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