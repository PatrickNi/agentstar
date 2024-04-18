<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:26:17
  from '/data/wwwroot/agentstar.geic.com.au/tpl/agent_coach.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3c99737fe4_35694768',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f18df19e9c762238b2e5503b6d002f00e77a7639' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/agent_coach.tpl',
      1 => 1635373840,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3c99737fe4_35694768 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>Agent Star -Client Management</title>
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
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
">
<input type="hidden" name="is_amb" value="<?php echo $_smarty_tpl->tpl_vars['is_global_ambassador']->value;?>
">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1" >
	<tr align="left"  class="bordered_2">
	  <td colspan="8">
	  	<?php if ($_smarty_tpl->tpl_vars['is_global_ambassador']->value) {?>
			<span class="highyellow">Agent: <?php echo $_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['name'];?>
</span>&nbsp;&nbsp;
        </select>        
	  	<?php } else { ?>
	  		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='agent_add.php';this.form.submit();" value="Go back to the <?php if ($_smarty_tpl->tpl_vars['agent_arr']->value[$_smarty_tpl->tpl_vars['aid']->value]['cate'] == 'student') {?>assistant<?php } else { ?>agent<?php }?> detail">
			&nbsp;&nbsp;&nbsp;&nbsp;
	   		<input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
	  	<?php }?>
	  </td>
	</tr>
    <tr align="center" class="totalrowodd">
        <td class="border_1">Client</td>
        <td class="border_1">Course</td>
        <td class="border_1">Subject</td>
        <td class="border_1">Grade</td>
        <td class="border_1">Teacher</td>
        <td class="border_1">&nbsp;</td>
    </tr>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coach_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
    <tr align="center" class="roweven" >
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['cname'];?>
</td>
        <td class="border_1"><span style="cursor:pointer;" onClick="window.open('client_coach_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['cid'];?>
&coachid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">
        <?php $_smarty_tpl->_assignInScope('partnerid', $_smarty_tpl->tpl_vars['items_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['itemid']]['pid']);?>
        <?php echo $_smarty_tpl->tpl_vars['items_arr']->value[$_smarty_tpl->tpl_vars['partnerid']->value]['tit'];?>
&nbsp;&nbsp;</span></td>
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['items_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['itemid']]['tit'];?>
</td>
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['grade_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['grade']];?>
</td>
        <td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['staff']];?>
</td>
        <td class="border_1">&nbsp;</td>                       
    </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
</form>	
</body>
</html><?php }
}
