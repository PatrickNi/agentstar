<?php /* Smarty version 2.6.13, created on 2020-10-24 03:36:05
         compiled from client_visa_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucwords', 'client_visa_detail.tpl', 254, false),array('modifier', 'string_format', 'client_visa_detail.tpl', 255, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js?v1"></script>
<?php echo $this->_tpl_vars['msg']; ?>

<body> 
<form method="get" id="form1" name="form1" action="/scripts/client_visa_detail.php" target="_self" onSubmit="return isDelete()"> 
  <input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
"> 
  <input type="hidden" name="vid" id="vid" value="<?php echo $this->_tpl_vars['vid']; ?>
"> 
  <input type="hidden" name="hCancel" value="0"> 
  <table border="0" width="95%" cellpadding="2" cellspacing="3"> 
	<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
		<tr align="center"  class="greybg">
			<input type="hidden" name="bt_name" id="bt_name" value="">
			<td align="left" width="10%">
				<?php if ($this->_tpl_vars['ugs']['v_visa']['d'] == 1): ?>
				<input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">&nbsp;&nbsp;&nbsp;
				<?php endif; ?>
                <?php if ($this->_tpl_vars['dt_arr']['auser'] != $this->_tpl_vars['uid']): ?>
				<input name="button" type="button" style="font-weight:bold" onClick="openModel('attachment.php?item=<?php echo $this->_tpl_vars['vid']; ?>
&type=<?php echo $this->_tpl_vars['itemtype']; ?>
',screen.width*6/7,screen.height*4/7,'NO', 'form1')" value="Attachment">
                <?php endif; ?>
			</td>					
			<td align="center" class="whitetext"> Detail Information &nbsp;&nbsp; </td> 			
			<td align="left" width="30%">
				<input type="button" value="Save" style="font-weight:bold" onClick="save_visa(this, false);" >
                <input type="button" value="Close &amp; Refresh " style="font-weight:bold" onClick="save_visa(this, true);">
			</td>
		</tr>		
	</table></td></tr>
    <tr align="center"  class="greybg" > 
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_visa.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"> <span class="highyellow">Client: <?php echo $this->_tpl_vars['client']['lname']; ?>
 <?php echo $this->_tpl_vars['client']['fname']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $this->_tpl_vars['client']['dob']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">Main Visa: <?php echo $this->_tpl_vars['client']['visa_n']; ?>
-<?php echo $this->_tpl_vars['client']['class_n']; ?>
, expr: <?php echo $this->_tpl_vars['client']['epdate']; ?>
</span>&nbsp;&nbsp; </td> 
    </tr> 
    <tr> 
      <td width="60%" align="left" valign="top"> <table border="0" width="100%" cellpadding="3" cellspacing="1"> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Status</strong></td> 
            <td align="left" width="64%" class="roweven">
                <span class="highlighttext"><?php echo $this->_tpl_vars['dt_arr']['status']; ?>
</span>
                <input type="hidden" name="t_status", value="<?php echo $this->_tpl_vars['dt_arr']['status']; ?>
">
				<!--
                <select name="t_status" class="highlighttext">
				<?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['st']):
?>
					<option value="<?php echo $this->_tpl_vars['st']; ?>
" <?php if ($this->_tpl_vars['st'] == $this->_tpl_vars['dt_arr']['status']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['st']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>&nbsp;&nbsp;&nbsp;
                -->
				<?php if ($this->_tpl_vars['showCourse'] == 1): ?><a href="./client_course_cp.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
" target="_blank">show course</a><?php endif; ?>
			</td> 
          </tr>	  	  
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Visa Category:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				<?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?><input type="hidden" name="t_visa" value="<?php echo $this->_tpl_vars['catid']; ?>
"> <?php endif; ?>
				<select name="t_visa" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?> disabled <?php endif; ?>> 
					<?php $_from = $this->_tpl_vars['cate_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>										 
					<option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['catid']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>                 
					<?php endforeach; endif; unset($_from); ?>
					<?php if ($this->_tpl_vars['catid'] == 0): ?><option value="0" selected>select a category</option><?php endif; ?> 
              	</select>
			</td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Visa Subclass:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				<?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?><input type="hidden" name="t_class" value="<?php echo $this->_tpl_vars['subid']; ?>
"> <?php endif; ?>
				<select name="t_class" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?> disabled <?php endif; ?>> 
                	<?php $_from = $this->_tpl_vars['class_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?> 
		                <option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['subid']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option> 
        			<?php endforeach; endif; unset($_from); ?>
					<?php if ($this->_tpl_vars['subid'] == 0): ?><option value="0" selected>select a subclass</option><?php endif; ?>
				</select>			
			</td> 
          </tr>   
          <!--
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>On / Off Shore</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
			<?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?><input type="hidden" name="t_shore" value="<?php echo $this->_tpl_vars['dt_arr']['shore']; ?>
"> <?php endif; ?>			
			  <input type="radio" name="t_shore" value="1" <?php if ($this->_tpl_vars['dt_arr']['shore'] == 1): ?> checked <?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?> disabled <?php endif; ?>> 
              On Shore&nbsp;&nbsp; 
              <input type="radio" name="t_shore" value="0" <?php if ($this->_tpl_vars['dt_arr']['shore'] == 0): ?> checked <?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?> disabled <?php endif; ?>> 
              Off Shore&nbsp;&nbsp;
			</td> 
          </tr> 
		  <tr>
			<td width="36%"  align="left" class="rowodd"><strong>Main Applicant Visa Expire Date:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="64%" class="roweven">
				<?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['isExpireSet'] != 1 || $this->_tpl_vars['ugs']['vinsert'] == 0 )): ?><input type="hidden" name="t_epdate" value="<?php echo $this->_tpl_vars['dt_arr']['epdate']; ?>
"> <?php endif; ?>
				<input type="text" name="t_epdate" id="t_epdate" value="<?php echo $this->_tpl_vars['dt_arr']['epdate']; ?>
" size="30" <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_visa']['v'] == 1 && $this->_tpl_vars['ugs']['v_visa']['m'] == 0 && ( $this->_tpl_vars['isExpireSet'] != 1 || $this->_tpl_vars['ugs']['v_visa']['i'] == 0 )): ?> disabled="disabled" <?php endif; ?>>
   
             
			</td>
		  </tr>
        -->
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Dependant Expire Date:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				<?php if ($this->_tpl_vars['vid'] > 0 && $this->_tpl_vars['ugs']['v_dp']['v'] == 1 && $this->_tpl_vars['ugs']['v_dp']['m'] == 1): ?> <input type="button" value="add dependant" onClick="openModel('client_dep.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
&vid=<?php echo $this->_tpl_vars['vid']; ?>
',800,400,'NO', 'form1')">         
                <br><?php endif; ?>
				<table width="100%" border="0" cellpadding="2" cellspacing="0" class="yellowbg" >
				<?php $_from = $this->_tpl_vars['dependants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['depid'] => $this->_tpl_vars['arr']):
?>
					<tr align="left">
						<td>
							<?php if ($this->_tpl_vars['ugs']['v_dp']['v'] == 1 && $this->_tpl_vars['ugs']['v_dp']['m'] == 0 && ( $this->_tpl_vars['arr']['expdate'] != '' && $this->_tpl_vars['arr']['expdate'] != '0000-00-00' || $this->_tpl_vars['ugs']['v_dp']['i'] == 0 )): ?>
								<input name="dep_<?php echo $this->_tpl_vars['depid']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['arr']['expdate']; ?>
">
							<?php endif; ?>
							<input name="dep_<?php echo $this->_tpl_vars['depid']; ?>
" type="text" value="<?php echo $this->_tpl_vars['arr']['expdate']; ?>
" size="30" onchange="audit_date(this)" <?php if ($this->_tpl_vars['ugs']['v_dp']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_dp']['v'] == 1 && $this->_tpl_vars['ugs']['v_dp']['m'] == 0 && ( $this->_tpl_vars['arr']['expdate'] != '' && $this->_tpl_vars['arr']['expdate'] != '0000-00-00' || $this->_tpl_vars['ugs']['v_dp']['i'] == 0 )): ?> disabled <?php endif; ?>>
						</td>
						<td><?php echo $this->_tpl_vars['arr']['name']; ?>
</td>
					</tr>			
				<?php endforeach; endif; unset($_from); ?>
				</table>
			</td> 
          </tr> 		  	
          <tr> 
            <td colspan="2" height="5"><hr></td> 
          </tr>		  		  		  
		  <?php if ($this->_tpl_vars['isViewBody']): ?>
			<tr>
				<td width="36%" align="left" class="rowodd"><strong>Assessment  Body:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="64%" class="roweven">
				<?php if ($this->_tpl_vars['ugs']['v_abas']['v'] == 1 && $this->_tpl_vars['ugs']['v_abas']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_abas']['i'] == 0 )): ?><input type="hidden" name="t_body" value="<?php echo $this->_tpl_vars['dt_arr']['body']; ?>
"> <?php endif; ?>				
				<select name="t_body" onChange="javascript:this.form.hCancel.value=2;this.form.submit();" <?php if ($this->_tpl_vars['ugs']['v_abas']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_abas']['v'] == 1 && $this->_tpl_vars['ugs']['v_abas']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_abas']['i'] == 0 )): ?> disabled <?php endif; ?>>
				<?php $_from = $this->_tpl_vars['abodys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
					<option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['dt_arr']['body']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>	
				<?php if ($this->_tpl_vars['dt_arr']['body'] == 0): ?><option value="0" selected>n/a</option><?php endif; ?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="36%" align="left" class="rowodd"><strong>ASCO:</strong>&nbsp;&nbsp;</td>
				<td align="left" width="64%" class="roweven">
				<?php if ($this->_tpl_vars['ugs']['v_abas']['v'] == 1 && $this->_tpl_vars['ugs']['v_abas']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_abas']['i'] == 0 )): ?><input type="hidden" name="t_asco" value="<?php echo $this->_tpl_vars['dt_arr']['asco']; ?>
"> <?php endif; ?>				
				<select name="t_asco"  <?php if ($this->_tpl_vars['ugs']['v_abas']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_abas']['v'] == 1 && $this->_tpl_vars['ugs']['v_abas']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_abas']['i'] == 0 )): ?> disabled <?php endif; ?>>
				<?php $_from = $this->_tpl_vars['ascos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
					<option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['dt_arr']['asco']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>	
				<?php if ($this->_tpl_vars['dt_arr']['asco'] == 0): ?><option value="0" selected>n/a</option><?php endif; ?>
				</select>
				</td>
			</tr>		  
		  <?php endif; ?>
          <?php if ($this->_tpl_vars['isViewState']): ?>
		  <tr> 
            <td width="36%" align="left" class="rowodd"><strong>State Sponsor:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				<select name="t_sponsor">
				<?php $_from = $this->_tpl_vars['sponsors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
					<option value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['dt_arr']['state']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>	
				</select>			
			</td> 
          </tr> 
		  <?php endif; ?>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Staff:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				<?php if ($this->_tpl_vars['ugs']['v_agsf']['v'] == 1 && $this->_tpl_vars['ugs']['v_agsf']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_agsf']['i'] == 0 )): ?><input type="hidden" name="t_auser" value="<?php echo $this->_tpl_vars['dt_arr']['auser']; ?>
"> <?php endif; ?>
				<select name="t_auser" <?php if ($this->_tpl_vars['ugs']['v_agsf']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_agsf']['v'] == 1 && $this->_tpl_vars['ugs']['v_agsf']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_agsf']['i'] == 0 )): ?> disabled <?php endif; ?>>
				<?php $_from = $this->_tpl_vars['user_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
	              <option  value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['dt_arr']['auser'] == $this->_tpl_vars['id']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
    			<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['dt_arr']['auser'] < 1): ?>
					<option  value="0" selected >select a user</option>
                <?php endif; ?>
				</select>			
			</td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Visa Paperwork:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
				<?php if ($this->_tpl_vars['ugs']['v_vpwk']['v'] == 1 && $this->_tpl_vars['ugs']['v_vpwk']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_vpwk']['i'] == 0 )): ?><input type="hidden" name="t_vuser" value="<?php echo $this->_tpl_vars['dt_arr']['vuser']; ?>
"> <?php endif; ?>
				<select name="t_vuser" <?php if ($this->_tpl_vars['ugs']['v_vpwk']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_vpwk']['v'] == 1 && $this->_tpl_vars['ugs']['v_vpwk']['m'] == 0 && ( $this->_tpl_vars['vid'] > 0 || $this->_tpl_vars['ugs']['v_vpwk']['i'] == 0 )): ?> disabled <?php endif; ?>>                 
				<?php $_from = $this->_tpl_vars['user_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
					<option  value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['dt_arr']['vuser'] == $this->_tpl_vars['id']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option> 
                <?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['dt_arr']['auser'] < 1): ?> 
	                <option  value="0" selected >select a user</option> 
    			<?php endif; ?>
				</select>			</td> 
          </tr>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Consult Date:</strong></td> 
            <td align="left" width="64%" class="roweven">
                <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 1 && $this->_tpl_vars['ugs']['v_agd']['m'] == 0 && ( ( $this->_tpl_vars['dt_arr']['vdate'] != '' && $this->_tpl_vars['dt_arr']['vdate'] != '0000-00-00' ) || $this->_tpl_vars['ugs']['v_agd']['i'] == 0 )): ?>
                    <input type="hidden" name="t_first" value="<?php echo $this->_tpl_vars['dt_arr']['vdate']; ?>
"> 
                <?php endif; ?>
                <input type="text" id="t_first" name="t_first" value="<?php echo $this->_tpl_vars['dt_arr']['vdate']; ?>
" size="30" <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 1 && $this->_tpl_vars['ugs']['v_agd']['m'] == 0 && ( ( $this->_tpl_vars['dt_arr']['vdate'] != '' && $this->_tpl_vars['dt_arr']['vdate'] != '0000-00-00' ) || $this->_tpl_vars['ugs']['v_agd']['i'] == 0 )): ?> disabled <?php endif; ?>>               
            </td> 
          </tr>           
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Consult Fee:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
                <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 1 && $this->_tpl_vars['ugs']['v_agd']['m'] == 0 && ( ( $this->_tpl_vars['dt_arr']['cfee'] > 0 ) || $this->_tpl_vars['ugs']['v_agd']['i'] == 0 )): ?>
                    <input type="hidden" name="t_cfee" value="<?php echo $this->_tpl_vars['dt_arr']['cfee']; ?>
"> 
                <?php endif; ?>
                <input type="text" id="t_cfee" name="t_cfee" value="<?php echo $this->_tpl_vars['dt_arr']['cfee']; ?>
" size="30" onChange="audit_money(this)"  <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 1 && $this->_tpl_vars['ugs']['v_agd']['m'] == 0 && ( ( $this->_tpl_vars['dt_arr']['cfee'] > 0 ) || $this->_tpl_vars['ugs']['v_agd']['i'] == 0 )): ?> disabled <?php endif; ?>> 
			</td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Net Amount:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				<?php echo $this->_tpl_vars['net_camount']; ?>
 
			</td> 
          </tr>          

          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Date:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven">
				<?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 1 && $this->_tpl_vars['ugs']['v_agd']['m'] == 0 && ( ( $this->_tpl_vars['dt_arr']['adate'] != '' && $this->_tpl_vars['dt_arr']['adate'] != '0000-00-00' ) || $this->_tpl_vars['ugs']['v_agd']['i'] == 0 )): ?>
                	<input type="hidden" name="t_adate" value="<?php echo $this->_tpl_vars['dt_arr']['adate']; ?>
"> 
                <?php endif; ?>
				<input type="text" id="t_adate" name="t_adate" value="<?php echo $this->_tpl_vars['dt_arr']['adate']; ?>
" size="30" <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 0): ?> style="visibility:hidden"<?php endif; ?> <?php if ($this->_tpl_vars['ugs']['v_agd']['v'] == 1 && $this->_tpl_vars['ugs']['v_agd']['m'] == 0 && ( ( $this->_tpl_vars['dt_arr']['adate'] != '' && $this->_tpl_vars['dt_arr']['adate'] != '0000-00-00' ) || $this->_tpl_vars['ugs']['v_agd']['i'] == 0 )): ?> disabled <?php endif; ?>> 
               
                
			</td> 
          </tr> 
        
          <tr><td colspan="2"><hr/></td></tr>                    
          <tr>
          	<td colspan="2"> 
     	
	 			<table border="0" cellpadding="1" cellspacing="1" width="100%"> 
		            <tr class="greybg"> 
		              <td colspan="11" class="whitetext" align="center">Payment</td> 
		            </tr>
		            <tr align="center" class="totalrowodd">
		            	<td>Item</td>
		          		<td>Due<br/>Amount</td>
		          		<td>GST</td>
		          		<td>Total<br/>Received</td>
		          		<td>Deduction</td>
		          		<td>Deduction<br/>Amount</td>
		          		<td>GST</td>
		          		<td>Total Paid</td>
		          		<td>Profit</td>
                        <!--
                        <td>Agreement<br/>Profit</td>
                        <td>Paperwork<br/>Profit</td>
		          	    -->
                      </tr>
		          	<?php $this->assign('total_profit', '0'); ?>
                    <?php $this->assign('agreement_profit', '0'); ?>
                    <?php $this->assign('paperwork_profit', '0'); ?>
	                <?php $_from = $this->_tpl_vars['account_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['arr']):
?>
					<tr align="center" class="roweven">
						<td style="text-decoration:underline; cursor:pointer" onClick="window.open('client_account_detail.php?vid=<?php echo $this->_tpl_vars['vid']; ?>
&aid=<?php echo $this->_tpl_vars['id']; ?>
&cid=<?php echo $this->_tpl_vars['cid']; ?>
&typ=visa','_blank', 'alwaysRaised=yes,height=500, width=800,location=no,scrollbars=yes')" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['step'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
</td>
						<td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['dueamt'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
						<td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['gst'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
						<td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_payment.php?aid=<?php echo $this->_tpl_vars['id']; ?>
','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span></td>
						<td><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['party'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
</td>
						<td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['dueamt_3rd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
						<td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['gst_3rd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
						<td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_spand.php?aid=<?php echo $this->_tpl_vars['id']; ?>
','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['spand'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span></td>
						<td align="right">
                            <?php if ($this->_tpl_vars['arr']['step'] != 'app'): ?>
							    <?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['paid']-$this->_tpl_vars['arr']['dueamt_3rd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

							    <?php $this->assign('total_profit', $this->_tpl_vars['total_profit']+$this->_tpl_vars['arr']['paid']-$this->_tpl_vars['arr']['dueamt_3rd']); ?>
                            <?php else: ?>
                                0.00
                            <?php endif; ?>
						</td>
                        <!--
                        <td align="right">
                            <?php if ($this->_tpl_vars['arr']['step'] != 'app'): ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['dueamt']-$this->_tpl_vars['arr']['gst']-$this->_tpl_vars['ueamt_3rd']+$this->_tpl_vars['arr']['gst_3rd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

                                <?php $this->assign('agreement_profit', $this->_tpl_vars['agreement_profit']+$this->_tpl_vars['arr']['dueamt']-$this->_tpl_vars['arr']['gst']-$this->_tpl_vars['ueamt_3rd']+$this->_tpl_vars['arr']['gst_3rd']); ?>
                            <?php else: ?>
                                0.00
                            <?php endif; ?>
                        </td>
                        <td align="right">
                            <?php if ($this->_tpl_vars['arr']['step'] != 'app'): ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['paid']-$this->_tpl_vars['arr']['gst']-$this->_tpl_vars['arr']['spand']+$this->_tpl_vars['arr']['gst_3rd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

                                <?php $this->assign('paperwork_profit', $this->_tpl_vars['paperwork_profit']+$this->_tpl_vars['arr']['paid']-$this->_tpl_vars['arr']['gst']-$this->_tpl_vars['arr']['spand']+$this->_tpl_vars['arr']['gst_3rd']); ?>
                            <?php else: ?>
                                0.00
                            <?php endif; ?>
                        </td>
                        -->                                                
					</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr align="center" class="roweven">
						<td align="right" colspan="8"><strong>Total:</strong></td>
						<td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total_profit'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</strong></td>
                        <!--
                        <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['agreement_profit'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</strong></td>
                        <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['paperwork_profit'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</strong></td>
					    -->
                    </tr>	
                  
					<tr align="center" class="roweven">
						<td colspan="11" align="center">
                            <?php if ($this->_tpl_vars['vid'] > 0): ?>        
                            <input type="button" value="Add new" onclick="window.open('client_account_detail.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
&vid=<?php echo $this->_tpl_vars['vid']; ?>
&typ=visa','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')" />
                            <?php endif; ?>
                        </td>
					</tr>				          	
		        </table>
	    
          	</td>	
          	
          </tr>   

          <tr> 
            <td colspan="2" height="5"><hr></td> 
          </tr>
        </table> 
        
        </td> 
      <td width="40%" align="left" valign="top"> 
      		<div style="width:100%;overflow-X:auto; overflow-Y:auto;"> 
	          <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
	            <tr class="greybg"> 
	              <td colspan="4" class="whitetext" align="center">Process &nbsp; 
                    <?php if ($this->_tpl_vars['vid'] > 0): ?>
	                <input type="button" value="add new" style="font-weight:bold" onClick="window.open('client_visa_process.php?vid=<?php echo $this->_tpl_vars['vid']; ?>
&cid=<?php echo $this->_tpl_vars['cid']; ?>
&isNew=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')"></td> 
	                <?php endif; ?>
                </tr> 
	            <tr align="center" class="totalrowodd"> 
	              <td class="border_1" width="33%">Date</td> 
	              <td class="border_1" width="60%">Subject</td> 
	              <td class="border_1" width="7%">Insert</td> 
	            </tr> 
	            <?php $_from = $this->_tpl_vars['process_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['arr']):
?>
	            <tr align="left" class="roweven"> 
	              <td class="border_1"><span style="font-size:16px;font-weight:bolder; color:#990000"><?php if ($this->_tpl_vars['arr']['done'] == 1): ?>&radic;<?php else: ?>?<?php endif; ?></span><?php echo $this->_tpl_vars['arr']['date']; ?>
</td> 
	              <td class="border_1"><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_process.php?vid=<?php echo $this->_tpl_vars['vid']; ?>
&pid=<?php echo $this->_tpl_vars['id']; ?>
&cid=<?php echo $this->_tpl_vars['cid']; ?>
','_blank','alwaysRaised=yes,height=500,width=800, location=no')"><?php echo $this->_tpl_vars['arr']['subject']; ?>
</span></td>
	              <td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_visa_process.php?vid=<?php echo $this->_tpl_vars['vid']; ?>
&pid=<?php echo $this->_tpl_vars['id']; ?>
&cid=<?php echo $this->_tpl_vars['cid']; ?>
&isNew=1&isOther=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')"></td> 
	            </tr> 
	            <?php endforeach; endif; unset($_from); ?>
	          </table> 
        	</div>
        	<hr/>
    	</td> 
    </tr> 
    <tr>
    	<td align="left" class="roweven">
        	<strong>Key Point</strong>
        	<textarea style="width:100%; height:100% " name="t_key"  rows="30"><?php echo $this->_tpl_vars['dt_arr']['key']; ?>
</textarea>
         </td> 
        <td align="left" class="roweven">
           	<strong>Note</strong>
        	<textarea style="width:100%; height:100% " name="t_note2" rows="30"><?php echo $this->_tpl_vars['dt_arr']['note2']; ?>
</textarea>
        </td>        
    </tr>
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>
  </table> 
</form> 
<?php echo '
<script type="text/javascript">
	$(\'#t_epdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$(\'#t_first\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
	$(\'#t_adate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

    function save_visa(obj,close_w){
        $(\'#bt_name\').val(\'save\');
        btn_n = $(obj).val();
        $(obj).val(\'waiting...\');
        //ContentType UTF-8
        $.post($(\'#form1\').attr(\'action\'), $(\'#form1\').serialize(), function(data){
            rtn = $.parseJSON(data);
            
            $(obj).val(btn_n);
            if (rtn.id > 0)
                $(\'#vid\').val(rtn.id);
            else {
                alert(rtn.msg);
                return false;
            }

            if (rtn.msg != \'Save OK\')
                close_w = false
            
            if (close_w) {
                if(window.opener && !window.opener.closed){
                    window.opener.location.reload(true);
                }
                window.close();
            }
            else{
                alert(rtn.msg);
                if (rtn.id > 0) 
                  window.location.href = window.location.href + \'&vid=\' + rtn.id;    
                else
                  window.location.reload();    
            }
        });
        
    }
</script>
'; ?>
	