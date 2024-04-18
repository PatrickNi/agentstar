<?php
/* Smarty version 4.3.2, created on 2023-12-28 17:44:48
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_658d43909a5d31_93324103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f47c885b5559369648a4129cdd0fbfb94abd30c0' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_detail.tpl',
      1 => 1703756663,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:style.tpl' => 1,
  ),
),false)) {
function content_658d43909a5d31_93324103 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

<?php $_smarty_tpl->_subTemplateRender("file:style.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body <?php echo $_smarty_tpl->tpl_vars['forbid_sl']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['forbid_cp']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['forbid_rc']->value;?>
>
<form name="form1" action="" target="_self" method="get" onSubmit="return isDelete()">
  <input type="hidden" name="cid" id="client_id" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
  <input type="hidden" name="visaChange" value="0">
  <table align="center" width="100%"  class="graybordertable" cellspacing="1" cellpadding="1" border="0">
    <tr align="left"  class="bordered_2">
      <td colspan="2"> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
        <input name="button" type="button" disabled style="font-weight:bold;" onClick="javascript:this.form.action='client_detail.php';this.form.submit();" value="Client Detail">
        <input name="button2" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_qual.php';this.form.submit();" value="EDU Background">
        &nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();" value="Working experience">
        &nbsp;&nbsp;
        <input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">
        &nbsp;&nbsp;
        <?php }?>
        <?php if (in_array('study',$_smarty_tpl->tpl_vars['client_type']->value) && $_smarty_tpl->tpl_vars['ugs']->value['c_service']['v'] == 1) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        <?php }?> 
        <?php if (in_array('immi',$_smarty_tpl->tpl_vars['client_type']->value) && $_smarty_tpl->tpl_vars['ugs']->value['v_service']['v'] == 1) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        <?php }?> 
        <?php if (in_array('coach',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service">
        &nbsp;
        <?php }?>
        <?php if (in_array('homeloan',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        <?php }?>
        <?php if (in_array('legal',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_legal.php';this.form.submit();" value="Legal Service">
        &nbsp;&nbsp; 
        <?php }?>  
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coupon.php';this.form.submit();" value="Coupons">
        &nbsp;&nbsp;
      </td>
    </tr>
    <tr>
      <td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
          <tr align="center"  class="greybg" >
            <input type="hidden" name="bt_name" value="">
            <td align="left" width="10%"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['d'] == 1) {?>
              <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">
              <?php }?></td>
            <td class="whitetext" align="center">Client Detail</td>
            <td align="right" width="10%">
            	<input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
            </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"  class="greybg" >
      <td align="left" colspan="2" style="font-size:16px "><span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['arr']->value['dob'];?>
</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['arr']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['arr']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['arr']->value['epdate'];?>
</span>&nbsp;&nbsp;             	
      <?php if ($_smarty_tpl->tpl_vars['arr']->value['status'] == 'new') {?>
	      <input type="submit" value="Approve From GEIC" style="font-weight:bold; color:#FF0000" onClick="this.form.bt_name.value='approved';this.disable=false;" >
      <?php }?>
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
                <td width="28%"  align="left" class="rowodd"><strong>Cryption Link:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                    <span id="cryption_link" style="background-color: yellow;"><?php echo $_smarty_tpl->tpl_vars['cryption_link']->value;?>
</span>&nbsp;&nbsp;&nbsp;
                    <button onclick="gen_crypt_link()">Generate</button>
                    <button onclick="expire_crypt_link()">Expired</button>
                </td>
              </tr>   
              <tr>
                <td colspan="2"><hr></td>
              </tr>    
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Current Visa type:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['i'] == 0)) {?>
                  <input type="hidden" name="t_visa" value="<?php echo $_smarty_tpl->tpl_vars['catid']->value;?>
">
                  <?php }?>
                  <select name="t_visa" onChange="this.form.visaChange.value=1;this.form.submit();" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['i'] == 0)) {?> disabled <?php }?>>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visa_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['catid']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  <?php if ($_smarty_tpl->tpl_vars['catid']->value == 0) {?>
                  <option value="0" selected>choose a category</option>
                  <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Current Visa subclass:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['i'] == 0)) {?>
                  <input type="hidden" name="t_class" value="<?php echo $_smarty_tpl->tpl_vars['classid']->value;?>
">
                  <?php }?>
                  <select name="t_class" onChange="this.form.t_epdate.focus();" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['i'] == 0)) {?> disabled <?php }?>>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaclass_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['classid']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  <?php if ($_smarty_tpl->tpl_vars['classid']->value == 0) {?>
                  <option value="0" selected>choose a subclass</option>
                  <?php }?>
                  </select>
                  &nbsp;
                  <input type="text" size="50" name="t_classtxt" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['classtxt'];?>
">
                  
                  </td>
              </tr>    
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Visa Expiry Date:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['i'] == 0)) {?>
                  <input type="hidden" name="t_epdate" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['epdate'];?>
">
                  <?php }?>
                  <input id='t_epdate' type="text" name="t_epdate" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['epdate'];?>
"  size="30" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_visa']['i'] == 0)) {?> disabled <?php }?>>
                 </td>
              </tr> 
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Consultant Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_staffname' type="text" name="t_staffname" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['staff_name'];?>
"  size="30">
                 </td>
              </tr>  
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat ID:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_id' type="text" name="t_wechat_id" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['wechatid'];?>
"  size="50">
                 </td>
              </tr> 
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat Linked Phone:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_phone' type="text" name="t_wechat_phone" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['wechatphone'];?>
"  size="50">
                 </td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Wechat Linked Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input id='t_wechat_email' type="text" name="t_wechat_email" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['wechatemail'];?>
"  size="50">
                 </td>
              </tr> 
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Country of passport:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><select name="t_country" onChange="this.form.t_sign.focus();">
                  
                    
                              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['country_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                                  
                    
                  <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['arr']->value['country']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                  
                    
                              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                              <?php if ($_smarty_tpl->tpl_vars['arr']->value['country'] < 1) {?>
                                
                    
                  <option value="0" selected>select a country</option>
                  
                    
                              <?php }?>
                          
                  
                </select>        &nbsp;&nbsp;&nbsp; <span style="cursor:pointer; font-weight:bolder; text-decoration:underline; color:#0066FF" onClick="window.open('/scripts/country.php','_blank', 'alwaysRaised=yes,height=300,width=300,location=no,scrollbars=yes')">add new country</span></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Input Date:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input type="text" id='t_sign' name="t_sign" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['sign'];?>
" size="30">
                </td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Last Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_lname" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
" size="30"></td>
              </tr>
              <tr>
                <td hwidth="28%"  align="left" class="rowodd"><strong>First Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_fname" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
" size="30"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Gender:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><select name="t_gender" onChange="this.form.t_dob.focus()">
                    <option value="F" <?php if ($_smarty_tpl->tpl_vars['arr']->value['gender'] == "F") {?> selected <?php }?>>Female</option>
                    <option value="M" <?php if ($_smarty_tpl->tpl_vars['arr']->value['gender'] == "M") {?> selected <?php }?>>Male</option>
                  </select></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>DoB:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                  <input type="text" id='t_dob' name="t_dob" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['dob'];?>
" size="30">
                </td>
              </tr>
              <tr>
                <td wwidth="28%"  align="left" class="rowodd"><strong>English Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_ename" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['ename'];?>
" size="30"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd" ><strong>Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_email" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['email'];?>
" size="60" onChange="audit_email(this.value);this.form.t_email.focus();">
                  <A HREF="mailto:<?php echo $_smarty_tpl->tpl_vars['arr']->value['email'];?>
">send mail</A></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Home Tel:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_tel" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['tel'];?>
" size="60"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Mobile:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_mobile" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['mobile'];?>
" size="60"></td>
              <tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Matrial Status:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven">
                        <select name="t_m" class="text">
                                <option value="married" <?php if ($_smarty_tpl->tpl_vars['arr']->value['married'] == 'married') {?> selected <?php }?> >���??(Married)</option>
                                <option value="divorce" <?php if ($_smarty_tpl->tpl_vars['arr']->value['married'] == 'divorce') {?> selected <?php }?>>���??(Divorce)</option>
                                <option value="never_married" <?php if ($_smarty_tpl->tpl_vars['arr']->value['married'] == 'never_married') {?> selected <?php }?>>δ��(Never Married)</option>
                                <option value="separated" <?php if ($_smarty_tpl->tpl_vars['arr']->value['married'] == 'separated') {?> selected <?php }?>>�־�(Separated)</option>
                                <option value="defacto" <?php if ($_smarty_tpl->tpl_vars['arr']->value['married'] == 'defacto') {?> selected <?php }?>>ͬ��(Defacto Relationship)</option>
                        </select>
                </td>
              <tr>    
                <td height="30" align="left" class="rowodd"><strong>Current residential addres:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" size="100" name="t_add" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['add'];?>
"></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Client Type:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_types']->value, 't', false, 'id');
$_smarty_tpl->tpl_vars['t']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->do_else = false;
?>
                      <input type="checkbox" name="t_type[]" value="<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['t']->value,$_smarty_tpl->tpl_vars['arr']->value['type'])) {?> checked <?php }?>><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&nbsp;&nbsp;
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  &nbsp;&nbsp;&nbsp; <?php if ($_smarty_tpl->tpl_vars['isDependant']->value) {?><span style="color:#FF0000">[Dependant]</span><?php }?> </td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Have contact Person:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="checkbox" name="t_c" value="1" onClick="has_contact(this.checked)" <?php if ($_smarty_tpl->tpl_vars['arr']->value['c_name'] != '') {?> checked <?php }?>></td>
              </tr>
              
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Contact Person Name:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_name" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['c_name'];?>
" size="30" <?php if ($_smarty_tpl->tpl_vars['arr']->value['c_name'] == '') {?> disabled <?php }?>></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Relationship to you:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input name="t_c_rtu" type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['c_rtu'];?>
" <?php if ($_smarty_tpl->tpl_vars['arr']->value['c_name'] == '') {?> disabled <?php }?>/>
              </tr>    
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Contact Home Tel:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%"class="roweven"><input type="text" name="t_c_tel" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['c_tel'];?>
" size="30" <?php if ($_smarty_tpl->tpl_vars['arr']->value['c_name'] == '') {?> disabled <?php }?>></td>
              </tr>
              <tr>
                <td height="30" align="left" class="rowodd"><strong>Contact Mobile:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_mobile" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['c_mobile'];?>
" size="30" <?php if ($_smarty_tpl->tpl_vars['arr']->value['c_name'] == '') {?> disabled <?php }?>></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Contact Email:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" name="t_c_email" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['c_email'];?>
" size="30" onChange="audit_email(this.value)" <?php if ($_smarty_tpl->tpl_vars['arr']->value['c_name'] == '') {?> disabled <?php }?>></td>
              </tr>
              <tr>
                <td width="28%" align="left" class="rowodd"><strong>Contact Address:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><input type="text" size="50" name="t_c_add" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['c_add'];?>
" <?php if ($_smarty_tpl->tpl_vars['arr']->value['c_name'] == '') {?> disabled <?php }?>></td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Where do you know about us:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar��Passby, Friends, other-->
                <select name="t_about" onChange="changeAboutInput(this.value,this.form.t_aboutTxt);">
                  <option value="" selected >Others</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientfroms']->value, 'name');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['arr']->value['about'] == $_smarty_tpl->tpl_vars['name']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>          
                </select>
                <input type="text" name="t_aboutTxt"value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['about'];?>
" <?php if ($_smarty_tpl->tpl_vars['aboutinput']->value == 1) {?> disabled  style="visibility:hidden"<?php }?>>        </td>
              </tr>

              <tr id="tr_gp" <?php if ($_smarty_tpl->tpl_vars['arr']->value['about'] != 'Global Partner') {?>style="visibility:collapse"<?php }?>>
                <td width="28%" align="left" class="rowodd"><strong>Global Partner:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_suba']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_suba']['i'] == 0)) {?>
                      <input type="hidden" name="t_agent_p" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['agent'];?>
">
                  <?php }?>
                  <select id="t_agent_p" name="t_agent_p" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_suba']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_suba']['i'] == 0)) {?> disabled <?php }?>>
                    <option value="0">choose a Global Partner</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agent_partner']->value, 'v', false, 'ag_id');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ag_id']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['ag_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['ag_id']->value == $_smarty_tpl->tpl_vars['arr']->value['agent']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    
                  </select>
                </td>
              </tr>    
              <tr  id="tr_ab" <?php if ($_smarty_tpl->tpl_vars['arr']->value['about'] != 'Ambassador') {?>style="visibility:collapse"<?php }?>>
                <td width="28%" align="left" class="rowodd"><strong>Ambassador:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"> 
                  <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['b_suba']['m'] == 0 && ($_smarty_tpl->tpl_vars['cid']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['b_suba']['i'] == 0)) {?>
                      <input type="hidden" name="t_agent_a" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['agent'];?>
">
                  <?php }?>
                  <select id="t_agent_a" name="t_agent_a"<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['v'] == 0 || ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['m'] == 0 && $_smarty_tpl->tpl_vars['cid']->value > 0) || ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['i'] == 0 && $_smarty_tpl->tpl_vars['cid']->value == 0)) {?> disabled <?php }?>>
                  <option value="0">choose an Ambassador</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agent_ambassador']->value, 'v', false, 'ag_id');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ag_id']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['ag_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['ag_id']->value == $_smarty_tpl->tpl_vars['arr']->value['agent']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
                </td>
              </tr> 
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Activated Membership:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar��Passby, Friends, other-->
                    <select name="t_actm" >
                      <option value="" <?php if ($_smarty_tpl->tpl_vars['arr']->value['actm'] == '') {?> selected <?php }?>>--</option>
                      <option value="ct" <?php if ($_smarty_tpl->tpl_vars['arr']->value['actm'] == "ct") {?> selected <?php }?>> Client testimonoial</option>
                      <option value="fb" <?php if ($_smarty_tpl->tpl_vars['arr']->value['actm'] == "fb") {?> selected <?php }?>> Facebook</option>
                      <option value="gr" <?php if ($_smarty_tpl->tpl_vars['arr']->value['actm'] == "gr") {?> selected <?php }?>> Google review</option>      
                    </select>
                    <input type="text" id='t_d_actm' name="t_d_actm" value="<?php echo $_smarty_tpl->tpl_vars['arr']->value['d_actm'];?>
" size="30">
                </td>
              </tr>     
              <tr>
                <td width="28%"  align="left" class="rowodd"><strong>Do You have an Australian bank account:</strong>&nbsp;&nbsp;</td>
                <td align="left" width="72%" class="roweven"><!--internet, Australian Newspaper,Education Seminar��Passby, Friends, other-->
                    <select name="t_bank" >
                      <option value="" <?php if ($_smarty_tpl->tpl_vars['arr']->value['bank'] == '') {?> selected <?php }?>> --</option>
                      <option value="nab" <?php if ($_smarty_tpl->tpl_vars['arr']->value['bank'] == "nab") {?> selected <?php }?>> NAB</option>
                      <option value="cba" <?php if ($_smarty_tpl->tpl_vars['arr']->value['bank'] == "cba") {?> selected <?php }?>> CBA</option>  
                      <option value="wetspac" <?php if ($_smarty_tpl->tpl_vars['arr']->value['bank'] == "wetspac") {?> selected <?php }?>> Wetspac</option>
                      <option value="anz" <?php if ($_smarty_tpl->tpl_vars['arr']->value['bank'] == "anz") {?> selected <?php }?>> ANZ</option>
                      <option value="stgeorge" <?php if ($_smarty_tpl->tpl_vars['arr']->value['bank'] == "stgeorge") {?> selected <?php }?>> StGeorge</option>   
                      <option value="other" <?php if ($_smarty_tpl->tpl_vars['arr']->value['bank'] == "other") {?> selected <?php }?>> Others</option>               
                    </select>
                </td>
              </tr>  
          </table>
      </td>
      <td width="30%" valign="top">
          <strong>Notes:</strong><br/>
          <textarea style="width:100%; height:600px;" name="t_note"><?php echo $_smarty_tpl->tpl_vars['arr']->value['note'];?>
</textarea>
          <p></p>
          <strong>Customer Notes:</strong><br/>
          <textarea style="width:100%; height:200px;" name="t_cus_note"><?php echo $_smarty_tpl->tpl_vars['arr']->value['cus_note'];?>
</textarea>
      </td>
    </tr>    
     
    <tr class="greybg">
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>

<?php echo '<script'; ?>
 type="text/javascript">
	 function changeClientFrom(obj1,obj2,obj_id){
		if(obj1.value>0){
			obj2.value='SubAgent';
		}
    $('#'+obj_id).val(0);
	 }
	 
	 function changeAboutInput(str,obj1){
	 	if(str == ''){
			obj1.disabled = false;
			obj1.style.visibility="visible";
		}
    else if(str == 'Global Partner') {
      $('#tr_gp').css('visibility','visible');
      $('#tr_ab').css('visibility','collapse');
    }
    else if(str == "Ambassador") {
      $('#tr_ab').css('visibility','visible');
      $('#tr_gp').css('visibility','collapse');
    }
		else{
			obj1.disabled = true;
			obj1.style.visibility="hidden";		
		}
	 }
	$('#t_sign').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_epdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$('#t_dob').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
  $('#t_d_actm').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

  function gen_crypt_link() {
    $.post('/scripts/client_detail.php', 'crypt_link=gen&cid='+$('#client_id').val(), function(data){
            rtn = $.parseJSON(data);
            if (rtn.succ != 0) {
                $('#cryption_link').html(rtn.link);
            }
            else {
                alert("Generate cryption link failed!");
            }
        });
  }

  function expire_crypt_link() {
    $.post('/scripts/client_detail.php', 'crypt_link=expire&cid='+$('#client_id').val(), function(data){
            rtn = $.parseJSON(data);
            if (rtn.succ != 0) {
                $('#cryption_link').html('');
            }
            else {
                alert("Expired cryption link failed!");
            }
        });
  }
<?php echo '</script'; ?>
>
	
</body>
</html>
<?php }
}
