<?php
/* Smarty version 4.3.2, created on 2024-01-08 10:30:49
  from '/data/wwwroot/agentstar.geic.com.au/tpl/institute_comm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659b5e59a8eef1_94586345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05951cd26898adbf8c5febbade697c310418ec54' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/institute_comm.tpl',
      1 => 1619777884,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659b5e59a8eef1_94586345 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Institute Management</title>
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
 language="javascript" ><?php echo $_smarty_tpl->tpl_vars['error_js']->value;
echo '</script'; ?>
>

<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="sid" value="<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="isNew" value="<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
">
<table align="center" class="graybordertable" width="100%" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
	  <td colspan="7">
		<input name="button" type="button" style="font-weight:bolder;" onClick="this.form.action='institute_detail.php';this.form.submit();" value="Go back to the institute detail">&nbsp;&nbsp;	  </td>	
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="7"> <span class="highyellow">Insititute: <?php echo $_smarty_tpl->tpl_vars['iname']->value;?>
</span></td>
	</tr>			
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="7" style="padding:3 ">Institute Commission 
			<input type="submit" value="Add New" style="font-weight:bold;" onClick="this.form.isNew.value='block'" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['i'] == 0) {?> disabled="disabled"<?php }?>>
		</td>
	</tr>
	<tr align="center" class="totalrowodd">
		<td>Start Date</td>
		<td>End Date</td>
		<td>Qualification<br>Major<br><hr>Course</td>
		<td>Commission Rate</td>
		<td >Bouns</td>
		<td>Through</td>
		<td>Action</td>
	</tr>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comm_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr align="center" class="roweven">
	    <td><?php echo $_smarty_tpl->tpl_vars['arr']->value['startdate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['enddate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['qual_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['qual']];?>
<br><?php echo $_smarty_tpl->tpl_vars['major_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['major']];?>
<br><hr><?php echo $_smarty_tpl->tpl_vars['arr']->value['course'];?>
</td>
		<td ><?php echo $_smarty_tpl->tpl_vars['arr']->value['rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['boun'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['agent'];?>
</td>
		<td>
			<select name="at_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" style="font-size:9px; font-weight:bolder;" <?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?> disabled <?php }?>>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['act_arr']->value, 'act_name', false, 'act_id');
$_smarty_tpl->tpl_vars['act_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['act_id']->value => $_smarty_tpl->tpl_vars['act_name']->value) {
$_smarty_tpl->tpl_vars['act_name']->do_else = false;
?>
                	<?php if (($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['m'] == 1 && $_smarty_tpl->tpl_vars['act_id']->value == 'E') || ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['d'] == 1 && $_smarty_tpl->tpl_vars['act_id']->value == 'D')) {?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['act_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['act_name']->value;?>
</option>
                    <?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>							
			</select>&nbsp;
			<input style="font-weight:bolder;" type="button" <?php if ($_smarty_tpl->tpl_vars['arr']->value['done'] == 1) {?> disabled <?php }?> value="OK" onClick="this.form.cid.value=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;this.form.submit();"> 					
		</td>
	</tr>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<p />
<div id="editDiv" style="display:<?php echo $_smarty_tpl->tpl_vars['isNew']->value;?>
;">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="2"align="center" class="whitetext">Detail Information</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Start Date:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input autocomplete="off" type="text" id="t_fd" name="t_fd" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['startdate'];?>
" size="30"/>
			</td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Start Date:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">
				<input autocomplete="off" type="text" id="t_ed" name="t_ed" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['enddate'];?>
" size="30"/>
			</td>
		</tr>

          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
				<select name="t_qual">
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
                	<option value="0" selected>All</option>
                </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
				<select name="t_major">
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
                	<option value="0" selected>All</option>                 
              </select>
            </td>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Course:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_course" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['course'];?>
" size="50";></td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Commission Rate:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_rate" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['rate'];?>
" size="50";></td>
		</tr>
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Bouns:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven"><input type="text" name="t_boun" value="<?php echo $_smarty_tpl->tpl_vars['dt_arr']->value['boun'];?>
"></td>
		</tr>				
		<tr>
			<td width="20%" align="left" class="rowodd"><strong>Through:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="80%" class="roweven">						
				<select name="t_agent">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agent_arr']->value, 'agent', false, 'aid');
$_smarty_tpl->tpl_vars['agent']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['aid']->value => $_smarty_tpl->tpl_vars['agent']->value) {
$_smarty_tpl->tpl_vars['agent']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['aid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['aid']->value == $_smarty_tpl->tpl_vars['dt_arr']->value['agentid']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['agent']->value;?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</select></td>
		</tr>
		<tr align="center"  class="greybg" >
	
			<td colspan="2"><input type="submit" value="Save" name="bt_name" style="font-weight:bold "></td>
		</tr>									
	</table>
</div>			
</form>	
</body>

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_fd').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_ed').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
<?php echo '</script'; ?>
>
	
</html><?php }
}
