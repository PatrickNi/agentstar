<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Agent Star -Immigration System</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="../css/sam.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
 <tr height="70" >
  <td width="192" align="center" valign="middle"><img src="../images/fox.gif" /></td>
  <td width="4"></td>

  <td width="" valign="bottom"><div style="margin:4px">User: <span class="orange">{$user_name}</span></div></td>
  <td width="100" align="right" valign="bottom"><a class="blue" href="login.php" target="_top" onclick="javascript:location.replace(this.href);event.returnValue=false;">login out</a></td>
 </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 4px">
 <tr height="20">
  <td align="center" width="192" class="bar"><b><a href="/migration/" class="home">HOME</a></b></td>
  <td width="4"></td>

  <td width="" class="navigation">&nbsp;&nbsp;<span class="white">Navigation:</span>&nbsp;&nbsp;<span class="orange">{if $gid gt 0}{$group_name} > {$func_name}{/if}</span></td>
 </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="192" align="center" valign="top">
  	<table height="100%" border="0" cellpadding="0" cellspacing="0" summary="menu">
		<tr><td height="10%" valign="top">
			<div id="menuDiv">
			{foreach key=groupId item=arr from=$grouArr}
			    <div class="menuPater" onClick="openMenu('{$groupId}')"><div class="menuTitle white">{$arr.name}</div></div>
			 	<span id="{$groupId}" class="menuClick" {if $groupId neq $gid}style="display:none;"{/if}>
				<ul class="menuSub">
			   	{foreach key=funcId item=func from=$arr.func}
 					<li><a href="{$func.url}">{$func.name}{if $func.name|lower == 'task'&& $task_num > 0}&nbsp;&nbsp;<strong style="color:#FF0000 ">Undo: {$task_num}</strong>{/if}</a></li>
				{/foreach}
				</ul>
			   </span>
			{/foreach} 
			</div>
		</td></tr>
	</table>
  </td>	
  <td width="4"></td>
  <td align="center" valign="top">  
    <iframe  name="dataFrame"  frameborder="0" width="100%" height="600" scrolling="auto" src="{$url}"></iframe>
  </td>
 </tr>
 <tr><td colspan="3"><hr   class="navigation" /></td></tr>
</table>
<br />
</body>
</html>  