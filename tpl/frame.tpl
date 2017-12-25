<html>
<head>
<title>Agent Star -Migration System</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<body>
<table width="100%" align="center" height="600">
<tr>
	<td height="40">&nbsp;</td>
	<td height="40" valign="bottom">
		<table width="100%" height="100%">
			<tr>
				<td width="80%" align="left" valign="bottom">User:&nbsp;&nbsp;<span style="color:#FC9138; font-weight:bold">{$user_name}</span></td>
				<td width="20%" align="right" valign="bottom"><a class="blue" href="login.php" target="_top" onclick="javascript:location.replace(this.href);event.returnValue=false;">login out</a></td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td width="10%" height="22" bgcolor="#ADB4FE">&nbsp;</td>
	<td width="90%" bgcolor="#6363CB"><span style="color: #FC9138; font-weight:bold">{if $gid gt 0}{$group_name} > {$func_name}{/if}</span>&nbsp;</td>
</tr>
<tr>
	<td valign="top">
		<table width="158" cellspacing="1" cellpadding="0" align="left">
			{foreach key=groupId item=arr from=$grouArr}
			<tr>
				<td width="150" align="center" class="menu" onClick="openMenu('{$groupId}')">{$arr.name}</td>
			</tr>
			<tr id="{$groupId}" {if $groupId neq $gid}style="display:none;"{/if}>
				<td align="center">
					<table width="100%" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
					 {foreach key=funcId item=func from=$arr.func}
					  <tr bgcolor="#FFFFFF"> 
						<td width="3%">&nbsp;</td>
						<td class=bg onmouseover="this.style.backgroundColor='#E9EDED';" style=" cursor:pointer;" onmouseout="this.style.backgroundColor='#FAFAFA'" align="left" height="20" width="97%"><a href="{$func.url}"  class="smalltext" target="_top">{$func.name}</a></td>
					  </tr>
					 {/foreach}			  
					</table>
				</td>
			</tr>
			{/foreach}		
		</table>	
	</td>
	<td align="center" valign="top">
		<iframe  name="dataFrame" frameborder="0" scrolling="yes" width="100%" height="100%" src="{$url}"></iframe>
	</td>
</tr>
</table>
</body>
</html>
