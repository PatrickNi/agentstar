<?php /* Smarty version 2.6.13, created on 2020-10-24 02:48:19
         compiled from client_coach.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Coach Service</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<body>
<form name="form1" action="" target="_self" method="get">
<input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
">
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
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply Course">
        &nbsp;&nbsp; 
        <?php endif; ?> 
        <?php if (in_array ( 'immi' , $this->_tpl_vars['client_type'] ) && $this->_tpl_vars['ugs']['v_service']['v'] == 1): ?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa Service">
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
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service"> 
        </td>
    </tr>
    <tr align="center"  class="greybg" >
        <td class="whitetext" colspan="9" style="padding:3 ">Client Coach Service
            &nbsp;&nbsp;&nbsp;&nbsp;
         <?php if ($this->_tpl_vars['ugs']['v_service']['i'] == 1): ?>
            <span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_coach_detail.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">add new</span>       
         <?php endif; ?>
        </td>
    </tr>
    <tr align="center"  class="greybg" >
        <td align="left" style="font-size:16px " colspan="9"> <span class="highyellow">Client: <?php echo $this->_tpl_vars['client']['lname']; ?>
 <?php echo $this->_tpl_vars['client']['fname']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $this->_tpl_vars['client']['dob']; ?>
</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: <?php echo $this->_tpl_vars['client']['visa_n']; ?>
-<?php echo $this->_tpl_vars['client']['class_n']; ?>
, expr: <?php echo $this->_tpl_vars['client']['epdate']; ?>
</span></td>
    </tr>       
    <tr align="center" class="totalrowodd">
        <td class="border_1">Category</td>
        <td class="border_1">Course</td>
        <td class="border_1">Date (Start ~ End) </td>
        <td class="border_1">Schedule</td>
        <td class="border_1">Fee</td>
        <td class="border_1">Staff</td>
    </tr>
    <?php $_from = $this->_tpl_vars['coach_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['arr']):
?>
    <tr align="center" class="roweven" >
        <td class="border_1"><span style="cursor:pointer;" onClick="window.open('client_coach_detail.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
&coachid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">
        <?php $this->assign('partnerid', $this->_tpl_vars['items_arr'][$this->_tpl_vars['arr']['itemid']]['pid']); ?>
        <?php echo $this->_tpl_vars['items_arr'][$this->_tpl_vars['partnerid']]['tit']; ?>
&nbsp;&nbsp;</span></td>
        <td class="border_1"><?php echo $this->_tpl_vars['items_arr'][$this->_tpl_vars['arr']['itemid']]['tit']; ?>
</td>
        <td class="border_1"><?php echo $this->_tpl_vars['arr']['startdate']; ?>
 ~ <?php echo $this->_tpl_vars['arr']['enddate']; ?>
</td>
        <td class="border_1">Time: <?php echo $this->_tpl_vars['arr']['starttime']; ?>
 (<?php echo $this->_tpl_vars['arr']['duehour']; ?>
 hours)<br/>Week: <?php echo $this->_tpl_vars['arr']['freqw']; ?>
</td>
        <td class="border_1"><?php echo $this->_tpl_vars['arr']['fee']; ?>
</td>
        <td class="border_1"><?php echo $this->_tpl_vars['user_arr'][$this->_tpl_vars['arr']['staff']]; ?>
</td>                       
    </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>
</form> 