<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="couponid" value="{$couponid}">
<input type="hidden" name="isNew" value="{$isNew}">
<table border="0" width="100%" cellpadding="3" cellspacing="1">
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" value="">
			<td align="left" width="10%">
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
			</td>		
			<td align="center" class="whitetext">Detail Information</td>
			 <td align="right"  width="10%">
				<input type="submit" value="Send" style="font-weight:bold" onClick="this.form.bt_name.value='send';this.disable=false;" >
			</td>
		</tr>	
	</table></td></tr>	
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>Coupon Configure:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven">
            <select name="t_conf">
			<option value=0>Choose a coupon configure</option>
            {foreach key=confid item=arr from=$coupon_confs}
				<option value={$confid} {if $confid == $dt_arr.confid}selected{/if}>{$arr.title} --- ${$arr.amount}</option>
            {/foreach}
            </select>    
    	</td>
	</tr>
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>Start Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven"><input type="text" name="t_sdate" id="t_sdate" value="{$dt_arr.sdate}" size="30" autocomplete="off">

        </td>
	</tr>
	<tr>
		<td width="20%" align="left" class="rowodd"><strong>End Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="80%" class="roweven"><input type="text" name="t_edate" id="t_edate" value="{$dt_arr.edate}" size="30" autocomplete="off"></td>
	</tr>					
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>									
</table>
</form>	

{literal}
<script type="text/javascript">
	$('#t_sdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_edate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
{/literal}	
</body>
</html>