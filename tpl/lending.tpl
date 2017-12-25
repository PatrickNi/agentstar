<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Lending Institute Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<script language="javascript">{$msg}</script>
<body>
<form action=""  target="_self" method="POST" name="form1">
  <table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
    <tr  class="bordered_2">
      <td align="left" colspan="3">
        <input type="button" value="Add New Institute" style="font-weight:bold;" onClick="javascrtipt:this.form.action='lending_detail.php';this.form.submit();">
      </td>
      <td align="right" colspan="4">
         <strong>From: &nbsp;</strong><input type="text"   name="t_fdate" value="{$from}" id="t_fdate" >&nbsp;
        <strong>To: &nbsp;</strong><input type="text"   name="t_tdate" value="{$to}" id="t_tdate" >&nbsp;
        <input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
      </td>
    </tr>  
    <tr class="title" style="font-weight:bold ">
      <!--<td width="2%"  align="center"><input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>-->
      <td width="40%" align="left" class="border_1" nowrap="nowrap">Lending Institute</td>
      <td width="10%" align="right" class="border_1">Category of Lender</td>
      <td width="10%" align="right" class="border_1">Commission Rate</td>
      <td width="10%" align="right" class="border_1">Client referred<br/>{$total.referre}</td>
      <td  width="10%" align="right" class="border_1">Client settled<br/>{$total.settled}</td>
      <td  width="10%" align="right" class="border_1">Total Comm Receivable<br/>{$total.comm_ref|number_format:2:'.':','}</td>
      <td  width="10%" align="right" class="border_1">Total Comm Received<br/>{$total.omm_rec|number_format:2:'.':','}</td>
    </tr>
    {foreach key=id item=v from=$lending_arr}
    <tr class="{cycle values='rowodd,roweven'}">
      <td align="center"><a href="lending_detail.php?lid={$id}" target="_self">{$v.name}</a></td>
      <td align="center">{$v.cate}</td>
      <td align="right">{$v.cr*100}%</td>
      <td align="right">{$stats[$id].referre}</td>
      <td align="right">{$stats[$id].settled}</td>
      <td align="right">{$stats[$id].comm_ref|number_format:2:'.':','}</td>
      <td align="right">{$stats[$id].comm_rec|number_format:2:'.':','}</td>
    </tr>
    {/foreach}
  </table>
</form>
</body>
{literal}
<script type="text/javascript">
  $('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
  $('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}  
</html>
