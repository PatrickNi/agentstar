<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>


<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="semid" value="{$cid}">
<input type="hidden" name="courseid" value="{$courseid}">
<input type="hidden" name="tid" value="{$tid}">

			<table width="100%" cellpadding="1" cellspacing="1" border="0" class="graybordertable">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="left" width="10%">&nbsp;</td>		
						<td align="center" class="whitetext">Internal Tranfer Note</td>
						<td align="right" width="10%">
							<input name="submit" type="submit" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" value="Save">
						</td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Client:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        {$client.fname} {$client.lname}
                    </td>
				</tr>
                <tr>
                    <td width="28%" align="left" class="rowodd"><strong>School Name:</strong>&nbsp;&nbsp;</td>
                    <td align="left" width="72%" class="roweven">{$school_name}&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
                    <td align="left" width="72%" class="roweven">{$qual_name}</td>
                </tr>
                <tr>
                    <td width="28%" align="left" class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
                    <td align="left" width="72%" class="roweven">{$major_name}</td>
                </tr>
                <tr>
                    <td width="28%" align="left" class="rowodd"><strong>Semester:</strong>&nbsp;&nbsp;</td>
                    <td align="left" width="72%" class="roweven"># {$sem_arr.sem}</td>
                </tr>								
                <tr>
                    <td colspan="2"><hr></td>
                </tr>	
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Transfer Date:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">{$dt_arr.date}</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Trust receipt no. & Job Code:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        <input type="text" name="t_recipt" value="{$dt_arr.recipt}" size="50"> 
                    </td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Commission Rate:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        <input type="text" name="t_cr" value="{$dt_arr.cr}" size="30">   
                    </td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Commission Amount:</strong><br/>(incl GST)</td>
				  	<td align="left" width="75%" class="roweven">
                        <input type="text" name="t_commgst" value="{$dt_arr.commgst}" size="30"> 
                    </td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Additional Bonus Amount</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        <input type="text" name="t_bonus" value="{$dt_arr.bonus}" size="30">    
                    </td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Total Commission to Biz</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        <input type="text" name="t_comm2biz" value="{$dt_arr.comm2biz}" size="30">   
                    </td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Net Payment to Institute:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        {$dt_arr.netpayment}
                    </td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Institute Bank Detail:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        Account: {$dt_arr.bank.name}<br/>
                        Account No: {$dt_arr.bank.no}<br/>
                        BSB: {$dt_arr.bank.bsb}<br/>
                    </td>
				</tr>
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>										
			</table>
</form>	
{literal}
<script type="text/javascript">      
</script>
{/literal}	
</body>
</html>