<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<body>
  <table align="center" width="100%"  class="graybordertable" cellpadding="5" cellspacing="0">
    <tr >
      <td align="left" class="bordered_2">Category: {$catname}&nbsp;&nbsp;&nbsp;&nbsp;SubClass: {$subname}</td>
    </tr>
  </table>
  <table align="center" width="100%"  cellpadding="1" cellspacing="1">
    <tr align="center" class="totalrowodd">
      <td class="border_1">Client Name</td>
      {foreach key=id item=title from=$title_arr}
     	 <td class="border_1">{$title}</td>
      {/foreach}
    </tr>
    {foreach key=vid item=arr from=$review_arr}
  	<tr align="center" class="{cycle values='roweven, rowodd'}">
    	<td align="center" >{$arr.name}</td>
    	{foreach key=id item=title from=$title_arr}
    		<td >{if array_key_exists($vid, $procs) && array_key_exists($id, $procs[$vid])}{$procs[$vid].$id}{else} &nbsp;{/if}</td>
    	{/foreach}
    </tr>
    {/foreach}
  </table>
</body>
</html>
