<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
{literal}
<script language="javascript">
		function setNameBox(id, obj)
		{
			arr = document.getElementsByTagName('INPUT');
			document.getElementsByName('new_'+id)[0].disabled = !obj.checked;
			document.getElementById('ch_'+id).disabled = !obj.checked;
			document.getElementById('del_'+id).disabled = !obj.checked;
			for(i=0;i < arr.length; i++)
			{
				if(arr[i].type == 'text' && arr[i].name.match('^new_') && arr[i].name != 'new_'+id)
				{
					arr[i].disabled = true;
				}
				if(arr[i].type == 'submit' && arr[i].name == 'Change' && arr[i].id != 'ch_'+id)
				{
					arr[i].disabled = true;
				}		
				if(arr[i].type == 'submit' && arr[i].name == 'Delete' && arr[i].id != 'del_'+id)
				{
					arr[i].disabled = true;
				}						
			}			
		}
</script>
{/literal}		
<body>
<form method="post" name="form1" action="" target="_self" enctype="multipart/form-data">
<input type="hidden" name="item" value="{$itemid}">
<input type="hidden" name="type" value="{$itemtype}">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Attachment</span></td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">ItemID: {$itemid}</span>&nbsp;&nbsp;&nbsp;<span class="highyellow">Type: {$itemtype}</span></td>
	</tr>			
	<tr align="center">
		<td class="roweven" align="left" colspan="2"><input type="file" size="160" name="uploadFile" value="Browse">
		  <input type="submit" name="bt_name" value="Upload" style="font-weight:bold">	  </td>
	</tr>
	<tr align="center">
		<td class="highlighttext">{$msg}</td>
	</tr>
	<tr><td>
		<table border="0" cellpadding="1" cellspacing="1" width="100%">
			<tr class="totalrowodd" align="center">
				<td width="2%">&nbsp;</td>
				<td width="30%">Name Change</td>
				<td width="40%">Download File</td>
				<td>Upload Time</td>
			</tr>
			{foreach key=id item=arr from=$files}
			<tr class="roweven" align="left">
				<td width="2%"><input type="radio" name="id" value="{$id}" onClick="setNameBox({$id}, this)"></td>
				<td><input type="text" name="new_{$id}" value="" disabled>&nbsp;
					<input type="submit" id="ch_{$id}" name="Change" value="Change" style="font-weight:bold;" disabled="disabled">&nbsp;
					<input type="submit" id="del_{$id}" name="Delete" value="Delete" style="font-weight:bold;" disabled="disabled">				</td>
				<td><a href="../download/{$arr.url}" target="_blank">{$arr.file}</a></td>				
				<td>{$arr.time}</td>
			</tr>
			{/foreach}
		</table>	
	</td></tr>
</table>
</form>	
</body>
</html>