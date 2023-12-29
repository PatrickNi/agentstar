<?php /* Smarty version 2.6.13, created on 2020-11-05 14:36:49
         compiled from client_detail.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "style.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script language="javascript" src="../js/audit.js"></script>
<body <?php echo $this->_tpl_vars['forbid_sl']; ?>
 <?php echo $this->_tpl_vars['forbid_cp']; ?>
 <?php echo $this->_tpl_vars['forbid_rc']; ?>
>
<form name="form1" action="" target="_self" method="get">
  <input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
">
  <input type="hidden" name="visaChange" value="0">
  <table align="center" width="100%"  class="graybordertable" cellspacing="1" cellpadding="1" border="0">
    <tr align="left"  class="bordered_2">
      <td colspan="2"> <?php if ($this->_tpl_vars['ugs']['b_service']['v'] == 1): ?>
        <input name="button" type="button" disabled style="font-weight:bold;" onClick="javascript:this.form.action='client_detail.php';this.form.submit();" value="Client Detail">
        <input name="button2" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_qual.php';this.form.submit();" value="EDU Background">
        &nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();" value="Working experience">
        &nbsp;&nbsp;
        <input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">
        &nbsp;&nbsp;
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
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service">
      </td>
    </tr>
    <tr>
      <td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
          <tr align="center"  class="greybg" >
            <input type="hidden" name="bt_name" value="">
            <td align="left" width="10%"><?php if ($this->_tpl_vars['ugs']['b_service']['d'] == 1): ?>
              <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
              <?php endif; ?></td>
            <td class="whitetext" align="center">Client Detail</td>
            <td align="right" width="10%">
            	<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
            </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"  class="greybg" >
      <td align="left" colspan="2" style="font-size:16px "><span class="highyellow">Client: <?php echo $this->_tpl_vars['arr']['lname']; ?>
 <?php echo $this->_tpl_vars['arr']['fname']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $this->_tpl_vars['arr']['dob']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: <?php echo $this->_tpl_vars['arr']['visa_n']; ?>
-<?php echo $this->_tpl_vars['arr']['class_n']; ?>
, expr: <?php echo $this->_tpl_vars['arr']['epdate']; ?>
</span>&nbsp;&nbsp;             	
      <?php if ($this->_tpl_vars['arr']['status'] == 'new'): ?>
	      <input type="submit" value="Approve From GEIC" style="font-weight:bold; color:#FF0000" onClick="this.form.bt_name.value='approved';this.disable=false;" >
      <?php endif; ?>
      </td>
    </tr>
    <tr align="center">
      <td width="70%" valign="top">
          <table align="center" width="100%">
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Password Reset:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <input type="password" size="20" name="t_pass" value=""></td>
              </tr>    
              <tr>
                <td colspan="2"><hr></td>
              </tr>    
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Current Visa type:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 1 && $this->_tpl_vars['ugs']['b_visa']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_visa']['i'] == 0 )): ?>
                  <input type="hidden" name="t_visa" value="<?php echo $this->_tpl_vars['catid']; ?>
">
                  <?php endif; ?>
                  <select name="t_visa" onChange="this.form.visaChange.value=1;this.form.submit();" <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 1 && $this->_tpl_vars['ugs']['b_visa']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_visa']['i'] == 0 )): ?> disabled <?php endif; ?>>
                  <?php $_from = $this->_tpl_vars['visa_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
                  <option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['catid']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                  <?php if ($this->_tpl_vars['catid'] == 0): ?>
                  <option value="0" selected>choose a category</option>
                  <?php endif; ?>
                  </select></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Current Visa subclass:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 1 && $this->_tpl_vars['ugs']['b_visa']['v'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_visa']['i'] == 0 )): ?>
                  <input type="hidden" name="t_class" value="<?php echo $this->_tpl_vars['classid']; ?>
">
                  <?php endif; ?>
                  <select name="t_class" onChange="this.form.t_epdate.focus();" <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 1 && $this->_tpl_vars['ugs']['b_visa']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_visa']['i'] == 0 )): ?> disabled <?php endif; ?>>
                  <?php $_from = $this->_tpl_vars['visaclass_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
                  <option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['classid']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                  <?php if ($this->_tpl_vars['classid'] == 0): ?>
                  <option value="0" selected>choose a subclass</option>
                  <?php endif; ?>
                  </select>
                  &nbsp;
                  <input type="text" size="50" name="t_classtxt" value="<?php echo $this->_tpl_vars['arr']['classtxt']; ?>
">
                  
                  </td>
              </tr>    
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Visa Expiry Date:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 1 && $this->_tpl_vars['ugs']['b_visa']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_visa']['i'] == 0 )): ?>
                  <input type="hidden" name="t_epdate" value="<?php echo $this->_tpl_vars['arr']['epdate']; ?>
">
                  <?php endif; ?>
                  <input id='t_epdate' type="text" name="t_epdate" value="<?php echo $this->_tpl_vars['arr']['epdate']; ?>
"  size="30" <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['b_visa']['v'] == 1 && $this->_tpl_vars['ugs']['b_visa']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_visa']['i'] == 0 )): ?> disabled <?php endif; ?>>
                 </td>
              </tr>  
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat ID:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_id' type="text" name="t_wechat_id" value="<?php echo $this->_tpl_vars['arr']['wechatid']; ?>
"  size="50">
                 </td>
              </tr> 
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat Linked Phone:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_phone' type="text" name="t_wechat_phone" value="<?php echo $this->_tpl_vars['arr']['wechatphone']; ?>
"  size="50">
                 </td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat Linked Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_email' type="text" name="t_wechat_email" value="<?php echo $this->_tpl_vars['arr']['wechatemail']; ?>
"  size="50">
                 </td>
              </tr> 
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Country of passport:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><select name="t_country" onChange="this.form.t_sign.focus();">
                  
                    
                              <?php $_from = $this->_tpl_vars['country_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
                                  
                    
                  <option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['arr']['country']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
                  
                    
                              <?php endforeach; endif; unset($_from); ?>
                              <?php if ($this->_tpl_vars['arr']['country'] < 1): ?>
                                
                    
                  <option value="0" selected>select a country</option>
                  
                    
                              <?php endif; ?>
                          
                  
                </select>        &nbsp;&nbsp;&nbsp; <span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="openModel('country.php',300,300,'NO','form1')">add new country</span></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Input Date:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input type="text" id='t_sign' name="t_sign" value="<?php echo $this->_tpl_vars['arr']['sign']; ?>
" size="30">
                </td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Last Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_lname" value="<?php echo $this->_tpl_vars['arr']['lname']; ?>
" size="30"></td>
              </tr>
              <tr>
                <td hwidth="28%"  align="left" class="rowodd"><strong>First Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_fname" value="<?php echo $this->_tpl_vars['arr']['fname']; ?>
" size="30"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Gender:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><select name="t_gender" onChange="this.form.t_dob.focus()">
                    <option value="F" <?php if ($this->_tpl_vars['arr']['gender'] == 'F'): ?> selected <?php endif; ?>>Female</option>
                    <option value="M" <?php if ($this->_tpl_vars['arr']['gender'] == 'M'): ?> selected <?php endif; ?>>Male</option>
                  </select></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>DoB:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input type="text" id='t_dob' name="t_dob" value="<?php echo $this->_tpl_vars['arr']['dob']; ?>
" size="30">
                </td>
              </tr>
              <tr>
                <td wwidth="28%"  align="left" class="rowodd"><strong>English Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_ename" value="<?php echo $this->_tpl_vars['arr']['ename']; ?>
" size="30"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd" ><strong>Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_email" value="<?php echo $this->_tpl_vars['arr']['email']; ?>
" size="60" onChange="audit_email(this.value);this.form.t_email.focus();">
                  <A HREF="mailto:<?php echo $this->_tpl_vars['arr']['email']; ?>
">send mail</A></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Home Tel:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_tel" value="<?php echo $this->_tpl_vars['arr']['tel']; ?>
" size="60"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_mobile" value="<?php echo $this->_tpl_vars['arr']['mobile']; ?>
" size="60"></td>
              <tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Matrial Status:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                        <select name="t_m" class="text">
                          <option value="married" <?php if ($this->_tpl_vars['arr']['married'] == 'married'): ?> selected <?php endif; ?>>结婚(Married)</option>
                          <option value="divorce" <?php if ($this->_tpl_vars['arr']['married'] == 'divorce'): ?> selected <?php endif; ?>>离婚(Divorce)</option>
                          <option value="never_married" <?php if ($this->_tpl_vars['arr']['married'] == 'never_married'): ?> selected <?php endif; ?>>未婚(Never Married)</option>
                          <option value="separated" <?php if ($this->_tpl_vars['arr']['married'] == 'separated'): ?> selected <?php endif; ?>>分居(Separated)</option>
                          <option value="defacto" <?php if ($this->_tpl_vars['arr']['married'] == 'defacto'): ?> selected <?php endif; ?>>同居(Defacto Relationship)</option>
                        </select> 
                </td>
              <tr>    
                <td height="30" align="left" class="rowodd"><strong>Current residential addres:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" size="100" name="t_add" value="<?php echo $this->_tpl_vars['arr']['add']; ?>
"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Client Type:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  <!--
                  <?php if ($this->_tpl_vars['ugs']['b_ctype']['v'] == 1 && $this->_tpl_vars['ugs']['b_ctype']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_ctype']['i'] == 0 )): ?>
                  <input type="hidden" name="t_type" value="<?php echo $this->_tpl_vars['arr']['type']; ?>
">
                  <?php endif; ?>
                  <select name="t_type" onChange="this.form.t_note.focus();" <?php if ($this->_tpl_vars['ugs']['b_ctype']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['b_ctype']['v'] == 1 && $this->_tpl_vars['ugs']['b_ctype']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_ctype']['i'] == 0 )): ?> disabled <?php endif; ?>>
                  <?php $_from = $this->_tpl_vars['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['type']):
?>
                  <option value="<?php echo $this->_tpl_vars['type']; ?>
" <?php if ($this->_tpl_vars['type'] == $this->_tpl_vars['arr']['type']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['id']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                  </select>
                  -->
                  <?php $_from = $this->_tpl_vars['all_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['t']):
?>
                      <input type="checkbox" name="t_type[]" value="<?php echo $this->_tpl_vars['t']; ?>
" <?php if (in_array ( $this->_tpl_vars['t'] , $this->_tpl_vars['arr']['type'] )): ?> checked <?php endif; ?>><?php echo $this->_tpl_vars['id']; ?>
&nbsp;&nbsp;
                  <?php endforeach; endif; unset($_from); ?>
                  &nbsp;&nbsp;&nbsp; <?php if ($this->_tpl_vars['isDependant']): ?><span style="color:#FF0000">[Dependant]</span><?php endif; ?> </td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Have contact Person:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="checkbox" name="t_c" value="1" onClick="has_contact(this.checked)" <?php if ($this->_tpl_vars['arr']['c_name'] != ""): ?> checked <?php endif; ?>></td>
              </tr>
              
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Contact Person Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_name" value="<?php echo $this->_tpl_vars['arr']['c_name']; ?>
" size="30" <?php if ($this->_tpl_vars['arr']['c_name'] == ""): ?> disabled <?php endif; ?>></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Relationship to you:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input name="t_c_rtu" type="text" class="form-control" value="<?php echo $this->_tpl_vars['arr']['c_rtu']; ?>
" <?php if ($this->_tpl_vars['arr']['c_name'] == ""): ?> disabled <?php endif; ?>/>
              </tr>    
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Contact Home Tel:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%"class="roweven"><input type="text" name="t_c_tel" value="<?php echo $this->_tpl_vars['arr']['c_tel']; ?>
" size="30" <?php if ($this->_tpl_vars['arr']['c_name'] == ""): ?> disabled <?php endif; ?>></td>
              </tr>
              <tr>
                <td height="30" align="left" class="rowodd"><strong>Contact Mobile:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_mobile" value="<?php echo $this->_tpl_vars['arr']['c_mobile']; ?>
" size="30" <?php if ($this->_tpl_vars['arr']['c_name'] == ""): ?> disabled <?php endif; ?>></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Contact Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_email" value="<?php echo $this->_tpl_vars['arr']['c_email']; ?>
" size="30" onChange="audit_email(this.value)" <?php if ($this->_tpl_vars['arr']['c_name'] == ""): ?> disabled <?php endif; ?>></td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Contact Address:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" size="50" name="t_c_add" value="<?php echo $this->_tpl_vars['arr']['c_add']; ?>
" <?php if ($this->_tpl_vars['arr']['c_name'] == ""): ?> disabled <?php endif; ?>></td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Global Partner:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  <?php if ($this->_tpl_vars['ugs']['b_suba']['v'] == 1 && $this->_tpl_vars['ugs']['b_suba']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_suba']['i'] == 0 )): ?>
                      <input type="hidden" name="t_agent_p" value="<?php echo $this->_tpl_vars['arr']['agent']; ?>
">
                  <?php endif; ?>
                  <select id="t_agent_p" name="t_agent_p" onChange="changeClientFrom(this,this.form.t_about,'t_agent_a');changeAboutInput(this.form.t_about.value,this.form.t_aboutTxt);" <?php if ($this->_tpl_vars['ugs']['b_suba']['v'] == 1 && $this->_tpl_vars['ugs']['b_suba']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_suba']['i'] == 0 )): ?> disabled <?php endif; ?>>
                    <option value="0">choose a global partner</option>
                    <?php $_from = $this->_tpl_vars['agent_partner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ag_id'] => $this->_tpl_vars['v']):
?>
                        <option value="<?php echo $this->_tpl_vars['ag_id']; ?>
" <?php if ($this->_tpl_vars['ag_id'] == $this->_tpl_vars['arr']['agent']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['v']['name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                    
                  </select>
                </td>
              </tr>    
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Global Assistant:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  <?php if ($this->_tpl_vars['ugs']['b_suba']['v'] == 1 && $this->_tpl_vars['ugs']['b_suba']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_suba']['i'] == 0 )): ?>
                      <input type="hidden" name="t_agent_a" value="<?php echo $this->_tpl_vars['arr']['agent']; ?>
">
                  <?php endif; ?>
                  <select id="t_agent_a" name="t_agent_a" onChange="changeClientFrom(this,this.form.t_about,'t_agent_p');changeAboutInput(this.form.t_about.value,this.form.t_aboutTxt)" <?php if ($this->_tpl_vars['ugs']['b_suba']['v'] == 1 && $this->_tpl_vars['ugs']['b_suba']['m'] == 0 && ( $this->_tpl_vars['cid'] > 0 || $this->_tpl_vars['ugs']['b_suba']['i'] == 0 )): ?> disabled <?php endif; ?>>
                  <option value="0">chose a global assistant</option>
                  <?php $_from = $this->_tpl_vars['agent_ambassador']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ag_id'] => $this->_tpl_vars['v']):
?>
                      <option value="<?php echo $this->_tpl_vars['ag_id']; ?>
" <?php if ($this->_tpl_vars['ag_id'] == $this->_tpl_vars['arr']['agent']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['v']['name']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                  

                  </select>
                </td>
              </tr> 
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Where do you know about us:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar，Passby, Friends, other-->
                <select name="t_about" onChange="changeAboutInput(this.value,this.form.t_aboutTxt);">
                  <option value="" selected >Others</option>
                  <?php $_from = $this->_tpl_vars['clientfroms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name']):
?>
                      <option value="<?php echo $this->_tpl_vars['name']; ?>
" <?php if ($this->_tpl_vars['arr']['about'] == $this->_tpl_vars['name']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>          
                </select>
                <input type="text" name="t_aboutTxt"value="<?php echo $this->_tpl_vars['arr']['about']; ?>
" <?php if ($this->_tpl_vars['aboutinput'] == 1): ?> disabled  style="visibility:hidden"<?php endif; ?>>        </td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Activated Membership:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar，Passby, Friends, other-->
                    <select name="t_actm" >
                      <option value="" <?php if ($this->_tpl_vars['arr']['actm'] == ""): ?> selected <?php endif; ?>>--</option>
                      <option value="ct" <?php if ($this->_tpl_vars['arr']['actm'] == 'ct'): ?> selected <?php endif; ?>> Client testimonail</option>
                      <option value="fb" <?php if ($this->_tpl_vars['arr']['actm'] == 'fb'): ?> selected <?php endif; ?>> Facebook</option>       
                    </select>
                    <input type="text" id='t_d_actm' name="t_d_actm" value="<?php echo $this->_tpl_vars['arr']['d_actm']; ?>
" size="30">
                </td>
              </tr>     
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Do You have an Australian bank account:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar，Passby, Friends, other-->
                    <select name="t_bank" >
                      <option value="" <?php if ($this->_tpl_vars['arr']['bank'] == ""): ?> selected <?php endif; ?>> --</option>
                      <option value="nab" <?php if ($this->_tpl_vars['arr']['bank'] == 'nab'): ?> selected <?php endif; ?>> NAB</option>
                      <option value="cba" <?php if ($this->_tpl_vars['arr']['bank'] == 'cba'): ?> selected <?php endif; ?>> CBA</option>  
                      <option value="wetspac" <?php if ($this->_tpl_vars['arr']['bank'] == 'wetspac'): ?> selected <?php endif; ?>> Wetspac</option>
                      <option value="anz" <?php if ($this->_tpl_vars['arr']['bank'] == 'anz'): ?> selected <?php endif; ?>> ANZ</option>
                      <option value="stgeorge" <?php if ($this->_tpl_vars['arr']['bank'] == 'stgeorge'): ?> selected <?php endif; ?>> StGeorge</option>   
                      <option value="other" <?php if ($this->_tpl_vars['arr']['bank'] == 'other'): ?> selected <?php endif; ?>> Others</option>               
                    </select>
                </td>
              </tr>  
          </table>
      </td>
      <td width="30%" valign="top">
          <strong>Notes:</strong><br/>
          <textarea style="width:100%; height:800px;" name="t_note"><?php echo $this->_tpl_vars['arr']['note']; ?>
</textarea>
      </td>
    </tr>    
     
    <tr class="greybg">
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
<?php echo '
<script type="text/javascript">
	 function changeClientFrom(obj1,obj2,obj_id){
		if(obj1.value>0){
			obj2.value=\'SubAgent\';
		}
    $(\'#\'+obj_id).val(0);
	 }
	 
	 function changeAboutInput(str,obj1){
	 	if(str == \'\'){
			obj1.disabled = false;
			obj1.style.visibility="visible";
		}
		else{
			obj1.disabled = true;
			obj1.style.visibility="hidden";		
		}
	 }
	$(\'#t_sign\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$(\'#t_epdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$(\'#t_dob\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
  $(\'#t_d_actm\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
'; ?>
	
</body>
</html>