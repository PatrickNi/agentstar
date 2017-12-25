<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="fd" value="{$fd}">
<input type="hidden" name="td" value="{$td}">
<input type="hidden" name="catid" value="{$catid}">
<input type="hidden" name="subid" value="{$subid}">
<input type="hidden" name="sf" value="{$sf}">
<input type="hidden" name="op" value="{$op}">
  <table align="center" width="100%"  class="graybordertable" cellpadding="5" cellspacing="0">
    <tr >
      <td align="left" class="bordered_2">
	  	Category: {$catname}&nbsp;&nbsp;&nbsp;&nbsp;SubClass: {$subname}&nbsp;&nbsp;&nbsp;&nbsp;
	    {if $ugs.export.v eq 1}
			<input type="submit" value="Export {$exp_name} Visa Emails" name="bt_export" style="font-weight:bold;">
		{/if}
	  </td>
    </tr>
  </table>
  <table align="center" width="100%"  cellpadding="1" cellspacing="1">
    <tr align="center" class="title">
      <td>Client Name</td>
      {foreach key=id item=title from=$title_arr}
     	 <td>{$title}</td>
      {/foreach}
	  <td>Balance</td>
    </tr>
    {foreach key=vid item=arr from=$review_arr}
  	<tr align="center" class="{cycle values='rowodd, roweven'}">
    	<td align="center" style="text-decoration:underline; cursor:pointer" onClick="window.open('redir.php?t=vs&cid={$arr.client}&vid={$vid}','','height='+screen.width*4/5+','+'width='+screen.width*4/5)">{$arr.name}</td>
    	{foreach key=id item=title from=$title_arr}
    		<td >{if array_key_exists($vid, $procs) && array_key_exists($id, $procs[$vid])}{$procs[$vid].$id}{else} &nbsp;{/if}</td>
    	{/foreach}
		<td align="right">{if array_key_exists($vid, $amounts)}{$amounts[$vid].balance|string_format:"%.2f"}{/if}</td>
    </tr>
    {/foreach}
  </table>
</form>
</body>
</html>
