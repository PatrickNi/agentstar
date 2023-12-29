<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Report Entity Visa</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" method="GET">
<table border="0" width="100%" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2" >
		<td class="whitetext" style="padding:3 " colspan="4">
        <input type="radio" name="v_company" value="geic" {if $v_company == 'geic'}checked{/if}><strong>GEIC</strong>
            &nbsp;
        <input type="radio" name="v_company" value="global_law_center" {if $v_company == 'global_law_center'} checked {/if}><strong>Global Law Center</strong>
            &nbsp;&nbsp;  
		<input type="submit" name="bt_name" value="Confirm" style="font-weight: bolder;">	  
		</td>
	</tr>
	 <tr>
	 	<td align="left" class="greybg" colspan="4"><span class="highyellow">Total Cases: {$page_url}</span></td>
	 </tr>		
     <tr class="totalrowodd">
        <td>Client Name</td>
        <td>Visa Category</td>
        <td>Visa Subclass</td>
        <td>Expiration</td>
     </tr>
	{foreach key=cid item=arr from=$visa_arr}
	    {foreach key=vid item=varr from=$arr}   
	    <tr class="roweven">
		    <td><span style="color:#0066FF; cursor:pointer;"  onClick="window.open('/scripts/client_visa_detail.php?cid={$cid}&vid={$vid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"> {$varr.client} </span></td>
            <td>{$varr.visa}</td>
            <td>{$varr.class}</td>
            <td>{$varr.edp}</td>
	    </tr>
	    {/foreach}
	{/foreach}
</table>
</form>
</body>
</html>
