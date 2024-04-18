<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:24:56
  from '/data/wwwroot/agentstar.geic.com.au/tpl/agent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3c48109861_05239015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6fbbb902893c5f022c1d2d2ab8d9fda13224b98' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/agent.tpl',
      1 => 1689415484,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3c48109861_05239015 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/function.cycle.php','function'=>'smarty_function_cycle',),1=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Institute</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<?php echo '<script'; ?>
 src="../js/jquery-1.9.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/jquery-ui-1.10.3.custom.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 language="javascript" src="../js/RolloverTable.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>

<body>
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
  <form action=""  target="_self" method="POST" name="form1">
    <input type="hidden" name="qflag" value="">
    <input type="hidden" name="status" value="">
    <tr  class="bordered_2" >

      <td colspan="11">
          <input type="hidden" name="t_form" value="<?php echo $_smarty_tpl->tpl_vars['form']->value;?>
" />
        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_top']['v'] == 1 && $_smarty_tpl->tpl_vars['form']->value == 'top') {?>
        <input type="button" value="Add Top-agent" onClick="javascript:this.form.status.value='top';this.form.action='agent_add.php';this.form.submit();" style="font-weight:bold;">
        &nbsp;&nbsp;
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['ap_d']['v'] == 1 && $_smarty_tpl->tpl_vars['form']->value == 'sub') {?>
        <input type="button" value="Add Partner" onClick="javascript:this.form.status.value='sub';this.form.action='agent_add.php';this.form.submit();" style="font-weight:bold;">
        &nbsp;&nbsp;
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_delpartner']['v'] == 1) {?>
        <input type="button" value="Remove" onClick="remove_confirm(this.form);" style="font-weight:bold;">
        <?php }?>	
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
      </td>
    </tr>
    <tr class="bordered_2">
      <td colspan="11" style="padding-top:10px"><strong>[First semester start date] From: &nbsp;</strong>
        <input type="text"	 id="t_fdate" name="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
"onChange="audit_date(this)">           
        &nbsp;&nbsp; <strong>To: &nbsp;</strong>
        <input type="text"	id="t_tdate"  name="t_tdate" value="<?php echo $_smarty_tpl->tpl_vars['to']->value;?>
" onChange="audit_date(this)">             
        &nbsp;&nbsp;
        <input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
        &nbsp;&nbsp;&nbsp;&nbsp;
       </td>
    </tr>
    <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_emailpartner']['v'] == 1) {?>
    <tr class="bordered_2">
      <td colspan="11" style="padding-top:10px">
          <input type="submit" value="Export Emails" name="bt_export" styple="font-weight:bold;">
          <strong>By:</strong>  
          <select name="t_cate">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['totals']->value, 'v', false, 'cateid');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cateid']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['cateid']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['n'];?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </select>
      </td>
    </tr>
    <?php } elseif ($_smarty_tpl->tpl_vars['form']->value == 'sub') {?>
      <input type="hidden" name="t_cate" value="education">
    <?php }?>
    <p/>
    <tr align="left" class="greybg">
      <td colspan="11" class="highyellow">Student: <?php echo $_smarty_tpl->tpl_vars['totals']->value['total'];?>
&nbsp;&nbsp;&nbsp;&nbsp;Offer: <?php echo $_smarty_tpl->tpl_vars['totals']->value['offer'];?>
&nbsp;&nbsp;&nbsp;&nbsp;Coe: <?php echo $_smarty_tpl->tpl_vars['totals']->value['coe'];?>
</td>
    </tr>      
    <tr class="totalrowodd">
      <td width="2%"  align="center" class="border_1"><input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>
      <td align="left" class="border_1" width="15%" nowrap="nowrap">Name</td>
      <td align="left" class="border_1" width="5%" nowrap="nowrap">Register</td>
      <td align="left" class="border_1" width="7%" nowrap="nowrap">City</td>
      <td align="left" class="border_1" width="10%" nowrap="nowrap">Country</td>
      <td align="left" class="border_1" width="5%" nowrap="nowrap">Status</td>
      <td align="left" class="border_1" width="5%" nowrap="nowrap">Studnets</td>
      <td align="right" class="border_1" width="5%" nowrap="nowrap">Offer Get</td>
      <td align="right"class="border_1" width="5%" nowrap="nowrap">COE</td>
      <?php if (($_smarty_tpl->tpl_vars['form']->value == 'top' && $_smarty_tpl->tpl_vars['ugs']->value['a_rev']['v'] == 1) || ($_smarty_tpl->tpl_vars['form']->value == 'sub' && $_smarty_tpl->tpl_vars['cate']->value == 'education' && $_smarty_tpl->tpl_vars['ugs']->value['ap_ppc']['v'] == 1) || ($_smarty_tpl->tpl_vars['form']->value == 'sub' && $_smarty_tpl->tpl_vars['cate']->value == 'student' && $_smarty_tpl->tpl_vars['ugs']->value['aa_ppc']['v'] == 1)) {?>
      <td align="right" class="border_1" width="7%" nowrap="nowrap">Receivable<br>Commossion</td>
      <td align="right" class="border_1" width="7%" nowrap="nowrap">Paid<br>Commossion</td>
      <?php } else { ?>
      <td align="right" class="border_1" width="7%" nowrap="nowrap"></td>
      <td align="right" class="border_1" width="7%" nowrap="nowrap"></td>
      <?php }?>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['totals']->value, 'v', false, 'catid');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['catid']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
    <tr class="border_1" style="background-color:<?php echo smarty_function_cycle(array('values'=>"#80FF80,#FFFF99,#CA95FF,#6C6CFF,#C78D8D,#7ABCBC"),$_smarty_tpl);?>
