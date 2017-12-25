<?php /* Smarty version 2.6.13, created on 2014-12-14 14:22:24
         compiled from agent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'agent.tpl', 83, false),array('modifier', 'string_format', 'agent.tpl', 103, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Institute</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="../css/jquery-ui-1.10.3.custom.css" />
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>

<script language="javascript" src="../js/RolloverTable.js"></script>
<script language="javascript" src="../js/audit.js"></script>

<body>
<table width="100%" class="graybordertable" cellpadding="0" cellspacing="0">
  <form action=""  target="_self" method="POST" name="form1">
    <input type="hidden" name="qflag" value="">
    <input type="hidden" name="status" value="">
    <tr  class="bordered_2" >
      <td colspan="11"><select name="t_form" onChange="this.form.submit();">
          
				<?php if ($this->_tpl_vars['ugs']['a_top']['v'] == 1): ?>
          <option value="top" <?php if ($this->_tpl_vars['form'] == 'top'): ?> selected <?php endif; ?>>Top-Agent</option>
           <?php endif; ?>
				<?php if ($this->_tpl_vars['ugs']['a_sub']['v'] == 1): ?>
          <option value="sub" <?php if ($this->_tpl_vars['form'] == 'sub'): ?> selected <?php endif; ?>>Sub-Agent</option>
           <?php endif; ?>
			    <?php if ($this->_tpl_vars['form'] == ''): ?>
					
          <option value="" selected>select an agent</option>
          
				<?php endif; ?>				
			
        </select>
        <?php if ($this->_tpl_vars['ugs']['a_top']['v'] == 1): ?>
        <input type="button" value="Add Top-agent" onClick="javascript:this.form.status.value='top';this.form.action='agent_add.php';this.form.submit();" style="font-weight:bold;">
        &nbsp;&nbsp;
        <?php endif; ?>
        <?php if ($this->_tpl_vars['ugs']['a_sub']['v'] == 1): ?>
        <input type="button" value="Add Sub-agent" onClick="javascript:this.form.status.value='sub';this.form.action='agent_add.php';this.form.submit();" style="font-weight:bold;">
        &nbsp;&nbsp;
        <?php endif; ?>
        <?php if ($this->_tpl_vars['ugs']['a_del']['v'] == 1): ?>
        <input type="button" value="Remove" onClick="remove_confirm(this.form);" style="font-weight:bold;">
        <?php endif; ?>	
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" style="font-weight:bold" onClick="printPage();"value="Print">
      </td>
    </tr>
    <tr class="bordered_2">
      <td colspan="11" style="padding-top:10px"><strong>[First semester start date] From: &nbsp;</strong>
        <input type="text"	 id="t_fdate" name="t_fdate" value="<?php echo $this->_tpl_vars['from']; ?>
"onChange="audit_date(this)">           
        &nbsp;&nbsp; <strong>To: &nbsp;</strong>
        <input type="text"	id="t_tdate"  name="t_tdate" value="<?php echo $this->_tpl_vars['to']; ?>
" onChange="audit_date(this)">             
        &nbsp;&nbsp;
        <input type="submit" value="Query" name="qSubmit" style="font-weight:bold;" >
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php if ($this->_tpl_vars['ugs']['a_top']['v'] == 1 && $this->_tpl_vars['form'] == 'top' && $this->_tpl_vars['ugs']['export']['v'] == 1): ?>
        <input type="submit" value="Export Top Agent Emails" name="bt_export" style="font-weight:bold;">
        <?php elseif ($this->_tpl_vars['ugs']['a_sub']['v'] == 1 && $this->_tpl_vars['form'] == 'sub' && $this->_tpl_vars['ugs']['export']['v'] == 1): ?>
        <input type="submit" value="Export Sub Agent Emails" name="bt_export" style="font-weight:bold;">
        <?php endif; ?> </td>
    </tr>
    <tr align="left" class="greybg">
      <td colspan="11" class="highyellow">Student: <?php echo $this->_tpl_vars['totals']['total']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;Offer: <?php echo $this->_tpl_vars['totals']['offer']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;Coe: <?php echo $this->_tpl_vars['totals']['coe']; ?>
</td>
    </tr>      
    <tr class="totalrowodd">
      <td width="2%"  align="center" class="border_1"><input type="checkbox" name="toggleAll" onClick="rowToggleAll(this);"></td>
      <td align="left" class="border_1" width="2%" nowrap="nowrap">Verified</td>
      <td align="left" class="border_1" width="15%" nowrap="nowrap">Name</td>
      <td align="left" class="border_1" width="7%" nowrap="nowrap">City</td>
      <td align="left" class="border_1" width="10%" nowrap="nowrap">Country</td>
      <td align="left" class="border_1" width="10%" nowrap="nowrap">Status</td>
      <td align="left" class="border_1" width="5%" nowrap="nowrap">Studnets</td>
      <td align="right" class="border_1" width="5%" nowrap="nowrap">Get Offers</td>
      <td align="right"class="border_1" width="5%" nowrap="nowrap">Get COEs</td>
      <td align="right" class="border_1" width="7%" nowrap="nowrap"><?php if ($this->_tpl_vars['ugs']['a_rev']['v'] == 1): ?>Receivable<br>
        Commossion<?php endif; ?></td>
      <td align="right" class="border_1" width="7%" nowrap="nowrap"><?php if ($this->_tpl_vars['ugs']['a_rev']['v'] == 1): ?>Paid<br>
        Commossion<?php endif; ?></td>
    </tr>
    <?php $_from = $this->_tpl_vars['totals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['catid'] => $this->_tpl_vars['v']):
?>
    <tr class="border_1" style="background-color:<?php echo smarty_function_cycle(array('values' => "#80FF80,#FFFF99,#CA95FF,#6C6CFF,#C78D8D,#7ABCBC"), $this);?>
" colspan="2">
      <td align="center" class="border_1" colspan="6" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $this->_tpl_vars['v']['n']; ?>
</td>
      <td align="left" class="border_1"nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $this->_tpl_vars['v']['s']; ?>
</td>
      <td align="right" class="border_1" nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $this->_tpl_vars['v']['o']; ?>
</td>
      <td align="right"class="border_1"nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php echo $this->_tpl_vars['v']['c']; ?>
</td>
      <td align="right" class="border_1"  nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php if ($this->_tpl_vars['ugs']['a_rev']['v'] == 1):  echo $this->_tpl_vars['v']['rc'];  endif; ?></td>
      <td align="right" class="border_1" nowrap="nowrap" style="font-size:14px; font-weight:bolder; font-style:italic"><?php if ($this->_tpl_vars['ugs']['a_rev']['v'] == 1):  echo $this->_tpl_vars['v']['pc'];  endif; ?></td>
    </tr>    
    <?php $_from = $this->_tpl_vars['v']['aid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id']):
?>
    <tr id="tr_<?php echo $this->_tpl_vars['id']; ?>
" onMouseOut="roff(<?php echo $this->_tpl_vars['id']; ?>
);" onMouseOver="ron(<?php echo $this->_tpl_vars['id']; ?>
);">
      <td onClick="rowToggle(<?php echo $this->_tpl_vars['id']; ?>
);" align="center" class="border_1"><input type="checkbox" id="box_<?php echo $this->_tpl_vars['id']; ?>
" onClick="toggleRow(this);" name="agentId[]" value="<?php echo $this->_tpl_vars['id']; ?>
">
      </td>
      <td align="center" class="border_1" nowrap="nowrap"><?php if ($this->_tpl_vars['agent_arr'][$this->_tpl_vars['id']]['verify'] == 1): ?><span style="font-size:18px;font-weight: bolder; color: #FF0000">&radic;</span><?php else: ?>&nbsp;&nbsp;<?php endif; ?></td>
      <td align="left" class="border_1" nowrap="nowrap"><a href="agent_add.php?aid=<?php echo $this->_tpl_vars['id']; ?>
" target="_self"><?php echo $this->_tpl_vars['agent_arr'][$this->_tpl_vars['id']]['name']; ?>
</a></td>
      <td align="left"class="border_1" nowrap="nowrap"><?php echo $this->_tpl_vars['agent_arr'][$this->_tpl_vars['id']]['city']; ?>
</td>
      <td align="left"class="border_1" nowrap="nowrap"><?php echo $this->_tpl_vars['agent_arr'][$this->_tpl_vars['id']]['cn']; ?>
</td>
      <td align="left"class="border_1" nowrap="nowrap"><?php echo $this->_tpl_vars['agent_arr'][$this->_tpl_vars['id']]['sn']; ?>
</td>
      <td align="left"class="border_1" nowrap="nowrap"><?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['id']]['stdcnt'] > 0): ?> <?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['id']]['stdcnt']; ?>
 <?php else: ?>0<?php endif; ?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['id']]['offer'] > 0): ?> <?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['id']]['offer']; ?>
 <?php else: ?>0<?php endif; ?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($this->_tpl_vars['stats'][$this->_tpl_vars['id']]['coe'] > 0): ?> <?php echo $this->_tpl_vars['stats'][$this->_tpl_vars['id']]['coe']; ?>
 <?php else: ?>0<?php endif; ?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($this->_tpl_vars['ugs']['a_rev']['v'] == 1):  if ($this->_tpl_vars['stats'][$this->_tpl_vars['id']]['coe'] > 0): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['stats'][$this->_tpl_vars['id']]['rcomm'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <?php else: ?>0.00<?php endif;  endif; ?></td>
      <td align="right"class="border_1" nowrap="nowrap"><?php if ($this->_tpl_vars['ugs']['a_rev']['v'] == 1):  if ($this->_tpl_vars['stats'][$this->_tpl_vars['id']]['coe'] > 0): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['stats'][$this->_tpl_vars['id']]['pcomm'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <?php else: ?>0.00<?php endif;  endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    <?php endforeach; endif; unset($_from); ?>
    <!--
   <tr >
   	<td align="right" colspan="6"><?php echo $this->_tpl_vars['page_url']; ?>
</td>
   </tr>
   -->
  </form>
</table>

<?php echo '
<script type="text/javascript">
	function remove_confirm(form) {	
		if(confirm("Are you sure you want to remove this subagent?")){form.qflag.value=\'remove\';form.submit();}	
	}
	$(\'#t_fdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$(\'#t_tdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
'; ?>
	
</body>
</html>