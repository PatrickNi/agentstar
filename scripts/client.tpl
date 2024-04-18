<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/calendar.js"></script>
<body>
<form name="form1" target="_self" method="post">
  <table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
    <tr >
      <td colspan="9" align="center"  class="bordered_2"><table width="100%" cellpadding="1" cellspacing="1">
          <tr>
            <td colspan="4"  align="left" ><input type="button" value="Add New Client" style="font-weight:bold;" onClick="javascrtipt:this.form.action='client_detail.php';this.form.submit();">
              &nbsp;
              <!--<input type="submit" value="Delete" name="qSubmit" style="font-weight:bold;">	-->
              {if $ugs.export.v eq 1}
              <input type="submit" value="Export Client Emails" name="bt_export" style="font-weight:bold;">
              {/if} </td>
            <td width="69%" colspan="4" align="right"><strong>From: &nbsp;</strong>
              <input type="text"	 name="t_fdate" value="{$from}" onDblClick="calendar()" onChange="audit_date(this)">
              &nbsp;&nbsp; <strong>To: &nbsp;</strong>
              <input type="text"	 name="t_tdate" value="{$to}" onDblClick="calendar()" onChange="audit_date(this)">
              &nbsp;&nbsp;
              <select name="srchType">
                <option value="l" {if $srchtype eq 'l'} selected {/if}>Last Name</option>
                <option value="f" {if $srchtype eq 'f'} selected {/if}>First Name</option>
                <option value="e" {if $srchtype eq 'e'} selected {/if}>English Name</option>
                <option value="t" {if $srchtype eq 't'} selected {/if}> Client Type</option>
                <option value="m" {if $srchtype eq 'm'} selected {/if}> Email</option>
              </select>
              &nbsp;&nbsp;
              <input type="text" name="srchTxt" size="20" value="{$srchtxt}">
              &nbsp;&nbsp;
              <input type="submit" value="QUERY" name="bt_name" style="font-weight:bold;" ></td>
          </tr>
        </table></td>
    </tr>
    {if $ugs.b_abouts.v eq 1}
    <tr><td align="left" colspan="9" class="greybg">&nbsp;</td></tr>
    <tr>
      <td align="left" colspan="9" class="greybg">
     	  {counter start=1 assign='no'}
      	  {foreach key=id item=num from=$abouts}
             {counter assign='no'}
             {if $no%7 eq 0}<p/>{/if}
              <span style="color:#000; font-weight:400">{$id}:({$num/$totalabouts*100|string_format:"%.2f"}%) &nbsp;&nbsp;</span>
          {/foreach} 
 
         </td>
    </tr>
    {/if}
    <tr><td align="left" colspan="9" class="greybg">&nbsp;</td></tr>
    <tr>
      <td align="left" colspan="9" class="rowodd"><span class="highyellow">{$page_url}</span></td>
    </tr>
    <tr align="center" class="totalrowodd">
      <td width="10%">Input Date</td>
      <td width="15%">Last Name</td>
      <td width="15%">First Name</td>
      <td width="10%">English Name</td>
      <td width="10%">Gender</td>
      <td width="10%">DoB</td>
      <td>Client Type</td>
    </tr>
    {foreach key=cid item=arr from=$client_arr}
    <tr class="{cycle values='roweven,roweven'}">
      <td align="center" class="border_1" nowrap="nowrap">{$arr.sign}</td>
      <td align="center" class="border_1"><a href="{$redir_url|cat:$cid}" target="_self">{$arr.lname}</a></td>
      <td align="center" class="border_1">{$arr.fname}</td>
      <td align="center" class="border_1">{$arr.ename}</td>
      <td align="center" class="border_1">{$arr.gender}</td>
      <td align="center" class="border_1">{$arr.dob}</td>
      <td align="center" class="border_1">{$arr.type}</td>
    </tr>
    {/foreach}
  </table>
</form>
</body>
</html>
