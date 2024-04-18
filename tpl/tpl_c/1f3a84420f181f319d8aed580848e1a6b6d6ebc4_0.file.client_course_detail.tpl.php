<?php
/* Smarty version 4.3.2, created on 2023-09-10 20:40:41
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64fdb94923b057_52008544',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f3a84420f181f319d8aed580848e1a6b6d6ebc4' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_detail.tpl',
      1 => 1694349632,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64fdb94923b057_52008544 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/modifier.capitalize.php','function'=>'smarty_modifier_capitalize',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 language="javascript"><?php echo $_smarty_tpl->tpl_vars['msg_alert']->value;
echo '</script'; ?>
>
<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return isDelete()">
  <input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
  <input type="hidden" name="courseid" value="<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
">
  <input type="hidden" name="isChange" value="0">
  <table border="0" width="100%" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
          <tr align="center"  class="greybg">
            <input type="hidden" name="bt_name" value="">
            <td align="left"  width="31%"><input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;" <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>>
              &nbsp;&nbsp;&nbsp;
              <input name="button" type="button" style="font-weight:bold" onClick="window.open('attachment.php?item=<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=' + screen.width*6/7 +',height='+screen.height*4/7)" value="Attachment">
            </td>
            <td width="49%" align="center" class="whitetext">Apply Course Detail</td>
            <td align="right"  width="20%"><input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;"  <?php if ($_smarty_tpl->tpl_vars['isapprove']->value == 0) {?> disabled <?php }?>>
            </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"  class="greybg" >
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_course.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"><span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span></td>
    </tr>
    <tr>
      <td width="45%" style="vertical-align: top;">
        <table border="0" width="100%" cellpadding="3" cellspacing="1">
          <tr>
            <td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Status:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="done" style=" font-weight:bold;color:#FF0000" onChange="this.form.t_key.focus();refuse(this.value,'rf', 't_rf')">
                <option value="0" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['active'] == 0) {?> selected <?php }?>>N/A</option>
                <option value="1" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['active'] == 1) {?> selected <?php }?>>Active</option>
                <option value="2" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['active'] == 2) {?> selected <?php }?>>Refused</option>
              </select>
            </td>
          </tr>
          <tr id="rf" style="<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['active'] != 2) {?>display:none;<?php }?>">
            <td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Refuse Reason:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%"  class="roweven"><textarea name="t_rf" style="width:300px; height:100px " <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['active'] != 2) {?>disabled<?php }?>><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['refuse'];?>
</textarea>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Consultant:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
             <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['m'] == 1 || ($_smarty_tpl->tpl_vars['dt_arr']->value['consultant'] == 0 && $_smarty_tpl->tpl_vars['ugs']->value['c_user']['i'] == 1)) {?>
                <select name="t_consultant">      
                  <option value="0" selected>choose a consultant</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'user_name', false, 'uid');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['uid']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['consultant'] == $_smarty_tpl->tpl_vars['uid']->value || ($_smarty_tpl->tpl_vars['dt_arr']->value['consultant'] == 0 && $_smarty_tpl->tpl_vars['user_id']->value == $_smarty_tpl->tpl_vars['uid']->value)) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
              <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 1) {?>
                  <?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['consultant']];?>

                <?php }?>
                <input type="hidden" name="t_consultant" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['consultant'];?>
">
              <?php }?>
            </td>
          </tr>    
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Paperwork:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
                <select name="t_paperwork">      
                  <option value="0" selected>choose a paperwork</option>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paperwork_arr']->value, 'user_name', false, 'uid');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['uid']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['paperwork'] == $_smarty_tpl->tpl_vars['uid']->value || ($_smarty_tpl->tpl_vars['dt_arr']->value['paperwork'] == 0 && $_smarty_tpl->tpl_vars['user_id']->value == $_smarty_tpl->tpl_vars['uid']->value)) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </td>
          </tr>   
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Consultant Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">

              <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['m'] == 1 || (($_smarty_tpl->tpl_vars['dt_arr']->value['consultant_date'] == '' || $_smarty_tpl->tpl_vars['dt_arr']->value['consultant_date'] == '0000-00-00') && $_smarty_tpl->tpl_vars['ugs']->value['c_user']['i'] == 1)) {?>
                <input type="text" name="t_consultant_date" id="t_consultant_date" onchange="audit_date(this)"  value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['consultant_date'];?>
">
              <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 1) {?>
                  <?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['consultant_date'];?>

                <?php }?>
                <input type="hidden" name="t_consultant_date" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['consultant_date'];?>
">
              <?php }?>
            </td>
          </tr>                
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Category Of Institute:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_cate" onChange="this.form.isChange.value=1;this.form.submit();">
                
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cate_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                                        	
                <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['catid']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                
										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										<?php if (!array_key_exists($_smarty_tpl->tpl_vars['dt_arr']->value['catid'],$_smarty_tpl->tpl_vars['cate_arr']->value)) {?>
                <option value="0" selected>choose category</option>
                <?php }?>
                                      
              </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Institute:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_school" onChange="this.form.isChange.value=1;this.form.submit();">
                
									  
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sc_arr']->value, 'sc_name', false, 'sc_id');
$_smarty_tpl->tpl_vars['sc_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sc_id']->value => $_smarty_tpl->tpl_vars['sc_name']->value) {
$_smarty_tpl->tpl_vars['sc_name']->do_else = false;
?>
                                        	
									  
                <option value="<?php echo $_smarty_tpl->tpl_vars['sc_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['sc_id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['iid']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['sc_name']->value;?>
</option>
                
									  
										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										<?php if (!array_key_exists($_smarty_tpl->tpl_vars['dt_arr']->value['iid'],$_smarty_tpl->tpl_vars['sc_arr']->value)) {?>
									  
                <option value="0" selected>choose institute</option>
                
									  <?php }?>
                                      
									  
              </select>
              <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['v'] == 1) {?>
              &nbsp;&nbsp;&nbsp;
              <input type="button" style="font-weight:bold" value="Commission" onClick="window.open('institute_comm.php?sid=<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['iid'];?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*6/7 +',height=' + screen.height*4/7)">
              <?php }?> </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_qual" onChange="this.form.isChange.value=1;this.form.submit();">
                
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['qual_arr']->value, 'qual', false, 'id');
$_smarty_tpl->tpl_vars['qual']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['qual']->value) {
$_smarty_tpl->tpl_vars['qual']->do_else = false;
?>
											
                <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['qual']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['qual']->value;?>
</option>
                
										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										<?php if (!array_key_exists($_smarty_tpl->tpl_vars['dt_arr']->value['qual'],$_smarty_tpl->tpl_vars['qual_arr']->value)) {?>
                <option value="0" selected>choose qualification</option>
                <?php }?>
										
              </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_major" onChange="this.form.t_key.focus();">
                
										  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['major_arr']->value, 'major', false, 'id');
$_smarty_tpl->tpl_vars['major']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['major']->value) {
$_smarty_tpl->tpl_vars['major']->do_else = false;
?>	
	                                      	
                <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['major']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['major']->value;?>
</option>
                
										  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										  <?php if (!array_key_exists($_smarty_tpl->tpl_vars['dt_arr']->value['major'],$_smarty_tpl->tpl_vars['major_arr']->value)) {?>
                <option value="0" selected>choose major</option>
                <?php }?>
	                                    
              </select>
            </td>
            </tr>
           <tr>
            <td width="28%" align="left"class="rowodd"><strong>Course Completed:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              <select name="t_completed" onChange="this.form.t_key.focus();">
                  <option value="YES" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['completed'] == 'YES') {?> selected <?php }?>>YES</option>
                  <option value="NO" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['completed'] == 'NO' || $_smarty_tpl->tpl_vars['dt_arr']->value['cpmpleted'] == '') {?> selected <?php }?>>NO</option>                                        
              </select>
            </td>
          </tr>

          </tr>
          <?php if ($_smarty_tpl->tpl_vars['courseid']->value > 0) {?>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Verify Migration Agents:</strong></td>
            <td align="left" width="72%" class="roweven">
              <select name="t_vma">
                  <option value="0">choose an agent</option>  
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agent_users']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?> 
                      <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['vma']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                
              </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Verify Migration Result:</strong></td>
            <td align="left" width="72%" class="roweven">
              <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['vma'] == $_smarty_tpl->tpl_vars['user_id']->value) {?>
                <select name="t_vms">
                      <option value="none" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['vms'] == "none") {?> selected <?php }?>>n/a</option> 
                      <option value="yes" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['vms'] == "yes") {?> selected <?php }?>>Yes</option> 
                      <option value="no" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['vms'] == "no") {?> selected <?php }?>>No</option>   
                </select>
              <?php } else { ?>
                <input type="hidden" name="t_vms" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['vms'];?>
">
                <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['dt_arr']->value['vms']);?>

              <?php }?>
            </td>
          </tr>
          <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_tta']['v'] == 1) {?>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>To top-agent :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_tta']['i'] == 1 || $_smarty_tpl->tpl_vars['ugs']->value['i_tta']['m'] == 1) {?>
               <select name="t_agent" onChange="this.form.t_key.focus();">
                <option value="0" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['agent'] == 0 || $_smarty_tpl->tpl_vars['dt_arr']->value['agent'] == '') {?>selected<?php }?>>N/A</option>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agent_arr']->value, 'ag_name', false, 'ag_id');
$_smarty_tpl->tpl_vars['ag_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ag_id']->value => $_smarty_tpl->tpl_vars['ag_name']->value) {
$_smarty_tpl->tpl_vars['ag_name']->do_else = false;
?>                        
                  <option value="<?php echo $_smarty_tpl->tpl_vars['ag_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['ag_id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['agent']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['ag_name']->value;?>
</option>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>
              <?php } else { ?>
                <input type="hidden" name="t_agent" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['agent'];?>
">
                <?php echo $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['dt_arr']->value['agent']];?>

              <?php }?>
            </td>
          </tr>
          <?php } else { ?>
            <input type="hidden" name="t_agent" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['agent'];?>
">
          <?php }?>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Course Start Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_fdate" id="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['start'];?>
" size="30" >
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd" ><strong>Course Complete Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_tdate" id="t_tdate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['end'];?>
" size="30" >
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Tution Fee:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_fee" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['fee'];?>
" size="30" onChange="audit_money(this)"></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Collect Document Due Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_apodue"  id="t_apodue" value="<?php echo $_smarty_tpl->tpl_vars['apodue']->value;?>
" size="30" >
            </td>
          </tr>          
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Duration:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_due" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['due'];?>
" size="10" onChange="audit_number(this)">
              &nbsp;&nbsp;
              <select name="t_unit" onChange="this.form.t_appfee.focus();">
                <option value="year" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['unit'] == 'year') {?> selected <?php }?>>year</option>
                <option value="month" <?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['unit'] == 'month') {?> selected <?php }?>>month</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong style="color:red">StudentID :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_studentid" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['studentid'];?>
" size="30"></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Apply Fee :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_appfee" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['appfee'];?>
" size="30" onChange="audit_money(this)"></td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>To Us Date :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_tusdate" id="t_tusdate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['tusdate'];?>
" size="30">          
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>To School Date :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_tsdate" id="t_tsdate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['tsdate'];?>
" size="30" >                      
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Method :</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_method" onChange="this.form.t_key.focus()">
                
										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['method_arr']->value, 'method', false, 'id');
$_smarty_tpl->tpl_vars['method']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['method']->value) {
$_smarty_tpl->tpl_vars['method']->do_else = false;
?>
											
                <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['method']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['method']->value;?>
</option>
                
										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										<?php if ($_smarty_tpl->tpl_vars['dt_arr']->value['method'] < 1) {?>
                <option value="0" selected>select a method</option>
                <?php }?>
										
              </select>
              <span style="text-decoration:underline; color:#0000CC; cursor:pointer; font-weight:bold" onClick="window.open('course_method.php','alwaysRaised=yes,resizable=yes,scrollbars=yes,width=300,height=300')">Add new method</span> </td>
          </tr>
          <tr>
            <td align="left" colspan="2" class="roweven">
              <strong>Key Point:</strong><br/>
              <textarea name="t_key" style="width:100%; height:600px; "><?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['key'];?>
</textarea>
            </td>
          </tr>
      </table>
      </form>
      </td>
    <td width="55%" align="left" valign="top">
        <div style="width:100%;overflow-X:auto; overflow-Y:auto;"> 
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr class="bordered_2">
                <td colspan="3" class="whitetext" align="center">Process</td>
              </tr>
              <tr align="center" class="totalrowodd">
                <td class="border_1" width="26%">Date</td>
                <td class="border_1" width="67%">Subject</td>
                <td class="border_1" width="7%">Insert</td>
              </tr>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['process_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
              <tr align="left" class="roweven">
                <td class="border_1" nowrap="nowrap"><span style="font-size:16px;font-weight:bolder; color:#990000"><?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?>&radic;<?php } else { ?>?<?php }?></span> <?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
 </td>
                <td class="border_1" onClick="window.open('client_course_process.php?courseid=<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"><span style="cursor:pointer; text-decoration:underline;"><?php if ($_smarty_tpl->tpl_vars['arr']->value['subject'] == 0) {
echo $_smarty_tpl->tpl_vars['arr']->value['add'];
} else {
if ($_smarty_tpl->tpl_vars['arr']->value['auto'] == 1) {?>AUTO:<?php }
echo $_smarty_tpl->tpl_vars['item_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['subject']]['name'];
}?></span></td>
                <td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_course_process.php?courseid=<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&isOther=1', '_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"></td>
              </tr>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <tr>
              <td colspan="3"><hr></td>
            </tr>
            </table>
        </div>
        <hr/>
        <?php if ($_smarty_tpl->tpl_vars['show_checklist']->value == 1) {?> 
        <div style="width:100%;overflow-X:auto; overflow-Y:auto;">
          <span id="cl_msg"></span>
          <form method="posts" id="form_checklists" name="form_checklists" action="/scripts/checklist_ajax.php"> 
            <input type="hidden" name="cl_act" id="cl_act" value="">
            <input type="hidden" name="cl_typ" id="cl_typ" value="course">
            <input type="hidden" name="cl_appid" id="cl_appid" value="<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
">
            <input type="hidden" name="cl_tplid" id="cl_tplid" value="1">
          </form>
        </div>
        <?php }?>
       </td>      
    </tr>
    <tr>
      <td colspan="2" class="greybg">&nbsp;</td>
    </tr>
  </table>

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});
	$('#t_apodue').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});	
	$('#t_tusdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
	$('#t_tsdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });	
  $('#t_consultant_date').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true }); 

	function do_checklist(act){
		$('#cl_act').val(act);
		$('#cl_msg').html('loading...');
		$.post($('#form_checklists').attr('action'), $('#form_checklists').serialize(), function(data){
			$('#form_checklists').html(data);
			$('#cl_msg').html('');
		});	
	}
  do_checklist('');
<?php echo '</script'; ?>
>
	
<?php }
}
