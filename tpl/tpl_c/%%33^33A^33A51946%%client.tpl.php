<?php /* Smarty version 2.6.13, created on 2020-10-29 14:35:29
         compiled from client.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'client.tpl', 68, false),array('function', 'counter', 'client.tpl', 86, false),array('modifier', 'cat', 'client.tpl', 70, false),array('modifier', 'wordwrap', 'client.tpl', 70, false),array('modifier', 'string_format', 'client.tpl', 91, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "style.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/audit.js"></script>

<body>
<form name="form1" target="_self" method="get" onkeydown="<?php echo 'if(event.keyCode==13){return false;}'; ?>
">
  <table align="center" width="100%"  class="graybordertable" cellpadding="0" cellspacing="0">
    <tr >
      <td colspan="9" align="center"  class="bordered_2"><table width="100%" cellpadding="1" cellspacing="1">
          <tr>
            <td colspan="4"  align="left" ><input type="button" value="Add New Client" style="font-weight:bold;" onClick="javascrtipt:this.form.action='client_detail.php';this.form.submit();">
              &nbsp;
              <!--<input type="submit" value="Delete" name="qSubmit" style="font-weight:bold;">	-->
              <?php if ($this->_tpl_vars['ugs']['export']['v'] == 1): ?>
              <input type="submit" value="Export Client Emails" name="bt_export" style="font-weight:bold;">
              <?php endif; ?> </td>
            <td width="69%" colspan="4" align="right">
              <?php if ($this->_tpl_vars['ugs']['b_fromto']['v'] == 1): ?>
              <strong>From: &nbsp;</strong>
              <input type="text"	 name="t_fdate" id="t_fdate" value="<?php echo $this->_tpl_vars['from']; ?>
" onChange="audit_date(this)">

              &nbsp;&nbsp; <strong>To: &nbsp;</strong>
              <input type="text"	 name="t_tdate" id="t_tdate"value="<?php echo $this->_tpl_vars['to']; ?>
" onChange="audit_date(this)">
  
               <?php endif; ?>              
              &nbsp;&nbsp;
              <select name="srchType">
                <option value="l" <?php if ($this->_tpl_vars['srchtype'] == 'l'): ?> selected <?php endif; ?>>Last Name</option>
                <option value="f" <?php if ($this->_tpl_vars['srchtype'] == 'f'): ?> selected <?php endif; ?>>First Name</option>
                <option value="e" <?php if ($this->_tpl_vars['srchtype'] == 'e'): ?> selected <?php endif; ?>>English Name</option>
                <option value="t" <?php if ($this->_tpl_vars['srchtype'] == 't'): ?> selected <?php endif; ?>>Client Type</option>
                <option value="m" <?php if ($this->_tpl_vars['srchtype'] == 'm'): ?> selected <?php endif; ?>>Email</option>
                <option value="c" <?php if ($this->_tpl_vars['srchtype'] == 'c'): ?> selected <?php endif; ?>>Client Code</option>
                <option value="dob" <?php if ($this->_tpl_vars['srchtype'] == 'dob'): ?> selected <?php endif; ?>>Dob</option>
              </select>
              &nbsp;&nbsp;
              <input type="text" name="srchTxt" size="20" value="<?php echo $this->_tpl_vars['srchtxt']; ?>
">
             &nbsp;&nbsp;
              <input type='checkbox' name="is_geic" value="new" <?php if ($this->_tpl_vars['is_geic'] == 'new'): ?> checked <?php endif; ?>>From GEIC
              
              &nbsp;&nbsp;
              <input type="submit" value="QUERY" name="bt_name" style="font-weight:bold;" ></td>
          </tr>
        </table></td>
    </tr>
    <tr><td align="left" colspan="9" class="greybg">&nbsp;</td></tr>
    <tr>
      <td align="left" colspan="9" class="rowodd"><span class="highyellow"><?php echo $this->_tpl_vars['page_url']; ?>
</span></td>
    </tr>
    <tr align="center" class="totalrowodd">
      <td width="10%">Input Date</td>
      <td width="15%">Last Name</td>
      <td width="15%">First Name</td>
      <td width="10%">English Name</td>
      <td width="10%">Gender</td>
      <td width="10%">DoB</td>
      <td>Client Type</td>
    </tr>
    <?php $_from = $this->_tpl_vars['client_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cid'] => $this->_tpl_vars['arr']):
?>
    <tr class="<?php if ($this->_tpl_vars['arr']['status'] == 'new'): ?>yellowbg<?php else:  echo smarty_function_cycle(array('values' => 'rowodd,roweven'), $this); endif; ?>">
      <td align="center" class="border_1" nowrap="nowrap"><?php echo $this->_tpl_vars['arr']['sign']; ?>
</td>
      <td align="center" class="border_1"><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['redir_url'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['cid']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['cid'])); ?>
" target="_self"><?php if ($this->_tpl_vars['arr']['lname'] != ''):  echo ((is_array($_tmp=$this->_tpl_vars['arr']['lname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 1) : smarty_modifier_wordwrap($_tmp, 1));  else: ?>n/a<?php endif; ?></a></td>
      <td align="center" class="border_1"><?php echo $this->_tpl_vars['arr']['fname']; ?>
</td>
      <td align="center" class="border_1"><?php echo $this->_tpl_vars['arr']['ename']; ?>
</td>
      <td align="center" class="border_1"><?php echo $this->_tpl_vars['arr']['gender']; ?>
</td>
      <td align="center" class="border_1"><?php echo $this->_tpl_vars['arr']['dob']; ?>
</td>
      <td align="center" class="border_1">
        <?php $_from = $this->_tpl_vars['arr']['type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['typ']):
?>
          <?php echo $this->_tpl_vars['typ']; ?>
,&nbsp;
        <?php endforeach; endif; unset($_from); ?>
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
        <?php if ($this->_tpl_vars['ugs']['b_abouts']['v'] == 1): ?>
    <tr><td align="left" colspan="9" class="greybg">&nbsp;</td></tr>
    <tr>
      <td align="left" colspan="9" class="greybg">
     	  <!--<?php echo smarty_function_counter(array('start' => 1,'assign' => 'no'), $this);?>
-->
      	  <?php $_from = $this->_tpl_vars['abouts']['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['num']):
?>
             <!--<?php echo smarty_function_counter(array('assign' => 'no'), $this);?>

             <?php if ($this->_tpl_vars['no']%7 == 0): ?><p/><?php endif; ?>-->
              <li>
                <span style="color:#000; font-weight:400"><?php echo $this->_tpl_vars['id']; ?>
:(<?php echo ((is_array($_tmp=$this->_tpl_vars['num']/$this->_tpl_vars['totalabouts']*100)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
%) &nbsp;&nbsp;</span>
                <?php if ($this->_tpl_vars['id'] == 'Others'): ?>
                	<ul>
	                <?php echo smarty_function_counter(array('start' => 1,'assign' => 'no'), $this);?>

    	            <?php $_from = $this->_tpl_vars['abouts']['other']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id2'] => $this->_tpl_vars['num2']):
?>
               	        <?php echo smarty_function_counter(array('assign' => 'no'), $this);?>

        	    	    <?php echo $this->_tpl_vars['id2']; ?>
:(<?php echo ((is_array($_tmp=$this->_tpl_vars['num2']/$this->_tpl_vars['num']*100)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
%)&nbsp;&nbsp;
                        <?php if ($this->_tpl_vars['no']%7 == 0): ?><br/><?php endif; ?> 
            	    <?php endforeach; endif; unset($_from); ?>
                    </ul>
                <?php endif; ?>
              </li>
          <?php endforeach; endif; unset($_from); ?> 
 
         </td>
    </tr>
    <?php endif; ?>
  </table>
</form>
<?php echo '
<script type="text/javascript">
	$(\'#t_fdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true});        
	$(\'#t_tdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
'; ?>
	
</body>
</html>