<?php
/* Smarty version 4.3.2, created on 2023-12-06 08:53:49
  from '/data/wwwroot/agentstar.geic.com.au/tpl/sys_assign.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_656fc61dc377f2_67780410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa797ea663191232dad593b66f905bf15cd2d718' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/sys_assign.tpl',
      1 => 1689867702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_656fc61dc377f2_67780410 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Function Managment</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<?php echo '<script'; ?>
 language="javascript" src="../js/RolloverTable.js"><?php echo '</script'; ?>
>
<body>
<form action=""  target="_self" method="POST" name="form1">
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
	<input type="hidden" name="qflag" value="">
	<tr  class="title" >
		<td colspan="6">
			User Select:&nbsp;&nbsp;
			<select name="uid" class="select" onChange="this.form.submit();">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == $_smarty_tpl->tpl_vars['uid']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php if ($_smarty_tpl->tpl_vars['uid']->value == 0) {?>
				<option value="0" selected>select a user</option>
			<?php }?>
			</select>
			&nbsp;&nbsp;
			<input type="button" style="font-weight:bold;" value="Approve the premission" onClick="javascript:this.form.qflag.value='approve';this.form.submit();">
		</td>
	</tr>
	<tr class="totalrowodd">
		<td width="50%" align="center">Function</td>
		<td width="50%"  align="center">Premission<input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>
   </tr>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['func_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
	<tr id="tr_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"  onmouseout="roff(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" onMouseOver="ron(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" <?php if ($_smarty_tpl->tpl_vars['arr']->value['select'] == 1) {?> bgcolor="#DDE4F2"<?php }?>>
		<td align="center"style="border-bottom: solid #C0C0C0 1px; border-right: solid #C0C0C0 1px;"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>	
		<td onClick="rowToggle(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);" align="center" style="border-bottom: solid #C0C0C0 1px; border-right: solid #C0C0C0 1px;"> <input type="checkbox" id="box_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onClick="toggleRow(this);" name="funcId[]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['arr']->value['select'] == 1) {?> checked <?php }?>> </td> 
   </tr>   
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
   <tr >
   	<td align="right" colspan="2">&nbsp;</td>
   </tr>
</table>
<table width="100%" class="graybordertable" cellpadding="1" cellspacing="1">   
   <tr class="title"><td align="left" colspan="2">Advance Setting</td></tr>   
   <?php if ($_smarty_tpl->tpl_vars['uid']->value > 0) {?>
   <!-- Basic Service --> 
   <tr class="rowodd"><td align="left" colspan="2"><li>Basic Information&nbsp;<input type="checkbox" name="g_b_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_service']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</li></td></tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Track all clients</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_seeall[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['seeall']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['seeall']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Forbid cut/copy on client detail</ul></td>
		<td width="79%" align="left">on&nbsp;<input type="checkbox" name="g_b_nocp[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_nocp']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_nocp']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Show abouts percentage</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_b_abouts[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_abouts']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_abouts']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Export Emails</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_export[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['export']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['export']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</td>
   </tr>     
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Current visa setting</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_visa']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_visa']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_visa']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_visa']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Clients remove</ul></td>
		<td width="79%" align="left">delete&nbsp;<input type="checkbox" name="g_b_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_service']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Clients Type</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_ctype[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_ctype']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_ctype']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_ctype[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_ctype']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_ctype']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_ctype[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_ctype']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_ctype']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" ><ul>From Subagent</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_suba[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_suba']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_suba[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_suba']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_suba[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_suba']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_suba']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>   
    <tr class="roweven">
		<td width="21%" align="left" ><ul>Expire Date Report</ul></td>
		<td width="79%" align="left">
			view&nbsp;<input type="checkbox" name="g_b_epd[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_epd']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_epd']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_b_epd[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_epd']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_epd']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_b_epd[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_epd']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_epd']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>From to selection</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_b_fromto[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['b_fromto']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_fromto']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</td>
   </tr>     
   <!-- Course Service -->   
   <tr class="rowodd"><td align="left" colspan="2"><li>Course Service&nbsp;<input type="checkbox" name="g_c_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_service']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_service']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</li></td></tr>
      <tr class="roweven">
		<td align="left" ><ul>Track all course for all clients</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_c_track[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_track']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_track']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td align="left" ><ul>Course consultant &amp; Visit date</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_c_user[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_user']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_c_user[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_user']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_c_user[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_user']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;	
		</td>
   </tr>   
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Add Course</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_c_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_service']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_service']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
        remove&nbsp;<input type="checkbox" name="g_c_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_service']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_service']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;        
        </td>
   </tr>      
   <tr class="roweven">
		<td align="left" ><ul>Receivable and Paid commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_c_rev[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_rev']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_rev']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_c_rev[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['c_rev']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_rev']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr> 
   <!-- Visa Service -->  
   <tr class="rowodd"><td align="left" colspan="2"><li>Visa Service&nbsp;<input type="checkbox" name="g_v_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_service']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_service']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</li></td></tr>
   <tr class="roweven">
		<td align="left" ><ul>Track all visa for all clients</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_track[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_track']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_track']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td width="21%" align="left" ><ul>Add Visa</ul></td>
		<td width="79%" align="left">view&nbsp;<input type="checkbox" name="g_v_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_service']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_service']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;     
        </td>
   </tr>    
   <tr class="roweven">
		<td align="left" ><ul>Apply visa setting</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_visa']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_visa']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_visa']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_v_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_visa']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_visa']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>        
    <tr class="roweven">
		<td align="left" ><ul>Dependant Add</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_dp[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_dp']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_dp']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;		
			insert&nbsp;<input type="checkbox" name="g_v_dp[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_dp']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_dp']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_dp[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_dp']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_dp']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_v_dp[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_dp']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_dp']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;	
		</td>
   </tr>     
   <tr class="roweven">
		<td align="left" ><ul>Assessment Body and ASOC</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_abas[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_abas']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_abas[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_abas']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_abas[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_abas']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_abas']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>     
   <tr class="roweven">
		<td align="left" ><ul>Agreement Staff</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_agsf[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agsf']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_agsf[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agsf']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_agsf[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agsf']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agsf']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>    
   <tr class="roweven">
		<td align="left" ><ul>Visa Paperwork</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_vpwk[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_vpwk']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_vpwk[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_vpwk']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_vpwk[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_vpwk']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_vpwk']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="roweven">
		<td align="left" ><ul>Agreement Date</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_agd[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agd']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_agd[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agd']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_agd[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agd']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agd']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr> 
   <tr class="roweven">
		<td align="left" ><ul>Agreement Fee</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_agf[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agf']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agf']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_agf[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agf']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agf']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_agf[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_agf']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_agf']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>       
   <tr class="roweven">
		<td align="left" ><ul>Visa payment</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_v_pay[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_pay']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_pay']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_v_pay[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_pay']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_pay']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_v_pay[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_pay']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_pay']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_v_pay[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_pay']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_pay']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>  
   <!--
    <tr class="roweven">
		<td align="left" ><ul>Payment Due Date</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_p_duedate[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['p_duedate']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['p_duedate']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_p_duedate[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['p_duedate']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['p_duedate']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_p_duedate[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['p_duedate']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['p_duedate']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_p_duedate[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['p_duedate']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['p_duedate']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>    
    -->
    <tr class="roweven">
		<td align="left" ><ul>Paid History</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_p_h[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['p_h']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['p_h']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_p_h[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['p_h']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['p_h']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_p_h[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['p_h']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['p_h']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>        
  
    <tr class="roweven">
		<td align="left" ><ul>ExpireDate Report</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_v_epd[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_epd']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_epd']['v'] == 1) {?> checked="checked" <?php }?>>			&nbsp;&nbsp;
		</td>
   </tr>      
       <tr class="roweven">
		<td align="left" ><ul>Reviewer</ul></td>
		<td align="left">
			modify&nbsp;
			<input type="checkbox" name="g_v_reviewer[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['v_reviewer']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_reviewer']['m'] == 1) {?> checked="checked" <?php }?>>			&nbsp;&nbsp;
		</td>
   </tr>  
   <!-- EDU -->  
   <tr class="rowodd"><td align="left" colspan="2"><li>Institutes&nbsp;<input type="checkbox" name="g_i_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_service']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_service']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;[Grants for to-do and urgent list]</li></td></tr>
   <tr class="roweven">
		<td width="21%" align="left" valign="middle"><ul>Forbid cut/copy on institute detail</ul></td>
		<td width="79%" align="left">on&nbsp;<input type="checkbox" name="g_i_nocp[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_nocp']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['no_cp']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;</td>
   </tr>
   <tr class="roweven">
		<td align="left" ><ul>Course</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_course[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_course']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_i_course[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_course']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_i_course[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_course']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_i_course[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_course']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_course']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td align="left" ><ul>Process</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_proc']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_i_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_proc']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_i_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_proc']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_i_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_proc']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td align="left" ><ul>Commissions</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_comm[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_comm']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_i_comm[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_comm']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_i_comm[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_comm']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_i_comm[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_comm']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_comm']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>   
   <tr class="roweven">
		<td align="left" ><ul>Student Stats</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_st[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_st']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_st']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="roweven">
		<td align="left" ><ul>Receivable and Paid commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_i_rev[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_rev']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_rev']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>  
    <tr class="roweven">
		<td align="left" ><ul>Institutes Remove</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_i_del[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_del']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_del']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>  
    <tr class="roweven">
		<td align="left" ><ul>Expoart All Staff Emails</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_i_export[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_export']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_export']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr> 
    <tr class="roweven">
		<td align="left" ><ul>Student, Offer, COE</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_i_soc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_soc']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_soc']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr> 
    <tr class="roweven">
        <td align="left" ><ul>To Top-Agent</ul></td>
        <td align="left">
            view&nbsp;
            <input type="checkbox" name="g_i_tta[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_tta']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_tta']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
            insert&nbsp;
            <input type="checkbox" name="g_i_tta[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_tta']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_tta']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
            modify&nbsp;
            <input type="checkbox" name="g_i_tta[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['i_tta']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_tta']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
        </td>
   </tr>        
   <!-- Agent -->  
   <tr class="rowodd"><td align="left" colspan="2"><li>Top Agents&nbsp;<input type="checkbox" name="g_a_service[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_service']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_service']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;[Grants for to-do and urgent list]</li></td></tr>
   <tr class="roweven">
		<td align="left" ><ul>View Top Agents</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_top[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_top']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_top']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>
   <!--
   <tr class="roweven">
		<td align="left" ><ul>View Sub Agents</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_sub[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_sub']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_sub']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>   
-->
   <tr class="roweven">
		<td align="left" ><ul>Details</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_dt[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_dt']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_dt']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_a_dt[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_dt']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_dt']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_a_dt[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_dt']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_dt']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_a_dt[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_dt']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_dt']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>      
   <tr class="roweven">
		<td align="left" ><ul>Progress/Attachment</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_proc']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_proc']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			insert&nbsp;<input type="checkbox" name="g_a_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_proc']['i'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_proc']['i'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			modify&nbsp;<input type="checkbox" name="g_a_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_proc']['m'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_proc']['m'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
			delete&nbsp;<input type="checkbox" name="g_a_proc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_proc']['d'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_proc']['d'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>         
   <tr class="roweven">
		<td align="left" ><ul>Students</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_st[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_st']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_st']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>
   <tr class="roweven">
		<td align="left" ><ul>Receivable and received commission</ul></td>
		<td align="left">
			view&nbsp;<input type="checkbox" name="g_a_rev[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_rev']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_rev']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="rowodd"><td align="left" colspan="2"><li>Global Agent (Sub-agents)</li></td></tr>
     <tr class="roweven">
        <td align="left" ><ul>Details</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_d[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['ap_d']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['ap_d']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Progress/Attachment</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_pa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['ap_pa']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['ap_pa']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Students</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_st[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['ap_st']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['ap_st']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Payable and paid commission</ul></td>
        <td align="left">
            <input type="checkbox" name="g_ap_ppc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['ap_ppc']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['ap_ppc']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
     <tr class="roweven">
		<td align="left" ><ul>Remove</ul></td>
		<td align="left">
			<input type="checkbox" name="g_a_delpartner[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_delpartner']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_delpartner']['v'] == 1) {?> checked="checked" <?php }?>>
		</td>
     </tr>   
        <tr class="roweven">
        <td align="left" ><ul>Email Export</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_emailpartner[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_emailpartner']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_emailpartner']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
   </tr>  
      <tr class="rowodd"><td align="left" colspan="2"><li>Global Partner (Sub-agents)</li></td></tr>
     <tr class="roweven">
        <td align="left" ><ul>Details</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_d[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['aa_d']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['aa_d']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Progress/Attachment</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_pa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['aa_pa']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['aa_pa']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Students</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_st[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['aa_st']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['aa_st']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
     <tr class="roweven">
        <td align="left" ><ul>Payable and paid commission</ul></td>
        <td align="left">
            <input type="checkbox" name="g_aa_ppc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['aa_ppc']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['aa_ppc']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
     </tr> 
    <tr class="roweven">
        <td align="left" ><ul>Remove</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_delambassador[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_delambassador']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_delambassador']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
    </tr>   
    <tr class="roweven">
        <td align="left" ><ul>Email Export</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_emailambassador[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_emailambassador']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_emailambassador']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
    </tr>
    <tr class="roweven">
        <td align="left" ><ul>Change Category</ul></td>
        <td align="left">
            <input type="checkbox" name="g_a_gpeditcate[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['a_gpeditcate']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_gpeditcate']['v'] == 1) {?> checked="checked" <?php }?>>
        </td>
    </tr> 

   <tr class="rowodd"><td align="left" colspan="2"><li>Staff Performance</li></td></tr>  
   <tr class="roweven">
		<td align="left" ><ul>Check all staff</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_rpt_staff[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['rpt_staff']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['rpt_staff']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>     
   <tr class="roweven">
		<td align="left" ><ul>Potential Comm</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_rpt_staff_pc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['rpt_staff_pc']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['rpt_staff_pc']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>  
   <tr class="roweven">
		<td align="left" ><ul>Received Comm</ul></td>
		<td align="left">
			view&nbsp;
			<input type="checkbox" name="g_rpt_staff_rc[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['rpt_staff_rc']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['rpt_staff_rc']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>               
   <tr class="rowodd"><td align="left" colspan="2"><li>Report Todo List</li></td></tr>  
   <tr class="roweven">
		<td align="left" ><ul>Visa List</ul></td>
		<td align="left">
			view all paperwork&nbsp;
			<input type="checkbox" name="g_todo_visa[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['todo_visa']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_visa']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		</td>
   </tr>            
   <tr class="roweven">
		<td align="left" ><ul>Course List</ul></td>
		<td align="left">
			view all consultant&nbsp;
			<input type="checkbox" name="g_todo_course[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['todo_course']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_course']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
            <!--
            view Hunter cases&nbsp;
            <input type="checkbox" name="sys_views[]" value="course_37" <?php if (is_array($_smarty_tpl->tpl_vars['sys_views']->value['course']) && in_array(37,$_smarty_tpl->tpl_vars['sys_views']->value['course'])) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
            view Mary cases&nbsp;
            <input type="checkbox" name="sys_views[]" value="course_45" <?php if (is_array($_smarty_tpl->tpl_vars['sys_views']->value['course']) && in_array(45,$_smarty_tpl->tpl_vars['sys_views']->value['course'])) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
		    view Stella cases&nbsp;
            <input type="checkbox" name="sys_views[]" value="course_73" <?php if (is_array($_smarty_tpl->tpl_vars['sys_views']->value['course']) && in_array(73,$_smarty_tpl->tpl_vars['sys_views']->value['course'])) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
            -->
        </td>
   </tr>
   <tr class="roweven">
        <td align="left" ><ul>Todo Alarm</ul></td>
        <td align="left">
            open&nbsp;
            <input type="checkbox" name="g_todo_alert[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['todo_alert']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_alert']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
        </td>
   </tr>     
               <tr class="roweven">
                <td align="left">
                    <ul>Visa Expire Date</ul>
                </td>
                <td align="left">
                    view all cases&nbsp;
                    <input type="checkbox" name="g_visa_expire[]" value="<?php echo $_smarty_tpl->tpl_vars['grant']->value['visa_expire']['v'];?>
" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['visa_expire']['v'] == 1) {?> checked="checked" <?php }?>>&nbsp;&nbsp;
                </td>
            </tr>           
   <?php }?>       
</table>            
</form> 
</body>
</html><?php }
}
