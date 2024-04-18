<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:59:18
  from '/data/wwwroot/agentstar.geic.com.au/tpl/client_course.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d4456aa2e46_30832478',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5952515836b6008c41d160c765edb80e1ee1bc59' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/client_course.tpl',
      1 => 1680181786,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d4456aa2e46_30832478 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
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
 type="text/javascript">
var hiddencomm = 1;
function ShowComm() {
	obj = document.getElementsByTagName('TD');
	if(obj.length < 0)
	{
		return false;
	}
	for(i=0; i<obj.length; i++)
	{
		if(obj[i].id == "ShowComm")
		{
			if(hiddencomm == 1)
			{
				obj[i].style.visibility = 'visible';
			}
			else 
			{
				obj[i].style.visibility = 'hidden';
			}
		}
	}
	if(hiddencomm == 1)
	{	
		hiddencomm = 0;
	}
	else 
	{
		hiddencomm = 1;
	}
}
<?php echo '</script'; ?>
>

<body>
<form method="get" name="form1" action="" target="_self" onSubmit="return form_audit('form1')">
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
">
<input type="hidden" name="courseid" value="<?php echo $_smarty_tpl->tpl_vars['course_id']->value;?>
">
<input type="hidden" name="hCancel" value="0">
<table align="center" class="graybordertable" width="100%">
	<tr align="left"  class="bordered_2">
		<td colspan="2">
			<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
			<input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
			<input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
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
        <?php if (in_array('coach',$_smarty_tpl->tpl_vars['client_type']->value)) {?>
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service">
        &nbsp;
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
		<td class="whitetext" colspan="2" style="padding:3 ">
			Client Apply Course &nbsp;&nbsp;&nbsp;
            <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_service']['i'] == 1) {?>
			<span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5)">new course</span>		
            <?php }?>
            </td>		
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">Client: <?php echo $_smarty_tpl->tpl_vars['client']->value['lname'];?>
 <?php echo $_smarty_tpl->tpl_vars['client']->value['fname'];?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $_smarty_tpl->tpl_vars['client']->value['dob'];?>
</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: <?php echo $_smarty_tpl->tpl_vars['client']->value['visa_n'];?>
-<?php echo $_smarty_tpl->tpl_vars['client']->value['class_n'];?>
, expr: <?php echo $_smarty_tpl->tpl_vars['client']->value['epdate'];?>
</span></td>
	</tr>
	 <tr class="greybg" align="center">
	   <td align="left" colspan="2">
		<!--
	   	<strong>Course-consulant:</strong>&nbsp;&nbsp;
		<?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['c_user']['m'] == 0 && ($_smarty_tpl->tpl_vars['client']->value['cuser'] > 0 || $_smarty_tpl->tpl_vars['ugs']->value['c_user']['i'] == 0)) {?><input type="hidden" name="t_cuser" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
"><?php }?>		  
		<select name="t_cuser" <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['c_user']['m'] == 0 && ($_smarty_tpl->tpl_vars['client']->value['cuser'] > 0 || $_smarty_tpl->tpl_vars['ugs']->value['c_user']['i'] == 0)) {?> disabled="disabled" <?php }?>>		  
			  <option value="0" selected>choose a user</option>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user_arr']->value, 'user_name', false, 'uid');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['uid']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
			  <option value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['client']->value['cuser'] == $_smarty_tpl->tpl_vars['uid']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

		</select>&nbsp;&nbsp;&nbsp;&nbsp;

	   <strong>Course Visit Date:</strong>&nbsp;&nbsp;
	   <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['c_user']['m'] == 0 && ($_smarty_tpl->tpl_vars['coursecount']->value > 0 || $_smarty_tpl->tpl_vars['ugs']->value['c_user']['i'] == 0)) {?><input type="hidden" name="t_first" value="<?php echo $_smarty_tpl->tpl_vars['client']->value['cvdate'];?>
"> <?php }?>
	    <input type="text" name="t_first" id="t_first" onchange="audit_date(this)"  value="<?php echo $_smarty_tpl->tpl_vars['client']->value['cvdate'];?>
"  <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 0) {?> style="visibility:hidden"<?php }?> <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_user']['v'] == 1 && $_smarty_tpl->tpl_vars['ugs']->value['c_user']['m'] == 0 && ($_smarty_tpl->tpl_vars['client']->value['cvdate'] != '' || $_smarty_tpl->tpl_vars['ugs']->value['c_user']['i'] == 0)) {?> disabled="disabled" <?php }?>>&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="submit" name="bt_name" value="Save" style="font-weight:bold ">
		-->
        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_service']['i'] == 1) {?>
        &nbsp;&nbsp;&nbsp;
        <input type="button" name="bt_name" value="Show comm" style="font-weight:bold" onClick="ShowComm()">
        <?php }?>
	   </td>
	</tr>		
	<tr>
		<td align="left" valign="top">
			<!--<fieldset>
			<legend class="green"><?php echo mb_strtoupper((string) $_smarty_tpl->tpl_vars['name']->value ?? '', 'UTF-8');?>
