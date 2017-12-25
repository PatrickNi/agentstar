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
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="qid" value="{$qid}">
<input type="hidden" name="isNew" value="{$isNew}">
<input type="hidden" name="isChange" value="{$isChange}">
<table border="0" width="100%" cellpadding="3" cellspacing="1">
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" value="">
			<td align="left" width="10%">
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
			</td>		
			<td align="center" class="whitetext">Detail Information</td>
			 <td align="right" width="10%">
				<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
			</td>
		</tr>	
	</table></td></tr>
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Start Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven"><input type="text" name="t_fdate"  id="t_fdate" value="{$dt_arr.fdate}" size="30" onChange="audit_date(this)">

        
        </td>
	</tr>
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Complete Date:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven"><input type="text" name="t_tdate" id="t_tdate" value="{$dt_arr.tdate}" size="30"ondblclick="calendar()" onChange="audit_date(this)">
       
        </td>
	</tr>
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Country:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven">	
			<select name="t_country" onChange="this.form.isChange.value=1;this.form.submit();">
			{foreach key=id item=country from=$country_arr}
			  <option value="{$id}" {if $id eq $dt_arr.country} selected {/if}>{$country}</option>
			{/foreach}
			{if $dt_arr.country lt 1}
			  <option value="0" selected>select a country</option>
  			{/if}
			</select>			
			<span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="openModel('country.php',300,300,'NO', 'form1')">Add new country</span>
		</td>
	</tr>				
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>School Name:</strong>&nbsp;&nbsp;</td>
	    <td align="left" width="75%" class="roweven">
            <input type="text" value="{$dt_arr.school}" name="t_school" size="50">
		</td>
	</tr>
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven">				
            <input type="text" value="{$dt_arr.qual}" name="t_qual" size="50">
		</td>
	</tr>
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven">										
            <input type="text" value="{$dt_arr.major}" name="t_major" size="50">
		</td>
	</tr>	
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Completed:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven">										
            <input type="radio" name="t_status" value="YES" {if $dt_arr.status == 'YES'} checked {/if}>YES
            &nbsp;&nbsp;
            <input type="radio" name="t_status" value="NO" {if $dt_arr.status == 'NO'} checked {/if}>NO
		</td>
	</tr>	
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Fulltime/Parttime:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven">										
            <input type="radio" name="t_fulltime" value="1" {if $dt_arr.fulltime == 1} checked {/if}>Fulltime
            &nbsp;&nbsp;
            <input type="radio" name="t_fulltime" value="0" {if $dt_arr.fulltime == 0} checked {/if}>Parttime
		</td>
	</tr>	        					
	<tr>
		<td width="25%" align="left" class="rowodd"><strong>Note:</strong>&nbsp;&nbsp;</td>
		<td align="left" width="75%" class="roweven"><textarea style="width:300px; height:100px;" name="t_note">{$dt_arr.note}</textarea></td>
	</tr>								
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>									
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