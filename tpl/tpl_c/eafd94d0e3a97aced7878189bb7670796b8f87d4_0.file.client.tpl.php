<?php
/* Smarty version 4.3.2, created on 2023-12-28 19:31:40
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_658d5c9c1ad062_39909476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eafd94d0e3a97aced7878189bb7670796b8f87d4' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client.tpl',
      1 => 1703763092,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:style.tpl' => 1,
  ),
),false)) {
function content_658d5c9c1ad062_39909476 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/function.cycle.php','function'=>'smarty_function_cycle',),1=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/function.counter.php','function'=>'smarty_function_counter',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

<?php $_smarty_tpl->_subTemplateRender("file:style.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 language="javascript" src="../js/RolloverTable.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>

<body>
<form name="form1" target="_self" method="get">
  <table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
    <tr >
      <td colspan="9" align="center"  class="bordered_2"><table width="100%" cellpadding="1" cellspacing="1">
          <tr>
            <td colspan="4"  align="left" ><input type="button" value="Add New Client" style="font-weight:bold;" onClick="javascrtipt:this.form.action='client_detail.php';this.form.submit();">
              &nbsp;
              <!--<input type="submit" value="Delete" name="qSubmit" style="font-weight:bold;">	-->
              <?php if ($_smarty_tpl->tpl_vars['ugs']->value['export']['v'] == 1) {?>
              <input type="button" value="Export Client Emails" name="bt_export" style="font-weight:bold;" onClick="javascrtipt:this.form.submit();">
              <?php }?> </td>
            <td width="69%" colspan="4" align="right">
              <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_fromto']['v'] == 1) {?>
              <strong>From: &nbsp;</strong>
              <input type="text"	 name="t_fdate" id="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
" onChange="audit_date(this)">

              &nbsp;&nbsp; <strong>To: &nbsp;</strong>
              <input type="text"	 name="t_tdate" id="t_tdate"value="<?php echo $_smarty_tpl->tpl_vars['to']->value;?>
" onChange="audit_date(this)">
  
               <?php }?>              
              &nbsp;&nbsp;
              <select name="srchType">
                <option value="e" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'e') {?> selected <?php }?>>Full Name</option>
                <option value="l" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'l') {?> selected <?php }?>>Last Name</option>
                <option value="f" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'f') {?> selected <?php }?>>First Name</option>
                <option value="en" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'en') {?> selected <?php }?>>English Name</option>
                <option value="t" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 't') {?> selected <?php }?>>Client Type</option>
                <option value="m" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'm') {?> selected <?php }?>>Email</option>
                <option value="mobile" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'mobile') {?> selected <?php }?>>Mobile</option>
                <option value="c" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'c') {?> selected <?php }?>>Client Code</option>
                <option value="dob" <?php if ($_smarty_tpl->tpl_vars['srchtype']->value == 'dob') {?> selected <?php }?>>Dob</option>
              </select>
              &nbsp;&nbsp;
              <input type="text" name="srchTxt" size="20" value="<?php echo $_smarty_tpl->tpl_vars['srchtxt']->value;?>
">
             &nbsp;&nbsp;
              <input type='checkbox' name="is_geic" value="new" <?php if ($_smarty_tpl->tpl_vars['is_geic']->value == "new") {?> checked <?php }?>>From GEIC
              
              &nbsp;&nbsp;
              <input type="submit" value="Search" name="bt_name" id="bt_name" style="font-weight:bold;"></td>
          </tr>
        </table></td>
    </tr>
    <tr><td align="left" colspan="9" class="greybg">&nbsp;</td></tr>
    <tr>
      <td align="left" colspan="9" class="rowodd"><span class="highyellow"><?php echo $_smarty_tpl->tpl_vars['page_url']->value;?>
</span></td>
    </tr>
    <tr align="center" class="totalrowodd">
      <td width="10%">Input Date</td>
      <td width="15%">Last Name</td>
      <td width="15%">First Name</td>
      <td width="10%">English Name</td>
      <td width="10%">Gender</td>
      <td width="10%">DoB</td>
      <td>Client Type</td>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['client_arr']->value, 'arr', false, 'cid');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cid']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
    <tr class="<?php if ($_smarty_tpl->tpl_vars['arr']->value['status'] == 'new') {?>yellowbg<?php } else {
echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);
}?>">
      <td align="center" class="border_1" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['arr']->value['sign'];?>
</td>
      <td align="center" class="border_1"><a href="<?php echo ($_smarty_tpl->tpl_vars['redir_url']->value).($_smarty_tpl->tpl_vars['cid']->value);?>
" target="_self"><?php if ($_smarty_tpl->tpl_vars['arr']->value['lname'] != '') {
echo $_smarty_tpl->tpl_vars['arr']->value['lname'];
} else { ?>n/a<?php }?></a></td>
      <td align="center" class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</td>
      <td align="center" class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['ename'];?>
</td>
      <td align="center" class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['gender'];?>
</td>
      <td align="center" class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['dob'];?>
</td>
      <td align="center" class="border_1">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arr']->value['type'], 'typ', false, 'id');
$_smarty_tpl->tpl_vars['typ']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['typ']->value) {
$_smarty_tpl->tpl_vars['typ']->do_else = false;
?>
          <?php echo $_smarty_tpl->tpl_vars['typ']->value;?>
,&nbsp;
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </td>
    </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_abouts']['v'] == 1) {?>
    <tr><td align="left" colspan="9" class="greybg">&nbsp;</td></tr>
    <tr>
      <td align="left" colspan="9" class="greybg">
     	  <!--<?php echo smarty_function_counter(array('start'=>1,'assign'=>'no'),$_smarty_tpl);?>
-->
      	  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['abouts']->value['all'], 'num', false, 'id');
$_smarty_tpl->tpl_vars['num']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['num']->value) {
$_smarty_tpl->tpl_vars['num']->do_else = false;
?>
             <!--<?php echo smarty_function_counter(array('assign'=>'no'),$_smarty_tpl);?>

             <?php if ($_smarty_tpl->tpl_vars['no']->value%7 == 0) {?><p/><?php }?>-->
              <li>
                <span style="color:#000; font-weight:400"><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
:(<?php echo $_smarty_tpl->tpl_vars['num']->value/$_smarty_tpl->tpl_vars['totalabouts']->value*sprintf("%.2f",100);?>
%) &nbsp;&nbsp;</span>
                <?php if ($_smarty_tpl->tpl_vars['id']->value == 'Others') {?>
                	<ul>
	                <?php echo smarty_function_counter(array('start'=>1,'assign'=>'no'),$_smarty_tpl);?>

    	            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['abouts']->value['other'], 'num2', false, 'id2');
$_smarty_tpl->tpl_vars['num2']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id2']->value => $_smarty_tpl->tpl_vars['num2']->value) {
$_smarty_tpl->tpl_vars['num2']->do_else = false;
?>
               	        <?php echo smarty_function_counter(array('assign'=>'no'),$_smarty_tpl);?>

        	    	    <?php echo $_smarty_tpl->tpl_vars['id2']->value;?>
:(<?php echo sprintf("%.2f",($_smarty_tpl->tpl_vars['num2']->value/$_smarty_tpl->tpl_vars['num']->value*100));?>
%)&nbsp;&nbsp;
                        <?php if ($_smarty_tpl->tpl_vars['no']->value%7 == 0) {?><br/><?php }?> 
            	    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                <?php }?>
              </li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
 
         </td>
    </tr>
    <?php }?>
  </table>
</form>

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
  $('#bt_name').focus();
<?php echo '</script'; ?>
>
	
</body>
</html>

<?php }
}