</legend>-->
			<div style="width:100%; overflow-X:scroll;">
			<table border="0" cellpadding="0" cellspacing="0" width="200%">
				<tr align="center" class="totalrowodd">
					<td class="border_1" width="15%">Institute</td>
					<td class="border_1" width="5%">Qualification</td>
					<td class="border_1" width="5%">Major</td>
					<td class="border_1" width="5%">Consultant</td>
					<td class="border_1" width="3%">Completed</td>
					<td class="border_1" width="5%">Verify<br>Migration</td>
					<td class="border_1" width="5%">Consultant Date</td>							
					<td class="border_1" width="5%">Course Start<br> Date</td>
					<td class="border_1" width="5%">Course Complete<br>  Date</td>
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
                    <td class="border_1" width="7%">&nbsp;</td>
				</tr>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['course_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>				
				<tr align="center" class="roweven" <?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] == 2) {?> style="background-color:#E9E8DA; font-style: italic "<?php }?>>
					<td class="border_1">

							<span style="<?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] == 0) {?>color:#0066FF; <?php }
if ($_smarty_tpl->tpl_vars['arr']->value['active'] != 2) {?>font-weight:bold;<?php }?>cursor:pointer;"  onClick="<?php if ($_smarty_tpl->tpl_vars['show_detail']->value == 1) {?>window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5)<?php } else { ?>alert('Permission denied')<?php }?>"><?php if ($_smarty_tpl->tpl_vars['arr']->value['school'] == '') {?>N/A<?php } else {
echo $_smarty_tpl->tpl_vars['arr']->value['school'];
}?></span>
							<?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] == 1) {?>
								<br>
								<img src="../images/arr_down.gif" alt  style="cursor:hand" width="8" height="4" border="0" onClick="open_fold('<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
')">
							<?php }?>					</td>
					<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['qualname'];?>
</td>
					<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['majorname'];?>
</td>
					<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['consultant']];?>
</td>
					<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['completed'];?>
</td>
					<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value[$_smarty_tpl->tpl_vars['arr']->value['vma']];?>
,<?php echo ucwords($_smarty_tpl->tpl_vars['arr']->value['vms']);?>
</td>
					<td class="border_1"><?php echo $_smarty_tpl->tpl_vars['arr']->value['consultant_date'];?>
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
                    <td class="border_1">&nbsp;</td>		
				</tr>
				<?php if ($_smarty_tpl->tpl_vars['arr']->value['active'] == 1) {?>
							<tr name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" style="font-weight:bolder;" align="right" class="yellowbg">
								<td class="border_1"align="center"><span style="text-decoration:underline; font-weight:lighter;cursor:pointer;" onClick="<?php if ($_smarty_tpl->tpl_vars['show_detail']->value == 1) {?>window.open('client_course_sem.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5)<?php } else { ?>alert('Permission denied');<?php }?>">add semesters</span></td>
								<td class="border_1">Start Date</td>
								<td class="border_1">Complete Date</td>
								<td class="border_1">Tution Fee</td>								                                
								<?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_rev']['v'] == 1) {?>
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">R Comm</td>
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Issue Invoice Date</td>
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Received Comm</td>
									<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Received Date</td>
									<?php if ($_smarty_tpl->tpl_vars['has_sub_agent']->value == 1) {?>
										<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Co Comm</td>
										<td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Co Date</td>
                                    <?php }?>
                                    <td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Discount</td>
                                    <td class="border_1" style="color:#CC3300; visibility:hidden" id="ShowComm">Discount Pay Day</td>
								<?php }?>							</tr>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['course_sem']->value[$_smarty_tpl->tpl_vars['id']->value], 'semarr', false, 'semid');
$_smarty_tpl->tpl_vars['semarr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['semid']->value => $_smarty_tpl->tpl_vars['semarr']->value) {
$_smarty_tpl->tpl_vars['semarr']->do_else = false;
?>
							<tr name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="yellowbg" style="<?php if ($_smarty_tpl->tpl_vars['semarr']->value['done'] == 2) {?>background-color: #ceccc5;font-style: italic;<?php }?>" >
								<td class="border_1"align="center" ><span style="text-decoration:underline; cursor:pointer;" onClick="<?php if ($_smarty_tpl->tpl_vars['show_detail']->value == 1) {?>window.open('client_course_sem.php?cid=<?php echo $_smarty_tpl->tpl_vars['cid']->value;?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&semid=<?php echo $_smarty_tpl->tpl_vars['semid']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,width='+ screen.width*4/5 +',height=' + screen.height*4/5)<?php } else { ?>alert('Permission denied');<?php }?>">semester<?php echo $_smarty_tpl->tpl_vars['semarr']->value['sem'];?>
</span></td>
								<td class="border_1" align="right"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['fdate'];?>
</td>
								<td class="border_1" align="right"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['tdate'];?>
</td>
								<td class="border_1" align="right"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['fee'];?>
</td>
                                <?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_rev']['v'] == 1) {?>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['rcomm'];?>
</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['ivdate'];?>
</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['redcomm'];?>
</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['reddate'];?>
</td>
                                    <?php if ($_smarty_tpl->tpl_vars['has_sub_agent']->value == 1) {?>
										<td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['ccomm'];?>
</td>
										<td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['cdate'];?>
</td>
                                    <?php }?>
                                    <td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['discount'];?>
</td>
									<td class="border_1" align="right" id="ShowComm" style="visibility:hidden"><?php echo $_smarty_tpl->tpl_vars['semarr']->value['discountdate'];?>
</td>
                                  <?php }?>
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
		  <!--</fieldset>
		  <p />-->		</td>
	</tr>
</table>
</form>	

<?php echo '<script'; ?>
 type="text/javascript">
	$('#t_first').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
<?php echo '</script'; ?>
>
	
<?php }
}
