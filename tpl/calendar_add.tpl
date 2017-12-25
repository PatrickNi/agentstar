<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script language="javascript" src="../js/audit.js"></script>
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>

<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" action="" target="_self" onSubmit="return isDelete()">
	<input type="hidden" name="id" value="{$calid}">
	<input type="hidden" name="hdate" value="{$hdate}">
	<input type="hidden" name="huser" value="{$huser}">
<table width="100%"  class="graybordertable" cellpadding="1" cellspacing="1">
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" value="">
			<td align="left" width="10%">
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
			</td>		
			<td align="center" height="20" class="whitetext">User Calendar Detail&nbsp;&nbsp;&nbsp;<span class="highlighttext">From User: {$username}</span></td>	
			 <td align="right" width="10%">
				<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
			</td>
		</tr>		
	</table></td></tr>
    <tr>
        <td width="18%" align="left" class="rowodd"><strong>Done:</strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%"  class="roweven"><input type="checkbox" value="1" name="t_done" {if $dt_arr.done eq 1} checked {/if}></td>
    </tr>	
    <tr>
        <td align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven"><input id="t_date" name="t_date" type="text" value="{$dt_arr.date}" readonly="true">
                                
        </td>
    </tr>
    <tr>
        <td align="left" class="rowodd"><strong>Hour: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven">
			<select name="t_hour" onChange="this.form.t_title.focus()">
				<option value="{$dt_arr.hour}">{$dt_arr.hour}</option>
			</select>		
			<!--				{foreach key=id item=hour from=$hour_arr}
					<option value="{$hour}" {if $dt_arr.hour eq $hour} selected {/if}>{$hour}</option>
				{/foreach}-->
		</td>
    </tr>
    <tr>
        <td align="left" class="rowodd"><strong>Consultar: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven">
			<select name="t_user" onChange="this.form.t_title.focus()">
           	{foreach key=id item=name from=$user_arr}
				<option value="{$id}" {if $id eq $dt_arr.user} selected {/if}>{$name}</option>
			{/foreach}
            </select>		
		</td>
    </tr>	 	
    <tr>
        <td align="left" class="rowodd"><strong>Title: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven"><textarea style="width:400px; height:50 " name="t_title">{$dt_arr.title}</textarea></td>
    </tr>
    <tr>
        <td align="left" class="rowodd"><strong>Description: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven"><textarea name="t_desc" style="width:400px; height:100 ">{$dt_arr.desc}</textarea></td>
    </tr>   
    <tr>
        <td align="left" class="rowodd"><strong>Duration: </strong>&nbsp;&nbsp;</td>
        <td align="left" width="82%" class="roweven">			
		   <select name="t_due" onChange="this.form.t_desc.focus();">
			{foreach key=id item=name from=$due_arr}
				<option value="{$id}" {if $id eq $dt_arr.due} selected {/if}>{$name}</option>
			{/foreach}
            </select>
		</td>
    </tr>
    <tr class="greybg"><td colspan="2">&nbsp;</td></tr>	
</table>
 </form>
 {literal}
<script type="text/javascript">
	$('#t_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
</script>
{/literal}	
</body>
</html>