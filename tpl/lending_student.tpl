<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Lending Student</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="lid" value="{$lid}">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1" >
	<tr align="left"  class="bordered_2">
	  <td colspan="9">
			<input style="font-weight:bold;" type="button" value="Lending Detail" onClick="javascript:this.form.action='lending_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Staff" onClick="javascript:this.form.action='lending_staff.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Clients" onClick="javascript:this.form.action='lending_student.php';this.form.submit();">&nbsp;&nbsp;
	  </td>  
	</tr>
	<tr align="center"  class="greybg">
		<td align="left" style="font-size:16px " colspan="9"> <span class="highyellow">Lending Insititute: {$iname}</span></td>
	</tr>			
	<tr align="center" class="title" style="font-weight:bold ">
		<td class="border_1">Clients</td>
		<td class="border_1">Loan Amount</td>
		<td class="border_1">Commission</td>
        <td class="border_1">Agreement Staff</td>
        <td class="border_1">Lending Manger</td>
        <td class="border_1">Refer Loan</td>
		<td class="border_1">Loan Approed</td>
		<td class="border_1">Load Settled</td>
        <td class="border_1">Comm Received</td>
	</tr>
	{foreach key=id item=arr from=$student_arr}
	<tr align="center" class="{cycle values='rowodd,roweven'}">
		<td style="cursor:pointer;text-decoration:underline" onClick="window.open('client_homeloan.php?cid={$arr.cid}&','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">{$arr.lname} {$arr.fname}</td>
		<td >{$arr.amount|number_format:2:'.':','}</td>
		<td >{$arr.comm|number_format:2:'.':','}</td>
        <td >{$user_arr[$arr.user]}</td>
        <td ><span onClick="openinSatff('s_{$id}');" style="text-decoration:underline; cursor:pointer;">{$staffs[$arr.staff].name}</span>
            <div style="text-align:left; display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="s_{$id}">
                <p><strong>P</strong>: {$staffs[$arr.staff].phone}</p>
                <p><strong>M</strong>: {$staffs[$arr.staff].mobile}</p>
                <p><strong>E</strong>: {$staffs[$arr.staff].email}</p>
                <p><strong>A</strong>: {$staffs[$arr.staff].addr}</p>
                <span style="font-weight:bolder; cursor:pointer;" onClick="javascript:document.getElementById('s_{$id}').style.display='none';">&times;</span> 
            </div>    
        </td>
		<td>{$process[$id].Referhomeloan.date}</td>
		<td>{$process[$id].Loanapproved.date}</td>
        <td>{$process[$id].Loansettled.date}</td>
        <td>{$process[$id].Commissionreceived.date}</td>				
	</tr>
	{/foreach}
</table>
</form>	
</body>
</html>