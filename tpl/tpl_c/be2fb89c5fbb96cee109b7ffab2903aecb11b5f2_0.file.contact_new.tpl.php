<?php
/* Smarty version 4.3.2, created on 2023-12-06 08:53:32
  from '/data/wwwroot/agentstar.geic.com.au/tpl/contact_new.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_656fc60c270236_96087500',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be2fb89c5fbb96cee109b7ffab2903aecb11b5f2' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/contact_new.tpl',
      1 => 1247462960,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_656fc60c270236_96087500 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="ctid" value="<?php echo $_smarty_tpl->tpl_vars['ctid']->value;?>
">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
	  <td colspan="2" align="center" style=" padding:5,5,5; font-size:12px; color:#FFFFFF">Other Contact&nbsp;&nbsp;
	  	<span onClick="openModel('contact_group.php', 400,260,'NO', 'form1')" style="color:#0000CC; cursor:pointer; font-weight:lighter">(add group)</span>
	  </td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table  border="0" cellpadding="1" cellspacing="1" width="100%">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contact_group_arr']->value, 'group', false, 'gid');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['gid']->value => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?> 
				<tr style="background-color:#BCB98F; font-weight:bold; ">
					<td  align="left" colspan="5">
						<span onClick="openModel('contact_group.php?gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
',400,260,'NO', 'form1')" style="color:#0000CC; cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</span>
						&nbsp;
						<span onClick="openModel('contact_info.php?gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
',600,500,'NO', 'form1')" style="color:#0000CC; cursor:pointer; font-weight:lighter">(add org.)</span>
					</td>
			  </tr>
				<tr align="left" class="totalrowodd" name="<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
">
					<td>Organization</td>
					<td width="20%" >Telphone</td>
					<td width="20%" >WebSite</td>
			  </tr>				
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contact_arr']->value[$_smarty_tpl->tpl_vars['gid']->value], 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<tr align="left" class="roweven" name="<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
">
					<td><span style="cursor:pointer;text-decoration:underline"onClick="openModel('contact_info.php?gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
&ctid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',600,600,'NO', 'form1')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['org'];?>
</span></td>
					<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['phone']) {
echo $_smarty_tpl->tpl_vars['arr']->value['phone'];
} else { ?>&nbsp;<?php }?></td>
					<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['web']) {
echo $_smarty_tpl->tpl_vars['arr']->value['web'];
} else { ?>&nbsp;<?php }?></td>
				</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
			</table>
		</td>
	</tr>
</table>
</form>	
<?php }
}
