<?php
/* Smarty version 4.3.2, created on 2023-11-22 14:29:00
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d9facd5b5a3_48575903',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe0b74225bce74ae55b0ecda97f4464a417f8f6e' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute.tpl',
      1 => 1593145110,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d9facd5b5a3_48575903 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/function.cycle.php','function'=>'smarty_function_cycle',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Institute Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/RolloverTable.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript"><?php echo $_smarty_tpl->tpl_vars['msg']->value;
echo '</script'; ?>
>
<body>
<form action=""  target="_self" method="POST" name="form1">
  <table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
    <tr >
      <td colspan="8" align="center"  class="bordered_2"><table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="6"  align="left" >
            	<input type="button" value="Add New Institute" style="font-weight:bold;" onClick="javascrtipt:this.form.action='institute_detail.php';this.form.submit();">
                <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_export']['v'] == 1) {?>
                 &nbsp;&nbsp;
                <input type="submit" name="qSubmit" value="Export all staff email" style="font-weight:bold;">
                <?php }?>
              	&nbsp;&nbsp;&nbsp;                    
                <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
            </td>
            <td colspan="3" align="right">
              <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_st']['v'] == 1) {?>
                <input type="checkbox" name="show_static" value="1" <?php if ($_smarty_tpl->tpl_vars['show_static']->value == 1) {?>checked<?php }?>>show static&nbsp;&nbsp;
              <?php }?>  
              <strong>[First semester start date]</strong>&nbsp;&nbsp; <strong>From: &nbsp;</strong>
              <input type="text"	 name="t_fdate" id="t_fdate" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
">
              
              &nbsp;&nbsp; <strong>To: &nbsp;</strong>
              <input type="text"	 name="t_tdate" value="<?php echo $_smarty_tpl->tpl_vars['to']->value;?>
" id="t_tdate">
               
              &nbsp;&nbsp;
              <input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
            </td>
          </tr>
        </table></td>
    </tr>
    <tr class="totalrowodd">
      <!--<td width="2%"  align="center"><input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>-->
      <td width="30%" align="left" class="border_1" nowrap="nowrap">Institute</td>
      <td width="10%" align="right" class="border_1">Agent Status</td>
      <td width="10%" align="right" class="border_1">Students<br/>
        (<?php echo $_smarty_tpl->tpl_vars['totals']->value['total'];?>
)</td>
      <td width="10%" align="right" class="border_1">Get Offers<br/>
        (<?php echo $_smarty_tpl->tpl_vars['totals']->value['offer'];?>
)</td>
      <td  width="10%" align="right" class="border_1">Get COEs<br/>
        (<?php echo $_smarty_tpl->tpl_vars['totals']->value['coe'];?>
)</td>
      <td  width="10%" align="right" class="border_1"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {?>Receivable comm<?php }?><br>
        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {?>(<?php echo $_smarty_tpl->tpl_vars['totals']->value['potrev'];?>
)<?php }?></td>
      <td  width="10%" align="right" class="border_1"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {?>Received Comm<?php }?><br>
        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {?>(<?php echo $_smarty_tpl->tpl_vars['totals']->value['redrev'];?>
)<?php }?></td>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category_arr']->value, 'v', false, 'catid');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['catid']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
    <tr class="border_1" style="background-color:<?php echo smarty_function_cycle(array('values'=>"#80FF80,#FFFF99,#CA95FF,#6C6CFF,#C78D8D,#7ABCBC"),$_smarty_tpl);?>
" colspan="2">
      <td align="left" colspan="2"><span style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['student'];?>
</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['offer'];?>
</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $_smarty_tpl->tpl_vars['v']->value['coe'];?>
</span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {
echo sprintf("%.2f",$_smarty_tpl->tpl_vars['v']->value['potrev']);
}?></span></td>
      <td align="right"><span style="font-size:14px; font-weight:bolder; font-style:italic"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {
echo sprintf("%.2f",$_smarty_tpl->tpl_vars['v']->value['redrev']);
}?></span></td>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['school_arr']->value[$_smarty_tpl->tpl_vars['catid']->value], 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
    <tr id="tr_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onMouseOut="roff(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" onMouseOver="ron(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);">
      <!--<td onClick="rowToggle(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" align="center" class="border_1"> <input type="checkbox" id="box_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onClick="toggleRow(this);" name="school[]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"> </td> -->
      <td align="left" class="border_1" nowrap="nowrap"><a href="<?php echo $_smarty_tpl->tpl_vars['redir_url']->value;
echo $_smarty_tpl->tpl_vars['id']->value;?>
" target="_self" style="color:#000000"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</a></td>
      <td align="right"class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['status'];?>
</td>
      <td align="right"class="border_1"><?php if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['num'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['num'];?>
 <?php } else { ?>0<?php }?></td>
      <td align="right"class="border_1"><?php if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['s2'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['s2'];?>
 <?php } else { ?>0<?php }?></td>
      <td align="right"class="border_1"><?php if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['s3'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['s3'];?>
 <?php } else { ?>0<?php }?></td>
      <td align="right"class="border_1"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {
if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['a1'] != '') {?> <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['a1']);?>
 <?php } else { ?>0.00<?php }
}?></td>
      <td align="right"class="border_1"><?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {
if ($_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['a2'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['stats']->value[$_smarty_tpl->tpl_vars['id']->value]['a2'];?>
 <?php } else { ?>0.00<?php }
}?></td>
    </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </table>
</form>

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
<?php echo '</script'; ?>
>
	
</body>
</html>
<?php }
}
