<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:33:46
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_cp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3e5a568b16_06309009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6aa2b3767f0ab8f1e0503fdcfe7c53c479863565' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_course_cp.tpl',
      1 => 1247462728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3e5a568b16_06309009 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/calendar.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return form_audit('form1')">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="courseid" value="<?php echo $_smarty_tpl->tpl_vars['course_id']->value;?>
">
<input type="hidden" name="hCancel" value="0">
<table align="center" class="graybordertable" width="100%">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:3 ">
			Client Apply Course </td>		
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp; <span class="highyellow">Type: <?php echo $_smarty_tpl->tpl_vars['client']->value['type'];?>
</span>&nbsp;&nbsp; </td>
	</tr>
		
	<tr>
		<td align="left" valign="top">
			<!--<fieldset>
			<legend class="green"><?php echo mb_strtoupper((string) $_smarty_tpl->tpl_vars['name']->value ?? '', 'UTF-8');?>
</legend>-->
			<div style="width:100%; overflow-X:scroll;">
			<table border="0" cellpadding="0" cellspacing="0" width="150%">
				<tr align="center" class="totalrowodd">
					<td class="border_1" width="10%">Institute</td>
					<td class="border_1" width="10%">Qualification</td>
					<td class="border_1" width="10%">Major</td>							
					<td class="border_1" width="7%">Course Start<br> Date</td>
					<td class="border_1" width="7%">Course Complete<br>  Date</td>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['col_arr']->value, 'col', false, 'id');
$_smarty_tpl->tpl_vars['col']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['col']->value) {
$_smarty_tpl->tpl_vars['col']->do_else = false;
?>
						<td class="border_1" width="7%"><?php echo $_smarty_tpl->tpl_vars['col']->value;?>
</td>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>					
					<td class="border_1" width="7%">Tution Fee</td>
					<td class="border_1" width="7%">Duration</td>
				</tr>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cate_arr']->value, 'name', false, 'catid');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['catid']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
				<?php if (array_key_exists($_smarty_tpl->tpl_vars['catid']->value,$_smarty_tpl->tpl_vars['course_arr']->value)) {?>				
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['course_arr']->value[$_smarty_tpl->tpl_vars['catid']->value], 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
					<tr align="center" class="roweven" <?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] == 2) {?> style="background-color:#E9E8DA; font-style: italic "<?php }?>>
						<td class="border_1">
	
								<span style="<?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] != 2) {?>font-weight:bold; color:#0066FF; <?php }?>cursor:pointer;" onClick="openModel('client_course_detail_cp.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',screen.width*4/5,screen.height*4/5,'YES', 'form1')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['school'];?>
</span>
								<?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] == 1) {?>
									<br>
									<img src="../images/arr_down.gif" alt  style="cursor:hand" width="8" height="4" border="0" onClick="open_fold('<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
')">
								<?php }?>					</td>
						<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['qualname'];?>
</td>
						<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['majorname'];?>
</td>
						<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['start'];?>
</td>
						<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['end'];?>
</td>	
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['col_arr']->value, 'col', false, 'col_id');
$_smarty_tpl->tpl_vars['col']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['col_id']->value => $_smarty_tpl->tpl_vars['col']->value) {
$_smarty_tpl->tpl_vars['col']->do_else = false;
?>
							<td class="border_1">
							<?php if (is_array($_smarty_tpl->tpl_vars['course_process']->value[$_smarty_tpl->tpl_vars['id']->value]) && array_key_exists($_smarty_tpl->tpl_vars['col_id']->value,$_smarty_tpl->tpl_vars['course_process']->value[$_smarty_tpl->tpl_vars['id']->value])) {?>
								<?php echo $_smarty_tpl->tpl_vars['course_process']->value[$_smarty_tpl->tpl_vars['id']->value][$_smarty_tpl->tpl_vars['col_id']->value];?>

							<?php } else { ?>
								&nbsp;
							<?php }?>						</td>	
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['fee'];?>
</td>
						<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>		
					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php }?>	
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
	 </table>
		  </div>
</td>
	</tr>
</table>
</form>	<?php }
}
