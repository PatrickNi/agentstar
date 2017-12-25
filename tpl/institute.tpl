<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Institute Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/RolloverTable.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<script language="javascript">{$msg}</script>
<body>
<form action=""  target="_self" method="POST" name="form1">
  <table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
    <tr >
      <td colspan="8" align="center"  class="bordered_2"><table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="6"  align="left" >
            	<input type="button" value="Add New Institute" style="font-weight:bold;" onClick="javascrtipt:this.form.action='institute_detail.php';this.form.submit();">
                {if $ugs.i_export.v eq 1}
                 &nbsp;&nbsp;
                <input type="submit" name="qSubmit" value="Export all staff email" style="font-weight:bold;">
                {/if}
              	&nbsp;&nbsp;&nbsp;                    
                <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
            </td>
            <td colspan="3" align="right"><strong>[First semester start date]</strong>&nbsp;&nbsp; <strong>From: &nbsp;</strong>
              <input type="text"	 name="t_fdate" id="t_fdate" value="{$from}">
              
              &nbsp;&nbsp; <strong>To: &nbsp;</strong>
              <input type="text"	 name="t_tdate" value="{$to}" id="t_tdate">
               
              &nbsp;&nbsp;
              <input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
            </td>
          </tr>
        </table></td>
    </tr>
    <tr class="totalrowodd">
      <!--<td width="2%"  align="center"><input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>-->
      <td width="30%" align="left" class="border_1" nowrap="nowrap">Institute</td>
      <td width="10%" align="right" class="border_1">Agent Status</td>
      <td width="10%" align="right" class="border_1">Students<br/>
        ({$totals.total})</td>
      <td width="10%" align="right" class="border_1">Get Offers<br/>
        ({$totals.offer})</td>
      <td  width="10%" align="right" class="border_1">Get COEs<br/>
        ({$totals.coe})</td>
      <td  width="10%" align="right" class="border_1">{if $ugs.i_rev.v eq 1}Receivable comm{/if}<br>
        {if $ugs.i_rev.v eq 1}({$totals.potrev}){/if}</td>
      <td  width="10%" align="right" class="border_1">{if $ugs.i_rev.v eq 1}Received Comm{/if}<br>
        {if $ugs.i_rev.v eq 1}({$totals.redrev}){/if}</td>
    </tr>
    {foreach key=catid item=v from=$category_arr}
    <tr class="border_1" style="background-color:{cycle values="#80FF80,#FFFF99,#CA95FF,#6C6CFF,#C78D8D,#7ABCBC"}" colspan="2">
      <td align="left" colspan="2"><span style="font-size:14px; font-weight:bolder; font-style:italic">{$v.name}</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic">{$v.student}</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic">{$v.offer}</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic">{$v.coe}</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic">{if $ugs.i_rev.v eq 1}{$v.potrev}{/if}</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic">{if $ugs.i_rev.v eq 1}{$v.redrev}{/if}</span></td>
    </tr>
    {foreach key=id item=arr from=$school_arr[$catid]}
    <tr id="tr_{$id}" onMouseOut="roff({$id});" onMouseOver="ron({$id});">
      <!--<td onClick="rowToggle({$id});" align="center" class="border_1"> <input type="checkbox" id="box_{$id}" onClick="toggleRow(this);" name="school[]" value="{$id}"> </td> -->
      <td align="left" class="border_1" nowrap="nowrap"><a href="{$redir_url}{$id}" target="_self" style="color:#000000">{$arr.name}</a></td>
      <td align="right"class="border_1">{$arr.status}</td>
      <td align="right"class="border_1">{if $stats[$id].num neq ''} {$stats[$id].num} {else}0{/if}</td>
      <td align="right"class="border_1">{if $stats[$id].s2 neq ''} {$stats[$id].s2} {else}0{/if}</td>
      <td align="right"class="border_1">{if $stats[$id].s3 neq ''} {$stats[$id].s3} {else}0{/if}</td>
      <td align="right"class="border_1">{if $ugs.i_rev.v eq 1}{if $stats[$id].a1 neq ''} {$stats[$id].a1} {else}0.00{/if}{/if}</td>
      <td align="right"class="border_1">{if $ugs.i_rev.v eq 1}{if $stats[$id].a2 neq ''} {$stats[$id].a2} {else}0.00{/if}{/if}</td>
    </tr>
    {/foreach}
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
    {/foreach}
  </table>
</form>
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}	
</body>
</html>
