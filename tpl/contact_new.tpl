<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="ctid" value="{$ctid}">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
	  <td colspan="2" align="center" style=" padding:5,5,5; font-size:12px; color:#FFFFFF">Other Contact&nbsp;&nbsp;
	  	<span onClick="openModel('contact_group.php', 400,260,'NO', 'form1')" style="color:#0000CC; cursor:pointer; font-weight:lighter">(add group)</span>
	  </td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table  border="0" cellpadding="1" cellspacing="1" width="100%">
			{foreach key=gid item=group from=$contact_group_arr} 
				<tr style="background-color:#BCB98F; font-weight:bold; ">
					<td  align="left" colspan="5">
						<span onClick="openModel('contact_group.php?gid={$gid}&type={$typeid}',400,260,'NO', 'form1')" style="color:#0000CC; cursor:pointer;">{$group.name}</span>
						&nbsp;
						<span onClick="openModel('contact_info.php?gid={$gid}',600,500,'NO', 'form1')" style="color:#0000CC; cursor:pointer; font-weight:lighter">(add org.)</span>
					</td>
			  </tr>
				<tr align="left" class="totalrowodd" name="{$gid}">
					<td>Organization</td>
					<td width="20%" >Telphone</td>
					<td width="20%" >WebSite</td>
			  </tr>				
				{foreach key=id item=arr from=$contact_arr[$gid]}
				<tr align="left" class="roweven" name="{$gid}">
					<td><span style="cursor:pointer;text-decoration:underline"onClick="openModel('contact_info.php?gid={$gid}&ctid={$id}',600,600,'NO', 'form1')">{$arr.org}</span></td>
					<td>{if $arr.phone}{$arr.phone}{else}&nbsp;{/if}</td>
					<td>{if $arr.web}{$arr.web}{else}&nbsp;{/if}</td>
				</tr>
				{/foreach}
			{/foreach}	
			</table>
		</td>
	</tr>
</table>
</form>	
