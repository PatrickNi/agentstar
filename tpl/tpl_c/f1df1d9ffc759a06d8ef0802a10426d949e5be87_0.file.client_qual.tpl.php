<?php
/* Smarty version 4.3.2, created on 2023-11-22 06:40:27
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_qual.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d31db965310_25682451',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f1df1d9ffc759a06d8ef0802a10426d949e5be87' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_qual.tpl',
      1 => 1679328872,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d31db965310_25682451 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
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
<form method="get" name="form1" action="" target="_self">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<table align="center" width="100%"  class="graybordertable" border="0" cellpadding="1" cellspacing="1">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
		<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input name="button" type="button"  style="font-weight:bold;" onClick="javascript:this.form.action='client_ielts.php';this.form.submit();" value="IETLS">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" disabled value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
		<?php }?>	
        <?php if (in_array('study',$_smarty_tpl->tpl_vars['client_type']->value) && $_smarty_tpl->tpl_vars['ugs']->value['c_service']['v'] == 1) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply course">
        &nbsp;&nbsp; 
        <?php }?> 
        <?php if (in_array('immi',$_smarty_tpl->tpl_vars['client_type']->value) && $_smarty_tpl->tpl_vars['ugs']->value['v_service']['v'] == 1) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa service">
        &nbsp;&nbsp; 
        <?php }?> 
        <?php if (in_array('homeloan',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        <?php }?>
        <?php if (in_array('legal',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_legal.php';this.form.submit();" value="Legal Service">
        &nbsp;&nbsp; 
        <?php }?>   
		</td>
	</tr>
	<tr align="center"  class="greybg" >
			<td class="whitetext" style="font-size:16px ">Client Qualification
				<input type="button" value="add new" style="font-weight:bold;" onclick="window.open('client_qual_dt.php?&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')">&nbsp;&nbsp;
				<input type="button" value="Attachment" style="font-weight:bold" onClick="window.open('attachment.php?item=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&type=<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*6/7 +',height=' + screen.height*4/7)">
			</td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px "> 
			<span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span>&nbsp;&nbsp; 
		</td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="1" cellspacing="1" width="100%">
				<tr align="center" class="totalrowodd">
					<td width="10%" >Start date</td>
					<td width="10%">Complete date</td>
					<td width="15%" >School Name </td>
					<td width="15%">School Country</td>
					<td width="*" >Qualification</td>
					<td width="12%" >Major</td>
                    <td width="5%" >Completed</td>
					<td width="5%" >Full/Part(time)</td>   
					<td width="10%" >Note</td>   
					<td width="5%">Insert</td>
				</tr>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['show_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<tr align="center" class="roweven">
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['fdate'];?>
</td>
					<td ><?php echo $_smarty_tpl->tpl_vars['arr']->value['tdate'];?>
</td>
					<td ><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_qual_dt.php?qid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')"><?php echo $_smarty_tpl->tpl_vars['arr']->value['school'];?>
</span></td>
					<td ><?php echo $_smarty_tpl->tpl_vars['country_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['country']];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['qual'];?>
</td>
					<td ><?php echo $_smarty_tpl->tpl_vars['arr']->value['major'];?>
</td>
					<td ><?php echo $_smarty_tpl->tpl_vars['arr']->value['status'];?>
</td>
                    <td ><?php if ($_smarty_tpl->tpl_vars['arr']->value['fulltime'] == 1) {?>Fulltime<?php } else { ?>Parttime<?php }?></td>  
					<td ><?php echo $_smarty_tpl->tpl_vars['arr']->value['note'];?>
</td>                   
					<td><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_qual_dt.php?qid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&isNew=1','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,height=380,width=500')"></td>
				</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
		</td>
	</tr>
</table>
</form>	
</body>
</html><?php }
}
