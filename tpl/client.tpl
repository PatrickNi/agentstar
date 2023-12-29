<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

{include file="style.tpl"}

<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/audit.js"></script>

<body>
<form name="form1" target="_self" method="get">
  <table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
    <tr >
      <td colspan="9" align="center"  class="bordered_2"><table width="100%" cellpadding="1" cellspacing="1">
          <tr>
            <td colspan="4"  align="left" ><input type="button" value="Add New Client" style="font-weight:bold;" onClick="javascrtipt:this.form.action='client_detail.php';this.form.submit();">
              &nbsp;
              <!--<input type="submit" value="Delete" name="qSubmit" style="font-weight:bold;">	-->
              {if $ugs.export.v eq 1}
              <input type="button" value="Export Client Emails" name="bt_export" style="font-weight:bold;" onClick="javascrtipt:this.form.submit();">
              {/if} </td>
            <td width="69%" colspan="4" align="right">
              {if $ugs.b_fromto.v eq 1}
              <strong>From: &nbsp;</strong>
              <input type="text"	 name="t_fdate" id="t_fdate" value="{$from}" onChange="audit_date(this)">

              &nbsp;&nbsp; <strong>To: &nbsp;</strong>
              <input type="text"	 name="t_tdate" id="t_tdate"value="{$to}" onChange="audit_date(this)">
  
               {/if}              
              &nbsp;&nbsp;
              <select name="srchType">
                <option value="e" {if $srchtype eq 'e'} selected {/if}>Full Name</option>
                <option value="l" {if $srchtype eq 'l'} selected {/if}>Last Name</option>
                <option value="f" {if $srchtype eq 'f'} selected {/if}>First Name</option>
                <option value="en" {if $srchtype eq 'en'} selected {/if}>English Name</option>
                <option value="t" {if $srchtype eq 't'} selected {/if}>Client Type</option>
                <option value="m" {if $srchtype eq 'm'} selected {/if}>Email</option>
                <option value="mobile" {if $srchtype eq 'mobile'} selected {/if}>Mobile</option>
                <option value="c" {if $srchtype eq 'c'} selected {/if}>Client Code</option>
                <option value="dob" {if $srchtype eq 'dob'} selected {/if}>Dob</option>
              </select>
              &nbsp;&nbsp;
              <input type="text" name="srchTxt" size="20" value="{$srchtxt}">
             &nbsp;&nbsp;
              <input type='checkbox' name="is_geic" value="new" {if $is_geic eq "new"} checked {/if}>From GEIC
              
              &nbsp;&nbsp;
              <input type="submit" value="Search" name="bt_name" id="bt_name" style="font-weight:bold;"></td>
          </tr>
        </table></td>
    </tr>
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
    <tr class="{if $arr.status == 'new'}yellowbg{else}{cycle values='rowodd,roweven'}{/if}">
      <td align="center" class="border_1" nowrap="nowrap">{$arr.sign}</td>
      <td align="center" class="border_1"><a href="{$redir_url|cat:$cid}" target="_self">{if $arr.lname != ''}{$arr.lname}{else}n/a{/if}</a></td>
      <td align="center" class="border_1">{$arr.fname}</td>
      <td align="center" class="border_1">{$arr.ename}</td>
      <td align="center" class="border_1">{$arr.gender}</td>
      <td align="center" class="border_1">{$arr.dob}</td>
      <td align="center" class="border_1">
        {foreach key=id item=typ from=$arr.type}
          {$typ},&nbsp;
        {/foreach}
      </td>
    </tr>
    {/foreach}
        {if $ugs.b_abouts.v eq 1}
    <tr><td align="left" colspan="9" class="greybg">&nbsp;</td></tr>
    <tr>
      <td align="left" colspan="9" class="greybg">
     	  <!--{counter start=1 assign='no'}-->
      	  {foreach key=id item=num from=$abouts.all}
             <!--{counter assign='no'}
             {if $no%7 eq 0}<p/>{/if}-->
              <li>
                <span style="color:#000; font-weight:400">{$id}:({$num/$totalabouts*100|string_format:"%.2f"}%) &nbsp;&nbsp;</span>
                {if $id eq 'Others'}
                	<ul>
	                {counter start=1 assign='no'}
    	            {foreach key=id2 item=num2 from=$abouts.other}
               	        {counter assign='no'}
        	    	    {$id2}:({($num2/$num*100)|string_format:"%.2f"}%)&nbsp;&nbsp;
                        {if $no%7 eq 0}<br/>{/if} 
            	    {/foreach}
                    </ul>
                {/if}
              </li>
          {/foreach} 
 
         </td>
    </tr>
    {/if}
  </table>
</form>
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
  $('#bt_name').focus();
</script>
{/literal}	
</body>
</html>
