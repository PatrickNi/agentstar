<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>

<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="aid" value="{$aid}">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Net Spand History</span>
		 </td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">3rd Party Amount:{$account.dueamt_3rd}</span></td>
	</tr>			
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<td width="2%">&nbsp;</td>
					<td >Paid Date</td>
					<td >Paid Amount</td>
				</tr>
				{foreach key=id item=arr from=$payments}
				<tr align="center" class="roweven">
					<td ><input type="radio" name="pid" value="{$id}" onClick="setPayment(this)"></td>
					<td id="d_{$id}">{$arr.date}</td>
					<td id="a_{$id}">{$arr.paid|string_format:"%.2f"}</td>
				</tr>
				{/foreach}
			</table>
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr><td colspan="2"><hr></td></tr>
				<tr><td colspan="2" align="center" class="totalrowodd"><input type="checkbox" name="t_new" id="t_new" value="1" onClick="newPayment(this)">&nbsp;Add new</td></tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Date</strong></td>
					<td width="50%" align="left" class="roweven"><input name="t_date" id="t_date" id="t_date" value="" size="30">                      
                    </td>
				</tr>
				<tr align="center">
					<td width="50%" class="rowodd"><strong>Paid Amount</strong></td>
					<td width="50%" align="left"  class="roweven"><input name="t_paid" id="t_paid" value="" size="30" onChange="audit_money(this)"></td>
				</tr>
				<tr align="center"  class="greybg">
					<input type="hidden" name="bt_name" value="">
					<td align="left">
						<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
					</td>		
					 <td align="right">
						<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>	

{literal}
<script type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});        
</script>
{/literal}	
</body>
</html>