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
<form method="post" name="form1" action="" id="form1" target="_self">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="coachid" value="{$coachid}">
<input type="hidden" name="lessonid" value="{$lessonid}">
<input type="hidden" id="token" name="token" value="">
<input type="hidden" id="btn_name" name="btn_name" value="">

			<table width="100%" cellpadding="1" cellspacing="1" border="0" class="graybordertable">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<td align="left" width="10%">&nbsp;</td>		
						<td align="center" class="whitetext">Lesson Detail </td>
						<td align="right" width="10%">
							<button type="button" id="btn_save" style="font-weight:bolder;font-size:larger" onclick="do_save({if $dt_arr.locked eq 1}1{else}0{/if})">Save</button>
						</td>
					</tr>					
				</table></td></tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Status:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
				  		<select name="t_status" id="t_step">
				  			<option value="Active" {if $dt_arr.status eq "Active"}selected{/if}>Active</option>
                            <option value="Completed" {if $dt_arr.status eq "Completed"}selected{/if}>Completed</option>
                            <option value="Defer" {if $dt_arr.status eq "Defer"}selected{/if}>Defer</option>
				  		</select>
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Course / Subject:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
                            {assign var="partnerid" value=$items_arr[$coach.itemid].pid}
                            {$items_arr[$partnerid].tit} / {$items_arr[$coach.itemid].tit}
					</td>
				</tr>				
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Date:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
						<input type="text" id="startdate" name="startdate" value="{$dt_arr.startdate}" size="30">
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Time:</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
						<select name="starttime">
						{foreach key=id item=name from=$init_hour}
							<option value="{$name}" {if $name eq $dt_arr.starttime} selected {/if}>{$name}</option>
						{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Teacher:</strong>&nbsp;&nbsp;</td>
				  	<td align="left" width="75%" class="roweven">
                        <select name="staff" >
                            {foreach key=id item=name from=$user_arr}
                            <option  value="{$id}" {if $dt_arr.staff eq $id} selected {/if}>{$name}</option>
                            {/foreach}
                            {if $dt_arr.staff lt 1}
                            <option  value="0" selected >Choose a teacher</option>
                            {/if}
                        </select> 
					</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Students in lesson:</strong><br/>(base on same teacher & date & time)</td>
				  	<td align="left" width="75%" class="roweven">{$student_in_lesson}</td>
				</tr>
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Fee(per class):</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
                        <input type="text" size="10" name="fee" value="{$dt_arr.fee}">
					</td>
				</tr>	
				<tr>
					<td width="25%" align="left" class="rowodd"><strong>Locked Period</strong>&nbsp;&nbsp;</td>
					<td align="left" width="75%" class="roweven">
                        {if $dt_arr.locked eq 1}<span style="color:red;">Yes</span>{else}No{/if}
					</td>
				</tr>	
				<tr class="greybg"><td colspan="2">&nbsp;</td></tr>										
			</table>
</form>	
{literal}
<script type="text/javascript">
	$('#startdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

	function do_save(locked) {
		if (locked == 1){
        	var token = prompt("Plese type in execute token");
        	if (token == null) {
            	return false;
        	}
		}
        $("#token").val(token);
        $("#btn_name").val("SAVE");
        $("#form1").submit();
        return true;
    }
         
</script>
{/literal}	
</body>
</html>