" colspan="2">
      <td align="center" class="border_1" colspan="6" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['n'];?>
</td>
      <td align="left" class="border_1"nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['s'];?>
</td>
      <td align="right" class="border_1" nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['o'];?>
</td>
      <td align="right"class="border_1"nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['c'];?>
</td>
      <?php if (($_smarty_tpl->tpl_vars['form']->value == 'top' && $_smarty_tpl->tpl_vars['ugs']->value['a_rev']['v'] == 1) || ($_smarty_tpl->tpl_vars['form']->value == 'sub' && $_smarty_tpl->tpl_vars['cate']->value == 'education' && $_smarty_tpl->tpl_vars['ugs']->value['ap_ppc']['v'] == 1) || ($_smarty_tpl->tpl_vars['form']->value == 'sub' && $_smarty_tpl->tpl_vars['cate']->value == 'student' && $_smarty_tpl->tpl_vars['ugs']->value['aa_ppc']['v'] == 1)) {?>
        <td align="right" class="border_1"  nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['rc']-sprintf("%.2f",$_smarty_tpl->tpl_vars['v']->value['pc']);?>
</td>
        <td align="right" class="border_1" nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['v']->value['pc']);?>
</td>
      <?php } else { ?>
        <td align="right" class="border_1"  nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"></td>
        <td align="right" class="border_1" nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"></td>
      <?php }?>
      
    </tr>    
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value['aid'], 'id');
$_smarty_tpl->tpl_vars['id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['id']->do_else = false;
?>
    <tr id="tr_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="<?php if ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['id']->value]['sn'] == 'New') {?>yellowbg<?php } else {
echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);
}?>">
      <td onClick="rowToggle(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" align="center" class="border_1"><input type="checkbox" id="box_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onClick="toggleRow(this);" name="agentId[]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
      </td>
      <!--<td align="center" class="border_1" nowrap="nowrap"><?php if ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['id']->value]['verify'] == 1) {?><span style="font-size:18px;font-weight: bolder; color: #FF0000">&radic;</span><?php } else { ?>&nbsp;&nbsp;<?php }?></td>-->
      <td align="left" class="border_1" nowrap="nowrap"><a href="agent_add.php?aid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" target="_self"><?php echo $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['id']->value]['name'];?>
</a></td>
      <td align="left"class="border_1" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['id']->value]['reg_d'];?>
</td>
      <td align="left"class="border_1" nowrap="nowrap"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['id']->value]['city'],15);?>
</td>
      <td align="left"class="border_1" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['id']->value]['cn'];?>
</td>
      <td align="left"class="border_1" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['id']->value]['sn'];?>
</td>
      <td align="left"class="border_1" nowrap="nowrap"><?php if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['stdcnt'] > 0) {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['stdcnt'];?>
 <?php } else { ?>0<?php }?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['offer'] > 0) {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['offer'];?>
 <?php } else { ?>0<?php }?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['coe'] > 0) {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['coe'];?>
 <?php } else { ?>0<?php }?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_rev']['v'] == 1) {
if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['coe'] > 0) {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['rcomm']-sprintf("%.2f",$_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['pcomm']);
} else { ?>0.00<?php }
}?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_rev']['v'] == 1) {
if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['coe'] > 0) {?> <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['pcomm']);?>
 <?php } else { ?>0.00<?php }
}?></td>
    </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <!--
   <tr >
   	<td align="right" colspan="6"><?php echo $_smarty_tpl->tpl_vars['page_url']->value;?>
</td>
   </tr>
   -->
  </form>
</table>


<?php echo '<script'; ?>
 type="text/javascript">
	function remove_confirm(form) {	
		if(confirm("Please confirm you want to remove")){form.qflag.value='remove';form.submit();}	
	}
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
<?php echo '</script'; ?>
>
	
</body>
</html>
<?php }
}
