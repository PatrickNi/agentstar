<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>

<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="cid" value="{$cid}">
		<table border="0" width="100%" cellpadding="3" cellspacing="1">
		  <tr align="left"  class="bordered_2">
			<td colspan="2">
			{if $ugs.b_service.v eq 1}
			  <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_detail.php';this.form.submit();" value="Client Detail">&nbsp;&nbsp;
			  <input name="button" type="button" disabled style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			  <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_qual.php';this.form.submit();" value="EDU Background">&nbsp;&nbsp;
			  <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();" value="Working experience">&nbsp;&nbsp; 
			  <input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
			{/if}
        {if in_array('study', $client_type) && $ugs.c_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('immi', $client_type) && $ugs.v_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('homeloan', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        {/if}  	
			</td>
		  </tr>		
			<tr class="greybg">
				<td colspan="2"align="center" class="whitetext">IELTS Information</td>
			</tr>	
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Module:</strong></td>
				<td align="left" width="76%" class="roweven">
					<select name="t_mod" onChange="this.form.t_testday.focus();">
						<option value="academic" {if $dt_arr.mod eq 'academic'} selected {/if}>Academic</option>
						<option value="general" {if $dt_arr.mod eq 'general'} selected {/if}>General</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Test Date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" size="30" name="t_testday"  id="t_testday" value="{$dt_arr.testday}" >  
                
                </td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Overall result:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_result" size="30" value="{$dt_arr.overall}" style="background-color:#CCCC66 "></td>
			</tr>
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Listening:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_listen" size="30" value="{$dt_arr.listen}" ></td>
			</tr>	
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Reading:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_read" size="30" value="{$dt_arr.read}" ></td>
			</tr>	
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Writing:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_write" size="30" value="{$dt_arr.write}" ></td>
			</tr>				
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Speaking:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_speak" size="30" value="{$dt_arr.speak}" ></td>
			</tr>				
			<tr>
				<td width="24%" align="left" class="rowodd"><strong>Planned attending IELTS test date:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="76%" class="roweven"><input type="text" name="t_planday" size="30"  id="t_planday" value="{$dt_arr.planday}" >
               
                </td>
			</tr>																										
			<tr align="center"  class="greybg" >
				<td colspan="2">
					<input type="hidden" name="bt_name" value="">
					<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<!--<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">-->
				</td>
			</tr>									
</table>
</form>
{literal}
<script type="text/javascript">
	$('#t_testday').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_planday').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
</script>
{/literal}		
</body>
</html>