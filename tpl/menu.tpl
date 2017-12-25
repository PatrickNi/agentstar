<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<body>
<div align="left">
<table width="158" cellspacing="1" cellpadding="0" align="left">
	{foreach key=groupId item=arr from=$grouArr}
	<tr>
		<td width="150" align="center" class="menu" onClick="openMenu('{$groupId}')">{$arr.name}</td>
	</tr>
	<tr id="{$groupId}" style="display:none;">
		<td align="center">
            <table width="100%" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
             {foreach key=funcId item=func from=$arr.func}
			  <tr bgcolor="#FFFFFF"> 
                <td width="3%">&nbsp;</td>
                <td class=bg onmouseover="this.style.backgroundColor='#E9EDED';" style=" cursor:pointer;" onmouseout="this.style.backgroundColor='#FAFAFA'" align="left" height="20" width="97%"><a href="{$func.url}" class="smalltext" target="main">{$func.name}</a></td>
              </tr>
             {/foreach}			  
            </table>
		</td>
	</tr>
	{/foreach}		
</table>
</div>
</body>
</html>
