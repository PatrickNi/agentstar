<?php /* Smarty version 2.6.13, created on 2020-10-29 14:45:10
         compiled from client_qual.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
">
<table align="center" width="100%"  class="graybordertable" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
		<?php if ($this->_tpl_vars['ugs']['b_service']['v'] == 1): ?>
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input name="button" type="button"  style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" disabled value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
		<?php endif; ?>	
        <?php if (in_array ( 'study' , $this->_tpl_vars['client_type'] ) && $this->_tpl_vars['ugs']['c_service']['v'] == 1): ?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        <?php endif; ?> 
        <?php if (in_array ( 'immi' , $this->_tpl_vars['client_type'] ) && $this->_tpl_vars['ugs']['v_service']['v'] == 1): ?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        <?php endif; ?> 
        <?php if (in_array ( 'homeloan' , $this->_tpl_vars['client_type'] )): ?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        <?php endif; ?>
        <?php if (in_array ( 'legal' , $this->_tpl_vars['client_type'] )): ?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_legal.php';this.form.submit();" value="Legal Service">
        &nbsp;&nbsp; 
        <?php endif; ?>   
		</td>
	</tr>
	<tr align="center"  class="greybg" >
			<td class="whitetext" style="font-size:16px ">Client Qualification
				<input type="button" value="add new" style="font-weight:bold;" onclick="window.open('client_qual_dt.php?&cid=<?php echo $this->_tpl_vars['cid']; ?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')">&nbsp;&nbsp;
				<input type="button" value="Attachment" style="font-weight:bold" onClick="window.open('attachment.php?item=<?php echo $this->_tpl_vars['cid']; ?>
&type=<?php echo $this->_tpl_vars['itemtype']; ?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*6/7 +',height=' + screen.height*4/7)">
			</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px "> 
			<span class="highyellow">Client: <?php echo $this->_tpl_vars['client']['lname']; ?>
 <?php echo $this->_tpl_vars['client']['fname']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $this->_tpl_vars['client']['dob']; ?>
</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: <?php echo $this->_tpl_vars['client']['visa_n']; ?>
-<?php echo $this->_tpl_vars['client']['class_n']; ?>
, expr: <?php echo $this->_tpl_vars['client']['epdate']; ?>
</span>&nbsp;&nbsp; 
		</td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<td width="10%" >Start date</td>
					<td width="10%">Complete date</td>
					<td width="25%" >School Name </td>
					<td width="15%">School Country</td>
					<td width="*" >Qualification</td>
					<td width="12%" >Major</td>
                    <td width="5%" >Completed</td>
					<td width="5%" >Full/Part(time)</td>                    
					<td width="5%">Insert</td>
				</tr>
				<?php $_from = $this->_tpl_vars['show_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['arr']):
?>
				<tr align="center" class="roweven">
					<td><?php echo $this->_tpl_vars['arr']['fdate']; ?>
</td>
					<td ><?php echo $this->_tpl_vars['arr']['tdate']; ?>
</td>
					<td ><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_qual_dt.php?qid=<?php echo $this->_tpl_vars['id']; ?>
&cid=<?php echo $this->_tpl_vars['cid']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')"><?php echo $this->_tpl_vars['arr']['school']; ?>
</span></td>
					<td ><?php echo $this->_tpl_vars['country_arr'][$this->_tpl_vars['arr']['country']]; ?>
</td>
					<td><?php echo $this->_tpl_vars['arr']['qual']; ?>
</td>
					<td ><?php echo $this->_tpl_vars['arr']['major']; ?>
</td>
					<td ><?php echo $this->_tpl_vars['arr']['status']; ?>
</td>
                    <td ><?php if ($this->_tpl_vars['arr']['fulltime'] == 1): ?>Fulltime<?php else: ?>Parttime<?php endif; ?></td>                     
					<td><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_qual_dt.php?qid=<?php echo $this->_tpl_vars['id']; ?>
&cid=<?php echo $this->_tpl_vars['cid']; ?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')"></td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
			</table>
		</td>
	</tr>
</table>
</form>	
</body>
</html>