<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Institute</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>

<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/audit.js"></script>

<body>
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
  <form action=""  target="_self" method="POST" name="form1">
    <input type="hidden" name="qflag" value="">
    <input type="hidden" name="status" value="">
    <tr  class="bordered_2" >

      <td colspan="11">
        {if $form eq 'top'}
          <strong>Top-Agent</strong>
        {elseif $form eq 'sub'}
          <strong>Sub-Agent</strong>
        {/if}
          <input type="hidden" name="t_form" value="{$form}" />
        {if $ugs.a_top.v eq 1 && $form eq 'top'}
        <input type="button" value="Add Top-agent" onClick="javascript:this.form.status.value='top';this.form.action='agent_add.php';this.form.submit();" style="font-weight:bold;">
        &nbsp;&nbsp;
        {/if}
        {if $ugs.a_sub.v eq 1  && $form eq 'sub'}
        <input type="button" value="Add Partner" onClick="javascript:this.form.status.value='sub';this.form.action='agent_add.php';this.form.submit();" style="font-weight:bold;">
        &nbsp;&nbsp;
        {/if}
        {if $ugs.a_delpartner.v eq 1}
        <input type="button" value="Remove" onClick="remove_confirm(this.form);" style="font-weight:bold;">
        {/if}	
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
      </td>
    </tr>
    <tr class="bordered_2">
      <td colspan="11" style="padding-top:10px"><strong>[First semester start date] From: &nbsp;</strong>
        <input type="text"	 id="t_fdate" name="t_fdate" value="{$from}"onChange="audit_date(this)">           
        &nbsp;&nbsp; <strong>To: &nbsp;</strong>
        <input type="text"	id="t_tdate"  name="t_tdate" value="{$to}" onChange="audit_date(this)">             
        &nbsp;&nbsp;
        <input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
        &nbsp;&nbsp;&nbsp;&nbsp;
       </td>
    </tr>
    {if $ugs.a_emailpartner.v eq 1}
    <tr class="bordered_2">
      <td colspan="11" style="padding-top:10px">
          <input type="submit" value="Export Emails" name="bt_export" styple="font-weight:bold;">
          <strong>By:</strong>  
          <select name="t_cate">
            {foreach key=cateid item=v from=$totals}
              <option value="{$cateid}">{$v.n}</option>
            {/foreach}
          </select>
      </td>
    </tr>
    {/if}
    <p/>
    <tr align="left" class="greybg">
      <td colspan="11" class="highyellow">Student: {$totals.total}&nbsp;&nbsp;&nbsp;&nbsp;Offer: {$totals.offer}&nbsp;&nbsp;&nbsp;&nbsp;Coe: {$totals.coe}</td>
    </tr>      
    <tr class="totalrowodd">
      <td width="2%"  align="center" class="border_1"><input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>
      <td align="left" class="border_1" width="15%" nowrap="nowrap">Name</td>
      <td align="left" class="border_1" width="7%" nowrap="nowrap">City</td>
      <td align="left" class="border_1" width="10%" nowrap="nowrap">Country</td>
      <td align="left" class="border_1" width="10%" nowrap="nowrap">Status</td>
      <td align="left" class="border_1" width="5%" nowrap="nowrap">Studnets</td>
      <td align="right" class="border_1" width="5%" nowrap="nowrap">Offer Get</td>
      <td align="right"class="border_1" width="5%" nowrap="nowrap">COE</td>
      <td align="right" class="border_1" width="7%" nowrap="nowrap">{if $ugs.a_rev.v eq 1}Receivable<br>
        Commossion{/if}</td>
      <td align="right" class="border_1" width="7%" nowrap="nowrap">{if $ugs.a_rev.v eq 1}Paid<br>
        Commossion{/if}</td>
    </tr>
    {foreach key=catid item=v from=$totals}
    <tr class="border_1" style="background-color:{cycle values="#80FF80,#FFFF99,#CA95FF,#6C6CFF,#C78D8D,#7ABCBC"}" colspan="2">
      <td align="center" class="border_1" colspan="5" style="font-size:14px; font-weight:bolder; font-style:italic">{$v.n}</td>
      <td align="left" class="border_1"nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic">{$v.s}</td>
      <td align="right" class="border_1" nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic">{$v.o}</td>
      <td align="right"class="border_1"nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic">{$v.c}</td>
      <td align="right" class="border_1"  nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic">{if $ugs.a_rev.v eq 1}{$v.rc}{/if}</td>
      <td align="right" class="border_1" nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic">{if $ugs.a_rev.v eq 1}{$v.pc}{/if}</td>
    </tr>    
    {foreach item=id from=$v.aid}
    <tr id="tr_{$id}" onMouseOut="roff({$id});" onMouseOver="ron({$id});">
      <td onClick="rowToggle({$id});" align="center" class="border_1"><input type="checkbox" id="box_{$id}" onClick="toggleRow(this);" name="agentId[]" value="{$id}">
      </td>
      <!--<td align="center" class="border_1" nowrap="nowrap">{if $agent_arr[$id].verify eq 1}<span style="font-size:18px;font-weight: bolder; color: #FF0000">&radic;</span>{else}&nbsp;&nbsp;{/if}</td>-->
      <td align="left" class="border_1" nowrap="nowrap"><a href="agent_add.php?aid={$id}" target="_self">{$agent_arr[$id].name}</a></td>
      <td align="left"class="border_1" nowrap="nowrap">{$agent_arr[$id].city|truncate:15}</td>
      <td align="left"class="border_1" nowrap="nowrap">{$agent_arr[$id].cn}</td>
      <td align="left"class="border_1" nowrap="nowrap">{$agent_arr[$id].sn}</td>
      <td align="left"class="border_1" nowrap="nowrap">{if $stats[$id].stdcnt gt 0} {$stats[$id].stdcnt} {else}0{/if}</td>
      <td align="right"class="border_1" nowrap="nowrap">{if $stats[$id].offer gt 0} {$stats[$id].offer} {else}0{/if}</td>
      <td align="right"class="border_1" nowrap="nowrap">{if $stats[$id].coe gt 0} {$stats[$id].coe} {else}0{/if}</td>
      <td align="right"class="border_1" nowrap="nowrap">{if $ugs.a_rev.v eq 1}{if $stats[$id].coe gt 0} {$stats[$id].rcomm|string_format:"%.2f"} {else}0.00{/if}{/if}</td>
      <td align="right"class="border_1" nowrap="nowrap">{if $ugs.a_rev.v eq 1}{if $stats[$id].coe gt 0} {$stats[$id].pcomm|string_format:"%.2f"} {else}0.00{/if}{/if}</td>
    </tr>
    {/foreach}
    {/foreach}
    <!--
   <tr >
   	<td align="right" colspan="6">{$page_url}</td>
   </tr>
   -->
  </form>
</table>

{literal}
<script type="text/javascript">
	function remove_confirm(form) {	
		if(confirm("Please confirm you want to remove")){form.qflag.value='remove';form.submit();}	
	}
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}	
</body>
</html>
