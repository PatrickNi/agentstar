<?php /* Smarty version 2.6.13, created on 2020-10-24 03:30:25
         compiled from client_visa.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" action="" target="_self" method="get">
<input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
">
<input type="hidden" name="vid" value="<?php echo $this->_tpl_vars['vid']; ?>
">
<input type="hidden" name="hCancel" value="0">
<table align="center" class="graybordertable" width="100%" cellpadding="0" cellspacing="0">
	<tr align="left"  class="bordered_2">
		<td colspan="9">
		 <?php if ($this->_tpl_vars['ugs']['b_service']['v'] == 1): ?>
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
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
		<td class="whitetext" colspan="9" style="padding:3 ">Client Visa Service
			&nbsp;&nbsp;&nbsp;&nbsp;
         <?php if ($this->_tpl_vars['ugs']['v_service']['i'] == 1): ?>
			<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">add visa</span>		
         <?php endif; ?>
		</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="9"> <span class="highyellow">Client: <?php echo $this->_tpl_vars['client']['lname']; ?>
 <?php echo $this->_tpl_vars['client']['fname']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $this->_tpl_vars['client']['dob']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: <?php echo $this->_tpl_vars['client']['visa_n']; ?>
-<?php echo $this->_tpl_vars['client']['class_n']; ?>
, expr: <?php echo $this->_tpl_vars['client']['epdate']; ?>
</span>&nbsp;&nbsp; </td>
	</tr>		
	<tr align="center" class="totalrowodd">
		<td class="border_1">Visa</td>
		<td class="border_1">Visa Subclass</td>
		<td class="border_1">On Shore<br>/Off Shore</td>
		<td class="border_1">Agreement Date</td>
		<td class="border_1">Apply Date</td>
		<td class="border_1">Grant Date</td>
		<td class="border_1">Agreement Staff</td>
		<td class="border_1">Visa Paperwork</td>
	</tr>
	<?php $_from = $this->_tpl_vars['visa_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['arr']):
?>
	<tr align="center" class="roweven" >
		<td class="border_1"><span style="<?php if ($this->_tpl_vars['arr']['active'] != 2): ?>font-weight:bold; color:#0066FF; <?php endif; ?>cursor:pointer;" onClick="<?php if ($this->_tpl_vars['arr']['vuser'] == $this->_tpl_vars['uid'] || $this->_tpl_vars['arr']['auser'] == $this->_tpl_vars['uid'] || $this->_tpl_vars['ugs']['v_track']['v'] == 1): ?>window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
&vid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)<?php else: ?>alert('Permission denied');<?php endif; ?>"><?php echo $this->_tpl_vars['arr']['visa']; ?>
&nbsp;&nbsp;</span></td>
		<td class="border_1"><?php echo $this->_tpl_vars['arr']['class']; ?>
</td>
		<td class="border_1"><?php if ($this->_tpl_vars['arr']['shore'] == 1): ?> onshore <?php else: ?> offshore <?php endif; ?></td>
		<td class="border_1"><?php echo $this->_tpl_vars['arr']['adate']; ?>
</td>
		<td class="border_1"><?php if (array_key_exists ( $this->_tpl_vars['id'] , $this->_tpl_vars['procs'] )):  echo $this->_tpl_vars['procs'][$this->_tpl_vars['id']]['lodge'];  endif; ?></td>
		<td class="border_1"><?php if (array_key_exists ( $this->_tpl_vars['id'] , $this->_tpl_vars['procs'] ) && $this->_tpl_vars['procs'][$this->_tpl_vars['id']]['grant'] != ""):  echo $this->_tpl_vars['procs'][$this->_tpl_vars['id']]['grant'];  else:  echo $this->_tpl_vars['arr']['status'];  endif; ?></td>
		<td class="border_1"><?php echo $this->_tpl_vars['user_arr'][$this->_tpl_vars['arr']['auser']]; ?>
</td>
		<td class="border_1"><?php echo $this->_tpl_vars['user_arr'][$this->_tpl_vars['arr']['vuser']]; ?>
</td>						
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
</form>	